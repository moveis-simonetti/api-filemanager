<?php

namespace MS\FileWrapper;

use MS\FileWrapper\Exception\FileNotSaveException;
use MS\FileWrapper\Exception\FileNotUnlikedException;
use MS\FileWrapper\File\File;

/**
 * Class Writter
 * @package MS\FileWrapper
 */
class Writter
{
    /**
     * @param File $file
     * @return bool
     */
    public function write(File $file)
    {
        $file->checkIsNotWritable();

        if (false === file_put_contents($file->getPath(), $file->getContent(), LOCK_EX)) {
            throw new FileNotSaveException($file->getPath());
        }

        if (!$this->isEqualToDisc($file)) {
            throw new FileNotSaveException($file->getPath());
        }

        return true;
    }

    /**
     * @param File $file
     */
    public function unlink(File $file)
    {
        $file->checkIsNotReadable();
        $file->checkIsNotWritable();

        if (false === @unlink($file)) {
            throw new FileNotUnlikedException($file->getPath());
        }
    }

    /**
     * @param File $file
     * @return bool
     */
    public function isEqualToDisc(File $file)
    {
        return ($file->getContent() == $file->getContentFromDisc());
    }
}