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
        // $this->content = 
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
