<?php

    // get our secrets file ($connection_details)
    require_once($_SERVER['DOCUMENT_ROOT'] . '/shared/secrets.php');

    // connect to our database
    try {
      $dbh = new PDO("mysql:host={$connection_details['host']};dbname={$connection_details['database']}", $connection_details['username'], $connection_details['password']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      echo 'Connection failed: ' . $e->getMessage();
    }

?>