<?php
class Controller
{
  public static function redirect ($url, $message=null)
  {
    if ($message != null)
    {
      session_start();
      $_SESSION['flash'] =  $message;
    }
    header("Location: " . $url);
  }
}
