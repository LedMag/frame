<?php

use Core\Router;

// Definir las rutas
$router->get('/', [\app\controllers\HomeController::class, 'index']);

// $router->get('/products', [\App\Controllers\ProductController::class, 'index']);
// $router->post('/products', [\App\Controllers\ProductController::class, 'store']);
// $router->get('/products/{id}', [\App\Controllers\ProductController::class, 'show']);
// $router->put('/products/{id}', [\App\Controllers\ProductController::class, 'update']);
// $router->delete('/products/{id}', [\App\Controllers\ProductController::class, 'destroy']);
