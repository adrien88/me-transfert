<?php

namespace App\controllers;

use App\Router\Route;
use App\models\Page as ModelsPage;
use App\views\Page as ViewsPage;

#[Route('page/')]
class Page
{

    /**
     * 
     */
    #[Route('')]
    function default($slug = null)
    {
        $this->read($slug);
    }

    /**
     * Read a page
     * 
     */
    #[Route('read/')]
    function read($slug = null)
    {
        $page = new ModelsPage($slug);
        new ViewsPage($page, 'App/src/assets/html/index.php');
    }

    /**
     * Add 
     * 
     * @param string $slug
     */
    #[Route('add/')]
    function add(string $slug = null)
    {
        $filename = '../App/src/assets/html/' . $slug;
    }

    /**
     * 
     */
    #[Route('edit/')]
    function edit(string $slug = null)
    {
    }

    /**
     * 
     */
    #[Route('delete/')]
    function del(string $slug = null)
    {
    }
}
