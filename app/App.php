<?php

namespace app;

use app\core\Request;

/**
 * @property Request $request
 */

class App
{
    /** @var $app App*/
    public static $app;
    public        $baseUrl;
    public        $request;
    protected     $_config;

    public function __construct()
    {
        App::$app = $this;
        $this->renderConfig();
    }

    /**
     * @return mixed
     */
    public function renderConfig()
    {
        $dir_config = ROOT . '/config';
        $config     = array_diff(scandir($dir_config), array('..', '.'));
        foreach ($config as $dir) {
            foreach ((require $dir_config . '/' . $dir) as $key => $value) {
                if ($key == 'component' && is_array($value)) {
                    foreach ($value as $key_component => $value_component) {
                        self::$app->$key_component = $value_component;
                    }
                } else {
                    self::$app->$key = $value;
                }
            }
        }


    }

    /**
     * @param $baseUrl
     *
     */
    public function run($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->request = $this->getRequest();
        $route         = $this->getRouter()->parseRequest(trim(str_replace($baseUrl, '', $this->request->getUri()),
          '/'));
        $module_dir    = ROOT . '/modules/' . $route['module'];
        if (!file_exists($module_dir . '/' . $route['module'] . 'Module.php')) {
            $route = [
              'module'     => 'site',
              'baseUrl'    => 'site',
              'controller' => 'site',
              'params'     => [$route['module']],
            ];
        }
        $name_module  = '\\app\\modules\\' . $route['module'] . '\\' . ucfirst($route['module']) . 'Module';
        $module       = new $name_module((object)$route);
        $this->module = $module;
        echo $module->init();

    }

    public function __call($class, $arg)
    {
        $class = '\\app\\core\\' . str_replace('get', '', $class);

        return new $class($arg);
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->_config)) {
            return $this->_config[$key];
        }

        return false;
    }

    public function __set($key, $value)
    {
        $this->_config[$key] = $value;
    }


}