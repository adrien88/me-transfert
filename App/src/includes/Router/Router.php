<?php

namespace App\Router;

class Router
{
    /**
     * 
     * 
     * 
     */
    function __construct()
    {


        // echo $url;
        // echo '<pre>' . print_r(Route::$routes, 1) . '</pre>';

        foreach (Route::$routes as $path => $controller) {
            if (strpos(URL, $path) === 0) {
                $reflectionClass =  array_shift($controller);
                $reflexionMethod =  array_shift($controller);
                $slug = str_replace($path, '', URL);
            }
        }


        if (isset($reflexionMethod))
            if ('__construct' === $reflexionMethod->getName()) {
                return $reflectionClass->newInstance($slug);
            } // 
            else if ($reflexionMethod->isStatic()) {
                return call_user_func_array([$reflectionClass->getName(), $reflexionMethod->getName()], [$slug]);
            } // 
            else {
                $controller = $reflectionClass->newInstance();
                $method = $reflexionMethod->getName();
                return $controller->$method($slug);
            }
    }
}
