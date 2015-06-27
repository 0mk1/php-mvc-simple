<?php

class Url
{
  public static function to ($controller, $method, $param=null)
  {
   $routesCollection = Router::getRoutesCollection();
   $key = $controller.'/'.$method;
   $url = null;

   if (array_key_exists($key, $routesCollection))
   {
      $url = $routesCollection[$key];
   }

   if ($param != null)
   {
      $url = str_replace("#id", $param, $url);
   }

   return $url;
  }
}
