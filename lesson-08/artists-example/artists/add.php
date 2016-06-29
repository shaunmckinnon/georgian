<?php

  require_once '../classes/class.crud.php';
  require_once '../config/config.database.php';
  $crud = new CRUD( $config );

  // validate, sanitize, set notifications, and update artists
  // validation rules
  $rules = [
    'required' => ['name']
  ];
  $result = $crud->vsn_add_record( $_POST, $rules, 'artists' );

  // redirect based on result
  if ( $result ) {
    $crud->notification->set_success( 'Artist was added successfully.' );
    $crud->notification->redirect( '../index.php/artists' );
  } else {
    $crud->notification->set_success( 'Artist could not be added.' );
    $crud->notification->redirect( '../index.php/artists/new' );
  }