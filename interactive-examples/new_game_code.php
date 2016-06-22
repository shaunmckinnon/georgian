<?php

  require_once 'class.game_codes.php';

  Admin::notVerifiedRedirect( 'login.php' );

  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $gc = new GameCodes();

    if ( !$gc->createGameCode( $_POST['code'] ) ) {
      echo 'Game code could not be added due to an error. Probably a duplicate.';
    } else {
      echo 'Game code was created successfully';
    }
  }

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <title>Add New Game Code</title>
  </head>

  <body>
    <div class="container">
      <?php require_once( 'header.php' ); ?>

      <header>
        <h1 class="page-header">Add New Game Code</h1>
      </header>

      <section>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="input-group">
            <label for="code" class="input-group-addon">Enter Code</label>
            <input class="form-control" type="text" name="code" max="16" placeholder="1234123412341234">
            <div class="input-group-addon">
              <button><i class="fa fa-plus"></i></button>
            </div>
          </div>
        </form>
      </section>
      
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>