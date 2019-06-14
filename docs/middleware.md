## Middleware

In a PSR-7/PSR-15 application, you can add middleware handler to all incoming routes, 
to a specific route, or to a group of routes. 

[Check the documentations](https://route.thephpleague.com/) 

### Global middleware

We already added some global middleware handlers to ensure
that the exception handler and some security related checks are allways enabled.

More details: [config/middleware.php](https://github.com/odan/psr7-skeleton/blob/master/config/middleware.php)

### Route specific middleware

You can also add custom middleware handler per route and/or a complete routing group. This makes
it easier to differentiate beetween public and protected areas, as well as api resources etc.

More details: [config/routes.php](https://github.com/odan/psr7-skeleton/blob/master/config/routes.php)

<hr>

Navigation: [Index](readme.md)