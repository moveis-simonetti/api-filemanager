<?php

namespace MS\FileWrapper\File;

class File
{
	protected $fileName;

	public function __construct($filename)
	{
		$this->setFileName($filename);
	}

	public function setFileName($fileName)
	{
		$this->fileName = $fileName;
	}

	public function getFileName()
	{
		return $this->fileName;
	}

	public function getContent()
	{
		return file_get_contents($this->getFileName());
	}
}