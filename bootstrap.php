<?php

use PragmaGoTech\Interview\App;
use PragmaGoTech\Interview\Router;
use PragmaGoTech\Interview\Controller\FeeCalculatorController;

require __DIR__ . '/vendor/autoload.php';
$container = require __DIR__ . '/config/container.php';
$router    = new Router($container);

$router->get('/', [FeeCalculatorController::class, 'index']);

return new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
);
