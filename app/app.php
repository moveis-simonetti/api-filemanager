<?php

$app = new Silex\Application();

// Carregando providers necessarios
$app->register(
    new Silex\Provider\MonologServiceProvider(),
    [
        'monolog.logfile' => __DIR__.'/logs/development.log',
    ]
);
$app->register(new MS\Provider\FileManagerProvider());
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

ini_set('display_error', 1);
error_reporting(E_ALL);
$app['debug'] = true;

// Carregando rotas
include __DIR__.'/routes.php';

return $app;
