<?php

  session_start(); // must be called in order to dump $_SESSION


  /* VARIABLES */
  // valid variable naming conventions
  $full_name = "Bobby Brown"; // common naming convention
  $fullName = "Bobby Brown"; // used but not as common as above
  $FullName = "Bobby Brown"; // rarely used but valid
  $Full_Name_for_Sure = "Bobby Brown"; // even rarer
  $_fullName = "Bobby Brown"; // valid, but not generally used. Use to be used for private/protected properties in a class

  // invalid (uncomment the line to see the error result)
  // $full-name = "Bobby Brown"; // you cannot use dashes to separate words
  // $1twoThree = "Bobby Brown"; // a variable cannot begin with a number
  // $full name = "Bobby Brown"; // you cannot use spaces to separate words
  // $full~name = "Bobby Brown"; // you cannot use most special characters


  /* ARRAYS AND ASSOCIATIVE ARRAYS */
  // arrays
  echo '<h3>Arrays & Associative Arrays</h3>';
  $arr = array( 'string', 1, 2.0, true ); // unlike many languages, it isn't strict
  $arr = ['string', 1, 2.0, true]; // shorthand
  echo '<pre>', var_dump($arr), '</pre>';

  // associative arrays
  $as_arr = array( 'string' => 'Hello World', 'integer' => 1, 'float' => 2.0, 'boolean' => true );
  $as_arr = ['string' => 'Hello World', 'integer' => 1, 'float' => 2.0, 'boolean' => true];
  echo '<pre>', var_dump($as_arr), '</pre>';


  /* CONSTANTS */
  // valid constant naming conventions
  define( 'FULLNAME', 'Bobby Brown' ); // most common naming convention
  define( '_FULLNAME', 'Bobby Brown' ); // used usually to define protected/private properties in a class
  define( '__FULLNAME__', 'Bobby Brown' ); // valid, but should be avoided as PHP magic properties could break your script

  // invalid (these will only throw an error when you attempt to use them)
  define( '1TWOTHREE', 'Bobby Brown' ); // a constant cannot begin with a number
  define( '$FULLNAME', 'Bobby Brown' ); // a constant cannot begin with a number
  define( 'FULL~NAME', 'Bobby Brown' ); // a constant cannot begin with a number


  /* PHP DEFINED SUPER GLOBALS AVAILABLE */
  // these super globals are available throughout your scripts
  // $GLOBALS, $_SERVER, $_GET, $_POST, $_FILES, $_COOKIE, $_SESSION, $_REQUEST, $_ENV

  // uncomment the line below to see what is contained within (some have data already)
  echo '<h3>$GLOBALS</h3>';
  echo '<pre>', var_dump( $GLOBALS ), '</pre>';
  echo '<h3>$_SERVER</h3>';
  echo '<pre>', var_dump( $_SERVER ), '</pre>';
  echo '<h3>$_GET</h3>';
  echo '<pre>', var_dump( $_GET ), '</pre>';
  echo '<h3>$_POST</h3>';
  echo '<pre>', var_dump( $_POST ), '</pre>';
  echo '<h3>$_FILES</h3>';
  echo '<pre>', var_dump( $_FILES ), '</pre>';
  echo '<h3>$_COOKIE</h3>';
  echo '<pre>', var_dump( $_COOKIE ), '</pre>';
  echo '<h3>$_SESSION</h3>';
  echo '<pre>', var_dump( $_SESSION ), '</pre>';
  echo '<h3>$_REQUEST</h3>';
  echo '<pre>', var_dump( $_REQUEST ), '</pre>';
  echo '<h3>$_ENV</h3>';
  echo '<pre>', var_dump( $_ENV ), '</pre>';


  /* RESERVED KEYWORDS */
  echo '<a href="http://php.net/manual/en/reserved.keywords.php">Reserved Words in PHP</a>';

?>