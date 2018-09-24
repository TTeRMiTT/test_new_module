<?php

namespace app\modules\site;


use app\core\Module;

class SiteModule extends Module
{

    public function __construct($id)
    {
        parent::__construct($id);
        $this->basePath = dirname(__DIR__);
    }

}