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
	 * Salva a atualização de permissões do usuário
	 */
	public function update()
	{
		//Carrega os modelos
		$permissoes  = new PermissaoUsuarioTipoModel();

		//Get request
		$request = $this->request->getVar();

		if ($request['checked'] == 'true') {
			//Monta os dados
			$dadosPermissao = [
				'usuario_tipo_id'   => $request['usuarioTipo'],
				'permissao_id'   	=> $request['permissaoId']
			];

			//Salva permissões do usuário
			$permissoes->save($dadosPermissao);
		} else {
			//limpa as informações de permissão
			$permissoes->where('usuario_tipo_id', $request['usuarioTipo'])->where('permissao_id', $request['permissaoId'])->delete();
		}

		return $this->response->setJSON(true);
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
