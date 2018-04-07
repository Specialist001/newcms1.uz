<?php
namespace Engine;

use Engine\Core\Router\DispatchedRoute;
use Engine\DI\DI;
use Engine\Helper\Common;

class Cms
{
    /**
     * @var DI
     */
    private $di;
    public $router;

    /**
     * cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    /**
     * Run cms
     */
    public function run(){

        try {
            require_once __DIR__ . '/../' . mb_strtolower(ENV) . '/route.php';

            $pluginService = $this->di->get('plugin');
            $plugins = $pluginService->getActivePlugins();

            foreach ($plugins as $plugin) {
                $pluginClass = '\\Provider\\' . $plugin->directory . '\\Provider';
                $pluginObject = new $pluginClass($this->di);

                if (method_exists($pluginClass, 'init')) {
                    $pluginObject->init();
                }
            }

            $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

            if ($routerDispatch == null) {
                $routerDispatch = new DispatchedRoute('ErrorController:page404');
                //$routerDispatch = new DispatchedRoute('LoginController:form');
            }

            list($class, $action) = explode(':', $routerDispatch->getController(), 2);

            $controller = '\\' . ENV . '\\Controller\\' . $class;
            $parameters = $routerDispatch->getParameters();

            call_user_func_array([new $controller($this->di), $action], $parameters);
        } catch (\Exception $e){
            echo $e->getMessage();
            exit;
        }


    }


}