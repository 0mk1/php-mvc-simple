<?php

class CommentsController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @param int $id
   * @return Response
   */
  public function index($id)
  {
    $Comment = new Comment();
    $comments = $Comment->all($id);

    return View::make('comments/index', compact('comments', 'id'));
  }

  /**
   * Show the form for creating a new resource.
   * with id injection to store comment for right topic
   *
   * @param int $id
   * @return Response
   */
  public function create($id)
  {
    return View::make('comments/create', compact('id'));
  }

  /**
   * Storing new comment to database.
   *
   * @return Response
   */
  public function store ()
  {
    if (isset($_POST['comment']))
    {
      $id = $_POST['topicid'];
      $values = array(
        'topic_id' => $id,
        'comment'  => $_POST['comment'],
      );
      $Comment = new Comment();
      $Comment->insert($values);

      return Controller::redirect(Url::to('CommentsController', 'index', $id), 'Your comment has been created !');
    }
    else
    {
      return Controller::redirect(Url::to('CommentsController', 'index', $id), 'Error: No comment posted !!');
    }
  }
}
