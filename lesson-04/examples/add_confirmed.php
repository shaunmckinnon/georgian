<?php

  // initiate the session so we can pass some information between pages
  /*
    session_start() is one of a few functions that modify HTTP headers.
    Any function that modifies the headers must be run before any output is sent
    to the screen.
    If you receive the error
      "Warning: Cannot modify header information - headers already sent (output started at script:line)"
    you are outputting something (maybe a whitespace character) before you've called the function.
  */
  session_start();

  // if either the success or fail message are not empty
  if ( !empty($_SESSION['success']) ) {
    // assign the success message and set class to 'success'
    $message = $_SESSION['success'];
    $class = "success";
  } else if ( !empty($_SESSION['fail']) ) {
    // assign the success message and set class to 'success'
    $message = $_SESSION['fail'];
    $class = "danger";
  } else {
    // the user has stumbled on this page accidentally and needs to be redirected
    header( 'Location: artists.php' );
  }

  // unregister the session variables (clears them)
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
    <div class="alert alert-<?= $class ?>">
      <?= $message ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>