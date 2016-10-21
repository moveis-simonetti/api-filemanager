<?php

namespace MS\FileWrapper\Exception;

abstract class FileException extends \RuntimeException
{
    protected $errorMessage = '';

    public function __construct($filename, $code = 404)
    {
        if (empty($this->errorMessage)) {
            throw new \InvalidArgumentException('A propriedade errorMessage precisa ser definada.');
        }

        $msg = sprintf($this->errorMessage, $filename);

        parent::__construct($msg, $code);
    }
}
