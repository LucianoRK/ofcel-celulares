<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\EmpresaModel;
use App\Models\FormaPagamentoModel;
use App\Models\ProdutoModel;
use App\Models\UsuarioEmpresaModel;
use App\Models\UsuarioModel;
use App\Models\UsuarioTipoModel;
use App\Models\VendaEstoqueModel;
use App\Models\VendaFormaPagamentoModel;
use App\Models\VendaModel;

class VendaController extends BaseController
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
		$venda = new VendaModel();

		//Carrega as variáveis
		$dados['vendasAtiva']    = $venda->get();
		$dados['vendasInativa']  = $venda->getDeleted();

		return $this->template('venda', 'index', $dados);
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
		$clienteModel 	= new ClienteModel;
		$usuarioModel 	= new UsuarioModel;
		$produtoModel 	= new ProdutoModel;
		$formaPagamento = new FormaPagamentoModel;
		//Sessão
		$empresaSessao = $this->session->get('empresa');
		//Carrega as variáveis
		$dados['clientes'] 		  = $clienteModel->get();
		$dados['usuarios'] 		  = $usuarioModel->get("usuario_tipo_id != 2");
		$dados['produtos'] 		  = $produtoModel->get(['e.empresa_id' => $empresaSessao['empresa_id']]);
		$dados['formasPagamento'] = $formaPagamento->get();

		return $this->template('venda', 'create', $dados);
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
			'cliente'          => 'required',
			'vendedor'         => 'required',
			'produtosEstoque'  => 'required',
			'valores'          => 'required',
			'formasPagamento'  => 'required',
			'valoresPagamento' => 'required'
		];
		if ($this->validate($rules)) {
			//Carrega os modelos
			$vendaModel               = new VendaModel;
			$vendaEstoqueModel        = new VendaEstoqueModel;
			$vendaFormaPagamentoModel = new VendaFormaPagamentoModel;

			//Sessão
			$empresaSessao = $this->session->get('empresa');

			//Prepara os dados
			$dadosVenda = [
				'empresa_id'  => $empresaSessao['empresa_id'],
				'usuario_id'  => $request['vendedor'],
				'cliente_id'  => $request['cliente'],
				'observacao'  => $this->validarEmpty($request['observacao'])
			];
			//Salva 
			$vendaModel->save($dadosVenda);
			//Pega a id da venda
			$vendaId = $vendaModel->getInsertID();
			//Percorre todos os produtos
			foreach ($request['produtosEstoque'] as $key => $produtosEstoque) {
				//Prepara os dados da empresa
				$dadosProdutoEstoque = [
					'venda_id'       => $vendaId,
					'estoque_id'     => $produtosEstoque,
					'valor_venda'    => $this->realToSql($request['valores'][$key])
				];
				//Salva as vendas itens
				$vendaEstoqueModel->save($dadosProdutoEstoque);
			}
			//Percorre todos as formas de pagamento
			foreach ($request['formasPagamento'] as $key => $formaPagamento) {
				//Prepara os dados da empresa
				$dadosVendaFormaPagamento = [
					'venda_id'           => $vendaId,
					'forma_pagamento_id' => $formaPagamento,
					'valor'              => $this->realToSql($request['valoresPagamento'][$key])
				];
				//Salva as vendas itens
				$vendaFormaPagamentoModel->save($dadosVendaFormaPagamento);
			}

			//Mensagem de retorno
			$this->setFlashdata('Venda cadastrado com sucesso !', 'success');
			//Redireciona
			return redirect()->to('/venda');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');
			//Redireciona
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
