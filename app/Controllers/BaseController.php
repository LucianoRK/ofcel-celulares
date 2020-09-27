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

use CodeIgniter\Config\Services;
use CodeIgniter\Controller;

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
		$this->session = \Config\Services::session();
	}

	/**
	 * validarSessao
	 */
	public function validarSessao()
	{
		if ($this->session->get('logado')) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Carrega o template do sistema
	 * 
	 * @param string $escopo caminho da view
	 * @param string $arquivo caminho da view
	 * @param array  $dados Informação para a tela
	 */
	public function template($pasta, $arquivo, $dados = [])
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
	public function template_publico($pasta, $arquivo, $dados = [])
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
	public function criptografia($senha)
	{
		$hash = getenv('hashSistema');

		for ($i = 0; $i < 20; $i++) {
			$senha = sha1($hash . $senha);
		}

		return $senha;
	}

	/**
	 * Gera o retorno flash para o cliente
	 * 
	 * @param string $mensagem
	 * @param string $tipo  success, error, info
	 * @param int    $tempo tempo da sessão flashdata
	 */
	public function setFlashdata($mensagem = null, $tipo = 'info', $tempo = 300)
	{
		$this->session->setFlashdata('responseFlash', ['tipo' => $tipo, 'mensagem' => $mensagem], $tempo);
	}
}
