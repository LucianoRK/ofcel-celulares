<?php

namespace App\Controllers;

use App\Models\CaixaLancamentoModel;
use App\Models\CaixaModel;
use App\Models\EmpresaModel;
use App\Models\VendaFormaPagamentoModel;
use App\Models\VendaModel;

class HomeController extends BaseController
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
		$empresas    			  = new EmpresaModel;
		$vendaFormaPagamentoModel = new VendaFormaPagamentoModel;
		$vendaModel 			  = new VendaModel;
		$caixaLancamentoModel     = new CaixaLancamentoModel;
		$caixaModel    		      = new CaixaModel;

		//Carrega as variáveis
		$dados['empresas']    = $empresas->get();
		
		foreach ($dados['empresas'] as $key => $empresa) {
			$empresaSessaoId = $empresa['empresa_id'];
			$caixa	         = $caixaModel->get("empresa_id = $empresaSessaoId AND DATE(created_at) = DATE(NOW())", true);
			$caixaId 		 = $caixa['caixa_id'];
			//Vendas
			$dados['empresas'][$key]['vendasQtd']  			= count($vendaModel->get("venda.empresa_id = $empresaSessaoId AND DATE(venda.created_at) = DATE(NOW())"));
			$dados['empresas'][$key]['vendas']      	    = $vendaFormaPagamentoModel->getValores("v.empresa_id = $empresaSessaoId AND DATE(v.created_at) = DATE(NOW())");
			$dados['empresas'][$key]['vendasValorTotal']    = array_sum($dados['empresas'][$key]['vendas']);
			//Ordem Serviço
			
			//Caixa
			$lancamentos    = $caixaLancamentoModel->get("caixa_id = '$caixaId' AND DATE(created_at) = DATE(NOW())");
			$totalLancamento 	  = 0.00;
			$totalRetirada   	  = 0.00;
			$dados['empresas'][$key]['caixaLancamentos']  = 0.00;
			$dados['empresas'][$key]['caixaRetiradas']    = 0.00;
			//Verifica se existe lançamentos neste caixa
			if ($lancamentos) {
				foreach ($lancamentos as $lancamento) {
					//Verifica o tipo de lançamento
					if ($lancamento['tipo'] == 1) {
						//lançamentos
						$totalLancamento += $lancamento['valor'];
					} else {
						//Retirada
						$totalRetirada += $lancamento['valor'];
					}
				}
				$dados['empresas'][$key]['caixaLancamentos'] =  $totalLancamento;
				$dados['empresas'][$key]['caixaRetiradas']   =  $totalRetirada;
			}
		}

		return $this->template('home', 'index', $dados);
	}

	/////////////////////////////
	//                         //
	//	        CRUD           //
	//                         //
	/////////////////////////////


	/////////////////////////////
	//                         //
	//	   Outras funções      //
	//                         //
	/////////////////////////////
}
