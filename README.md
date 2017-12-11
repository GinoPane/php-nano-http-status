PHP Nano Http Status
============

<sub>Powered by [composer-package-template](https://github.com/GinoPane/composer-package-template)</sub>

[![Latest Stable Version](https://poser.pugx.org/gino-pane/nano-http-status/v/stable)](https://packagist.org/packages/gino-pane/nano-http-status)
[![License](https://poser.pugx.org/gino-pane/nano-http-status/license)](https://packagist.org/packages/gino-pane/nano-http-status)
[![composer.lock](https://poser.pugx.org/gino-pane/nano-http-status/composerlock)](https://packagist.org/packages/gino-pane/nano-http-status)
[![Total Downloads](https://poser.pugx.org/gino-pane/nano-http-status/downloads)](https://packagist.org/packages/gino-pane/nano-http-status)

Truly minimalistic and self-contained package to handle HTTP statuses and relevant description messages. Such packages as 
[Teapot](https://github.com/shrikeh/teapot) or [Httpstatus](https://github.com/lukasoppermann/http-status) are nice and famous, but still
either too heavy and over-complicated or simply does not fit to Gino Pane's high code quality standards.

Requirements
------------

* PHP >= 7.0;
* composer.

Features
--------

* PSR-4 autoloading compliant structure;
* PSR-2 compliant code style;
* Unit-Testing with PHPUnit 6;
* Comprehensive guide and tutorial;
* Easy to use with any framework or even a plain php file;
* Useful tools for better code included.

Installation
============

    composer create-project gino-pane/composer-package-template yourproject
    
This will create a basic project structure for you:

* **/build** is used to store code coverage output by default;
* **/src** is where your codes will live in, each class will need to reside in its own file inside this folder;
* **/tests** each class that you write in src folder needs to be tested before it was even "included" into somewhere else. So basically we have tests classes there to test other classes;
* **.gitignore** there are certain files that we don't want to publish in Git, so we just add them to this fle for them to "get ignored by git";
* **CHANGELOG.md** to keep track of package updates;
* **CONTRIBUTION.md** Contributor Covenant Code of Conduct;
* **LICENSE** terms of how much freedom other programmers is allowed to use this library;
* **README.md** it is a mini documentation of the library, this is usually the "home page" of your repo if you published it on GitHub and Packagist;
* **composer.json** is where the information about your library is stored, like package name, author and dependencies;
* **phpunit.xml** It is a configuration file of PHPUnit, so that tests classes will be able to test the classes you've written;
* **.travis.yml** basic configuration for Travis CI with configured test coverage reporting for code climate.

Please refer to original [article](http://www.darwinbiler.com/creating-composer-package-library/) for more information.

Changelog
=========

To keep track, please refer to [CHANGELOG.md](https://github.com/GinoPane/composer-package-template/blob/master/CHANGELOG.md).

Contributing
============

1. Fork it.
2. Create your feature branch (git checkout -b my-new-feature).
3. Make your changes.
4. Run the tests, adding new ones for your own code if necessary (phpunit).
5. Commit your changes (git commit -am 'Added some feature').
6. Push to the branch (git push origin my-new-feature).
7. Create new pull request.

Also please refer to [CONTRIBUTION.md](https://github.com/GinoPane/composer-package-template/blob/master/CONTRIBUTION.md).

License
=======

Please refer to [LICENSE](https://github.com/GinoPane/composer-package-template/blob/master/LICENSE).

Useful Tools
============

Running tests with Composer:
----------------------------



Code sniffer tool:
------------------

 ```php vendor/bin/phpcs --standard=PSR2 src/```
 
 or
 
 ```composer psr2check```

Code auto-fixer:
----------------

 ```php vendor/bin/phpcbf --standard=PSR2 src/``` 
    
 or
 
 ```composer psr2autofix```
 
PhpUnit:
--------

 ```php vendor/bin/phpunit```
 
 or 
 
 ```composer test```