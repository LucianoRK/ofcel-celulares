<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
$session = Services::session();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

/**
 * --------------------------------------------------------------------
 * Home
 * --------------------------------------------------------------------
 */
// Páginas
$routes->get('/', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('/home', 'HomeController::index');
//Funcionalidades
$routes->get('/logout', 'LoginController::logout');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/buscaCep', 'BaseController::buscaCep');

/**
 * --------------------------------------------------------------------
 * Empresa
 * --------------------------------------------------------------------
 */
// Páginas

// Funcionalidades
$routes->get('/empresa/trocarEmpresa/(:num)', 'EmpresaController::trocarEmpresa/$1');

/**
 * --------------------------------------------------------------------
 * Usuário
 * --------------------------------------------------------------------
 */

// Páginas
$routes->get('/usuario', 'UsuarioController::index');
$routes->get('/usuario/create', 'UsuarioController::create');
$routes->get('/usuario/edit/(:num)', 'UsuarioController::edit/$1');
// Funcionalidades
$routes->post('/usuario/store', 'UsuarioController::store');
$routes->post('/usuario/update/(:num)', 'UsuarioController::update/$1');
$routes->post('/usuario/verificarLoginRepetido', 'UsuarioController::verificarLoginRepetido');
$routes->post('/usuario/ativarUsuario', 'UsuarioController::ativarUsuario');
$routes->post('/usuario/desativarUsuario', 'UsuarioController::desativarUsuario');

/**
 * --------------------------------------------------------------------
 * Permissões
 * --------------------------------------------------------------------
 */

// Páginas
$routes->get('/permissao', 'PermissaoController::index');
$routes->get('/permissao/edit/(:num)', 'PermissaoController::edit/$1');
// Funcionalidades
$routes->post('/permissao/update', 'PermissaoController::update');

/**
 * --------------------------------------------------------------------
 * Clentes
 * --------------------------------------------------------------------
 */

// Páginas
$routes->get('/cliente', 'ClienteController::index');
$routes->get('/cliente/edit/(:num)', 'ClienteController::edit/$1');
$routes->get('/cliente/create', 'ClienteController::create');
// Funcionalidades
$routes->post('/cliente/store', 'ClienteController::store');
$routes->post('/cliente/update/(:num)', 'ClienteController::update/$1');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
