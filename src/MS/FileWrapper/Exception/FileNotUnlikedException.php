<?php

namespace MS\FileWrapper\Exception;

class FileNotUnlikedException extends FileException
{
    protected $errorMessage = 'Aconteceu algum erro ao apagar o arquivo %s.';
}
