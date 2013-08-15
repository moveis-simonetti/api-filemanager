<?php

namespace MS\FileWrapper;

use MS\FileWrapper\Exception\FileNotFoundException;
use MS\FileWrapper\Exception\FileNotSaveException;
use MS\FileWrapper\Exception\FileNotWritableException;
use MS\FileWrapper\File\File;

class Writter
{
	public function write(File $file)
	{
		if( ! $this->isWritable(dirname($file->getFileName())) ) {
			throw new FileNotWritableException(
				sprintf('O arquivo %s nao pode ser escrito. Sem permissao.', $file->getFileName())
			);
		}

		if( false === file_put_contents($file->getFileName(), $file->getContent(), LOCK_EX) ) {
			throw new FileNotSaveException(
				sprintf('Aconteceu algum erro ao escrever o arquivo %s.', $file->getFileName())
			);
		}

		if( ! $this->isEqualToDisc($file) ) {
			throw new FileNotSaveException(
				sprintf('O arquivo %s% nao foi gravado corretamente no disco.', $file->getFileName())
			);
		}

		return true;
	}

	public function isWritable($filename)
	{
		return is_writable($filename);
	}

	public function isEqualToDisc(File $file)
	{
		return ($file->getContent() === $file->getContentFromDisc());
	}
}