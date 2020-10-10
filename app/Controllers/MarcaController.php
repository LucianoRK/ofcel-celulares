<?php

namespace App\Controllers;

use App\Models\MarcaModel;

class MarcaController extends BaseController
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
		$MarcaModel = new MarcaModel();

		//Carrega as variáveis
		$dados['marcasAtivo']    = $MarcaModel->get();
		$dados['marcasInativos'] = $MarcaModel->getDeleted();

		return $this->template('marca', 'index', $dados);
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
			$marcaModel  = new MarcaModel();

			//Prepara os dados do Usuário
			$dadosMarca = [
				'nome'  => !empty($request['nome']) ? $request['nome'] : null
			];
			//Salva o usuário
			$marcaModel->save($dadosMarca);

			//Mensagem de retorno
			$this->setFlashdata('Marca cadastrada com sucesso !', 'success');

			return redirect()->to('/marca');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/marca');
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
			'marcaId' => 'required'
		];

		if ($this->validate($rules)) {
			//Carrega os modelos
			$marcaModel  = new MarcaModel();

			//Prepara os dados do Usuário
			$dadosMarca = [
				'marca_id' => $request['marcaId'],
				'nome'  => !empty($request['nome']) ? $request['nome'] : null
			];
			//Salva o usuário
			$marcaModel->save($dadosMarca);

			//Mensagem de retorno
			$this->setFlashdata('Marca editada com sucesso !', 'success');

			return redirect()->to('/marca');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/marca');
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
	public function desativarMarca()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$marcaModel  = new MarcaModel();

		//deleta (safe mode)
		$dados = $marcaModel->delete($request['marcaId']);

		return $this->response->setJSON($dados);
	}

	/**
	 * Remove ou desabilita o dado
	 */
	public function ativarMarca()
	{
		//Get request
		$request = $this->request->getVar();

		//Carrega os modelos
		$marcaModel  = new MarcaModel();

		//deleta o usuário (safe mode)
		$dados = $marcaModel->update($request['marcaId'], ['deleted_at' => null]);

		return $this->response->setJSON($dados);
	}
}
