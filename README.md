# Silex Console Service Provider

[![Build Status](https://img.shields.io/travis/euskadi31/ConsoleServiceProvider/master.svg)](https://travis-ci.org/euskadi31/ConsoleServiceProvider)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/768203f3-aad2-4e23-a3c1-6666bdd3876b.svg)](https://insight.sensiolabs.com/projects/768203f3-aad2-4e23-a3c1-6666bdd3876b)
[![Coveralls](https://img.shields.io/coveralls/euskadi31/ConsoleServiceProvider.svg)](https://coveralls.io/github/euskadi31/ConsoleServiceProvider)
[![HHVM](https://img.shields.io/hhvm/euskadi31/ConsoleServiceProvider.svg)](https://travis-ci.org/euskadi31/ConsoleServiceProvider)
[![Packagist](https://img.shields.io/packagist/v/euskadi31/console-service-provider.svg)](https://packagist.org/packages/euskadi31/console-service-provider)


## Install

Add `euskadi31/console-service-provider` to your `composer.json`:

    % php composer.phar require euskadi31/console-service-provider:~1.0

## Usage

### Configuration

```php
<?php

$app = new Silex\Application;

$app->register(new \Euskadi31\Silex\Provider\ConsoleServiceProvider(), [
    'console.options' => [
        'name' => 'Console',
        'version' => '1.2.3'
    ]
]);

$app['console']->add(new HelloCommand());

$code = $app['console']->run();

exit($code);
```

## License

ConsoleServiceProvider is licensed under [the MIT license](LICENSE.md).
