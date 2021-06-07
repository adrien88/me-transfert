<?php

namespace App\models;

use App\DataFile;

class User
{
    use DataFile;

    /**
     * 
     */
    function __construct()
    {
        $this->init('guest');
        $_SESSION['login'] = 'guest';
    }

    /**
     * 
     */
    static function exists($uri)
    {
    }

    /**
     * 
     */
    function login($uri)
    {
    }

    /**
     * 
     */
    function unlogin()
    {
    }
}
