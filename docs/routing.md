# Routing

All requests go through the same cycle:  `routing > middleware > conroller/action > response`

### Routes

All the app routes are defined in the [routes.php](https://github.com/odan/psr7-skeleton/blob/master/config/routes.php) file.

The `$router` variable is responsible for registering the routes. 
You will notice that most routes are enclosed in the `group` method which gives the prefix to the most routes.

Every route is defined by a method corresponds to the HTTP verb. For example, a POST request to register a user is defined by:

```php
$group->post('/users', \App\Action\UserRegisterAction::class);
```

<hr>

Navigation: [Index](index.md)