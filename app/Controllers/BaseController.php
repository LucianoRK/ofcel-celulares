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

use App\Models\CaixaModel;
use App\Models\LogAcessoModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\RedirectResponse;
use PHPUnit\Framework\MockObject\Rule\AnyParameters;

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
		$this->router  = Services::router();

		//Variaveis Globais
		$this->controller   = str_replace('\App\Controllers\\', '', $this->router->controllerName());
		$this->method       = $this->router->methodName();
		$this->route        = $this->controller . '/' . $this->router->methodName();
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
		$dados['base']          = $this;

		echo view('template/header', $dados);
		echo view('template/functions', $dados);
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
		//Variaveis Globais
		$dados['session']       = $this->session;
		$dados['responseFlash'] = $this->session->getFlashdata('responseFlash');
		$dados['base']          = $this;

		echo view('template/header', $dados);
		echo view('template/functions', $dados);
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
	public function permissao($permissao = false)
	{
		$permissoesUsuario = $this->session->get('permissao');

		if (in_array($permissao, $permissoesUsuario)) {
			return true;
		} else {
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

	/**
	 * Log 
	 * 
	 * @param array  $dados
	 */
	public function buscaCep()
	{
		//Get request
		$request = $this->request->getVar();
		if (strlen($request['cep']) == 8) {
			//Monta a url
			$url = env('buscaCep') . $request['cep'] . '/json';
			//Busca os dados
			$result = file_get_contents($url);

			if ($result) {
				// faz o parse do resultado
				$dados = json_decode($result);
			} else {
				$dados = false;
			}
		} else {
			$dados = false;
		}

		return $this->response->setJSON($dados);
	}

	/** 
	 * 
	 * @param string $valor
	 */
	public function sqlToReal($valor)
	{
		return number_format($valor, 2, ",", ".");
	}

	/** 
	 * 
	 * @param $var
	 */
	public function realToSql($valor)
	{
		return str_replace(',', '.', str_replace('.', '', $valor));
	}

	/** 
	 * Função usada para debugar o sistema (Contém die())
	 * 
	 * @param $var
	 */
	public function debug($var)
	{
		echo '<pre>';
		var_dump($var);
		die();
	}
	/** 
	 * Seta o valor como nulo caso venha vazio
	 * 
	 * @param $var
	 */
	public function validarEmpty($var)
	{
		return !empty($var) ? $var : null;
	}
	/** 
	 * Coloca a classe active no menu
	 * 
	 * @param $menuControllador
	 */
	public function addActiveMenu($menuControllador)
	{
		if (is_array($menuControllador)) {
			if (in_array($this->controller, $menuControllador)) {
				return 'active';
			}
		} else {
			if ($this->controller == $menuControllador) {
				return 'active';
			}
		}
	}

	/** 
	 * Verifica se o caixa já foi inicializado
	 */
	public function caixaInicializado()
	{
		$caixaModel      = new CaixaModel;
		//Sessão
		$empresaSessao   = $this->session->get('empresa');
		$empresaSessaoId = $empresaSessao['empresa_id'];
		//Busca o caixa do dia
		$caixa	= $caixaModel->get("empresa_id = $empresaSessaoId", true);

		if ($caixa) {
			if (date('Y-m-d', strtotime($caixa['created_at'])) == date('Y-m-d')) {
				return true; // Caixa inicializado
			} else {
				return $caixa; //  Caixa Pendente (dia anterior)
			}
		} else {
			return false; // Caixa não iniciado ou finalizado
		}
	}
}
