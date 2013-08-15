<?php

namespace MS\API\StarTwo\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
	public function indexAction()
	{
		return new JsonResponse(
			array(
				'status' => 'Ok',
				'mensagem' => 'API para integracao entre o WebPDV e o StarTwo',
			)
		);
	}
}