# Http-exception-logger-middleware

[![Travis CI](https://api.travis-ci.org/qlimix/http-exception-logger-middleware.svg?branch=master)](https://travis-ci.org/qlimix/http-exception-logger-middleware)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/http-exception-logger-middleware.svg)](https://coveralls.io/github/qlimix/http-exception-logger-middleware)
[![Packagist](https://img.shields.io/packagist/v/qlimix/http-exception-logger-middleware.svg)](https://packagist.org/packages/qlimix/http-exception-logger-middleware)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/http-exception-logger-middleware/blob/master/LICENSE)

Logging exceptions during the http request with PSR-15 middleware.

## Install

Using Composer:

~~~
$ composer require qlimix/http-exception-logger-middleware
~~~

## usage
```php
<?php

use Qlimix\HttpMiddleware\ExceptionLoggerMiddleware;

$logger = new FooBarExceptionLogger();

$loggerMiddleware = new ExceptionLoggerMiddleware($logger);
```

## Testing
To run all unit tests locally with PHPUnit:

~~~
$ vendor/bin/phpunit
~~~

## Quality
To ensure code quality run grumphp which will run all tools:

~~~
$ vendor/bin/grumphp run
~~~

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
