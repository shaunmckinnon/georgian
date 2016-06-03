<?php
  
  /* VALIDATE THE DATA */
  // start the session
  session_start();

  // set an error message variable
  $error_msg = "";

  // set a flag variable
  $validated = true;

  // check if the form has been submitted
  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    // check if any of the required fields are empty
    if ( empty($_POST['name']) ) {
      $error_msg .= "You must enter a name.";
      $validated = false;
    } else {
      $name = $_POST['name'];
    }
  } else {
    // form was submitted in error
    $error_msg .= "Please fill out the form first.";
    $validated = false;
  }

  // if everything is good
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

    // The above isn't required. You are welcome to enter the parameters directly in the connection string.
    $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );

    // add error checking
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // build the SQL
    $sql = 'INSERT INTO categories (name, description) VALUES(:name, :description)';

    // prepare our SQL
    $sth = $dbh->prepare( $sql );

    // bind our values
    $sth->bindParam( ':name', $name, PDO::PARAM_STR, 100 );
    $sth->bindParam( ':description', $description, PDO::PARAM_STR, 500 );

    // execute the SQL
    $sth->execute();

    // close the connection
    $dbh = null;

    // return to products.php
    $_SESSION['success'] = "New category, {$name}, was added successfully.";
    header( "Location: categories.php" );
  } else {
    // return user to form with an error message
    $_SESSION['fail'] = $error_msg;
    header( "Location: new_category.php" );
  }

?>