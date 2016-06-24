<?php

  // assign $_POST values to variables
  $artist_id = $_POST['artist'];
  $title = $_POST['title'];
  $length = implode(":", $_POST['length']);

  /* Validate User Input */
  // start the session
  session_start();

  // create a flag variable to manage validation state
  $validated = true;

  // create a message variable to hold our error message
  $error_msg = "";

  // validate that the artist has been selected
  if ( empty( $artist_id ) ) {
    // concatenate an error message
    $error_msg .= "An artist must be selected.<br>";

    // set the validation state
    $validated = false;
  }

  // validate the song title isn't empty
  if ( empty( $title ) ) {
    // concatenate an error message
    $error_msg .= "The song title can't be empty.<br>";

    // set the validation state
    $validated = false;
  } else {
    // sanitize the data
    $title = filter_var( $title, FILTER_SANITIZE_STRING );
  }

  // convert length to null if its empty
  if ( preg_match( "/^\:\:$/", $length ) ) {
    $length = null;
  }

  // validate if the length isn't empty and doesn't match the time pattern
  if ( !empty( $length ) && !preg_match("/^([0-9]|0[0-9]|1[0-9]|2[0-3])\:([0-9]|[0-5][0-9])\:([0-9]|[0-5][0-9])$/", $length) ) {
    // concatenate an error message
    $error_msg .= "The song length isn't in the valid format.<br>";

    // set the validation state
    $validated = false;
  }

  // if the validation has failed, redirect the user to the our confirmation page
  if ( $validated == false ) {
    // set our session variable with the error message
    $_SESSION['fail'] = "The song could not be added:<br>{$error_msg}";

    // redirect the user and exit the script
    header( 'Location: confirmed.php' );
    exit;
  }

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

  // prepare the SQL statment
  $sth = $dbh->prepare($sql);

  // bind the values
  $sth->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
  $sth->bindParam(':title', $title, PDO::PARAM_STR, 100);
  $sth->bindParam(':length', $length, PDO::PARAM_STR);

  // execute the SQL
  $sth->execute();

  // close the DB connection
  $dbh = null;

  // provide confirmation
  // set our session variable with the error message
  $_SESSION['success'] = "You have added the song, {$title}, successfully.";

  // redirect the user and exit the script
  header( 'Location: confirmed.php' );
  exit;

?>