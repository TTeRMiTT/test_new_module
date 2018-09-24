<?php

namespace app\modules\news;


use app\core\Module;

class NewsModule extends Module
{
    public function __construct($id)
    {
        parent::__construct($id);
        $this->basePath = dirname(__DIR__);
    }
}