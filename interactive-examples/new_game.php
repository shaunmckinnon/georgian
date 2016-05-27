<?php

  require_once 'class.games.php';

  Admin::notVerifiedRedirect( 'login.php' );

  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $game = new Games();

    if ( !$game->createGame( $_POST['name'], $_POST['sortables'] ) ) {
      echo 'Game could not be added due to an error.';
    } else {
      echo 'Game was created successfully';
    }
  }

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <title>Add New Game</title>
  </head>

  <body>
    <div class="container">
      <?php require_once( 'header.php' ); ?>

      <header>
        <h1 class="page-header">Add New Game</h1>
      </header>

      <section>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="form-group">
            <label for="name">Enter Game Name</label>
            <input class="form-control" type="text" name="name" max="16" placeholder="Bob's Game" required>
          </div>

          <div class="form-group">
            <label for="sortables">Sortables (newline delimited)</label>
            <textarea class="form-control" name="sortables"></textarea>
          </div>

          <div class="form-group">
            <button class="btn btn-primary"><i class="fa fa-plus"></i></button>
          </div>
        </form>
      </section>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>