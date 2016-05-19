<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
#config do sistema
$directory = [];
$directory['directoryROOT'] = dirname(__DIR__);

//Registra o memcached
$app->register(new Moust\Silex\Provider\CacheServiceProvider(), array(
    'cache.options' => array(
        'driver' => 'memcache',
        'memcache' => function () {
            $memcache = new \Memcache;
            $memcache->connect('localhost', 8000);
            return $memcache;
        }
    )
));

//Chama a configuração do Doctrine para as entidades da Atitude
require_once $directory['directoryROOT'] . '/config/database.php';

$app->mount('/atitude', new atitude\app\Http\Controllers\AtitudeControllerProvider());
$app['debug'] = true;
$app->run();