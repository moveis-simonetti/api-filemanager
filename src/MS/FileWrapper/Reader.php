<?php

namespace MS\FileWrapper;

use MS\FileWrapper\Exception\FileNotFoundException;

class Reader
{
	public function getFile($filename)
	{
		if( !$this->fileExists($filename) ) {
			throw new FileNotFoundException('Arquivo nao encontrado.');
		}

		return new File\File($filename);
	}

	public function fileExists($filename)
	{
		return file_exists($filename);
	}

	public function toBase64($content)
	{
		return base64_encode($content);
	}
}