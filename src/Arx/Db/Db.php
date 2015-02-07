<?php namespace Arx\Db;

use Illuminate\Database\Capsule\Manager as ParentClass;
use Illuminate\Events\Dispatcher;
use Arx\Utils\Arr, Arx\Utils\Container;

/**
 * Class DB
 *
 * Works exactly as the Laravel Class DB but it's easily usable outside a Laravel Project
 *
 * @package Arx\Utils
 */
class Db extends ParentClass {

    private static $_aInstances = array();

    public static function config($config = array(
        'driver'    => 'sqlite',
        'host'      => 'localhost',
        'database'  => '',
        'username'  => '',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => ''
    ), $name = 'default'){

        $t = self::getInstance();

        $t->addConnection($config, $name);

        $t->setEventDispatcher(new Dispatcher(new Container));

        // Set the cache manager instance used by connections... (optional)
        //$capsule->setCacheManager(...);

        // Make this Capsule instance available globally via static methods... (optional)
        $t->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $t->bootEloquent();

    }

    public static function configSqlite($param = array()){
        $default = array(
            'driver'   => 'sqlite',
            'database' => '/database/production.sqlite',
            'prefix'   => ''
        );
        return Arr::merge($default, $param);
    }

    public static function configMysql($param = array()){
        $default = array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'database',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        );
        return Arr::merge($default, $param);
    }

    public static function getInstance(){

        $sClass = get_called_class();

        if (!isset(self::$_aInstances[$sClass])) {
            self::$_aInstances[$sClass] = new $sClass;
        }

        return self::$_aInstances[$sClass];
    }

} // class::DB