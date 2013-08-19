<?php

include __DIR__ . '/../vendor/autoload.php';

$file = new  MS\FileWrapper\File\File(__DIR__ . '/teste.txt');

var_dump($file->isReadable());

echo $file->getContent();

//$file->setContent('testeknalksdjakls');

//$writter = new MS\FileWrapper\Writter();

var_dump(unlink($file));

