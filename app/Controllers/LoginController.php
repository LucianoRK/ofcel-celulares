<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\UsuarioModel;

class LoginController extends BaseController
{
	public function __construct()
	{
	}

	/////////////////////////////
	//                         //
	//	       Paginas         //
	//                         //
	/////////////////////////////

	/**
	 * Pagina inicial do módulo
	 */
	public function index()
	{
		if ($this->session->get('logado')) {
			return $this->template('home', 'index');
		} else {
			return $this->template_publico('login', 'index');
		}
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

	/**
	* Faz o login no sistema
	* 
	* @param string $usuario 
	* @param string $senha
	*/
	public function login()
	{
		//Modelos
		$usuarioModel = new UsuarioModel();
		$empresaModel = new EmpresaModel();

		//Requests
		$request = $this->request->getVar();

		//Rules
		$rules = [
			'login' => 'required',
			'senha' => 'required|min_length[6]'
		];

		//Valida as rules
		if ($this->validate($rules)) {
			//Parâmetros
			$parametros = [
				'login' => $request['login'],
				'senha' => $this->criptografia($request['senha'])
			];

			//Pega os dados do usuário para gravar na sessão
			$dadosUsuario = $usuarioModel->get($parametros, true);

			if ($dadosUsuario) {
				$dadosEmpresas   = $empresaModel->getEmpresasUsuario($dadosUsuario['usuario_id']);	
				$dadosEmpresa    = [];			
				$dadosPermissao  = [];

				foreach($dadosEmpresas as $dadoEmpresas){
					if($dadoEmpresas['principal'] == 1){
						$dadosEmpresa  = $dadoEmpresas;
					}
				}

				if(!$dadosEmpresa){
					$this->setFlashdata('O usuário não tem empresa principal', 'error');
					return redirect()->to('/');
				}

				$sessionData = [
					'usuario'   => $dadosUsuario,
					'empresa'   => $dadosEmpresa,
					'empresas'  => $dadosEmpresas,
					'permissao' => $dadosPermissao,
					'logado'    => TRUE
				];

				//Grava na sessão as informações
				$this->session->set($sessionData);
				//Salva o log
				$this->logAcesso(1, json_encode($dadosUsuario), $this->request->getIPAddress());
				
				return redirect()->to('home');
			} else {
				//Salva o log
				$this->logAcesso(2, json_encode($request), $this->request->getIPAddress());
				//Mensagem de retorno
				$this->setFlashdata('Usuário ou senha inconrreto', 'error');

				return redirect()->to('/');
			}
		}else{
			$this->setFlashdata('Usuário ou senha inconrreto', 'error');
			return redirect()->to('/');
		}
	}

	/**
	* Faz o logout do sistema
	*/
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}
}
