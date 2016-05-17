<?php

    // get our secrets file ($connection_details)
    if ( file_exists($_SERVER['DOCUMENT_ROOT'] . '/shared/secrets.php') ) {
      // local server
      require_once($_SERVER['DOCUMENT_ROOT'] . '/shared/secrets.php');

      $host = $connection_details['host'];
      $dbname = $connection_details['database'];
      $username = $connection_details['username'];
      $password = $connection_details['password'];
    } else {
      // remote server (Heroku)
      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

      $host = $url["host"];
      $dbname = substr($url["path"], 1);
      $username = $url["user"];
      $password = $url["pass"];
    }

    // connect to our database
    try {
      $dbh = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      echo 'Connection failed: ' . $e->getMessage();
    }

?>