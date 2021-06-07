<?php

use App\Router\Route;
use App\Router\Router;

define('DEV', true);
if (true === DEV)
    ini_set("display_errors", "1");

# Start session handling
session_start();

chdir('../');
define('RELPATH', str_replace($_SERVER['DOCUMENT_ROOT'], '',  getcwd()));
define('ASSETS', RELPATH . '/App/src/assets');
define('URL', ('/public/index.php' != $_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] :  '/page/accueil.html');

// composer autoloader
include_once "vendor/autoload.php";

try {

    if (true === DEV) {
        foreach (glob('App/src/includes/models/entities/*.php') as $entitie) {
            $classname = 'App\\models\\' . substr(basename($entitie), 0, -4);
            foreach (include $entitie as $page) {
                $objPage = new $classname($page['filename']);
                foreach ($page as $attr => $value)
                    $objPage->$attr = $value;
                $objPage->save();
            }
        }
    }

    Route::registre([
        'App\controllers\Page',
        'App\controllers\File',
    ]);

    new Router();


    //
} catch (Exception $e) {
    var_dump($e->getMessage());
}
