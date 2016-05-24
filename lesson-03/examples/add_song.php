<?php
  
  // get our connection script
  require_once( $_SERVER['DOCUMENT_ROOT'] . '/shared/connect.php' );

  // build the SQL statment with placeholders
  $sql = 'INSERT INTO songs (artist_id, title, length) VALUES (:artist_id, :title, :length)';

  // assign our values to variables
  $artist_id = $_POST['artist'];
  $title = $_POST['title'];
  $no_of_secs = ( $_POST['length']['hours'] * 3600 ) + ( $_POST['length']['minutes'] * 60 ) + $_POST['length']['seconds'];
  $length = gmdate("H:i:s", $no_of_secs);

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

  // send user to list of artists
  header('Location: songs.php');

?>