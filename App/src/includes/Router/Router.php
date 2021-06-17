<?php

namespace App\Router;

class Router
{
    /**
     * Router will followin class.
     *
     */
    function __construct(string $url = URL, string $namespace = 'App\\controllers\\')
    {
        foreach (Route::$routes as $path => $controller) {
            if (strpos($url, $path) === 0) {
                $reflectionClass =  array_shift($controller);
                $reflexionMethod =  array_shift($controller);
                $slug = str_replace($path, '', $url);
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
