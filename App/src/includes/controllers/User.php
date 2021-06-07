<?php

namespace App\controllers;

use App\Router\Route;
use App\models\User as ModelsUser;

#[Route('User/')]
class Page
{
    function __construct()
    {
    }

    #[Route('login/')]
    function login()
    {
        $_SESSION['try'] = ($_SESSION['try'] ?? 1);
        $data = [];

        if ($_SESSION['try'] >= 3) {
            exit;
        }
        if (!isset($_POST['login'])) {
            $data = [];
            ++$_SESSION['try'];
        }
        if (!isset($_POST['pssword'])) {
            $data = [];
            ++$_SESSION['try'];
        }


        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    #[Route('unlogin/')]
    function unlogin()
    {
        $data = [];
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}
