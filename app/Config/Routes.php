<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('', 'Home::index');

$routes->get('testdb', 'TestDB::index');

$routes->get('hello', function() {
    return 'Hello, world!';
});

$routes->get('login', 'Auth::login');
$routes->get('signup', 'Auth::signup');
$routes->post('login/authenticate', 'Auth::authenticate');
$routes->post('signup/register', 'Auth::register');
$routes->get('menu/(:num)', 'Auth::menu/$1');
$routes->post('user/update', 'Auth::update/');
$routes->post('user/delete/(:num)', 'Auth::delete/$1');


