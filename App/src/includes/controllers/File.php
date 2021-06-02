<?php

namespace App\controllers;

use App\models\File as ModelsFile;
use App\Route;
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
        // $this->file = new ModelsFile($slug);
        // if ($this->file->exists($slug)) {

        //     $file = $this->file->$slug;
        //     $mime = finfo_file($slug, FILEINFO_MIME);

        //     header('Content-Type: ' . $mime);
        //     echo readfile($file);
        //     exit;
        // } else {
        //     http_response_code(404);
        //     echo 'This file not exists.';
        //     exit;
        // }
        var_dump('ok');
    }

    /**
     * 
     */
    #[Route('send/')]
    function send($slug = null)
    {
        var_dump('ok');

        if (isset($_POST['files'])) {
            var_dump($_POST['files']);
        }

        // var_dump('test');
    }
}
