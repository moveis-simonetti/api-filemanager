<?php

namespace MS\FileWrapper;

use MS\FileWrapper\File\File;

/**
 * Class to create file objects
 * @author Vinicius de Sa <viniciusss@me.com>
*/
class Reader
{
	/**
	 * Get a file by the name, if the file not exists a exception will be throw
	 * @param string $filename
	 * @return MS\FileWrapper\File\File
	 * @throws MS\FileWrapper\Exception\FileNotFoundException
	*/
	public function getFile($filename)
	{
		return new File($filename);
	}

	/**
	 * Return if the file exists
	 * @return boolean
	 * @link http://php.net/file_exists The function file_exists
	*/
	public function fileExists($filename)
	{
		return file_exists($filename);
	}

	/**
	 * Return a encoded base64 from a string
	 * @param string $content
	 * @return string
	 * @see http://php.net/base64_encode The function base64_encoded
	*/
	public function encodeBase64($content)
	{
		return base64_encode($content);
	}

	/**
	 * Return a encoded base64 from a string
	 * @param string $content The string encoded
	 * @return string
	 * @see http://php.net/base64_decode The function base64_encoded
	*/
	public function decodeBase64($content)
	{
		return base64_decode($content);
	}
}