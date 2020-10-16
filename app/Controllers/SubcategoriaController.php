<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\SubcategoriaModel;

class SubcategoriaController extends BaseController
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
		$categoriaModel    = new CategoriaModel();
		$subcategoriaModel = new SubcategoriaModel();

		//Carrega as variáveis
		$dados['categorias']            = $categoriaModel->get();
		$dados['subcategoriasAtivo']    = $subcategoriaModel->get();
		$dados['subcategoriasInativo']  = $subcategoriaModel->getDeleted();

		return $this->template('subcategoria', 'index', $dados);
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
			'nome' => 'required',
			'categoria' => 'required'
		];

		if ($this->validate($rules)) {
			//Carrega os modelos
			$subcategoriaModel  = new SubcategoriaModel();

			//Prepara os dados 
			$dadosSubcategoria = [
				'categoria_id' =>  $request['categoria'],
				'nome'         => !empty($request['nome']) ? $request['nome'] : null
			];
			//Salva os dados
			$subcategoriaModel->save($dadosSubcategoria);

			//Mensagem de retorno
			$this->setFlashdata('Subcategoria cadastrada com sucesso !', 'success');

			return redirect()->to('/subcategoria');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/subcategoria');
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
			'subcategoriaId' => 'required',
			'categoria' => 'required'
		];

		if ($this->validate($rules)) {
			//Carrega os modelos
			$subcategoriaModel  = new SubcategoriaModel();

			//Prepara os dados 
			$dadosSubcategoria = [
				'subcategoria_id' => $request['subcategoriaId'],
				'categoria_id'    =>  $request['categoria'],
				'nome'            => !empty($request['nome']) ? $request['nome'] : null
			];
			//Salva os dados
			$subcategoriaModel->save($dadosSubcategoria);

			//Mensagem de retorno
			$this->setFlashdata('Subcategoria editada com sucesso !', 'success');

			return redirect()->to('/subcategoria');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/subcategoria');
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
	public function desativarSubcategoria()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$subcategoriaModel  = new SubcategoriaModel();

		//deleta (safe mode)
		$dados = $subcategoriaModel->delete($request['subcategoriaId']);

		return $this->response->setJSON($dados);
	}

	/**
	 * Remove ou desabilita o dado
	 */
	public function ativarSubcategoria()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$subcategoriaModel  = new SubcategoriaModel();

		//deleta (safe mode)
		$dados = $subcategoriaModel->update($request['subcategoriaId'], ['deleted_at' => null]);

		return $this->response->setJSON($dados);
	}

	/**
	 * Remove ou desabilita o dado
	 */
	public function getByCategoria()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$subcategoriaModel  = new SubcategoriaModel();

		//deleta (safe mode)
		$dados   = $subcategoriaModel->get(['subcategoria.categoria_id' => $request['categoria']]);

		return $this->response->setJSON($dados);
	}
}
