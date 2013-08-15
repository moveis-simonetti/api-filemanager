<?php

use MS\API\FileManager\Controller as Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;

$app['home.controller'] = $app->share(function(){
	return new Controllers\HomeController();
});

$app['error.controller'] = $app->share(function(){
	return new Controllers\ErrorController();
});

$app['arquivos.controller'] = $app->share(function() use($app) {
	return new Controllers\ArquivosController($app);
});

$app->get('/', 'home.controller:indexAction');

$app->post('/ler-arquivo', 'arquivos.controller:lerAction');

$app->post('/listar-arquivos', 'arquivos.controller:lerAction');

$app->post('/salvar-arquivo', 'arquivos.controller:salvarAction');

$app->post('/apagar-arquivo', 'arquivos.controller:apagarAction');

$app->post('/apagar-varios-arquivos', 'arquivos.controller:apagarVariosAction');

$app->error(function (\Exception $e, $code){
	
	$return = array(
		'success' => false,
		'message' => $e->getMessage(),
	);

	return new JsonResponse($return);
});