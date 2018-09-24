<?php

namespace app\core;

use app\App;

class Router
{
    public function parseRequest($uri)
    {
        $parse_uri = explode('/', $uri);
        if (count($parse_uri) > 0) {
            if ($parse_uri[0] == '') {
                return [
                  'module'     => 'site',
                  'baseUrl'    => App::$app->baseUrl,
                  'controller' => ucfirst(App::$app->baseUrl),
                  'params'     => [],
                ];
            }

            return [
              'module'     => array_shift($parse_uri),
              'baseUrl'    => App::$app->baseUrl,
              'controller' => ucfirst(App::$app->baseUrl),
              'params'     => (count($parse_uri) > 0) ? $parse_uri : [],
            ];
        }

        return [
          'module'     => 'site',
          'baseUrl'    => 'error',
          'controller' => 'error',
          'params'     => [],
        ];
    }

}