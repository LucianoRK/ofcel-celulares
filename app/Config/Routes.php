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
$routes->group('empresa', function ($routes) {
// Páginas

// Funcionalidades
$routes->get('trocarEmpresa/(:num)', 'EmpresaController::trocarEmpresa/$1');
});

/**
 * --------------------------------------------------------------------
 * Usuário
 * --------------------------------------------------------------------
 */

$routes->group('usuario', function ($routes) {
	// Páginas
	$routes->get('/', 'UsuarioController::index');
	$routes->get('create', 'UsuarioController::create');
	$routes->get('edit/(:num)', 'UsuarioController::edit/$1');
	// Funcionalidades
	$routes->post('store', 'UsuarioController::store');
	$routes->post('update/(:num)', 'UsuarioController::update/$1');
	$routes->post('verificarLoginRepetido', 'UsuarioController::verificarLoginRepetido');
	$routes->post('ativarUsuario', 'UsuarioController::ativarUsuario');
	$routes->post('desativarUsuario', 'UsuarioController::desativarUsuario');
});

/**
 * --------------------------------------------------------------------
 * Permissões
 * --------------------------------------------------------------------
 */

$routes->group('permissao', function ($routes) {
	// Páginas
	$routes->get('/', 'PermissaoController::index');
	$routes->get('edit/(:num)', 'PermissaoController::edit/$1');
	// Funcionalidades
	$routes->post('update', 'PermissaoController::update');
});
/**
 * --------------------------------------------------------------------
 * Clentes
 * --------------------------------------------------------------------
 */
$routes->group('cliente', function ($routes) {
	// Páginas
	$routes->get('/', 'ClienteController::index');
	$routes->get('edit/(:num)', 'ClienteController::edit/$1');
	$routes->get('create', 'ClienteController::create');
	// Funcionalidades
	$routes->post('store', 'ClienteController::store');
	$routes->post('update/(:num)', 'ClienteController::update/$1');
});

/**
 * --------------------------------------------------------------------
 * Marcas
 * --------------------------------------------------------------------
 */
$routes->group('marca', function ($routes) {
	// Páginas
	$routes->get('/', 'MarcaController::index');
	$routes->get('edit/(:num)', 'MarcaController::edit/$1');
	$routes->get('create', 'MarcaController::create');
	// Funcionalidades
	$routes->post('store', 'MarcaController::store');
	$routes->post('update', 'MarcaController::update');
	$routes->post('ativarMarca', 'MarcaController::ativarMarca');
	$routes->post('desativarMarca', 'MarcaController::desativarMarca');
});


/**
 * --------------------------------------------------------------------
 * Categorias
 * --------------------------------------------------------------------
 */
$routes->group('categoria', function ($routes) {
	// Páginas
	$routes->get('/', 'CategoriaController::index');
	$routes->get('edit/(:num)', 'CategoriaController::edit/$1');
	$routes->get('create', 'CategoriaController::create');
	// Funcionalidades
	$routes->post('store', 'CategoriaController::store');
	$routes->post('update', 'CategoriaController::update');
	$routes->post('ativarCategoria', 'CategoriaController::ativarCategoria');
	$routes->post('desativarCategoria', 'CategoriaController::desativarCategoria');
});


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
