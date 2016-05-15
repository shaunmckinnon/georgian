<?php
    
  // get our connection script
  require_once( $_SERVER['DOCUMENT_ROOT'] . '/shared/connect.php' );

  // build the SQL statment with placeholders
  $sql = 'INSERT INTO artists (name, founded_date, bio_link, website) VALUES (:name, :founded_date, :bio_link, :website)';

  // assign our values to variables
  $name = $_POST['name'];
  $founded_date = $_POST['founded-date'];
  $bio_link = $_POST['bio-link'];
  $website = $_POST['website'];

  // prepare the SQL statment
  $sth = $dbh->prepare($sql);

  // fill the placeholders
  $sth->bindParam(':name', $name, PDO::PARAM_STR, 50);
  $sth->bindParam(':founded_date', $founded_date, PDO::PARAM_STR);
  $sth->bindParam(':bio_link', $bio_link, PDO::STR, 100);
  $sth->bindParam(':website', $website, PDO::PARAM_STR, 100);

  // execute the SQL and bind the values
  $sth->execute();

  // close the DB connection
  $dbh = null;

?>