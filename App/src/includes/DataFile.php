<?php

namespace App;

use Exception;

class DataFile
{
    const FOLDER = 'App/data/';

    private string $folder;
    private array $data;

    function __construct(string $folder = 'App\Class')
    {
        $this->folder = self::FOLDER . $folder . '::';
        if (!file_exists($folder) && !mkdir($folder, 0600, true)) {
            throw new Exception('PHP can\'t write \'' . $folder . '\' folder.');
            die();
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
    function save(string $name)
    {
        $path = $this->folder . $name;
        $data = json_encode($this->data, JSON_PRETTY_PRINT);
        return file_put_contents($path, $data);
    }

    /**
     * 
     */
    function load(string $name)
    {
        $path = $this->folder . $name;
        if (file_exists($path)) {
            $data = file_get_contents($path);
            $this->data = json_decode($data);
        }
    }

    /**
     * 
     */
    function unlink(string $name)
    {
        $path = $this->folder . $name;
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
