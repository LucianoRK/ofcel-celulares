<?php

namespace App\Controllers;

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
		$permissoes  = new PermissaoUsuarioTipoModel();
	
		//Carrega as variáveis
		$dados['permissoes']  = $permissoes->get(['usuario_tipo_id' => $id]);

		return $this->template('permissao', 'edit', $dados);
	}

	/**
	 * Salva a atualização do dado
	 */
	public function update($id)
	{
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
