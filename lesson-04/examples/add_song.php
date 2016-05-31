<?php

  // connect to the DB
  $dbh = new PDO( "mysql:host=localhost;dbname=comp-1006-lesson-examples", "root", "root" );
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // build the SQL
  $sql = 'INSERT INTO songs (artist_id, title, length) VALUES (:artist_id, :title, :length)';

  // assign our values to variables
  $artist_id = $_POST['artist'];
  $title = $_POST['title'];

  // create a time stamp
  // $no_of_secs = ( $_POST['length']['hours'] * 3600 ) + ( $_POST['length']['minutes'] * 60 ) + $_POST['length']['seconds'];
  // $length = gmdate( "H:i:s", $no_of_secs );

  $length = $_POST['length']['hours'] . ':' . $_POST['length']['minutes'] . ':' . $_POST['length']['seconds'];

  // prepare the SQL
  $sth = $dbh->prepare( $sql );

  // bind the values
  $sth->bindParam( ':artist_id', $artist_id, PDO::PARAM_INT );
  $sth->bindParam( ':title', $title, PDO::PARAM_STR, 100 );
  $sth->bindParam( ':length', $length, PDO::PARAM_STR );

  // execute the SQL
  $sth->execute();

  // close the DB
  $dbh = null;













