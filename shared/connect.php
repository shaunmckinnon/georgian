<?php

  // check if secrets exists
  if ( file_exists('../../shared/secrets.json') ) {

    // get the file contents and json_decode them
    $secrets = json_decode( file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/shared/secrets.json') );

    $username = $secrets->{'PDO-connection'}->{'username'};
    $password = $secrets->{'PDO-connection'}->{'password'};
    $host = $secrets->{'PDO-connection'}->{'host'};
    $database = $secrets->{'PDO-connection'}->{'database'};


    if ( !empty($username) && !empty($password) && !empty($host) && !empty($database) ) {
      // connect to our database
      try {
        $dbh = new PDO("mysql:host={$host};dbname={$database}", $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch ( PDOException $e ) {
        echo 'Connection failed: ' . $e->getMessage();
      }
    } else {
      echo "You are missing the required connection details.";
    }

  } else {
    echo "Secrets not available.";
  }
  
?>