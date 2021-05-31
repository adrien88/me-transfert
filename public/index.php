<?php

use App\Router;

ini_set("display_errors", "1");

include_once "../vendor/autoload.php";

Router::route([
    'App\controllers\Page',
]);
