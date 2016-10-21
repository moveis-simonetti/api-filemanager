<?php

use MS\API\FileManager\Controller as Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;

$app['home.controller'] = $app->share(
    function () {
        return new Controllers\HomeController();
    }
);

$app['file.controller'] = $app->share(
    function () use ($app) {
        return new Controllers\FileController($app);
    }
);

$app->get('/', 'home.controller:indexAction');

$app->get('/diretorio/{diretorio}', 'file.controller:listAction'); // Listar
$app->get('/file/{nomeArquivo}', 'file.controller:readAction'); // Ler conteúdo

$app->post('/file/{nomeArquivo}/{conteudo}', 'file.controller:saveAction'); // Salvar arquivo

$app->delete('/file/{nomeArquivo}', 'file.controller:deleteAction'); // Remover

$app->error(
    function (\Exception $e, $code) {
        $return = [
            'success' => false,
            'message' => $e->getMessage(),
        ];

        return new JsonResponse($return);
    }
);
