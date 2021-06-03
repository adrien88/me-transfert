<?php

namespace App;

use Exception;

class DataFile
{
    private string $folder;
    private string $filename = 'default.txt';
    private array $data;

    function __construct(string $name = null)
    {
        var_dump(get_called_class());
        $this->folder = 'App/data/' . get_called_class() . '/';
        if (isset($name)) $this->filename = $name;
        if (!file_exists($this->folder)) {
            mkdir($this->folder, 0766, true);
        }
    }

    /**
     * magic setter
     */
    function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    function __get($name)
    {
        return $this->data[$name];
    }

    function __isset($name)
    {
        return isset($this->data[$name]);
    }

    function __unset($name)
    {
        unset($this->data[$name]);
    }

    /**
     * Save data in file
     */
    function save(string $name = null)
    {
        $path = $this->folder . ($name ?? $this->filename);
        var_dump($path);
        if (isset($name)) $this->filename = $name;
        $data = json_encode($this->data, JSON_PRETTY_PRINT);
        return file_put_contents($path, $data);
    }

    /**
     * 
     */
    function load(string $name = null)
    {
        $path = $this->folder . ($name ?? $this->filename);
        if (file_exists($path)) {
            if (isset($name)) $this->filename = $name;
            $data = file_get_contents($path);
            $this->data = json_decode($data);
        }
    }

    /**
     * 
     */
    function exists(string $name = null)
    {
        $path = $this->folder . ($name ?? $this->filename);
        return file_exists($path);
    }

    /**
     * 
     */
    function unlink(string $name = null)
    {
        $path = $this->folder . ($name ?? $this->filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * 
     */
    function parseEntities()
    {
        $entities = (array) include __DIR__ . '/models/entities/Pages.php';
        foreach ($entities as $entitie) {
            $newObj = new self();
            foreach ($entitie as $key => $value)
                $newObj->$key = $value;
            // if (!$this->exists($newObj->filename)) 
            $newObj->save();
        }
    }
}
