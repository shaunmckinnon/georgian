<?php
  
  /* Validating And Sanitizing The Data Before We Input It Into The Database */

  // initiate the session so we can pass some information between pages
  /*
    session_start() is one of a few functions that modify HTTP headers.
    Any function that modifies the headers must be run before any output is sent
    to the screen.
    If you receive the error
      "Warning: Cannot modify header information - headers already sent (output started at script:line)"
    you are outputting something (maybe a whitespace character) before you've called the function.
  */
  session_start();

  // setting a flag variable to distinguish if the values are good
  $validated = true;

  // set a variable to store the error messages
  $error_msg = "";

  // assign $_POST values to variables
  $name = $_POST['name'];
  $bio_link = $_POST['bio_link'];

  // validate that the $_POST['name'] contains a value
  if ( empty($name) ) {
    $error_msg .= "You must provide an artist name.</br>";
    $validated = false;
  } else {
    // sanitize the string
    $aritst_name = filter_var( $name, FILTER_SANITIZE_STRING );
  }

  // validate that the bio_link is in an URL format IF the field isn't empty
  if ( !empty($bio_link) && !filter_var($bio_link, FILTER_VALIDATE_URL) ) {
    $error_msg .= "The Bio Link URL must be in the correct format.</br>";
    $validated = false;
  }

  // creating a condition to stop this execution if the values aren't valid
  if ( $validated == true ) {
    
    // SHAUN'S CONNECTION DETAILS (YOU NEED TO USE YOUR OWN OR REPLACE THE VALUES)
    if ( preg_match('/Heroku|georgian\.shaunmckinnon\.ca/i', $_SERVER['HTTP_HOST']) ) {
      // remote server
      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
      $host = $url["host"];
      $dbname = substr($url["path"], 1);
      $username = $url["user"];
      $password = $url["pass"];
    } else { // localhost
      $host = 'localhost';
      $dbname = 'comp-1006-lesson-examples';
      $username = 'root';
      $password = 'root';
    }

    // connect to the DB
    $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // build the SQL
    $sql = 'INSERT INTO artists (name, bio_link) VALUES (:name, :bio_link)';

    // prepare our SQL
    $sth = $dbh->prepare( $sql );
    $sth->bindParam( ':name', $name, PDO::PARAM_STR, 50 );
    $sth->bindParam( ':bio_link', $bio_link, PDO::PARAM_STR, 100 );

    // execute the SQL
    $sth->execute();

    // close our connection
    $dbh = null;

    // we set the 'success' session variable and store our message
    $_SESSION['success'] = "Artist was added successfully";

    // we redirect to a page with a success message
    header( "Location: add_confirmed.php" );
  } else {
    // we set the 'fail' session variable and store our message
    $_SESSION['fail'] = $error_msg;

    // we redirect to a page with the failed message
    header( 'Location: add_confirmed.php' );
  }

?>