<?php

  /* Validating And Sanitizing The Data Before We Input It Into The Database */

  // setting a flag variable to distinguish if the values are good
  $validated = true;
  $error_msg = "";

  // check that the song title isn't empty and sanitize it
  if ( empty($_POST['title']) ) {
    $error_msg = "You must enter a song title.<br>";
    $validated = false;
  } else {
    // sanitize the string and set validated to true
    $_POST['title'] = filter_var( $_POST['title'], FILTER_SANITIZE_STRING );
    $validated = true;
  }

  // check that the artist id isn't empty and is a valid integer
  if ( empty($_POST['artist']) && !filter_var($_POST['artist'], FILTER_VALIDATE_INT) ) {
    $error_msg = "You must select an artist.<br>";
    $validated = false;
  } else {
    $validated = true;
  }

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
  
  if ( $validated == true ) {

    // get our connection script
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

    $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // build the SQL statment with placeholders
    $sql = 'INSERT INTO songs (artist_id, title, length) VALUES (:artist_id, :title, :length)';

    // assign our values to variables
    $artist_id = $_POST['artist'];
    $title = $_POST['title'];

    // convert our time to time stamp format
    $length = "{$_POST['length']['hours']}:{$_POST['length']['minutes']}:{$_POST['length']['seconds']}";

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

    // we relocate to the artist_songs table to see the newly added song
    header( "Location: artist_songs.php?id={$artist_id}" );
  } else {
    // we set the 'fail' session variable and store our message
    $_SESSION['fail'] = $error_msg;

    // we are returning to our form with our error message
    header( 'Location: new_song.php' );
  }

?>