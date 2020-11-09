<?php

namespace App\Controllers;

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
		$empresas    = new EmpresaModel();
		//Carrega as variáveis
		$dados['empresas']    = $empresas->get();

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
