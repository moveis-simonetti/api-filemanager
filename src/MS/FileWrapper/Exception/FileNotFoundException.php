<?php

namespace MS\FileWrapper\Exception;

class FileNotFoundException extends FileException
{
	protected $errorMessage = 'Arquivo %s nao encontrado ou nao pode ser lido.';
}