<?php

namespace App\controllers;

use App\Router;

// #[Router(__CLASS__)]
class Page
{

    #[Router('page/{slug}', methods: ["GET"])]
    function read($slug = null)
    {
        var_dump('test');
    }

    #[Router('page/add', methods: ["GET", "POST"])]
    function add()
    {
    }

    #[Router('page/edit/{slug}', methods: ["GET", "POST"])]
    function edit($slug)
    {
    }

    #[Router('page/delete/{slug}', methods: ["GET"])]
    function del($slug)
    {
    }
}
