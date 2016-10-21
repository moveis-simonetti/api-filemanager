<?php

namespace MS\API\FileManager\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    public function indexAction()
    {
        return new JsonResponse(
            [
                'status'   => 'Ok',
                'mensagem' => 'API para integracao entre o WebPDV e o StarTwo',
            ]
        );
    }
}
