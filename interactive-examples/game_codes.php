<?php

  require_once( 'class.game_codes.php' );

  $gc = new GameCodes();
  $results = $gc->getAllGameCodes();

  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    switch ( $_POST['command'] ) {
      case 'deactivate':
        $gc->deactivateGameCode( $_POST['id'] );
        break;
      case 'activate':
        $gc->activateGameCode( $_POST['id'] );
        break;
      case 'destroy':
        $gc->destroyGameCode( $_POST['id'] );
        break;
    }

    header( 'Location: game_codes.php' );
  }

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <title>Active Game Codes</title>
  </head>

  <body>
    <div class="container">
      <?php require_once( 'header.php' ); ?>
      
      <header>
        <h1 class="page-header">Active Game Codes</h1>
      </header>

      <section>
        <?php if ( count( $results > 0 ) ): ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <td>Game Code</td>
              <td>Date</td>
              <td>Activate/Deactivate</td>
              <td>Delete</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $results as $result ): ?>
              <tr>
                <td><?= $result['code'] ?></td>
                <td><?= $result['date'] ?></td>
                <?php if ( $result['active'] ): ?>
                  <td><form method="post" action="<?= $_SERVER['PHP_SELF'] ?>"><input type="hidden" name="id" value="<?= $result['id'] ?>" name=""><input type="hidden" name="command" value="deactivate"><button type="submit" class="btn btn-warning"><i class="fa fa-ban"></i></button></form></td>
                <?php else: ?>
                  <td><form method="post" action="<?= $_SERVER['PHP_SELF'] ?>"><input type="hidden" name="id" value="<?= $result['id'] ?>" name=""><input type="hidden" name="command" value="activate"><button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button></form></td>
                <?php endif ?>
                  <td><form method="post" action="<?= $_SERVER['PHP_SELF'] ?>"><input type="hidden" name="id" value="<?= $result['id'] ?>" name=""><input type="hidden" name="command" value="destroy"><button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this resource???');"><i class="fa fa-remove"></i></button></form></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php else: ?>
          <div class="alert alert-danger">No Game Codes</div>
        <?php endif ?>
      </section>

    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>