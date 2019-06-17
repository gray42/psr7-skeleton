## Security

### Session

This application uses `sessions` to store the logged-in user information. If you 
have to add api routes you may use `JWT` or a `OAuth2 Bearer-Token`.

### Authentication

The authentication depends on the defined routes and the attached middleware.
You can add routing groups with Sessions and/or OAuth2 authentication. 
It's up to you how you configure the routes and their individual authentication.

### Authorization

To check user permissions, the Actions controller contains an `Auth` object.

Determine the logged-in user ID::

```php
$userId = $this->auth->getUserId();
```

Checking the user role (permission group):

```php
$isAdmin = $this->auth->hasRole(UserRole::ROLE_ADMIN);
```

### CSRF Protection

All session based requests are protected against Cross-site request forgery (CSRF).

<hr>

Navigation: [Index](readme.md)
