<?php
  
  if ( preg_match( '/Heroku|georgian\.shaunmckinnon\.ca/i', $_SERVER['HTTP_HOST'] ) ) {
    // get the environment connection string
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $config = [
      'host' => $url["host"],
      'dbname' => substr($url["path"], 1),
      'user' => $url["user"],
      'password' => $url["pass"]
    ];
  } else {
    $config = [
      'host' => 'localhost',
      'dbname' => 'comp-1006-lesson-examples',
      'user' => 'root',
      'password' => 'root'
    ];
  }

  define( 'DBHOST', $config['host'] );
  define( 'DBNAME', $config['dbname'] );
  define( 'DBUSER', $config['user'] );
  define( 'DBPASS', $config['password'] );