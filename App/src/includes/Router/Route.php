<?php

namespace App\Router;

use ReflectionClass;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class Route
{
    /**
     * List of routes.
     */
    static array $routes = [];

    /**
     * Instance new route and store it in static lsit.
     * 
     * @param string $path
     * @param string $classname
     * @param $method
     */
    function __construct(
        private string $path,
        private $class,
        private $method
    ) {
        self::$routes['/' . $path] = [$class, $method];
    }

    /**
     * Bind Routable methods in class.
     * 
     * @param $classname class to bind 
     * @param 
     */
    static function bindClass(string $classname = ''): void
    {
        if (class_exists($classname, true)) {
            if ($reflectionClass = new ReflectionClass($classname)) {
                $prefix = self::getReflectionPrefix($reflectionClass);
                foreach ($reflectionClass->getMethods() as $method) {
                    $attr = $method->getAttributes(self::class);
                    if (isset($attr[0])) {
                        $path = strtolower($prefix . $attr[0]->getArguments()[0]);
                        new self($path, $reflectionClass, $method);
                    }
                }
            }
        }
    }

    /**
     * Get classe route prefix.
     * 
     * @param ReflectionClass $ReflectionClass Reflection de la classe;
     * @return string 
     */
    static function getReflectionPrefix(\ReflectionClass $ReflectionClass): string
    {
        $classAttributes = $ReflectionClass->getAttributes(self::class);
        if (!empty($classAttributes)) {
            return $classAttributes[0]->getArguments()[0];
        }
        return '';
    }

    /**
     * To make methods routable with anotations.
     * > #[Router('/{slug}', methods: ["GET"])]
     * 
     * @param array  list of paths to bind
     * @return void  
     */
    static function registre(array $routes = []): void
    {
        foreach ($routes as $path)
            self::bindClass($path);
    }
}
