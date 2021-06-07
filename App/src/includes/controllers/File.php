<?php

namespace App\controllers;

use App\models\File as ModelsFile;
use App\Router\Route;
use finfo;

#[Route('file/')]
class File
{

    #[Route('')]
    function default($slug = null)
    {
        // var_dump('ok');
        // $this->get($slug);
    }

    /**
     * Return JSON data about file
     */
    #[Route('get/')]
    function get(string $slug = null)
    {
        $this->file = new ModelsFile($slug);
        if ($this->file->exists($slug)) {

            $file = $this->file->$slug;
            $mime = finfo_file($slug, FILEINFO_MIME);

            header('Content-Type: ' . $mime);
            echo readfile($file);
            exit;
        } else {
            http_response_code(404);
            echo 'This file not exists.';
            exit;
        }
        var_dump('ok');
    }

    /**
     * 
     */
    #[Route('send/')]
    function send($slug = null)
    {
        var_dump($_FILES);

        // if (isset($_FILES['files'])) {
        //     foreach ($_FILES['files'] as $file) {
        //         $path = '';
        //         move_uploaded_file($file['tmp_name'], $path);
        //     }
        //     // var_dump($_POST['files']);
        // }

        // var_dump('test');
    }
}
