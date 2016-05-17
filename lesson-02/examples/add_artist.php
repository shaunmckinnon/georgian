<?php

  // get our connection script
  require_once( $_SERVER['DOCUMENT_ROOT'] . '/shared/connect.php' );

  // build the SQL statement
  $sql = 'INSERT INTO artists (name, bio_link) VALUES (:name, :bio_link)';

  // assign our values to variables
  $name = $_POST['name'];
  $bio_link = $_POST['bio_link'];

  // prepare the SQL statement
  $sth = $dbh->prepare( $sql );

  // fill the placeholders
  $sth->bindParam( ':name', $name, PDO::PARAM_STR, 50 );
  $sth->bindParam( ':bio_link', $bio_link, PDO::PARAM_STR, 100 );

  // execute the SQL
  $sth->execute();

  // close the DB connection
  $dbh = null;

?>