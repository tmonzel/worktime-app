<?php
/**
 * Initialize application
 * 
 */
$loader = require __DIR__ . "/../vendor/autoload.php";

use App\Controllers\EmployeesController;
use App\Controllers\ProjectsController;

// Initialize slim application
$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
    'db' => [
      'driver' => 'mysql',
      'host' => 'db',
      'database' => 'worktime_dev',
      'username' => 'root',
      'password' => 'foobar',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci'
    ]
  ]
]);

// Modify headers for all requests
$app->add(function($req, $res, $next) {
  $response = $next($req, $res)->withHeader('Access-Control-Allow-Origin', '*');
  //$response = $response->withHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, X-authentication, X-client');
  return $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Setting up containers
$container = $app->getContainer();

$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


require __DIR__ . "/routes.php";

return $app;