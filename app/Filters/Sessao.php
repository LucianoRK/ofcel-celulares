<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Sessao implements FilterInterface
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

        if ($router->controllerName() != '\App\Controllers\LoginController' && !$session->get('logado')) {
            return $redirectResponse->route('/');
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
