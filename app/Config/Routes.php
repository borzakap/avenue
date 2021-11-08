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

// admin ['filter' => 'role:superadmin,moderator,manager'], 
$routes->group('console', ['filter' => 'role:superadmin,content_manager,sales_head,owner'], function($routes){
    // console dashboard
    $routes->get('', 'Admin\ResidentialsController::list', ['as' => 'dashboard']);
    // residentials
    $routes->group('residentials', function($routes){
        $routes->get('', 'Admin\ResidentialsController::list', ['as' => 'residentials']);
        $routes->match(['get', 'post'], 'create', 'Admin\ResidentialsController::create', ['as' => 'residential_create']);
        $routes->match(['get', 'post'], 'update/(:num)', 'Admin\ResidentialsController::update/$1', ['as' => 'residential_update']);
        $routes->post('plans-upload', 'Admin\ResidentialsController::plansUpload', ['as' => 'plans-upload']);
        $routes->post('plans-load', 'Admin\ResidentialsController::plansLoad', ['as' => 'plans-load']);
        $routes->post('plans-update', 'Admin\ResidentialsController::plansUpdate', ['as' => 'plans-update']);
    });
    // progress
    $routes->group('progress', function($routes){
        $routes->get('', 'Admin\ProgressController::list', ['as' => 'progress']);
        $routes->match(['get', 'post'], 'create', 'Admin\ProgressController::create', ['as' => 'progress_create']);
        $routes->match(['get', 'post'], 'update/(:num)', 'Admin\ProgressController::update/$1', ['as' => 'progress_update']);
        $routes->post('images-upload', 'Admin\ProgressController::imageUpload', ['as' => 'images_upload']);
        $routes->post('images-load', 'Admin\ProgressController::imagesLoad', ['as' => 'images_load']);
        $routes->post('images-update', 'Admin\ProgressController::imageUpdate', ['as' => 'image_update']);
    });
    // infrastructure
    $routes->group('infrastructure', function($routes){
        $routes->get('', 'Admin\InfrastructureController::list', ['as' => 'infrastructure']);
        $routes->match(['get', 'post'], 'create', 'Admin\InfrastructureController::create', ['as' => 'infrastructure_create']);
        $routes->match(['get', 'post'], 'update/(:num)', 'Admin\InfrastructureController::update/$1', ['as' => 'infrastructure_update']);
        $routes->post('images-upload', 'Admin\InfrastructureController::imageUpload', ['as' => 'infrastructure_upload']);
    });
    // sections
    $routes->group('sections', function($routes){
        $routes->get('', 'Admin\SectionsController::list', ['as' => 'sections']);
        $routes->match(['get', 'post'], 'create', 'Admin\SectionsController::create');
        $routes->match(['get', 'post'], 'update/(:num)', 'Admin\SectionsController::update/$1', ['as' => 'section_update']);
        $routes->post('floors-upload', 'Admin\SectionsController::floorsUpload', ['as' => 'floors-upload']);
        $routes->post('floors-load', 'Admin\SectionsController::floorsLoad', ['as' => 'floors-load']);
        $routes->post('floors-update', 'Admin\SectionsController::floorsUpdate', ['as' => 'floors-update']);
        $routes->post('poligon-commerce', 'Admin\SectionsController::poligonCommerce', ['as' => 'section_poligon_commerce']);
        $routes->post('poligon-leaving', 'Admin\SectionsController::poligonLeaving', ['as' => 'section_poligon_leaving']);
        $routes->post('poligon-pantry', 'Admin\SectionsController::poligonPantry', ['as' => 'section_poligon_pantry']);
    });
    // layouts
    $routes->group('layouts', function($routes){
        $routes->get('', 'Admin\LayoutsController::list', ['as' => 'layouts']);
        $routes->match(['get', 'post'], 'create', 'Admin\LayoutsController::create', ['as' => 'layout_create']);
        $routes->match(['get', 'post'], 'update/(:num)', 'Admin\LayoutsController::update/$1', ['as' => 'layout_update']);
        $routes->post('poligon-section', 'Admin\LayoutsController::poligonSectionSave', ['as' => 'layout_poligon_section']);
        $routes->post('poligon-plan', 'Admin\LayoutsController::poligonPlanSave', ['as' => 'layout_poligon_plan']);
        $routes->post('images', 'Admin\LayoutsController::imagesSave', ['as' => 'layout_images_upload']);
    });
    // commerce
    $routes->group('commerce', function($routes){
        $routes->get('', 'Admin\CommerceController::list', ['as' => 'commerce']);
        $routes->get('chess', 'Admin\CommerceController::chess', ['as' => 'commerce_chess']);
        $routes->match(['get', 'post'], 'create', 'Admin\CommerceController::create', ['as' => 'commerce_create']);
        $routes->match(['get', 'post'], 'update/(:num)', 'Admin\CommerceController::update/$1', ['as' => 'commerce_update']);
        $routes->post('poligon-section', 'Admin\CommerceController::poligonSectionSave', ['as' => 'commerce_poligon_section']);
        $routes->post('poligon-plan', 'Admin\CommerceController::poligonPlanSave', ['as' => 'commerce_poligon_plan']);
        $routes->post('images', 'Admin\CommerceController::imagesSave', ['as' => 'commerce_images_upload']);
    });
    // pages
    $routes->group('pages', function($routes){
        $routes->add('update/(:segment)', 'Admin\PagesTranslationsController::update/$1', ['as' => 'page_update']);
    });
    // requests
    $routes->group('requests', function($routes){
        $routes->add('', 'Admin\ClientsRequestsController::list', ['as' => 'requests']);
    });
    // users
    $routes->group('users', function($routes){
        $routes->add('', 'Admin\UsersController::list', ['as' => 'users']);
    });
    // ajax
    $routes->group('ajax', function ($routes) {
        $routes->post('floors-image-change-url', 'Admin\LayoutsController::poligonChange', ['as' => 'floors-image-change-url']);
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
    $routes->post('quiz/send', 'Api\ClientsQuizController::send');
});

// site.
$routes->group('{locale}', function($routes){
    $routes->get('', 'Pages::index');
    $routes->match(['get', 'post'], 'oneroom/(:segment)', 'Pages::oneroom/$1', ['as'=>'oneroom-filter']);
    $routes->match(['get', 'post'], 'tworoom/(:segment)', 'Pages::tworoom/$1', ['as'=>'tworoom-filter']);
    $routes->get('contact', 'Pages::contact');
    $routes->group('layouts', function($routes){
        $routes->get('genplan/(:segment)', 'Layouts::genplan/$1', ['as'=>'layouts-genplan']);
        $routes->get('section/(:segment)', 'Layouts::section/$1', ['as'=>'layouts-section']);
        $routes->match(['get', 'post'], 'filter/(:segment)', 'Layouts::filter/$1', ['as'=>'layouts-filter']);
        $routes->get('view/(:segment)', 'Layouts::view/$1', ['as'=>'layout-view']);
        $routes->post('load', 'Layouts::load', ['as'=>'layout-load']);
    });
    $routes->group('commerce', function($routes){
        $routes->get('genplan/(:segment)', 'Commerce::genplan/$1', ['as'=>'commerce-genplan']);
        $routes->get('section/(:segment)', 'Commerce::section/$1', ['as'=>'commerce-section']);
        $routes->get('view/(:segment)', 'Commerce::view/$1', ['as'=>'commerce-view']);
        $routes->post('load', 'Commerce::load', ['as'=>'commerce-load']);
    });
});


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
