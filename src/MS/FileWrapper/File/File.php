<?php

namespace MS\FileWrapper\File;

use MS\FileWrapper\Exception\FileNotFoundException;
use MS\FileWrapper\Exception\FileNotWritableException;

class File extends \SplFileInfo
{
	/**
	 * Content of the file
	 * @var string
	*/
	protected $content;

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function getContent()
	{
		if( is_null($this->content) )
			$this->setContentFromDisc();

		return $this->content;
	}

	public function setContentFromDisc()
	{
		$this->setContent(
			$this->getContentFromDisc()
		);
	}

	public function getContentFromDisc()
	{
		$this->checkIsNotReadable();
		return file_get_contents($this->getPathName());
	}

	public function checkIsNotWritable()
	{
		if( ! $this->isWritable() ) {
			throw new FileNotWritableException($this->getPathName());
		}
	}

	public function checkIsNotReadable()
	{
		if( ! $this->isReadable() ) {
			throw new FileNotFoundException($this->getPathName());
		}
	}
}