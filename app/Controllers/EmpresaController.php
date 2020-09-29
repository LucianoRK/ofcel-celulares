<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

class EmpresaController extends BaseController
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
	 * Trocar empresa da Sessão
     * @param int $id da empresa
	 */
	public function trocarEmpresa($id)
	{
        //Prepara as variáveis
        $sessionEmpresas = $this->session->get('empresas');
        $sessaoCompleta  = $this->session->get();

        //Verifica se a empresa pertence ao usuário
        foreach($sessionEmpresas as $empresas){
            if($empresas['empresa_id'] == $id){
                $sessaoCompleta['empresa'] = $empresas;
                $this->session->set($sessaoCompleta);
            }
        }
        return redirect()->to('/');
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
