<?php

namespace App\models;

use App\DataFile;
use stdClass;

class Page extends DataFile
{
    function __construct(
        private string $filename,
        public string $model = '',
        private ?stdClass $data = null,
    ) {
        parent::__construct();
        parent::parseEntities();
        $this->data = new stdClass();
    }
}
