<?php

  require_once '../classes/class.crud.php';
  require_once '../config/config.database.php';
  $crud = new CRUD( $config );

  // validate, sanitize, set notifications, and update artists
  // validation rules
  $rules = [
    'required' => ['id', 'name']
  ];
  $result = $crud->vsn_update_record( $_POST['id'], $_POST, $rules, 'artists' );

  // redirect based on result
  if ( $result ) {
    $crud->notification->set_success( 'Artist was updated successfully.' );
    $crud->notification->redirect( '../index.php/artists' );
  } else {
    $crud->notification->set_fail( 'Artist could not be updated.' );
    $crud->notification->redirect( '../index.php/artists/new' );
  }