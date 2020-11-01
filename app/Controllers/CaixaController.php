<?php

namespace App\Controllers;

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
		$empresas    			  = new EmpresaModel;
		$vendaFormaPagamentoModel = new VendaFormaPagamentoModel;

		//Sessão
		$empresaSessao = $this->session->get('empresa');
		$empresaSessaoId = $empresaSessao['empresa_id'];

		//Carrega as variáveis
		$dados['empresas'] 					= $empresas->get();
		$dados['venda']   					= $vendaFormaPagamentoModel->getValores("v.empresa_id = $empresaSessaoId AND DATE(v.created_at) = DATE(NOW())");
		$dados['ordemServico']   			= $vendaFormaPagamentoModel->getValores("v.empresa_id = $empresaSessaoId AND DATE(v.created_at) = DATE('2000-01-01')");// Alterar para ordem serviço
		$dados['venda']['total']   		 	= array_sum($dados['venda']);
		$dados['ordemServico']['total']     = array_sum($dados['ordemServico']);
		

		return $this->template('caixa', 'index', $dados);
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
