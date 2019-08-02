<?php

use League\Route\Router;

$router = $container->get(Router::class);

// Register middleware for all routes
$router->lazyMiddleware(\App\Middleware\ExceptionMiddleware::class);
$router->lazyMiddleware(\App\Middleware\CorsMiddleware::class);

return $router;
