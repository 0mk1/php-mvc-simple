<div class="container">
   <div class="header">
    <a href="/"><h1>StackOverflow Feed</h1></a>
  </div>
  <hr>
<?php foreach ($view->topics as $topic): ?>
    <div class="topic">
       <h3><?= $topic['title'] ?></h3>
       <p>Posted on <?= date("j F Y", strtotime($topic['date'])) ?></p>
       <p><?= $topic['desc'] ?></p>
      <form action="<?= Url::to('TopicsController', 'store') ?>" method="post">
        <input type="hidden" name="title" value='<?= htmlspecialchars($topic['title'], ENT_QUOTES) ?>' />
        <input type="hidden" name="date" value='<?= $topic['date'] ?>' />
        <input type="hidden" name="desc" value='<?= htmlspecialchars($topic['desc'], ENT_QUOTES) ?>' />
        <input type="submit" class="btn btn-default" value='Save to database'/>
      </form>
    </div>
<?php endforeach; ?>
  <hr/>
     <div class="header">
      <h1>Database Topics</h1>
    </div>
<?php foreach ($view->topicsDB as $topic): ?>
   <div class="topic">
     <h3><?= $topic["title"] ?></h3>
     <p><small>Posted on <?= date("j F Y", strtotime($topic["date"])) ?></small></p>
     <p><?=  $topic["description"] ?></p>

     <a href="<?= Url::to('TopicsController', 'destroy', $topic["id"]) ?>"><button class="btn btn-danger">Delete</button></a>
      <a href="<?= Url::to('CommentsController', 'index', $topic["id"]) ?>"><button class="btn btn-default">Show comments</button></a>
    </div>
<?php endforeach; ?>
</div>
