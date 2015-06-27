<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$router = Router::init();
$router->add('/', 'TopicsController', 'index');
$router->add('/topics', 'TopicsController', 'index');
$router->add('/topics/store', 'TopicsController', 'store');
$router->add('/topics/#id', 'TopicsController', 'destroy');
$router->add('/topics/#id/comments', 'CommentsController', 'index');
$router->add('/topics/#id/comments/create', 'CommentsController', 'create');
$router->add('/topics/#id/comments/store', 'CommentsController', 'store');
$router->start();
