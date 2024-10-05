<?php

function cors() {
  if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
      header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
    exit(0);
  }
}

cors();

require 'config.php';
require 'router.php';
require 'controllers/auth.php';

$router = new Router();

$router->post('/api/register', 'AuthController@register');
$router->post('/api/login', 'AuthController@login');

$router->get('/api/register', 'AuthController@register');
$router->get('/api/login', 'AuthController@login');

$router->put('/api/register', 'AuthController@register');
$router->put('/api/login', 'AuthController@login');

$router->delete('/api/register', 'AuthController@register');
$router->delete('/api/login', 'AuthController@login');

$router->dispatch();
?>
