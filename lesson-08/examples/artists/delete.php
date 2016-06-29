<?php

  require_once '../classes/class.crud.php';
  require_once '../config/config.database.php';
  $crud = new CRUD( $config );

  // validate, sanitize, set notifications, and update artists
  $result = $crud->vsn_delete_record( $_POST['id'], 'artists' );

  // redirect based on result
  if ( $result ) {
    $crud->notification->set_success( 'Artist was deleted successfully.' );
    $crud->notification->redirect( '../index.php/artists' );
  } else {
    $crud->notification->set_fail( 'Artist could not be deleted.' );
    $crud->notification->redirect( '../index.php/artists' );
  }