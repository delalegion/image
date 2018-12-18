<?php

use Respect\Validation\Validator as v;

/*
 *
 *
 * Require composer
 *
 *
 */
require __DIR__ . '/../vendor/autoload.php';

/*
 *
 *
 * Starting session
 *
 *
 */
session_start();

/*
 *
 *
 * Variable with app
 *
 *
 */
$app = new \Slim\App([
    'settings'  =>  [
        'displayErrorDetails'   => true,
        'db' => [
            'driver'    => 'mysql',
            'host'  => 'localhost',
            'database'  => 'codeslim',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collaction'    => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'translations'  =>  [
            'path'  =>  __DIR__ . '/../lang',
            'fallback'  => 'pl'
        ]
    ]
]);

/*
 *
 *
 * Variable with container
 *
 *
 */
$container = $app->getContainer();

/*
 *
 *
 * Class with eloquent component
 * Eloquent from laravel framework
 *
 *
 */
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

/*
 *
 *
 * Require front controller
 *
 *
 */
require __DIR__ . '/../app/front.php';

/*
 *
 *
 * Adding rules from Respect\Validation
 *
 *
 */
v::with('App\\Validation\\Rules\\');

/*
 *
 *
 * Require routes
 *
 *
 */
require __DIR__ . '/../app/routes.php';
