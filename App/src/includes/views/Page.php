<?php

namespace App\views;

use App\models\Page as ModelsPage;

class Page
{
    function __construct(ModelsPage $page, string $model = 'App/src/assets/html/index.php')
    {
        /**
         * prepare page elements here ! 
         * compose menu & onter stuffs
         */
        if (file_exists($model) && is_file($model))
            include $model;
    }

    /**
     * 
     */
    function parse()
    {
    }

    /**
     * 
     */
    function parseVariables(string &$content, array $data = [])
    {
        if (0 != ($nbr = preg_match('/\$[\w]/i', $content, $matches)))
            foreach ($matches as $match) {
                $content = str_replace($match, '', $content);
            }
        return $nbr;
    }

    /**
     * 
     */
    function parseFiles(string &$content)
    {
        if (0 != ($nbr = preg_match('/\#[\w\/\.\-]/i', $content, $matches)))
            foreach ($matches as $match) {
                $file = substr($match, 1);
                if (file_exists($file)) {
                    $include = file_get_contents($file);
                    // garder espace pour parser 
                    // $this->parseFiles($include);
                    $content = str_replace($match, $include, $content);
                }
            }
        return $nbr;
    }
}
