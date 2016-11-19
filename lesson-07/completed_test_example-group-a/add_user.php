<?php

  /* VALIDATION */
  session_start();

  /* Step 1 - Create a flag variable to monitor validation state and an error message variable to hold the error messages */
  $validated = true;
  $error_msg = "";

  /* Step 2 - Assign all the variables from the $_POST associative array */
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $date_of_birth = $_POST['date_of_birth'];
  $city_id = $_POST['city_id'];

  /* Step 3 - Check if the required fields (first_name, and last_name) are empty */
  if ( empty( $first_name ) ) {
    $error_msg .= "The first name is required.<br>";
    $validated = false;
  }

  if ( empty( $last_name ) ) {
    $error_msg .= "The first name is required.<br>";
    $validated = false;
  }

  /* Step 4 - Check the state of the validation flag and redirect the user with an error message if needed */
  /* HINT: don't forget to exit */
  if ( $validated == false ) {
    $_SESSION['fail'] = "There was an error adding the user: {$error_msg}";
    header( 'Location: confirmed.php' );
    exit;
  }

  /* Step 5 - Connect to the database */
  $dbh = new PDO('mysql:host=localhost;dbname=comp-1006-lesson-examples;', 'root', 'root');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  /* Step 6 - Build a SQL string to insert the new record in the table term1_users */
  $sql = 'INSERT INTO term1_users (first_name, last_name, date_of_birth, city_id) VALUES (:first_name, :last_name, :date_of_birth, :city_id)';

  /* Step 7 - Prepare the SQL statement */
  $sth = $dbh->prepare( $sql );

  /* Step 8 - Bind the values to the placeholders in the SQL statment */
  $sth->bindParam( ':first_name', $first_name, PDO::PARAM_STR, 50 );
  $sth->bindParam( ':last_name', $last_name, PDO::PARAM_STR, 50 );
  $sth->bindParam( ':date_of_birth', $date_of_birth, PDO::PARAM_STR, 50 );
  $sth->bindParam( ':city_id', $city_id, PDO::PARAM_INT );

  /* Step 9 - Execute the SQL statement */
  $sth->execute();

  /* Step 10 - Close the connection */
  $dbh = null;

  /* Step 11 - Redirect the user to the confirmed.php page with a success message */
  /* HINT: don't forget to exit */
  $_SESSION['success'] = "User has been successfully added.<br>";
  header( 'Location: confirmed.php' );
  exit;



