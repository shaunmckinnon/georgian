<?php

  require_once 'class.admin.php';

  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if (Admin::verify( $_POST['username'], $_POST['password'] ) ) {
      echo 'You were logged in successfully';
    } else {
      echo 'Sorry, but there was an error';
    }
  }

  if ( Admin::verified() ) {
    header( 'Location: new_game.php' );
  }

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <title>Login</title>
  </head>

  <body>
    <div class="container">

      <header>
        <h1 class="page-header">Login</h1>
      </header>

      <section>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="form-inline">
            <div class="form-group">
              <div class="input-group">
                <label for="username" class="input-group-addon">Enter Username</label>
                <input class="form-control" type="text" name="username">
                <label for="password" class="input-group-addon">Enter Password</label>
                <input class="form-control" type="password" name="password">
              </div>
              <div class="form-group">
                <button class="btn btn-primary">login</button>
              </div>
            </div>
          </div>
        </form>
      </section>
      
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>