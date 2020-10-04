<?php

namespace App\Controllers;

use App\Models\PermissaoModel;
use App\Models\PermissaoUsuarioTipoModel;
use App\Models\UsuarioTipoModel;

class PermissaoController extends BaseController
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
		//$permissoes  = new PermissaoUsuarioTipoModel();
		$usuarioTipo = new UsuarioTipoModel();

		//Carrega as variáveis
		$dados['usuarioTipo']   = $usuarioTipo->get();
		//$dados['permissoes']    = $permissoes->get();

		return $this->template('permissao', 'index', $dados);
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
	}

	/**
	 * Salva o novo item na tabela
	 */
	public function store()
	{
	}

	/**
	 * Retorna a View para edição do dado
	 */
	public function edit($id)
	{
		//Carrega os modelos
		$permissoes          = new PermissaoUsuarioTipoModel();
		$permissoesSistema   = new PermissaoModel();

		//Carrega as variáveis
		$dados['permissoesSistema']  = $permissoesSistema->get();
		$dados['permissoes']         = $permissoes->get(['usuario_tipo_id' => $id]);
		$dados['usurioTipoId']       = $id;

		return $this->template('permissao', 'edit', $dados);
	}

	/**
	 * Salva a atualização do dado
	 */
	public function update($id)
	{
		//Carrega os modelos
		$permissoes  = new PermissaoUsuarioTipoModel();

		//Get request
		$request = $this->request->getVar();

		//limpa as informações de empresa
		$permissoes->where('usuario_tipo_id', $id)->delete();

		if (!empty($request['permissoes'])) {
			foreach ($request['permissoes'] as $key => $permissao) {
				//Prepara os dados da permissão
				$dadosPermissao = [
					'usuario_tipo_id'   => $id,
					'permissao_id'   	=> !empty($permissao) ? $permissao  : null,
				];

				//Salva as empresas do usuário
				$permissoes->save($dadosPermissao);
			}

			//Mensagem de retorno
			$this->setFlashdata('Permissões alteradas com sucesso !', 'success');

			return redirect()->to('/permissao');
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


}
