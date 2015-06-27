<?php

class TopicsController extends Controller {
  /**
   * Display a listing of the resource
   *
   * @return Response
   */
  public function index()
  {
    $url = 'feed.xml';
    $topics = Feed::parser($url, 20);

    $Topic = new Topic();
    $topicsDB = $Topic->all();

    return View::make('topics/index', compact('topics', 'topicsDB'));
  }

  /**
   * Store Topic in database
   *
   * @param  Request  $request
   * @return Response
   */
  public function store()
  {
    if (isset($_POST))
    {
      $values = array(
        'title'       => $_POST['title'],
        'date'        => $_POST['date'],
        'description' => $_POST['desc'],
      );
      $topic = new Topic();
      $topic->insert($values);

      return Controller::redirect('/', 'Successfully saved the RSS topic!');
    }
    else
    {
      return Controller::redirect('/', 'Error: Something went wrong!');
    }
  }

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return Response
 */
  public function destroy($id)
  {
    $topic = new Topic();
    $topic->delete($id);

    return Controller::redirect('/', 'Successfully deleted the RSS topic!');
  }
}
