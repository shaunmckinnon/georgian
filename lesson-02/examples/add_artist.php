<?php

  // Check if the form has been submitted
  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    
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

    // execute the SQL and bind the values
    $sth->execute([
      ':name' => $name,
      ':founded_date' => $founded_date,
      ':bio_link' => $bio_link,
      ':website' => $website
    ]);

    // close the DB connection
    $dbh = null;

  }
  
?>