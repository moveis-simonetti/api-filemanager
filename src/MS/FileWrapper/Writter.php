<?php

namespace MS\FileWrapper;

use MS\FileWrapper\File\File;

class Writter
{
	public function write(File $file)
	{
		if( !$this->isWritable($file->getFileName()) ) {
			throw new FileNotWritableException(sprintf('O arquivo %s nao pode ser escrito. Sem permissao.', $file->getFileName()));
		}

		if( false === file_put_contents($file->getFileName(), $file->getContent()) ) {
			throw new FileNotSaveException(sprintf('O arquivo %s nao pode ser escrito. Sem permissao.', $file->getFileName()));
		}
	}

	public function isWritable(filename)
	{
		return is_writable(filename);
	}
}