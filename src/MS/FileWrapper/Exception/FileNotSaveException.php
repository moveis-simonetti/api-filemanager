<?php

namespace MS\FileWrapper\Exception;

class FileNotSaveException extends FileException
{
	protected $errorMessage = 'Aconteceu algum erro ao escrever o arquivo %s.';
}