<?php

namespace MS\FileWrapper\File;

class File
{
	protected $fileName;

	protected $content;

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
		return file_get_contents($this->getFileName());
	}
}