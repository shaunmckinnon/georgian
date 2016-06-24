<?php

  // start the session
  session_start();

  // assign the $_POST values to variables
  $id = $_POST['id'];
  $name = $_POST['name'];
  $bio_link = $_POST['bio_link'];

  // validate
  // set our validation flag variable
  $validated = true;

  // set variable to store error messages
  $error_msg = "";

  // check that the artist id isn't empty
  if ( empty( $id ) ) {
    // concatenate an error message
    $error_msg .= "You must select an artist.<br>";

    // set the validation state
    $validated = false;
  }

  // check if the name was passed
  if ( empty( $name ) ) {
    // concatenate an error message
    $error_msg .= "The artist name cannot be empty.<br>";

    // set the validate state
    $validated = false;
  } else {
    // sanitize the data
    $name = filter_var( $name, FILTER_SANITIZE_STRING );
  }

  // check if the URL is empty, and IF it isn't, validate that its an URL
  if ( !empty( $bio_link ) && !filter_var( $bio_link, FILTER_VALIDATE_URL ) ) {
    // concatenate an error message
    $error_msg .= "The bio link must be in a valid URL format.<br>";

    // set the validation state
    $validated = false;
  }
  // DON'T FORGET TO FORMAT THE URL IN artists.php AND artist_songs.php //

  // if the validation has failed, redirect the user to the confirmation page
  if ( $validated == false ) {
    // set our session variable with the error message
    $_SESSION['fail'] = "The artist could not be added:<br>{$error_msg}";

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

  // build the SQL
  $sql = 'UPDATE artists SET name = :name, bio_link = :bio_link WHERE id = :id';

  // prepare our SQL
  $sth = $dbh->prepare( $sql );

  // bind the values
  $sth->bindParam( ':name', $name, PDO::PARAM_STR, 50 );
  $sth->bindParam( ':bio_link', $bio_link, PDO::PARAM_STR, 100 );
  $sth->bindParam( ':id', $id, PDO::PARAM_INT );

  // execute the SQL
  $sth->execute();

  // close the connection
  $dbh = null;

  // we set the 'success' session variable and store our message
  $_SESSION['success'] = "Artist was updated successfully.<br>";

  // we redirect to the confirmation page
  header( 'Location: confirmed.php' );
  exit;











