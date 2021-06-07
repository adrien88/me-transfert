<?php

namespace App\models;

use App\DataFile;

class Page
{
    use DataFile;

    function __construct(?string $slug = 'default.html')
    {

        // trait : page init
        $this->init($slug);

        // page default
        $this->DOM['head']['lang'] = 'en';
        $this->DOM['head']['charset'] = 'utf-8';
        $this->DOM['head']['title'] = 'Me-Transfert';

        $this->DOM['meta']['assets'] = RELPATH . '/App/src/assets';
        $this->DOM['meta']['routes'] = RELPATH;

        // page navigation
        $this->DOM['navlinks'] = [];
        foreach ($this->list() as $file) {
            $file = substr(basename($file), 0, -5);
            $text = substr($file, 0, -5);
            $link = RELPATH . '/page/' . $file;
            // $a = '<a href="' .  . '">' . substr($file, 0, -5) . ' </a> ';
            $this->DOM['navlinks'][$text] = $link;
        }
    }

    /**
     * 
     */
    function __destruct()
    {
        // $this->unlink();
    }
}
