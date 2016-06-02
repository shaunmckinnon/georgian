<?php
  
  /* Validating And Sanitizing The Data Before We Input It Into The Database */

  // setting a flag variable to disitinguish if the values are validated
  $validated = true;

  // variable to store our error message
  $error_msg = "";

  // check that song title isn't empty
  if ( empty($_POST['title']) ) {
    $error_msg .= "You must enter a song title<br>";
    $validated = false;
  } else {
    $_POST['title'] = filter_var( $_POST['title'], FILTER_SANITIZE_STRING );
  }

  // check that the artist id isn't empty is valid integer
  if ( empty($_POST['artist']) || !filter_var($_POST['artist'], FILTER_VALIDATE_INT) ) {
    $error_msg .= "You need to select an artist<br>";
    $validated = false;
  }

  // initiate the session so we can pass some information between pages
  session_start();

  if ( $validated == true ) {
    // connect to the DB
    $dbh = new PDO( "mysql:host=localhost;dbname=comp-1006-lesson-examples", "root", "root" );
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // build the SQL
    $sql = 'INSERT INTO songs (artist_id, title, length) VALUES (:artist_id, :title, :length)';

    // assign our values to variables
    $artist_id = $_POST['artist'];
    $title = $_POST['title'];

    $length = $_POST['length']['hours'] . ':' . $_POST['length']['minutes'] . ':' . $_POST['length']['seconds'];

    // prepare the SQL
    $sth = $dbh->prepare( $sql );

    // bind the values
    $sth->bindParam( ':artist_id', $artist_id, PDO::PARAM_INT );
    $sth->bindParam( ':title', $title, PDO::PARAM_STR, 100 );
    $sth->bindParam( ':length', $length, PDO::PARAM_STR );

    // execute the SQL
    $sth->execute();

    // close the DB
    $dbh = null;

    $_SESSION['message'] = "Song was successfully added";
    header( 'Location: artist_songs.php?artist_id=' . $artist_id );
  } else {
    $_SESSION['message'] = $error_msg;
    header( 'Location: new_song.php' );
  }













