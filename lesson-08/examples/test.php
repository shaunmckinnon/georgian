<?php

  // get all artists
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-08/examples/classes/class.database.php';

  $dbh = new Database;

  $dbh->prepare( "SELECT * FROM artists" );
  $dbh->execute();
  $artists = $dbh->allRecords();

  var_dump( $artists );