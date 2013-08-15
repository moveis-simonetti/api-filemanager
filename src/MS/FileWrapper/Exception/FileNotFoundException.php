<?php

namespace MS\FileWrapper\Exception;

class FileNotFoundException extends \Exception
{
	public function __construct($msg = '', $code = 404)
	{
		parent::__construct($msg, $code);
	}
}