<div class="container">
  <h1>All comments to this topic</h1>
  <?php foreach ($view->comments as $comment): ?>
    <div class="topic">
      <p><?= htmlspecialchars($comment['comment'], ENT_QUOTES) ?></p>
      <small><?= $comment['created_at'] ?></small>
      <hr>
    </div>
  <?php endforeach; ?>
  <a href="<?= Url::to('CommentsController', 'create', $view->id) ?>"><button class="btn btn-default">Add comment</button></a>
  <a href="/"><button class="btn btn-default">Back to Topics</button></a>
</div>
