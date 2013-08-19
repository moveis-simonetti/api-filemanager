<?php

namespace MS\API\FileManager\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

/**
 * FileController
 * @author Vinicius de Sa <viniciusss@me.com>
*/
class FileController
{
	/**
	 * @var Silex\Application
	*/
	protected $app;

	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function readAction()
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

	public function saveAction()
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

	/**
	 * Lista arquivos de um diretorio
	 * @return JsonResponse
	*/
	public function listAction()
	{
		return new JsonResponse(array());
	}

	public function deleteAction()
	{
		return new JsonResponse(array());
	}

	public function deleteMultipleAction()
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