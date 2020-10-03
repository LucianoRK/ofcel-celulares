<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\UsuarioEmpresaModel;
use App\Models\UsuarioModel;
use App\Models\UsuarioTipoModel;
use CodeIgniter\Config\Services;

class UsuarioController extends BaseController
{
	public function __construct()
	{

	}

	/////////////////////////////
	//                         //
	//	        CRUD           //
	//                         //
	/////////////////////////////

	/**
	 * Pagina inicial do módulo
	 */
	public function index()
	{
		//Carrega os modelos
		$usuario = new UsuarioModel();

		//Carrega as variáveis
		$dados['usuariosAtivo']    = $usuario->get();
		$dados['usuariosInativos'] = $usuario->getDeleted();
		
		return $this->template('usuario', 'index', $dados);
	}

	/**
	 * Mostra um item específico
	 */
	public function show()
	{
		//
	}

	/**
	 * Retorna a View para criar um item da tabela
	 */
	public function create()
	{
		//Carrega os modelos
		$usuarioTipo = new UsuarioTipoModel();
		$empresas    = new EmpresaModel();
		//Carrega as variáveis
		$dados['usuarioTipo'] = $usuarioTipo->get();
		$dados['empresas']    = $empresas->get();

		return $this->template('usuario', 'create', $dados);
	}

	/**
	 * Salva o novo item na tabela
	 */
	public function store()
	{
		//Get request
		$request = $this->request->getVar();

		//Rules
		$rules = [
			'nome' => 'required',
			'login' => 'required|min_length[4]',
			'senha' => 'required|min_length[6]',
			'tipoUsuario' => 'required',
		];

		if ($this->validate($rules)) {
			//Carrega os modelos
			$usuarioModel         = new UsuarioModel();
			$usuarioEmpresaModel  = new UsuarioEmpresaModel();

			//Prepara os dados do Usuário
			$dadosUsuario = [
				'nome'             => !empty($request['nome'])         ? $request['nome']                        : null,
				'login'            => !empty($request['login'])        ? $request['login']                       : null,
				'senha'            => !empty($request['senha'])        ? $this->criptografia($request['senha'])  : null,
				'usuario_tipo_id'  => !empty($request['tipoUsuario'])  ? $request['tipoUsuario']                 : null,
				'telefone'         => !empty($request['telefone'])     ? $request['telefone']                    : null,
				'email'            => !empty($request['email'])        ? $request['email']                       : null
			];
			//Salva o usuário
			$usuarioModel->save($dadosUsuario);
			//Pega o id inserido			
			$usuarioId = $usuarioModel->getInsertID();

			if (!empty($request['empresas'])) {
				foreach ($request['empresas'] as $key => $empresa) {
					$principal = null;
					if (!empty($request['empresaPrincipal'][$key])) {
						$principal = 1;
					}
					//Prepara os dados da empresa
					$dadosUsuarioEmpresa = [
						'empresa_id'   => !empty($empresa)   ? $empresa    : null,
						'usuario_id'   => !empty($usuarioId) ? $usuarioId  : null,
						'principal'    => !empty($principal) ? $principal  : null,
					];

					//Salva as empresas do usuário
					$usuarioEmpresaModel->save($dadosUsuarioEmpresa);
				}
			}

			//Mensagem de retorno
			$this->setFlashdata('Usuário cadastrado com sucesso !', 'success');

			return redirect()->to('/usuario');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/usuario/create');
		}
	}

	/**
	 * Retorna a View para edição do dado
	 */
	public function edit($id)
	{
		//Carrega os modelos
		$usuarioModel         = new UsuarioModel();
		$usuarioEmpresaModel  = new UsuarioEmpresaModel();
		$usuarioTipoModel     = new UsuarioTipoModel();
		$empresaModel         = new EmpresaModel();

		//Prepara as variáveis iniciais
		$dados['usuario']         = $usuarioModel->getById($id);
		$dados['usuarioEmpresas'] = $usuarioEmpresaModel->get(['usuario_id' => $id]);

		$dados['usuarioTipo'] = $usuarioTipoModel->get();
		$dados['empresas']    = $empresaModel->get();

		if ($dados['usuario']) {
			return $this->template('usuario', 'edit', $dados);
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Usuário não encontrado !', 'error');
			return redirect()->to('/usuario');
		}
	}

