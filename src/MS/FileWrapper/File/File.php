<?php

namespace MS\FileWrapper\File;

use MS\FileWrapper\Exception\FileNotFoundException;
use MS\FileWrapper\Exception\FileNotWritableException;

class File
{
    /**
     * @var string
     */
    private $path;
    /**
     * Content of the file.
     *
     * @var string
     */
    protected $content;

    /**
     * File constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        if (is_null($this->content)) {
            $this->setContentFromDisc();
        }

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

        return file_get_contents($this->path);
    }

    public function checkIsNotWritable()
    {
        if (!is_writable(dirname($this->path))) {
            throw new FileNotWritableException($this->path);
        }
    }

    public function checkIsNotReadable()
    {
        if (!is_readable($this->path)) {
            throw new FileNotFoundException($this->path);
        }
    }
}
