<?php

  /* VALIDATION */
  session_start();

  /* Step 1 - Create a flag variable to monitor validation state and an error message variable to hold the error messages */
  $validated = true;
  $error_msg = "";

  /* Step 2 - Assign all the variables from the $_POST associative array */
  $user_id = $_POST['user_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $date_of_birth = $_POST['date_of_birth'];
  $city_id = $_POST['city_id'];

  /* Step 3 - Check if the required fields (user_id, first_name, and last_name) are empty */
  if ( empty( $user_id ) ) {
    $error_msg .= "You must select a user.<br>";
    $validated = false;
  }

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

  /* Step 6 - Build a SQL string to update the record in the table term1_users based on the user_id */
  $sql = 'UPDATE term1_users SET first_name = :first_name, last_name = :last_name, date_of_birth = :date_of_birth, city_id = :city_id WHERE id = :user_id';

  /* Step 7 - Prepare the SQL statement */
  $sth = $dbh->prepare( $sql );

  /* Step 8 - Bind the values to the placeholders in the SQL statment */
  $sth->bindParam( ':user_id', $user_id, PDO::PARAM_INT );
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
  $_SESSION['success'] = "User has been successfully updated.<br>";
  header( 'Location: confirmed.php' );
  exit;