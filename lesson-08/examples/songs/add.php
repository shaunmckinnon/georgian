<?php

  require_once '../classes/class.crud.php';
  require_once '../config/config.database.php';
  $crud = new CRUD( $config );

  // validate, sanitize, set notifications, and update songs
  // validation rules
  $rules = [
    'required' => ['title', 'artist_id']
  ];

  // combine length
  $_POST['length'] = implode( ':', $_POST['length'] );

  $result = $crud->vsn_add_record( $_POST, $rules, 'songs' );

  // redirect based on result
  if ( $result ) {
    $crud->notification->set_success( 'Song was added successfully.' );
    $crud->notification->redirect( '../index.php/artists/' . $_POST['artist_id'] );
  } else {
    $crud->notification->set_success( 'Song could not be added.' );
    $crud->notification->redirect( '../index.php/songs/new' );
  }