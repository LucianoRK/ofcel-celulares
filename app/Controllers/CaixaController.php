<?php

namespace App\Controllers;

use App\Models\CaixaLancamentoModel;
use App\Models\CaixaModel;
use App\Models\EmpresaModel;
use App\Models\VendaFormaPagamentoModel;

class CaixaController extends BaseController
{
	public function __construct()
	{
	}
	/////////////////////////////
	//                         //
	//	        Paginas        //
	//                         //
	/////////////////////////////

	/**
	 * Pagina inicial do módulo
	 */
	public function index()
	{
		$empresaModel    		  = new EmpresaModel;
		$caixaModel    		      = new CaixaModel;
		$vendaFormaPagamentoModel = new VendaFormaPagamentoModel;
		$caixaLancamentoModel     = new CaixaLancamentoModel;
		//Sessão
		$empresaSessao   = $this->session->get('empresa');
		$empresaSessaoId = $empresaSessao['empresa_id'];
		//Carrega as variáveis
		//Busca o caixa do dia
		$dados['caixa']	= $caixaModel->get("empresa_id = $empresaSessaoId AND DATE(created_at) = DATE(NOW())", true);
		//Verifica se o caixa existe, caso contrario redireciona para a criação do mesmo
		if ($this->caixaInicializado()) {
			//Pega carrega as variaveis da tela
			$caixaId 						= $dados['caixa']['caixa_id'];
			$dados['empresas'] 				= $empresaModel->get();
			$dados['venda']   				= $vendaFormaPagamentoModel->getValores("v.empresa_id = $empresaSessaoId AND DATE(v.created_at) = DATE(NOW())");
			$dados['ordemServico']   		= $vendaFormaPagamentoModel->getValores("v.empresa_id = $empresaSessaoId AND DATE(v.created_at) = DATE('2000-01-01')"); // Alterar para ordem serviço
			$dados['caixaLancamentos']		= $caixaLancamentoModel->get("caixa_id = $caixaId AND DATE(created_at) = DATE(NOW())");
			$dados['venda']['total']   		= array_sum($dados['venda']);
			$dados['ordemServico']['total'] = array_sum($dados['ordemServico']);
			//Inicia os valores totais de lançamento
			$totalLancamento 	  = 0.00;
			$totalRetirada   	  = 0.00;
			$dados['totalGeral']  = 0.00;
			//Verifica se existe lançamentos neste caixa
			if ($dados['caixaLancamentos']) {
				foreach ($dados['caixaLancamentos'] as $lancamento) {
					//Verifica o tipo de lançamento
					if ($lancamento['tipo'] == 1) {
						//lançamentos
						$totalLancamento += $lancamento['valor'];
					} else {
						//Retirada
						$totalRetirada += $lancamento['valor'];
					}
				}
				//Total Geral = O.s + Vendas + lançamentos - retiradas
				$dados['totalGeral'] = ($dados['venda']['dinheiro'] + $dados['ordemServico']['total'] + $totalLancamento) - $totalRetirada;
			}

			return $this->template('caixa', 'index', $dados);
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Caixa ainda não inicializado na data de hoje', 'info');

			return redirect()->to('/caixa/create');
		}
	}

	public function create()
	{
		if($this->caixaInicializado()){
			return redirect()->to('/caixa');
		}else{
			return $this->template('caixa', 'create');
		}
	}

	/////////////////////////////
	//                         //
	//	        CRUD           //
	//                         //
	/////////////////////////////


	/**
	 * Salva o novo item na tabela
	 */
	public function store()
	{
		//Get request
		$request = $this->request->getVar();
		//Rules
		$rules = [
			'valor' => 'required'
		];
		if ($this->validate($rules)) {
			//Carrega os modelos
			$caixaLancamentoModel  = new CaixaLancamentoModel;
			$caixaModel                 = new CaixaModel;
			//Sessão
			$empresaSessao   = $this->session->get('empresa');
			$usuarioSessao   = $this->session->get('usuario');
			$empresaSessaoId = $empresaSessao['empresa_id'];
			$usuarioSessaoId = $usuarioSessao['usuario_id'];
			//Carrega as variáveis
			//Busca o caixa do dia
			$caixaHoje	= $caixaModel->get("empresa_id = $empresaSessaoId AND DATE(created_at) = DATE(NOW())", true);
			//Verifica se já existe o caixa desta empresa hoje
			if (!$caixaHoje) {
				//Prepara os dados 
				$dadosCaixa = [
					'empresa_id'	=>  $empresaSessaoId,
					'usuario_id'	=>  $usuarioSessaoId
				];
				//Salva
				$caixaModel->save($dadosCaixa);
				//Pega o id inserido
				$caixaId = $caixaModel->getInsertID();
				//Prepara os dados 
				$dadosLancamento = [
					'caixa_id'	=>  $caixaId,
					'nome'   	=>  'Valor Inicial de caixa',
					'valor'  	=>  $this->validarEmpty($this->realToSql($request['valor'])),
					'tipo'   	=>  '1'
				];
				//Salva os dados
				$caixaLancamentoModel->save($dadosLancamento);
				//Mensagem de retorno
				$this->setFlashdata('Caixa criado com sucesso', 'success');

				return redirect()->to('/caixa');
			} else {
				//Mensagem de retorno
				$this->setFlashdata('Caixa já foi criado', 'info');

				return redirect()->to('/caixa');
			}
		}
	}

	/**
	 * Salva o novo item na tabela
	 */
	public function storeLancamento()
	{
		//Get request
		$request = $this->request->getVar();
		//Rules
		$rules = [
			'caixaId'  => 'required',
			'nome'  	=> 'required',
			'valor' 	=> 'required',
			'tipo'  	=> 'required'
		];
		if ($this->validate($rules)) {
			//Carrega os modelos
			$caixaLancamentoModel  = new CaixaLancamentoModel;
			//Prepara os dados 
			$dadosLancamento = [
				'caixa_id'	=>  $this->validarEmpty($request['caixaId']),
				'nome'   	=>  $this->validarEmpty($request['nome']),
				'valor'  	=>  $this->validarEmpty($this->realToSql($request['valor'])),
				'tipo'   	=>  $this->validarEmpty($request['tipo'])
			];
			//Sobrescreve o tipo
			if (!$dadosLancamento['tipo']) {
				$dadosLancamento['tipo'] = '0';
			}
			//Salva os dados
			$caixaLancamentoModel->save($dadosLancamento);
			//Verifica o tipo para retornar a resposta correta
			if ($request['tipo'] == '1') {
				//Mensagem de retorno
				$this->setFlashdata('Lançamento cadastrada com sucesso !', 'success');
			} else {
				//Mensagem de retorno
				$this->setFlashdata('Retirada cadastrada com sucesso !', 'success');
			}

			return redirect()->to('/caixa');
		} else {
			//Mensagem de retorno
			$this->setFlashdata('Preencha todos os campos obrigatório !', 'error');

			return redirect()->to('/caixa');
		}
	}

	/////////////////////////////
	//                         //
	//	   Outras funções      //
	//                         //
	/////////////////////////////
}
