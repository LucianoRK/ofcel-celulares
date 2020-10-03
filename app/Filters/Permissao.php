<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Permissao implements FilterInterface
{
    /**
     * This is a demo implementation of using the Throttler class
     * to implement rate limiting for your application.
     *
     * @param RequestInterface|\CodeIgniter\HTTP\IncomingRequest $request
     * @param array|null                                         $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $redirectResponse = Services::redirectResponse(null, true);
        $session          = Services::session();
        $router           = Services::router();

        //monta string Controller/metodo
        $controller = str_replace('\App\Controllers\\', '', $router->controllerName());
        $rota = $controller . '/' . $router->methodName();

        //Ignora alguns controladores
        if (!in_array($controller, ['LoginController', 'HomeController'])) {
            //Verifico se a permissão foi cadastrada
            if (in_array($rota, $session->get('permissaoSistema'))) {
                  //Verifica se existe no array de permissões do usuario
                if (!in_array($rota, $session->get('permissao'))) {
                    return $redirectResponse->route('/');
                }
            }
        }
    }

    //--------------------------------------------------------------------

    /**
     * We don't have anything to do here.
     *
     * @param RequestInterface|\CodeIgniter\HTTP\IncomingRequest $request
     * @param ResponseInterface|\CodeIgniter\HTTP\Response       $response
     * @param array|null                                         $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
