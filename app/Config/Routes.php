<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');
$routes->get('/', 'Pacientes::index');
$routes->get('/Pacientes', 'Pacientes::index');
$routes->get('/Pacientes/pesquisa', 'Pacientes::pesquisa');
$routes->post('/Pacientes/pesquisa', 'Pacientes::pesquisa');
$routes->post('/Pacientes/importar', 'Pacientes::importar');
$routes->post('/Pacientes/save', 'Pacientes::save');

