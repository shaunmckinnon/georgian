<?php
  
  // set a common file basename
  $basename = $_SERVER['DOCUMENT_ROOT'] . '/lesson-08/examples';
  $baseurl = '/lesson-08/examples';

  // require the needed classes
  require_once $basename . '/config/config.database.php';
  require_once $basename . '/classes/class.crud.php';
  require_once $basename . '/classes/class.validation.php';
  require_once $basename . '/classes/class.notification.php';

  // instantiate the Notification object as it contains session_start
  $notify = new Notification;

  // instantiate the Database object for use
  $dbh = new Database( $config );

  // require our routes to show the right content
  require_once './routes.php';

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <title><?= isset( $page_title ) ? $page_title : "COMP-1006" ?></title>
  </head>

  <body>
    <?php require_once $basename . '/includes/notifications.php' ?>
    <div class="container">
      <?php require_once $basename . '/includes/navigation.php' ?>
      <h1 class="page-header"><?= isset( $page_title ) ? $page_title : "COMP-1006" ?></h1>

      <div>
        <?php if ( isset( $url ) && !empty( $url ) ) require_once $url ?>
      </div>
    </div>

    <?php $dbh->close() ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>