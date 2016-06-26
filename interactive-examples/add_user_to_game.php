<?php

  require_once 'class.interactive_example_users.php';

  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $ieu = new InteractiveExampleUsers();

    $response = $ieu->createUser( $_POST['name'], $_POST['code'] );

    echo json_encode( $response );

  }