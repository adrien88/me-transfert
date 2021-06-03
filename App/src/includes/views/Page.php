<?php

namespace App\views;

use App\models\Page as ModelsPage;

class Page
{
    function __construct(ModelsPage $page)
    {

        /**
         * prepare page elements here ! 
         * compose menu & onter stuffs
         */

        if (file_exists($page->model) && is_file($page->model))
            include $page->model;
    }
}
