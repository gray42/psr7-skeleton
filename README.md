# PHP Skeleton Application

A very basic PSR-7 / PSR-15 application for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/odan/psr7-skeleton.svg?style=flat-square)](https://packagist.org/packages/odan/psr7-skeleton)
[![Software License](https://img.shields.io/badge/license-BSD-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/odan/psr7-skeleton/master.svg?style=flat-square)](https://travis-ci.org/odan/psr7-skeleton)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/odan/psr7-skeleton.svg?style=flat-square)](https://scrutinizer-ci.com/g/odan/psr7-skeleton/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/odan/psr7-skeleton.svg?style=flat-square)](https://scrutinizer-ci.com/g/odan/psr7-skeleton/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/odan/psr7-skeleton.svg?style=flat-square)](https://packagist.org/packages/odan/psr7-skeleton/stats)

Please have a look at my new skeleton project for Slim 4: [odan/slim4-skeleton](https://github.com/odan/slim4-skeleton)

## Requirements

* PHP 7.2+
* Composer
* MySQL 5.7+
* Apache with mod_rewrite
* [Apache Ant](https://ant.apache.org/)

## Recommended

* NPM

## Features

This project comes configured with:

* Modern coding style (PSR-1, PSR-2, PSR-12)
* PHPDoc Standard (PSR-5, PSR-19)
* Class Autoloader (PSR-4)
* HTTP request and response (PSR-7)
* HTTP Server Request Handlers, Middleware (PSR-15)
* HTTP Factories (PSR-17)
* Dependency injection container (PSR-11)
* Routing
* Single action controllers ([ADR](https://github.com/pmjones/adr/blob/master/ADR.md))
* Logging (PSR-3)
* Translations
* Sessions and Cookies
* Authentication and Authorization
* Database Query Builder
* Database Migrations (Phinx)
* Database Migrations Generator
* Date and time (Chronos)
* Console Commands (Symfony)
* Unit testing (PHPUnit)

**Middleware:**

* CSRF protection
* CORS
* Session
* Language
* Authentication

**Rendering:**

* Twig
* Assets (js, css) minification and caching
* Twig translations

**Continuous integration:**

* Tested on Travis CI and Scrutinizer CI
* Unit tests
* Integration tests (http and database)
* PHPStan (level=max)
* Code style checker and fixer (PSR-1, PSR-2, PSR-12)
* Ant scripts
* Deployment scripts

## Installation

### Manual

* [Download ZIP](https://github.com/odan/psr7-hello-world/archive/master.zip)
* Create a new database
* Run `composer update`
* Run `php bin/cli.php install`
* Open the application in your browser

### Using Composer

Read more: [Installing the application with Composer.](https://odan.github.io/psr7-skeleton/manual-setup.html)

## Documentation

The documentation of this demo application can be found here: [Documentation](https://odan.github.io/psr7-skeleton)

## License

The BSD 2-Clause License. Please see [License File](LICENSE) for more information.

