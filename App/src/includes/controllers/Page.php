<?php

namespace App\controllers;

use App\Route;
use App\models\Page as ModelsPage;
use App\views\Page as ViewsPage;

#[Route('page/')]
class Page
{


    function __construct()
    {
    }

    #[Route('')]
    function default($slug = null)
    {
        $this->read($slug);
    }

    /**
     * Read a page
     */
    #[Route('read/')]
    function read($slug = null)
    {
        $page = new ModelsPage($slug, 'App/src/assets/html/index.php');
        new ViewsPage($page);
    }

    #[Route('add/')]
    function add($slug = null)
    {
        $filename = '../App/src/assets/html/' . $slug;
    }

    #[Route('edit/')]
    function edit($slug)
    {
        var_dump($slug);
    }

    #[Route('delete/')]
    function del($slug)
    {
    }
}
