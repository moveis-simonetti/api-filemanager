<?php

namespace MS\API\FileManager\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class ArquivosController
{
	/**
	 * @var Silex\Application
	*/
	protected $app;

	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function lerAction()
	{
		try {
			$file = $this->getFileFromRequest();
			$content = $this->app['file.reader']->toBase64($file->getContent());
		} catch(\Exception $e) {
			return $this->generateJsonResponseFromException($e);
		}
		
		return new JsonResponse(
			array(
				'success' => true,
				'content' => $content
			)
		);
	}

	public function salvarAction()
	{
		try {
			$file = $this->getFileFromRequest(true);
			$content = $this->app['file.reader']->decodeBase64(
				$this->app['request']->get('content')
			);
			$file->setContent($content);
			$this->app['file.writter']->write($file);
		} catch(Exception $e) {
			return $this->generateJsonResponseFromException($e);
		}

		return new JsonResponse(array(
				'success' => true,
			)
		);
	}

	public function apagarAction()
	{
		return new JsonResponse(array());
	}

	public function apagarVariosAction()
	{
		return new JsonResponse(array());
	}

	protected function getFileFromRequest($isNew = false)
	{
		$filename = $this->app['request']->get('filename');
		$this->app['monolog']->info('Tentando ler o arquivo ' . $filename);
		return $this->app['file.reader']->getFile($filename, $isNew);
	}

	protected function generateJsonResponseFromException(\Exception $exception)
	{
		$this->app['monolog']->error($exception->getMessage());
		return new JsonResponse(
			array(
				'success' => false,
				'error' => $exception->getMessage(),
			),
			$exception->getCode()
		);
	}
}