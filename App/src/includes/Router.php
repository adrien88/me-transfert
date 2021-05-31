<?php

namespace App;

use ReflectionClass;


// use App\controllers\Page;
use Attribute;

#[\Attribute(Attribute::TARGET_METHOD)]
class Router
{
    function __construct(
        private string $path,
        private array $methods,
    ) {
        // var_dump($path);
        // var_dump($_SERVER['PATH_INFO']);
    }

    /**
     * Bind Routable methods in class.
     * 
     * @param $classname class to bind 
     * @param 
     */
    static function bindClass(string $classname = '')
    {
        if (class_exists($classname, true)) {

            if ($reflectionClass = new ReflectionClass($classname)) {
                // $classAttributes = $reflectionClass->getAttributes(Router::class);
                // if (!empty($classAttributes)) {
                //     // $classname = 
                //     var_dump($classAttributes);
                // }
                $classname = explode('\\', $classname);
                $classname = end($classname);

                foreach ($reflectionClass->getMethods() as $method) {
                    $attr = $method->getAttributes(Router::class);
                    if (isset($attr[0])) {
                        $attr = $attr[0];

                        var_dump($attr->getArguments());
                        $route = $attr->newInstance();
                    }
                }
            }
        }
    }

    /**
     * To make methods routable with anotations.
     * > #[Router('/{slug}', methods: ["GET"])]
     * 
     * @param array  list of paths to bind
     * @return void  
     */
    static function route(array $routes = []): void
    {
        foreach ($routes as $path)
            self::bindClass($path);
    }
}
