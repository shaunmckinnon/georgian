<?php
  
  /* Validating And Sanitizing The Data Before We Input It Into The Database */

  // setting a flag variable to distinguish if the values are good
  $validated = true;

  // validate that the $_POST['artist_name'] contains a value
  if ( empty($_POST['name']) ) {
    $validated = false;
  } else {
    // sanitize the string
    $_POST['name'] = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
  }

  // validate that the bio_link is in an URL format IF the field isn't empty
  if ( !empty($_POST['bio_link']) && !filter_var($_POST['bio_link'], FILTER_VALIDATE_URL) ) {
    $validated = false;
  }

  // creating a condition to stop this execution if the values aren't valid
  if ( $validated == true ) {

    // assign variables
    $artist_name = $_POST['name'];
    $bio_link = $_POST['bio_link'];
    
    // connection to database
    // Heroku
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

    // build the SQL
    $sql = 'INSERT INTO artists (name, bio_link) VALUES (:name, :bio_link)';

    // prepare our SQL
    // ALTER TABLE artists ADD UNIQUE (name);
    try {
      $sth = $dbh->prepare( $sql );
      $sth->bindParam( ':name', $artist_name, PDO::PARAM_STR, 50 );
      $sth->bindParam( ':bio_link', $bio_link, PDO::PARAM_STR, 100 );

      // execute the SQL
      $sth->execute();

      // close our connection
      $dbh = null;

      // provide confirmation
      header( 'Location: new_artist_confirm.php' );
    } catch ( PDOException $e ) {
      if ( $e->errorInfo[1] == 1062 ) {
        // verify that the artist name isn't a duplicate
        header( 'Location: new_artist_fail.php' );
      } 

      header( 'Location: new_artist_fail.php' );       
    }

  } else {
    header( 'Location: new_artist_fail.php' );
  }

?>