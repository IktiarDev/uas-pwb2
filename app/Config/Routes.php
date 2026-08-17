<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'BookController::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->group('books', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'BookController::index');
    $routes->get('view/(:num)', 'BookController::view/$1');
    $routes->get('create', 'BookController::create', ['filter' => 'admin']);
    $routes->post('store', 'BookController::store', ['filter' => 'admin']);
    $routes->get('edit/(:num)', 'BookController::edit/$1', ['filter' => 'admin']);
    $routes->post('update/(:num)', 'BookController::update/$1', ['filter' => 'admin']);
    $routes->get('delete/(:num)', 'BookController::delete/$1', ['filter' => 'admin']);
});
