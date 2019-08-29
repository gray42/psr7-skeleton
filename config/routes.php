<?php

use App\Middleware\AuthenticationMiddleware;
use App\Middleware\LanguageMiddleware;
use App\Middleware\SessionMiddleware;
use League\Route\RouteGroup;
use League\Route\Router;
use Odan\Csrf\CsrfMiddleware;
use Psr\Container\ContainerInterface;

// Define the routes

return static function (ContainerInterface $container) {
    $router = $container->get(Router::class);

    $router->post('/ping', \App\Action\HomePingAction::class);

    // Login, no auth check for this actions required
    $router->group('/users', static function (RouteGroup $group): void {
        $group->post('/login', \App\Action\UserLoginSubmitAction::class);
        $group->get('/login', \App\Action\UserLoginIndexAction::class)->setName('login');
        $group->get('/logout', \App\Action\UserLogoutAction::class);
    })
        ->lazyMiddleware(SessionMiddleware::class)
        ->lazyMiddleware(CsrfMiddleware::class);

    // Routes with authentication
    $router->group('', static function (RouteGroup $group): void {
        // Default page
        $group->get('/', \App\Action\HomeIndexAction::class)->setName('root');

        $group->get('/users', \App\Action\UserIndexAction::class);

        $group->post('/users/list', \App\Action\UserListAction::class);

        // This route will only match if {id} is numeric
        $group->get('/users/{id:[0-9]+}', \App\Action\UserEditAction::class)->setName('users.edit');

        // Json request
        $group->post('/home/load', \App\Action\HomeLoadAction::class);
    })
        ->lazyMiddleware(SessionMiddleware::class)
        ->lazyMiddleware(LanguageMiddleware::class)
        ->lazyMiddleware(AuthenticationMiddleware::class)
        ->lazyMiddleware(CsrfMiddleware::class);

    return $router;
};
