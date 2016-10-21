<?php

namespace MS\API\FileManager\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * FileController.
 *
 * @author Vinicius de Sa <viniciusss@me.com>
 */
class FileController
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * FileController constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $nomeArquivo
     *
     * @return JsonResponse
     */
    public function readAction($nomeArquivo)
    {
        try {
            $file = $this->getFileFromRequest($this->app['file.reader']->decodeBase64($nomeArquivo));
            $content = $file->getContent();

            return new JsonResponse(
                [
                    'success' => true,
                    'content' => $content,
                ]
            );
        } catch (\Exception $e) {
            return $this->generateJsonResponseFromException($e);
        }
    }

    /**
     * @param string $nomeArquivo
     * @param string $conteudo
     *
     * @return JsonResponse
     */
    public function saveAction($nomeArquivo, $conteudo)
    {
        try {
            $file = $this->getFileFromRequest($this->app['file.reader']->decodeBase64($nomeArquivo));
            $file->setContent($this->app['file.reader']->decodeBase64($conteudo));
            $this->app['file.writter']->write($file);
        } catch (Exception $e) {
            return $this->generateJsonResponseFromException($e);
        }

        return new JsonResponse(
            ['success' => true]
        );
    }

    /**
     * @param $diretorio
     *
     * @return JsonResponse
     */
    public function listAction($diretorio)
    {
        $files = glob($this->app['file.reader']->decodeBase64($diretorio).'\*');

        return new JsonResponse($files);
    }

    /**
     * @param $nomeArquivo
     *
     * @return JsonResponse
     */
    public function deleteAction($nomeArquivo)
    {
        unlink($this->app['file.reader']->decodeBase64($nomeArquivo));

        return new JsonResponse(
            ['success' => true]
        );
    }

    /**
     * @param $filename
     * @param bool $isNew
     *
     * @return mixed
     */
    protected function getFileFromRequest($filename, $isNew = false)
    {
        $this->app['monolog']->info('Tentando ler o arquivo '.$filename);

        return $this->app['file.reader']->getFile($filename, $isNew);
    }

    /**
     * @param \Exception $exception
     *
     * @return JsonResponse
     */
    protected function generateJsonResponseFromException(\Exception $exception)
    {
        $this->app['monolog']->error($exception->getMessage());

        return new JsonResponse(
            [
                'success' => false,
                'error'   => $exception->getMessage(),
            ],
            $exception->getCode()
        );
    }
}
