<?php

use App\models\Page;
use App\Route;
use App\Router;

ini_set("display_errors", "1");

chdir('../');
define('RELPATH', str_replace($_SERVER['DOCUMENT_ROOT'], '',  getcwd()));
define('ASSETS', RELPATH . '/App/src/assets');
define('ROUTE', RELPATH . '/public');

include_once "vendor/autoload.php";

Route::registre([
    'App\controllers\Page',
    'App\controllers\File',
]);
new Router('/page/accueil.php');
