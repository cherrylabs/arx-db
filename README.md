# Blok Db

[![Latest Stable Version](https://poser.pugx.org/arx/db/v/stable.png)](https://packagist.org/packages/arx/db)
[![Total Downloads](https://poser.pugx.org/arx/db/downloads.png)](https://packagist.org/packages/arx/db)
[![License](https://poser.pugx.org/arx/db/license.png)](http://opensource.org/licenses/MIT)


## Features

* Simple wrapper to use Laravel Eloquent in every php project

## Getting started

### Requirements

- PHP > 5.3
- [Composer](http://www.getcomposer.org)

### Installation

In the `require` key of `composer.json` file add the following

```json
"arx/db": "dev-master"
```

```bash
$ composer update
```

```php
    require 'vendor/autoload.php'
```

### How to use it

```php
    require 'vendor/autoload.php';
    
    use Arx\Db\Db;
    use Arx\Db\DbModel;
    use Arx\Utils\Utils;
    
    # Alias just for debugging
    Utils::alias('de', 'Arx\Utils\Utils::predie');
    
    Db::config(
        array(
            'driver'    => 'sqlite',
            'host'      => 'localhost',
            'database'  => __DIR__.'/production.sqlite',
            'username'  => '',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        )
    );
    
    // Example of Table Schema creation
    if(!Db::schema()->hasTable('users')){
        Db::schema()->create('users', function($table){
            $table->increments('id');
            $table->string('email');
            $table->timestamps();
        });
    }
    
    // Example of EloquentModel
    class User extends DbModel {
    
    }
    
    $user = new User;
    
    // Generate a random email for demo
    $user->email = "test@email.com";
    
    $user->save();
    
    de(Db::table('users')->get());
```

### Advanced

See ** [Eloquent Documentation for more advanced feature](http://laravel.com/docs/4.2/eloquent) **

## Release Notes

### Version 4.2.0

- use Laravel tagging version to simplify the version correspondance (so yes we jump directly to 4.2 instead of 1.0)

## License

Blok Db is free software distributed under the terms of the MIT license

## Aditional information

Any questions, feel free to contact me or ask [here](https://github.com/arx/php-db/issues)

Any issues, please [report here](https://github.com/arx/php-db/issues)