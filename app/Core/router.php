<?php

final class Router
{
    private static $Instance = false;

    public static function init()
    {
      if( self::$Instance == false )
      {
        self::$Instance = new Router();
      }
      return self::$Instance;
    }

    private function __construct ()
    {
      $this->request = $_SERVER["REQUEST_URI"];
      $this->routesCollection = array();
    }

    public function add ($urlRule, $controller, $method)
    {
      $key = $controller.'/'.$method;
      if(!isset($this->routesCollection[$key]))
      {
        $this->routesCollection[$key] = $urlRule;
      }
    }

    public function start ()
    {
      $urlRules = $this->routesCollection;

      $urlRequest = $this->request;
      $urlRequestMatch = preg_replace("/\d+/", "#id", $urlRequest);

      foreach ($urlRules as $key=>$urlRule)
      {
        $keyArray = preg_split('/\//',$key);
        $controller = $keyArray[0];
        $method = $keyArray[1];

        $urlRule = str_replace("/" , "\/", $urlRule);
        $urlPattern = "/" .$urlRule . "$/";
        if (preg_match($urlPattern, $urlRequestMatch))
        {
          $param = Router::getIdFromUrl($urlRequest);
          Router::action($controller, $method, $param);
          break;
        }
      }
    }

    public static function getRoutesCollection ()
    {
      $router = Router::init();
      return $router->routesCollection;
    }


    private static function getIdFromUrl ($urlRequest)
    {
      $param = preg_split("/\D+/", $urlRequest);
      return $param[1];
    }


    private static function action ($controller, $controllerMethod, $params=null)
    {
      $controller = new $controller;
      $view = $controller->$controllerMethod($params);
      echo $view;
    }
}
