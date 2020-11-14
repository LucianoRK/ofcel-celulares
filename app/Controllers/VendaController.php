<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\EmpresaModel;
use App\Models\EstoqueModel;
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
		$vendaModel = new VendaModel;
		//Sessão
		$empresaSessao = $this->session->get('empresa');

		//Carrega as variáveis
		$whereVendas = [
			'venda.empresa_id' => $empresaSessao['empresa_id'],
			'DATE(venda.created_at)' => date('Y-m-d')
		];
		$dados['vendasAtiva']    = $vendaModel->get($whereVendas);
		$dados['vendasInativa']  = $vendaModel->getDeleted($whereVendas);

		return $this->template('venda', 'index', $dados);
	}

	/**
	 * Mostra um item específico
	 */
	public function show()
	{
		//Get request
		$request = $this->request->getVar();
		//Carrega os modelos
		$vendaModel 			  = new VendaModel;
		$vendaEstoqueModel        = new VendaEstoqueModel;
		$vendaFormaPagamentoModel = new VendaFormaPagamentoModel;
		//prepara as variáveis
		$dados['base']          	  = $this;
		$dados['valorTotalProduto']   = 0.00;
		$dados['valorTotalFormaPag']  = 0.00;
		$dados['venda']               = $vendaModel->get(['venda.venda_id' => $request['vendaId']], true);
		$dados['vendaEstoque']        = $vendaEstoqueModel->get(['venda_id' => $request['vendaId']]);
		$dados['vendaFormaPagamento'] = $vendaFormaPagamentoModel->get(['venda_id' => $request['vendaId']]);

		return view('venda/show', $dados);
	}

	/**
	 * Mostra um item específico
	 */
	public function print($id)
	{
		//Carrega os modelos
		$vendaModel 			  = new VendaModel;
		$vendaEstoqueModel        = new VendaEstoqueModel;
		$vendaFormaPagamentoModel = new VendaFormaPagamentoModel;
		$empresaModel             = new EmpresaModel;

		//prepara as variáveis
		$dados['venda'] = $vendaModel->get(['venda.venda_id' => $id], true);

		if ($dados['venda']) {
			//prepara as variáveis
			$dados['valorTotalProduto']   = 0.00;
			$dados['valorTotalFormaPag']  = 0.00;
			$dados['vendaEstoque']        = $vendaEstoqueModel->get(['venda_id' => $id]);
			$dados['vendaFormaPagamento'] = $vendaFormaPagamentoModel->get(['venda_id' => $id]);
			$dados['empresa']             = $empresaModel->get(['empresa_id' => $dados['venda']['empresa_id']], true);

			return $this->template_publico('venda', 'print', $dados);
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Venda não localizada.', 'error');
			//Redireciona
			return redirect()->to('/venda');
		}
	}

	/**
	 * Retorna a View para criar um item da tabela
	 */
	public function create()
	{
		if ($this->caixaInicializado()) {
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
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Caixa não inicializado', 'info');

			return redirect()->to('/caixa/create');
		}
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
			$estoqueModel 			  = new EstoqueModel;
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
			foreach ($request['produtosEstoque'] as $key => $estoqueId) {
				//Prepara os dados
				$dadosProdutoEstoque = [
					'venda_id'       => $vendaId,
					'estoque_id'     => $estoqueId,
					'valor_venda'    => $this->realToSql($request['valores'][$key])
				];
				//Salva as vendas itens
				$vendaEstoqueModel->save($dadosProdutoEstoque);
				//Pego o estoque deste produto
				$estoqueItem = $estoqueModel->getById($estoqueId);
				//Verifico se existe mais que 0 no estoque
				if ($estoqueItem['quantidade'] > 0) {
					$quantidadeEstoque = $estoqueItem['quantidade'] - 1;
				} else {
					$quantidadeEstoque = 0;
				}
				//Preparo os dados
				$dadosEstoque = [
					'estoque_id'     => $estoqueId,
					'quantidade'     => $quantidadeEstoque
				];
				//Salva
				$estoqueModel->save($dadosEstoque);
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
			return redirect()->to('/venda/create');
		}
	}

	public function editObservacao()
	{
		//Get request
		$request = $this->request->getVar();
		//Carrega os modelos
		$vendaModel   = new VendaModel;
		//Prepara os dados
		$dadosVenda = [
			'venda_id'    => $request['vendaId'],
			'observacao'  => $request['observacao']
		];
		
		return $vendaModel->save($dadosVenda);

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
	 * Desativa a venda (Extorno)
	 */
	public function desativarVenda()
	{
		//Get request
		$request = $this->request->getVar();
		//Carrega os modelos
		$vendaModel         = new VendaModel;
		$vendaEstoqueModel  = new VendaEstoqueModel;
		$estoqueModel       = new EstoqueModel;
		//deleta o usuário (safe mode)
		$dados = $vendaModel->delete($request['vendaId']);
		//Devolve os itens para o estoque
		$produtosEstoque = $vendaEstoqueModel->get(['venda_id' => $request['vendaId']]);
		//Percorre todos os itens da venda
		foreach ($produtosEstoque as $produtoEstoque) {
			$estoqueItem = $estoqueModel->getById($produtoEstoque['estoque_id']);
			//Adiciona +1 no estoque
			$quantidadeEstoque = $estoqueItem['quantidade'] + 1;
			//Preparo os dados
			$dadosEstoque = [
				'estoque_id'     => $produtoEstoque['estoque_id'],
				'quantidade'     => $quantidadeEstoque
			];
			//Salva
			$estoqueModel->save($dadosEstoque);
		}
		$this->setFlashdata('Venda extornada com sucesso.', 'success');

		return $this->response->setJSON($dados);
	}
}
