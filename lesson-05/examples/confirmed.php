<?php

  // start the session
  session_start();

  // check if the session variables are NOT empty
  if ( !empty( $_SESSION['success'] ) ) {
    // if there is a success message
    $class = 'success';
    $message = $_SESSION['success'];
  } else if ( !empty( $_SESSION['fail'] ) ) {
    // if there is a fail message
    $class = 'danger';
    $message = $_SESSION['fail'];
  } else {
    // user has arrived to this page accidentally
    // redirect the user to artists
    header( 'Location: artists.php' );
  }

  // clear the session variables
  session_unset();

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Confirmation</title>
  </head>

  <body>
    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="alert alert-<?= $class ?>">
      <?= strip_tags($message) ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>