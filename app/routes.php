<?php

use MS\API\FileManager\Controller as Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;

$app['home.controller'] = $app->share(function(){
	return new Controllers\HomeController();
});

$app['file.controller'] = $app->share(function() use($app) {
	return new Controllers\FileController($app);
});

$app->get('/', 'home.controller:indexAction');

$app->post('/read-file', 'file.controller:readAction');

$app->post('/list-files', 'file.controller:listAction');

$app->post('/save-file', 'file.controller:saveAction');

$app->post('/delete-file', 'file.controller:deleteAction');

$app->post('/delete-multiple-files', 'file.controller:deleteMultipleAction');

$app->error(function (\Exception $e, $code){
	
	$return = array(
		'success' => false,
		'message' => $e->getMessage(),
	);

	return new JsonResponse($return);
});