<?php

namespace App\models;

use App\DataFile;

class Page
{
    use DataFile;

    function __construct(?string $slug = 'default.html')
    {
        $this->init($slug);
    }

    /**
     * 
     */
    function __destruct()
    {
        // $this->unlink();
    }
}
