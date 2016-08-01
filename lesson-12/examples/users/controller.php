<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-13/examples/config.php';


  /* VIEWS */
  function index () {
    $users = User::all( array( 'order' => 'last_name' ) );
    return get_included_file_contents( 'views/index.php', ['users' => $users] );
  }

  function create () {
    return get_included_file_contents( 'views/create.php' );
  }

  function edit ( $get ) {
    if ( !isset( $get['id'] ) || !User::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a category.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $user = User::find( 'first', $get['id'] );
    return get_included_file_contents( 'views/edit.php', ['user' => $user] );
  }

  
  /* PROCESSES */
  function add ( $post ) {
  }

  function update ( $post ) {
  }

  function delete ( $post ) {
  }


  /* Authentication */


  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'index', 'create', 'edit'], $_REQUEST );