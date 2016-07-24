<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-11/examples/config.php';


  /* VIEWS */
  public function index () {
    $users = User::all( array( 'order' => 'last_name' ) );
    return get_included_file_contents( 'views/index.php', ['users' => $users] );
  }

  public function create () {
    return get_included_file_contents( 'views/create.php' );
  }

  public function edit ( $get ) {
    if ( !isset( $get['id'] ) || !User::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a category.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $user = User::find( 'first', $get['id'] );
    return get_included_file_contents( 'views/edit.php', ['user' => $user] );
  }

  
  /* PROCESSES */
  public function add ( $post ) {}

  public function update ( $post ) {}

  public function delete ( $post ) {}


  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'index', 'show', 'create', 'edit'], $_REQUEST );