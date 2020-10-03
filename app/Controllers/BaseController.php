<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\LogAcessoModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\RedirectResponse;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->session = Services::session();
	}

	/**
	 * Carrega o template do sistema
	 * 
	 * @param string $escopo caminho da view
	 * @param string $arquivo caminho da view
	 * @param array  $dados Informação para a tela
	 */
	protected function template($pasta, $arquivo, $dados = [])
	{

		$dados['session']       = $this->session;
		$dados['responseFlash'] = $this->session->getFlashdata('responseFlash');

		echo view('template/header', $dados);
		echo view('template/navBar', $dados);
		echo view('template/sideBar', $dados);
		echo view($pasta . '/' . $arquivo, $dados);
		echo view($pasta . '/functions', $dados);
		echo view('template/footer', $dados);
	}

	/**
	 * Carrega o template do sistema sem navbar e sidebar
	 * 
	 * @param string $escopo caminho da view
	 * @param string $arquivo caminho da view
	 * @param array  $dados Informação para a tela
	 * 
	 */
	protected function template_publico($pasta, $arquivo, $dados = [])
	{
		$dados['session']       = $this->session;
		$dados['responseFlash'] = $this->session->getFlashdata('responseFlash');

		echo view('template/header', $dados);
		echo view($pasta . '/' . $arquivo, $dados);
		echo view($pasta . '/functions', $dados);
		echo view('template/footer', $dados);
	}

	/**
	 * Gera a criptografia das senhas do sistema
	 * 
	 * @param string $senha
	 */
	protected function criptografia($senha)
	{
		$hash = getenv('hashSistema');

		for ($i = 0; $i < 20; $i++) {
			$senha = sha1($hash . $senha);
		}

		return $senha;
	}

	/**
	 * permissao
	 * 
	 * @param string $senha
	 */
	protected function permissao($permissaoId)
	{
		$permissoesUsuario = $this->session->get('permissao');

		if (in_array($permissaoId, $permissoesUsuario)) {
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Gera o retorno flash para o cliente
	 * 
	 * @param string $mensagem
	 * @param string $tipo  success, error, info
	 * @param string $variavel Nome da variavel
	 * @param int    $tempo tempo da sessão flashdata
	 */
	protected function setFlashdata($mensagem = '', $tipo = 'info', $variavel = 'responseFlash', $tempo = 300)
	{
		$this->session->setFlashdata($variavel, ['tipo' => $tipo, 'mensagem' => $mensagem], $tempo);
	}

	/**
	 * Log Acesso
	 * 
	 * @param int    $status
	 * @param string $ip
	 * @param array  $dados
	 */
	protected function logAcesso($status, $dados, $ip)
	{
		$log = new LogAcessoModel();
		$dadosLog = [
			'status' => !empty($status) ? $status : null,
			'ip'     => !empty($ip)     ? $ip     : null,
			'dados'  => !empty($dados)  ? $dados  : null
		];
		$log->save($dadosLog);
	}

	/**
	 * Log 
	 * 
	 * @param array  $dados
	 */
	protected function log($dados)
	{
	}
}
