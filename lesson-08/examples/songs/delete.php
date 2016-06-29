<?php

  require_once '../classes/class.crud.php';
  require_once '../config/config.database.php';
  $crud = new CRUD( $config );

  // validate, sanitize, set notifications, and update songs
  $result = $crud->vsn_delete_record( $_POST['id'], 'songs' );

  // redirect based on result
  if ( $result ) {
    $crud->notification->set_success( 'Song was deleted successfully.' );
    $crud->notification->redirect( '../index.php/artists/' . $_POST['artist_id'] );
  } else {
    $crud->notification->set_fail( 'Song could not be deleted.' );
    $crud->notification->redirect( '../index.php/artists/' . $_POST['artist_id'] );
  }