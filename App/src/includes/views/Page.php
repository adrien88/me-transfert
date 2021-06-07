<?php

namespace App\views;

use App\models\Page as ModelsPage;
use App\Router\Route;

class Page
{
    function __construct(ModelsPage $page, string $model = 'App/src/assets/html/index.html')
    {
        $loader = new \Twig\Loader\FilesystemLoader('App/src/assets/html');
        $twig = new \Twig\Environment($loader, [
            // uncomment to enable cache !
            // 'cache' => 'App/cache',
        ]);

        $template = $twig->load($page->filename);
        echo $template->render($page->DOM);
    }
}
