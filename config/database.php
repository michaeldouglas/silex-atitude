<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once $directory['directoryROOT'].'/src/app.php';

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => 
    [
        'atitude_default' => 
        [
            'driver'   => 'pdo_mysql',
            'host'     => "127.0.0.1",
            'dbname'   => "teste_atitude",
            'user'     => "root",
            'password' => "123456",
            'charset'  => 'utf8mb4',
        ]
    ],
));
    
$paths = array("src/atitude/app/Models/Entities/Api");
$isDevMode = false;
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$driverImpl = $config->newDefaultAnnotationDriver('src/atitude/app/Models/Entities/Api');
$config->setProxyDir('src/atitude/app/Models/Entities/Api');
$config->setProxyNamespace('src\atitude\app\Models\Entities\Api');
$config->setAutoGenerateProxyClasses(true);
//Conexão Default da API Atitude
$entityManager = EntityManager::create($app['dbs.options']['atitude_default'], $config);
$app['entityManager'] = $entityManager;