<?php

namespace MS\FileWrapper\Exception;

class FileNotWritableException extends FileException
{
	protected $errorMessage = 'O arquivo %s nao pode ser escrito. Sem permissao.';
}