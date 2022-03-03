<?php

$db_config = get_db_config();

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    //'default' => env('DB_CONNECTION', 'mysql'),
    'default' => $db_config['connection'],

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => $db_config['host'],
            'port' => env('DB_PORT', '5432'),
            'database' => $db_config['database'],
            'username' => $db_config['username'],
            'password' => $db_config['password'],
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST_1000y', 'localhost'),
            'port' => env('DB_PORT_1000y', '1433'),
            'database' => env('DB_DATABASE_1000y', 'forge'),
            'username' => env('DB_USERNAME_1000y', 'forge'),
            'password' => env('DB_PASSWORD_1000y', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

        'sqlsrv_yh' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST_YH', 'localhost'),
            'port' => env('DB_PORT_YH', '1433'),
            'database' => env('DB_DATABASE_YH', 'forge'),
            'username' => env('DB_USERNAME_YH', 'forge'),
            'password' => env('DB_PASSWORD_YH', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

        'laravel-visits' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 3, // anything from 1 to 15, except 0 (or what is set in default)
        ],

    ],

    'sdb' => [
        'userdata' => str_finish(env('P_USER_DATA', '/'), '/'),
        'tgs' => [
            'guild' => str_finish(env('P_1000y_TGS', '/'), '/').'Guild/',
            'init' => str_finish(env('P_1000y_TGS', '/'), '/').'Init/',
            'itemlog' => str_finish(env('P_1000y_TGS', '/'), '/').'Itemlog/',
            'setting' => str_finish(env('P_1000y_TGS', '/'), '/').'Setting/',
        ],
    ],

];
