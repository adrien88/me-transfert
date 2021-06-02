<?php

namespace App\models;

class File
{
    /**
     * 
     */
    function __construct(
        private string $uri = 'file/foo.php',
    ) {
        $this->filename = basename($uri);
    }

    /**
     * 
     */
    function exists($uri)
    {
    }

    /**
     * 
     */
    function rename()
    {
    }
}
