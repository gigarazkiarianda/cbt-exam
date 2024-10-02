<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes = Services::routes();


$routes->get('/', 'Home::index');
$routes->get('/exam/start', 'ExamController::start'); 
$routes->post('/exam/submit', 'ExamController::submit'); 
$routes->get('/exam/result', 'ExamController::result'); 

$routes->get('/exam/navigate/(:num)', 'ExamController::navigate/$1'); 
