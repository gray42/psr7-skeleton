## Testing

### Unit tests

* todo

#### Debugging unit tests with PhpStorm

To debug tests with PhpStorm you must have to mark the directory `tests/` 
as the test root source.

* Open the project in PhpStorm
* Right click the directory `tests` 
* Select: `Mark directory as`
* Click `Test Sources Root`
* Set a breakpoint within a test method
* Right click `test`
* Click `Debug (tests) PHPUnit`

### HTTP tests

Everything is prepared to run mocked http tests.

Please take a look at the example tests in:

* `tests/TestCase/HomeIndexActionTest.php`
* `test/TestCase/HomePingActionTest.php`

## Database Testing

Everything is ready to run integration tests.

Please take a look at the example tests in:

* `tests/TestCase/Domain/User/UserRepositoryTest.php`

## Mocking

There is no special mocking example available. 

Just use the [PHPUnit mocking functionality](https://phpunit.de/manual/current/en/test-doubles.html)
or install other mocking libraries you want. Feel free.



<hr>

Navigation: [Index](readme.md)
