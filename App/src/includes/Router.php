<?php

namespace App;

use App\controllers\Page;
use ReflectionClass;
use ReflectionMethod;

class Router
{
    /**
     * 
     */
    function __construct()
    {

        foreach (Route::$routes as $path => $controller)
            if (strpos($_SERVER['PATH_INFO'], $path) === 0) {

                $slug = str_replace($path, '', $_SERVER['PATH_INFO']);

                $reflectionClass =  array_shift($controller);
                $reflexionMethod =  array_shift($controller);

                if ('__construct' === $reflexionMethod->getName()) {
                    return $reflectionClass->newInstance($slug);
                } // 
                else if ($reflexionMethod->isStatic()) {
                    return call_user_func_array([$reflectionClass->getName(), $reflexionMethod->getName()], []);
                } //  
                else {
                    $controller = $reflectionClass->newInstance();
                    return $controller->$controller[1]();
                }
            }
    }
}
