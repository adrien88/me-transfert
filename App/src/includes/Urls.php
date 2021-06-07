<?php

namespace App;

class Urls
{
    use DataFile;

    function __construct(string $url)
    {
        $this->init($url);
    }
}
