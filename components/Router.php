<?php

/**
 * Класс для работы с маршрутами
 */
class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';

        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    public function run()
    {
        $uri = $this->getURI();

        if (strpos($_SERVER['REQUEST_URI'], 'itemspagination') !== false) {
            include_once('controllers/SiteController.php');
            $controllerObject = new SiteController();
            $parameters = [];
            $actionName = 'actionIndex';
            $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
        }

        if (strpos($_SERVER['REQUEST_URI'], 'items/search') !== false) {
            include_once('controllers/ItemsController.php');
            $controllerObject = new ItemsController();
            $parameters = [];
            $actionName = 'actionSearch';
            $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
        }

        foreach ($this->routes as $uriPattern => $path) {
            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
    }

}
