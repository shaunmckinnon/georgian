<?php

    // Localhost or Dreamhost
    if ( file_exists($_SERVER['DOCUMENT_ROOT'] . '/shared/secrets.php') ) {
      // local server
      require_once($_SERVER['DOCUMENT_ROOT'] . '/shared/secrets.php');

      $host = $connection_details['host'];
      $dbname = $connection_details['database'];
      $username = $connection_details['username'];
      $password = $connection_details['password'];
    }

    // Heroku
    if ( preg_match('/Heroku|georgian\.shaunmckinnon\.ca/i', $_SERVER['HTTP_HOST']) ) {
      // remote server
      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
      $host = $url["host"];
      $dbname = substr($url["path"], 1);
      $username = $url["user"];
      $password = $url["pass"];
    }

    // Azure
    if ( preg_match('/Azure/i', $_SERVER['HTTP_HOST']) ) {
      $conn_str = getenv("MYSQLCONNSTR_defaultConnection");
      $parts = explode(';', $conn_str);
      
      $url = [];
      foreach ( $parts as $part ) {
        $temp = explode('=', $part);
        $url[$temp[0]] = $temp[1];
      }

      $host = $url["Data Source"];
      $dbname = $url["Database"];
      $username = $url["User Id"];
      $password = $url["Password"];
    }

    // connect to our database
    try {
      $dbh = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      echo 'Connection failed: ' . $e->getMessage();
    }

?>