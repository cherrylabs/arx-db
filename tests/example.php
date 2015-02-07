<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Arx\Db\Db;
use Arx\Db\DbModel;
use Arx\Utils\Utils;

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





