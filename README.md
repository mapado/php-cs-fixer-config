# Mapado php-cs-fixer-config

[`PHP CS Fixer`](http://github.com/FriendsOfPHP/PHP-CS-Fixer) config for Mapado.

## Installation
```
$ composer require --dev mapado/php-cs-fixer-config
```

## Usage

### Configuration

Create a configuration file `.php_cs` in the root of your project:

```php
<?php

require(__DIR__ .'/vendor/autoload.php');

$config = new \Mapado\CS\Config();

$config->getFinder()
    ->in([
        __DIR__.'/src',
    ])
    // if you want to exclude Tests directory
    // ->exclude([ 'Tests' ])
;

return $config;
```

### Run 
```sh
bin/php-cs-fixer fix --config=.php_cs
```

### In project
You might want to use [lint-staged](https://github.com/okonet/lint-staged), [php-git-hooks](https://github.com/bruli/php-git-hooks) or [composer-git-hooks](https://github.com/BrainMaestro/composer-git-hooks) to run this command automatically on git files, or autofix on save in your IDE.

### Git

Add `.php_cs.cache` (this is the cache file created by `php-cs-fixer`) to `.gitignore`:

## License

This project is licensed under the [MIT license](LICENSE).
