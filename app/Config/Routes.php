<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;
use Config\Services;

$routes = Services::routes();

// Load the system's default routes if they exist
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Default route
$routes->get('/', 'AuthController::login');

// Authentication routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::storeLogin'); // POST route for login
    $routes->get('register', 'AuthController::register');
    $routes->post('storeRegister', 'AuthController::storeRegister'); // Route for registration handling
    $routes->get('logout', 'AuthController::logout');
});

// Exam routes
$routes->group('exam', function($routes) {
    $routes->get('index', 'ExamController::index'); // Route for the exam index page
    $routes->get('start/(:num)', 'ExamController::start/$1'); // Route for starting the exam by category ID
    $routes->post('submit/(:num)', 'ExamController::submit/$1'); // Route for submitting all exam answers
    $routes->get('result', 'ExamController::result'); // Route for displaying exam results
});

// Dashboard route
$routes->get('dashboard', 'DashboardController::index'); // Redirect after successful login

// Load additional routes for the current environment if they exist
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
