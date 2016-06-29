<?php

  require_once '../classes/class.crud.php';
  require_once '../config/config.database.php';
  $crud = new CRUD( $config );

  // validate, sanitize, set notifications, and update songs
  // validation rules
  $rules = [
    'required' => ['id', 'title', 'artist_id']
  ];
  $result = $crud->vsn_update_record( $_POST['id'], $_POST, $rules, 'songs' );

  // combine length
  $_POST['length'] = implode( ':', $_POST['length'] );

  // redirect based on result
  if ( $result ) {
    $crud->notification->set_success( 'Song was updated successfully.' );
    $crud->notification->redirect( $baseurl . '/index.php/artists/' . $_POST['artist_id'] );
  } else {
    $crud->notification->set_fail( 'Song could not be updated.' );
    $crud->notification->redirect( $baseurl . '/index.php/songs/new' );
  }