<?php

namespace App;

use Error;
use Exception;

trait DataFile
{

    /**
     * @var string $folder Folder
     */
    private $folder = 'App/data/';

    /**
     * @var string $filename 
     */
    public string $filename = 'default.txt';

    /**
     * 
     */
    function init(?string $filename = null)
    {
        if (null !== $filename)
            $this->filename = $filename;
        $this->makefolder();
        if (!$this->load()) {
            $this->created = time();
        }
    }

    /**
     * Save data in file
     * 
     */
    function save(): bool
    {
        $path = $this->folder . $this->filename . '.json';
        $data = json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
        $bool = (bool) file_put_contents($path, $data);
        chmod($path, 0777);
        return $bool;
    }

    /**
     * 
     */
    function load(): bool
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
    function exist(): bool
    {
        $path = $this->folder . $this->filename . '.json';
        return file_exists($path);
    }

    /**
     * 
     */
    function delete(): void
    {
        $path = $this->folder . $this->filename . '.json';
        if ($this->exist()) {
            unlink($path);
        }
    }

    /**
     * 
     */
    static function list(): array
    {
        $folder = 'App/data/' . str_replace('\\', '-', get_class()) . '/';
        if (false !== ($list = scandir($folder)))
            return $list;
        else return [];
    }

    /**
     * 
     */
    function makefolder(): void
    {
        $this->folder .= str_replace('\\', '-', get_class()) . '/';
        if (!file_exists($this->folder) && !mkdir($this->folder, 0777, true)) {
            throw new Exception('Impossible de créer le dossier');
        }
    }
}
