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
      // remote server
      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
      // Heroku
      if ( $url ) {
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
      }
      $conn_str = getenv("MYSQLCONNSTR_defaultConnection");
      //Azure
      if ( $conn_str ) {
        $parts = explode(';', $conn_str);
        $url = [];
        foreach ( $parts as $part ) {
          $temp = explode('=', $part);
          $url[$temp[0]] = $temp[1];
        }
        $host = $url["Data Source"];
        $dbname = substr($url["Database"], 1);
        $username = $url["User Id"];
        $password = $url["Password"];
      }
    }

    // connect to our database
    try {
      $dbh = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      echo 'Connection failed: ' . $e->getMessage();
    }

?>