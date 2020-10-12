<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class CategoriaController extends BaseController
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
		$categoriaModel = new CategoriaModel();

		//Carrega as variáveis
		$dados['categoriasAtiva']    = $categoriaModel->get();
		$dados['categoriasInativa'] = $categoriaModel->getDeleted();

		return $this->template('categoria', 'index', $dados);
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
		//Get request
		$request = $this->request->getVar();

		//Rules
		$rules = [
			'nome' => 'required'
		];

		if ($this->validate($rules)) {
			//Carrega os modelos
			$categoriaModel  = new CategoriaModel();

			//Prepara os dados
			$dadosCategoria = [
				'nome'  => !empty($request['nome']) ? $request['nome'] : null
			];

			//Salva 
			$categoriaModel->save($dadosCategoria);

			//Mensagem de retorno
			$this->setFlashdata('Categoria cadastrada com sucesso !', 'success');

			return redirect()->to('/categoria');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/categoria');
		}
	}

	/**
	 * Retorna a View para edição do dado
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Salva a atualização do dado
	 */
	public function update()
	{
		//Get request
		$request = $this->request->getVar();

		//Rules
		$rules = [
			'nome' => 'required',
			'categoriaId' => 'required'
		];

		if ($this->validate($rules)) {
			//Carrega os modelos
			$categoriaModel  = new CategoriaModel();

			//Prepara os dados
			$dadosCategoria = [
				'categoria_id' => $request['categoriaId'],
				'nome'  => !empty($request['nome']) ? $request['nome'] : null
			];
			//Salva os dados
			$categoriaModel->save($dadosCategoria);

			//Mensagem de retorno
			$this->setFlashdata('Categoria editada com sucesso !', 'success');

			return redirect()->to('/categoria');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/categoria');
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
	public function desativarCategoria()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$categoriaModel  = new CategoriaModel();

		//deleta (safe mode)
		$dados = $categoriaModel->delete($request['categoriaId']);

		return $this->response->setJSON($dados);
	}

	/**
	 * Remove ou desabilita o dado
	 */
	public function ativarCategoria()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$categoriaModel  = new CategoriaModel();

		//deleta (safe mode)
		$dados = $categoriaModel->update($request['categoriaId'], ['deleted_at' => null]);

		return $this->response->setJSON($dados);
	}
}
