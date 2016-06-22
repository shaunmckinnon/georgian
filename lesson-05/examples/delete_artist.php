<?php

  // session start
  session_start();

  // assign the post value to a variable
  $artist_id = $_POST['id'];

  // is artist ID empty?
  if ( empty( $artist_id ) ) {
    $_SESSION['fail'] = "You have not seelcted an artist to delete.<br>";
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
  $sql = 'DELETE FROM artists WHERE id = :id';

  // prepare the SQL
  $sth = $dbh->prepare( $sql );

  // bind the value
  $sth->bindParam( ':id', $artist_id, PDO::PARAM_INT );

  // execute
  $sth->execute();

  // close the DB
  $dbh = null;

  // redirect to confirm with success message
  $_SESSION['success'] = "You have successfully deleted the artist.<br>";
  header( 'Location: confirmed.php' );
  exit;










