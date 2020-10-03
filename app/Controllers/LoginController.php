<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\PermissaoUsuarioTipoModel;
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
		$usuarioModel 		  = new UsuarioModel();
		$empresaModel 		  = new EmpresaModel();
		$permissaoUsuarioTipo = new PermissaoUsuarioTipoModel();

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

			//Pega os dados do usuário
			$dadosUsuario = $usuarioModel->get($parametros, true);

			if ($dadosUsuario) {
				//Carrega os dados base
				$dadosEmpresas               = $empresaModel->getEmpresasUsuario($dadosUsuario['usuario_id']);	
				$dadosPermissaoArray         = $permissaoUsuarioTipo->get(['usuario_tipo_id' => $dadosUsuario['usuario_tipo_id']]);
				$dadosPermissaoSistemaArray  = $permissaoUsuarioTipo->get();
				$dadosEmpresa                = [];
				$dadosPermissao              = [];//Permissões do usuário
				$dadosPermissaoSistema       = [];//Permissões registradas no sistema (tabela permissao)
				
				//Monta o array de permissões do usuário
				if($dadosPermissaoArray){
					foreach($dadosPermissaoArray as $permissao){	
						array_push($dadosPermissao, $permissao['rota']);
					}
				}

				//Monta o array de todas as permissões do sistema
				if($dadosPermissaoSistemaArray){
					foreach($dadosPermissaoSistemaArray as $permissao){	
						array_push($dadosPermissaoSistema, $permissao['rota']);
					}
				}

				//Verifica a empresa principal
				foreach($dadosEmpresas as $dadoEmpresas){
					if($dadoEmpresas['principal'] == '1'){
						$dadosEmpresa  = $dadoEmpresas;
					}
				}

				//Verifica se tem empresa principal
				if(!$dadosEmpresa){
					$this->setFlashdata('O usuário não tem empresa principal', 'error');
					return redirect()->to('/');
				}

				//Monta o array da sessão
				$sessionData = [
					'usuario'   	   => $dadosUsuario,
					'empresa'   	   => $dadosEmpresa,
					'empresas'  	   => $dadosEmpresas,
					'permissao' 	   => $dadosPermissao,
					'permissaoSistema' => $dadosPermissaoSistema,
					'logado'           => TRUE
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
