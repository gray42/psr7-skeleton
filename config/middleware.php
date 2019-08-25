<?php

use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function (ContainerInterface $container) {
    $router = $container->get(Router::class);

    // Register middleware for all routes
    $router->lazyMiddleware(\App\Middleware\ExceptionMiddleware::class);
    $router->lazyMiddleware(\App\Middleware\CorsMiddleware::class);

    return $router;
};
