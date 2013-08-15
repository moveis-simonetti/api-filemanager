<?php

namespace MS\FileWrapper;

use MS\FileWrapper\Exception\FileNotFoundException;
use MS\FileWrapper\File\File;

class Reader
{
	public function getFile($filename, $isNew = false)
	{
		if( ! $this->fileExists($filename) && false === $isNew ) {
			throw new FileNotFoundException(sprintf('Arquivo %s nao encontrado.', $filename));
		}

		return new File($filename);
	}

	public function fileExists($filename)
	{
		return file_exists($filename);
	}

	public function encodeBase64($content)
	{
		return base64_encode($content);
	}

	public function decodeBase64($content)
	{
		return base64_decode($content);
	}
}