	/**
	 * Salva a atualização do dado
	 */
	public function update($id)
	{
		//Get request
		$request = $this->request->getVar();

		//Rules
		$rules = [
			'nome' => 'required',
			'login' => 'required|min_length[4]',
			'tipoUsuario' => 'required',
		];

		if ($this->validate($rules)) {
			//Carrega os modelos
			$usuarioModel         = new UsuarioModel();
			$usuarioEmpresaModel  = new UsuarioEmpresaModel();

			if (!empty($request['senha'])) {
				//Rules
				$rulesSenha = [
					'senha' => 'min_length[6]',
				];
				//Verifica as regras da senha
				if ($this->validate($rulesSenha)) {
					$senhaAlterada = [
						'usuario_id' => $id,
						'senha'      => $this->criptografia($request['senha'])
					];
					//Salva a senha
					$usuarioModel->save($senhaAlterada);
				} else {
					//Mensagem de retorno
					$this->setFlashdata('A senha deve conter pelo menos 6 digitos !', 'error');

					return redirect()->to('/usuario/edit/' . $id);
				}
			}

			//Prepara os dados do Usuário
			$dadosUsuario = [
				'usuario_id'       => $id,
				'nome'             => !empty($request['nome'])         ? $request['nome']          : null,
				'login'            => !empty($request['login'])        ? $request['login']         : null,
				'usuario_tipo_id'  => !empty($request['tipoUsuario'])  ? $request['tipoUsuario']   : null,
				'telefone'         => !empty($request['telefone'])     ? $request['telefone']      : null,
				'email'            => !empty($request['email'])        ? $request['email']         : null
			];
			//Salva o usuário
			$usuarioModel->save($dadosUsuario);
			//Pega o id do usuário			
			$usuarioId = $id;

			//limpa as informações de empresa
			$usuarioEmpresaModel->where('usuario_id', $usuarioId)->delete();

			if (!empty($request['empresas'])) {
				foreach ($request['empresas'] as $key => $empresa) {
					$principal = null;
					if (!empty($request['empresaPrincipal'][$key])) {
						$principal = 1;
					}
					//Prepara os dados da empresa
					$dadosUsuarioEmpresa = [
						'empresa_id'   => !empty($empresa)   ? $empresa    : null,
						'usuario_id'   => !empty($usuarioId) ? $usuarioId  : null,
						'principal'    => !empty($principal) ? $principal  : null,
					];

					//Salva as empresas do usuário
					$usuarioEmpresaModel->save($dadosUsuarioEmpresa);
				}
			}

			//Mensagem de retorno
			$this->setFlashdata('Usuário alterado com sucesso !', 'success');

			return redirect()->to('/usuario');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/usuario/create');
		}
	}

	/**
	 * Remove ou desabilita o dado
	 */
	public function destroy()
	{
		//
	}

	/////////////////////////////
	//                         //
	//	   Outras funções      //
	//                         //
	/////////////////////////////

	/**
	 * Remove ou desabilita o dado
	 */
	public function verificarLoginRepetido()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$usuarioModel  = new UsuarioModel();

		//Get dados
		$dados = $usuarioModel->get(['login' => $request['login']], true);

		return $this->response->setJSON($dados);
	}

	/**
	 * Remove ou desabilita o dado
	 */
	public function desativarUsuario()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$usuarioModel  = new UsuarioModel();

		//deleta o usuário (safe mode)
		$dados = $usuarioModel->delete($request['usuarioId']);

		return $this->response->setJSON($dados);
	}

	/**
	 * Remove ou desabilita o dado
	 */
	public function ativarUsuario()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$usuarioModel  = new UsuarioModel();

		//deleta o usuário (safe mode)
		$dados = $usuarioModel->update($request['usuarioId'], ['deleted_at' => null]);

		return $this->response->setJSON($dados);
	}
}
