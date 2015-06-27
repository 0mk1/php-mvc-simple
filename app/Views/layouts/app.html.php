<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RSS App</title>

  <link href="<?= CSS_DIR ?>bootstrap.min.css" rel="stylesheet">
  <link href="<?= CSS_DIR ?>app.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!-- will be used to show any messages -->
<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-info"><?= $_SESSION['flash'] ?></div>
<?php endif; ?>

<div class="container">
    <?php include($view->content); ?>
</div>
  <!-- Scripts -->
</body></html>
</html>
