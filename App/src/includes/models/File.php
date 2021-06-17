<?php

namespace App\models;

use App\DataFile;
use Exception;
use finfo;

class File
{
    use DataFile;

    /**
     * Path to save files
     */
    const FOLDER = 'App/data/storage';

    /**
     * 
     */
    function __construct(?string $slug = null)
    {
        $this->init($slug);
        $this->path = self::FOLDER . '/' . session_id() . '/';
        if (!file_exists($this->path) && !mkdir($this->path, 0777, true))
            throw new Exception('PHP can\'t create folder ' . $this->path . ' !');
    }

    /**
     * 
     */
    function moveUploaded($file)
    {
        if (file_exists($file['tmp_name'])) {
            $this->filename = sha1($file['name'] . $file['size'] . $file['type'] . microtime());
            $this->crc32 = crc32(file_get_contents($file['tmp_name']));
            $this->name = $file['name'];
            $this->size = $file['size'];
            $this->type = $file['type'];
            move_uploaded_file($file['tmp_name'], $this->path . $this->filename);
            $this->save();
        }
    }

    /**
     * 
     */
    function unlink(): void
    {
        if ($this->exist()) {
            unlink($this->path .  $this->filename);
            $this->delete();
        }
    }

    /**
     * 
     */
    function list()
    {
        if (false !== ($list = scandir($this->path)))
            return $list;
        return [];
    }

    /**
     * 
     */
    function exists(?string $filename = null)
    {
        $filename = $filename ?? $this->filename;
        return file_exists($this->path . $filename);
    }

    /**
     * Read a file.
     * 
     * 
     */
    function readfile(?string $filename = null)
    {
        $filename = $filename ?? $this->filename;
        if ($this->exists($filename)) {
            readfile($this->path . $filename);
        }
    }
}
