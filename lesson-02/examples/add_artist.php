<?php

  // resume our session
  session_start();

  // Check if the form has been submitted
  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    
    // get our connection script
    require_once( $_SERVER['DOCUMENT_ROOT'] . '/shared/connect.php' );

    // build the SQL statment
    $sql = 'INSERT INTO artists (name, founded_date, bio_link, website) VALUES (:name, :founded_date, :bio_link, :website)';

    // remember to catch your errors
    try {
      // prepare the SQL statment
      $sth = $dbh->prepare($sql);
      $sth->execute([
        ':name' => $_POST['name'],
        ':founded_date' => $_POST['founded-date'],
        ':bio_link' => $_POST['bio-link'],
        ':website' => $_POST['website']
      ]);

      // close the DB connection
      $dbh = null;

      // create a success message and store it in our super global session variable
      $_SESSION['success'] = 'New Artist created successfully';

      // send user to success page
      header( 'Location: new_artist.php' );
    } catch (PDOException $e) {
      echo "There was error adding the artist: {$e}";
    }

  }
?>