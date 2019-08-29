<?php

use League\Route\Router;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

(static function (ContainerInterface $container): void {
    (new SapiEmitter())
        ->emit($container->get(Router::class)
            ->dispatch($container->get(ServerRequestInterface::class)));
})(require __DIR__ . '/../config/bootstrap.php');
