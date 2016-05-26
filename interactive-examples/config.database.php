<?php

  // Heroku
  if ( preg_match('/Heroku|georgian\.shaunmckinnon\.ca/i', $_SERVER['HTTP_HOST']) ) {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    define( "DB_HOST", $url['host'] );
    define( "DB_NAME", substr($url['path'], 1) );
    define( "DB_USER", $url['user'] );
    define( "DB_PASS", $url['pass'] );
  } else {
    // Localhost
    define( "DB_HOST", "localhost" );
    define( "DB_NAME", "comp-1006-lesson-examples" );
    define( "DB_USER", "root" );
    define( "DB_PASS", "root" );
  }