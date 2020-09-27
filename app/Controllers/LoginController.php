<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\CLI\Console;
use CodeIgniter\HTTP\Request;


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
		if ($this->validarSessao()) {
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
			$dadosUsuario = $usuarioModel->login($parametros);

			if ($dadosUsuario) {
				$sessionData = [
					'user'  => $dadosUsuario,
					'logado' => TRUE
				];

				//Grava na sessão as informações
				$this->session->set($sessionData);

				return redirect()->to('home');
			} else {
				$this->setFlashdata('Usuário ou senha inconrreto', 'error');
				return redirect()->to('/');
			}
		}else{
			$this->setFlashdata('Preencha login e senha', 'error');
			return redirect()->to('/');
		}
	}

	/**
	* Faz o logout do sistema
	* 
	* @param string $usuario 
	* @param string $senha
	*/
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}
}
