<div class="container">
  <h1>Add new comment</h1>
  <hr>
  <form action="<?= Url::to('CommentsController', 'store', $view->id)  ?>" method="post">
      <input type='hidden' name="topicid" value="<?= $view->id ?>"></input>
      <div class="form-group">
        <textarea name="comment" id="comment" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <input type='submit' class='btn btn-primary form-control' value='Add comment'/>
      </div>
  </form>
</div>
