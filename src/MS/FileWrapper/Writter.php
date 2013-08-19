<?php

namespace MS\FileWrapper;

use MS\FileWrapper\Exception\FileNotSaveException;
use MS\FileWrapper\Exception\FileNotUnlikedException;
use MS\FileWrapper\File\File;

/**
 * 
*/
class Writter
{
	public function write(File $file)
	{
		$file->checkIsNotWritable();

		if( false === file_put_contents($file->getPathName(), $file->getContent(), LOCK_EX) ) {
			throw new FileNotSaveException($file->getPathName());
		}

		if( ! $this->isEqualToDisc($file) ) {
			throw new FileNotSaveException($file->getPathName());
		}

		return true;
	}

	public function unlink(File $file)
	{
		$file->checkIsNotReadable();
		$file->checkIsNotWritable();

		if( false === @unlink($file) )
		{
			throw new FileNotUnlikedException($file->getPathName());
		}
	}

	public function isEqualToDisc(File $file)
	{
		return ($file->getContent() == $file->getContentFromDisc());
	}
}