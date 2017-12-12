PHP Nano Http Status
============

[![Latest Stable Version](https://poser.pugx.org/gino-pane/nano-http-status/v/stable)](https://packagist.org/packages/gino-pane/nano-http-status)
[![Build Status](https://travis-ci.org/GinoPane/php-nano-rest.svg?branch=master)](https://travis-ci.org/GinoPane/php-nano-rest)
[![Maintainability](https://img.shields.io/codeclimate/maintainability/GinoPane/php-nano-http-status.svg)](https://codeclimate.com/github/GinoPane/php-nano-http-status/maintainability)
[![Test Coverage](https://img.shields.io/codeclimate/coverage/github/GinoPane/php-nano-http-status.svg)](https://codeclimate.com/github/GinoPane/php-nano-http-status/test_coverage)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GinoPane/php-nano-http-status/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GinoPane/php-nano-http-status/?branch=master)
[![License](https://poser.pugx.org/gino-pane/nano-http-status/license)](https://packagist.org/packages/gino-pane/nano-http-status)
[![composer.lock](https://poser.pugx.org/gino-pane/nano-http-status/composerlock)](https://packagist.org/packages/gino-pane/nano-http-status)
[![Total Downloads](https://poser.pugx.org/gino-pane/nano-http-status/downloads)](https://packagist.org/packages/gino-pane/nano-http-status)

Truly minimalistic and self-contained package to handle HTTP statuses and relevant description messages. Such packages as 
[Teapot](https://github.com/shrikeh/teapot) or [Httpstatus](https://github.com/lukasoppermann/http-status) are nice and famous, but still
either too heavy and over-complicated or simply does not fit to Gino Pane's high code quality standards.

Requirements
------------

* PHP >= 7.0;

Features
--------

* The full list of HTTP status codes as readable constants;
* relevant status messages;
* ability to customize messages;
* ability to easily detect the class of the status;
* no dependencies in production;
* integrated tools for code quality, testing and building docs.

Installation
============

    composer require gino-pane/nano-http-status

Basic Usage
===========

Check existence of the code (using numeric codes or nice readable constants):

    (new NanoHttpStatus())->statusExists(200); //true
    (new NanoHttpStatus())->statusExists(400); //true
    (new NanoHttpStatus())->statusExists(451); //true
    (new NanoHttpStatus())->statusExists(511); //true
    (new NanoHttpStatus())->statusExists(522); //false
    
Detect the class of the code using code numbers:

    (new NanoHttpStatus())->isInformational(NanoHttpStatus::HTTP_OK); //false
    (new NanoHttpStatus())->isSuccess(202);         //true
    (new NanoHttpStatus())->isRedirection(301);     //true
    (new NanoHttpStatus())->isClientError(404);     //true
    (new NanoHttpStatus())->isServerError(NanoHttpStatus::HTTP_BAD_REQUEST); //false
    
Get status message by status code:

    (new NanoHttpStatus())->getMessage(200); //OK
    (new NanoHttpStatus())->getMessage(451); //Unavailable For Legal Reasons
    (new NanoHttpStatus())->getMessage(452); //Undefined Status
    
Set localization mapping and get custom status messages:

    $status = new NanoHttpStatus([
        NanoHttpStatus::HTTP_BAD_REQUEST => 'Very bad request',
        NanoHttpStatus::HTTP_BAD_GATEWAY => 'Not so bad gateway'
    ]);
    
    $status->getMessage(400); //'Very bad request'
    $status->getMessage(502); //'Not so bad gateway'
    
Please note, that ```NanoHttpStatus``` itself does not throw any exceptions for invalid statuses.

Useful Tools
============

Running Tests:
--------

    php vendor/bin/phpunit
 
 or 
 
    composer test

Code Sniffer Tool:
------------------

    php vendor/bin/phpcs --standard=PSR2 src/
 
 or
 
    composer psr2check

Code Auto-fixer:
----------------

    php vendor/bin/phpcbf --standard=PSR2 src/ 
    
 or
 
    composer psr2autofix
 
 
Building Docs:
--------

    php vendor/bin/phpdoc -d "src" -t "docs"
 
 or 
 
    composer docs

Changelog
=========

To keep track, please refer to [CHANGELOG.md](https://github.com/GinoPane/php-nano-http-status/blob/master/CHANGELOG.md).

Contributing
============

1. Fork it.
2. Create your feature branch (git checkout -b my-new-feature).
3. Make your changes.
4. Run the tests, adding new ones for your own code if necessary (phpunit).
5. Commit your changes (git commit -am 'Added some feature').
6. Push to the branch (git push origin my-new-feature).
7. Create new pull request.

Also please refer to [CONTRIBUTION.md](https://github.com/GinoPane/php-nano-http-status/blob/master/CONTRIBUTION.md).

License
=======

Please refer to [LICENSE](https://github.com/GinoPane/php-nano-http-status/blob/master/LICENSE).
 
Notes
=====
 
Powered by [composer-package-template](https://github.com/GinoPane/composer-package-template)
