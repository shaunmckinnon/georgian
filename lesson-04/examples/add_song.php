<?php

  /* Validating And Sanitizing The Data Before We Input It Into The Database */

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

  // setting a flag variable to distinguish if the values are good
  $validated = true;
  $error_msg = "";

  // assign $_POST values to variables
  $artist_id = $_POST['artist'];
  $title = $_POST['title'];
  $length = $_POST['length'];

  // check that the song title isn't empty and sanitize it
  if ( empty($title) ) {
    $error_msg .= "You must enter a song title.<br>";
    $validated = false;
  } else {
    // sanitize the string and set validated to true
    $title = filter_var( $title, FILTER_SANITIZE_STRING );
  }

  // check that the artist id isn't empty
  if ( empty($_POST['artist']) ) {
    $error_msg .= "You must select an artist.<br>";
    $validated = false;
  }
  
  if ( $validated == true ) {

    // SHAUN'S CONNECTION DETAILS (YOU NEED TO USE YOUR OWN OR REPLACE THE VALUES)
    if ( preg_match('/Heroku|georgian\.shaunmckinnon\.ca/i', $_SERVER['HTTP_HOST']) ) {
      // remote server
      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
      $host = $url["host"];
      $dbname = substr($url["path"], 1);
      $username = $url["user"];
      $password = $url["pass"];
    } else { // localhost
      $host = 'localhost';
      $dbname = 'comp-1006-lesson-examples';
      $username = 'root';
      $password = 'root';
    }

    // connect to the DB
    $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // build the SQL statment with placeholders
    $sql = 'INSERT INTO songs (artist_id, title, length) VALUES (:artist_id, :title, :length)';

    // assign our values to variables
    $artist_id = $_POST['artist'];
    $title = $_POST['title'];

    // convert our time to time stamp format
    $length = "{$length['hours']}:{$length['minutes']}:{$length['seconds']}";

    // prepare the SQL statment
    $sth = $dbh->prepare($sql);

    // bind the values
    $sth->bindParam(':artist_id', $artist_id);
    $sth->bindParam(':title', $title, PDO::PARAM_STR, 100);
    $sth->bindParam(':length', $length, PDO::PARAM_STR);

    // execute the SQL
    $sth->execute();

    // close the DB connection
    $dbh = null;

    // we set the 'success' session variable and store our message
    $_SESSION['success'] = "Song was added successfully";

    // we redirect to a page with a success message
    header( "Location: add_confirmed.php" );
  } else {
    // we set the 'fail' session variable and store our message
    $_SESSION['fail'] = $error_msg;

    // we redirect to a page with the failed message
    header( 'Location: add_confirmed.php' );
  }

?>