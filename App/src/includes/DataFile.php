<?php

namespace App;

use Error;
use Exception;

trait DataFile
{
    private string $folder;
    public string $filename = 'default.txt';

    /**
     * 
     */
    function init(string $objname = '')
    {
        $this->filename = $objname;
        $this->makefolder();
        if (!$this->load()) {
            $this->menu = '';
            $this->created = time();
        }
    }

    /**
     * Save data in file
     * 
     */
    function save()
    {
        $path = $this->folder . $this->filename . '.json';
        $data = json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
        return file_put_contents($path, $data);
    }

    /**
     * 
     */
    function load()
    {
        $path = $this->folder . $this->filename . '.json';
        if (file_exists($path)) {
            $data = file_get_contents($path);
            $data = json_decode($data, JSON_OBJECT_AS_ARRAY);
            foreach ($data as $attr => $value)
                $this->$attr = $value;
            return true;
        }
        return false;
    }

    /**
     * 
     */
    function exist()
    {
        $path = $this->folder . $this->filename . '.json';
        return file_exists($path);
    }

    /**
     * 
     */
    function unlink()
    {
        $path = $this->folder . $this->filename . '.json';
        if ($this->exist()) {
            unlink($path);
        }
    }

    /**
     * 
     */
    static function list()
    {
        $folder = 'App/data/' . str_replace('\\', '-', get_class()) . '/*';
        return glob($folder);
    }

    /**
     * 
     */
    function makefolder()
    {
        $this->folder = 'App/data/' . str_replace('\\', '-', get_class()) . '/';
        if (!file_exists($this->folder) && !mkdir($this->folder, 0766, true)) {
            throw new Exception('Impossible de créer le dossier');
        }
    }
}
