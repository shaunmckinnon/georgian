<?php
    
  // get our connection script
  require_once( $_SERVER['DOCUMENT_ROOT'] . '/shared/connect.php' );

  // build the SQL statment with placeholders
  $sql = 'INSERT INTO artists (name, bio_link) VALUES (:name, :bio_link)';

  // assign our values to variables
  $name = $_POST['name'];
  $bio_link = $_POST['bio-link'];

  // prepare the SQL statment
  $sth = $dbh->prepare($sql);

  // fill the placeholders
  $sth->bindParam(':name', $name, PDO::PARAM_STR, 50);
  $sth->bindParam(':bio_link', $bio_link, PDO::PARAM_STR, 100);

  // execute the SQL and bind the values
  $sth->execute();

  // close the DB connection
  $dbh = null;

?>