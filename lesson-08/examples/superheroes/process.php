<?php

  session_start();

  // validate the 'action' is present
  if ( !isset( $_POST['action'] ) || !in_array( $_POST['action'], ['new', 'edit', 'delete'] ) ) {
    $_SESSION['fail'] = 'You have been redirected.';
    header( 'Location: superheroes.php' );
    exit;
  } else {
    $action = $_POST['action'];

    // don't forget to unset action as you will get an error
    // when the database attempts to add it
    unset( $_POST['action'] );
  }

  // validate based on action
  require_once '../classes/class.validate.php';
  $v = new Validate;

  // action is add or update
  if ( in_array( $action, ['new', 'edit'] ) ) {
    // validate the required fields
    if ( !$v->required( $_POST['alias'] ) ) {
      // set the fail message
      $_SESSION['fail'][] = 'You must include an alias.';
    }
  }

  // action is update or delete
  if ( in_array( $action, ['edit', 'delete'] ) ) {
    // validate the ID has been included
    if ( !$v->exists( $_POST['id'] ) || !$v->number( $_POST['id'] ) ) {
      // set the fail message
      $_SESSION['fail'][] = 'You must select a superhero.';
    }
  }

  // redirect if validation has failed
  if ( !$v->get_valid() ) {
    header( 'Location: superheroes.php' );
    exit;
  }

  // database operations
  require_once '../classes/class.database.php';
  $dbh = new Database;
  switch ( $action ) {
    case 'new':
      if ( $dbh->create( 'superheroes', $_POST ) ) {
        $_SESSION['success'] = 'The superhero was created successfully.';
      }
      break;

    case 'edit':
      if ( $dbh->update( 'superheroes', $_POST ) ) {
        $_SESSION['success'] = 'The superhero was created successfully.';
      }
      break;

    case 'delete':
      if ( $dbh->create( 'superheroes', $_POST['id'] ) ) {
        $_SESSION['success'] = 'The superhero was created successfully.';
      }
      break;
  }

  // check for a fail, and redirect
  if ( $dbh->get_error_message() ) {
    $_SESSION['fail'][] = 'There was an error: ' . $dbh->get_error_message();
  }

  header( 'Location: superheroes.php' );
  exit;