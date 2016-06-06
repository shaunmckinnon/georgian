<?php
  
  // start session
  session_start();

  // assign post values to variables
  $name = $_POST['name'];
  $bio_link = $_POST['bio_link'];

  /* Validate the User Input */
  // create a flag variable to manage validation state
  $validated = true;

  // create a message variable to hold our error message
  $error_msg = "";

  // check if the name was passed empty
  if ( empty( $name ) ) {
    // concatenate an error message
    $error_msg .= "The artist name cannot be empty.<br>";

    // set the validation state
    $validated = false;
  } else {
    // sanitize the data
    $name = filter_var( $name, FILTER_SANITIZE_STRING );
  }

  // check if url was entered and is valid
  if ( !empty( $bio_link ) && !filter_var( $bio_link, FILTER_VALIDATE_URL ) ) {
    // concatenate an error message
    $error_msg .= "The bio link must be in a valid URL format.<br>";

    // set the validation state
    $validated = false;
  }

  // if the validation has failed
  if ( $validated == false ) {
    // set our session message variable
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
  $sql = 'INSERT INTO artists (name, bio_link) VALUES (:name, :bio_link)';

  // prepare our SQL
  $sth = $dbh->prepare( $sql );

  // bind our values
  $sth->bindParam( ':name', $name, PDO::PARAM_STR, 50 );
  $sth->bindParam( ':bio_link', $bio_link, PDO::PARAM_STR, 100 );

  // execute the SQL
  $sth->execute();

  // close our connection
  $dbh = null;

  // provide confirmation
  // define a success message
  $_SESSION['success'] = "The artist, {$name}, was added successfully.<br>";

  // redirect the user
  header( 'Location: confirmed.php' );
  exit;

?>