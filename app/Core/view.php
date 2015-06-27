<?php

class View
{
  public $content;
  public $variables;
  private $layout;

  public function __construct ($viewPath, $var=[])
  {
    $this->layout = VIEWS_DIR . 'layouts/app.html.php';
    $this->content = VIEWS_DIR . $viewPath . '.html.php';
    $this->variables = $var;
  }

  public static function make ($viewPath, $var=[])
  {
    $view = new View($viewPath, $var);

    foreach ($var as $key => $value)
    {
      $view->$key = $value;
    }

    header('Content-Type: text/html; charset=utf-8');
    session_start();
    include($view->layout);
  }

  public function __destruct ()
  {
    $_SESSION['flash'] = null;
  }

}
