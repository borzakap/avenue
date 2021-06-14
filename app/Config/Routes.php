<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// admin
$routes->group('console', ['filter' => 'role:admin,manager'], function($routes){
    // console dashboard
    $routes->add('/', 'Admin\ResidentialsController::list', ['as' => 'dashboard']);
    // residentials
    $routes->group('residentials', function($routes){
        $routes->add('', 'Admin\ResidentialsController::list', ['as' => 'residentials']);
        $routes->add('create', 'Admin\ResidentialsController::create');
        $routes->add('update/(:num)', 'Admin\ResidentialsController::update/$1', ['as' => 'residential_update']);
    });
    // sections
    $routes->group('sections', function($routes){
        $routes->add('', 'Admin\SectionsController::list', ['as' => 'sections']);
        $routes->add('create', 'Admin\SectionsController::create');
        $routes->add('update/(:num)', 'Admin\SectionsController::update/$1', ['as' => 'section_update']);
    });
    // pages
    $routes->group('pages', function($routes){
        $routes->add('update/(:segment)', 'Admin\PagesTranslationsController::update/$1', ['as' => 'page_update']);
    });
    // requests
    $routes->group('requests', function($routes){
        $routes->add('', 'Admin\ClientsRequestsController::list', ['as' => 'requests']);
    });
});


/*
 * Myth:Auth routes file.
 */
$routes->group('', ['namespace' => 'Myth\Auth\Controllers'], function ($routes) {
    // Login/out
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
    $routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

    // Forgot/Resets
    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'AuthController::attemptReset');
});

// api
$routes->group('api', function($routes){
    $routes->post('request/send', 'Api\ClientsRequestsController::send');
});

// site.
$routes->get('{locale}', 'Pages::index');
$routes->get('{locale}/contact', 'Pages::contact');

/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
