<?php

final class App
{
  private static $Instance = false;

  public static function run()
  {
    if( self::$Instance == false )
    {
      self::$Instance = new App();
    }
    return self::$Instance;
  }

  private function __construct ()
  {
    include_once 'app/config.php';
    include_once 'app/Core/model.php';
    include_once 'app/Core/view.php';
    include_once 'app/Core/controller.php';
    include_once 'app/Core/router.php';
    include_once 'app/Core/url.php';
    include_once 'app/Models/Topic.php';
    include_once 'app/Models/Comment.php';
    include_once 'app/Helpers/feed.php';
    include_once 'app/Controllers/TopicsController.php';
    include_once 'app/Controllers/CommentsController.php';
    include_once 'app/routes.php';
  }
}
