<?php

  // start our session to avoid headers issue
  session_start();


  /* Views */
  function index () {
    $users = User::all( array( 'order' => 'last_name' ) );
    return get_included_file_contents( 'views/index.php', array( 'users' => $users ) );
  }

  function create () {
    return get_included_file_contents( 'views/create.php' );
  }

  function edit ( $get ) {
    if ( !isset( $get['id'] ) || !User::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a user.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $user = User::find( 'first', $get['id'] );
    return get_included_file_contents( 'views/edit.php', array('user' => $user) );
  }


  /* Processes */
  function add ( $post ) {
    // create a new record
    $user = new User;

    // assign the values
    $user->first_name = $post['first_name'];
    $user->last_name = $post['last_name'];
    $user->email = $post['email'];
    $user->password = $post['password'];
    $user->confirm_password = $post['password'];

    // when we save, we apply our assigned properties and write them to the DB
    // the passed attribute "false" forces validation to not occur a second time
    $user->save( false );

    if ( $user->is_invalid() ) {
      // set fail messages
      $_SESSION['fail'][] = $user->errors->full_messages();
      $_SESSION['fail'][] = 'The user could not be created.';

      // redirect
      header( 'Location: index.php?action=create' );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'User was created successfully.';
    header( 'Location: ../authentication/index.php?action=login' );
    exit;
  }

  function update ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !User::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a user.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // get existing record
    $user = User::find( $post['id'] );

    // update the values
    $user->first_name = $post['first_name'];
    $user->last_name = $post['last_name'];
    $user->email = $post['email'];

    // if there is a password
    if ( !empty( $post['password'] ) ) {
      $user->password = $post['password'];
      $user->confirm_password = $post['password'];
    }

    // when we save, we apply our assigned properties and write them to the DB
    // the passed attribute "false" forces validation to not occur a second time
    $user->save( false );

    if ( $user->is_invalid() ) {
      // set fail messages
      $_SESSION['fail'][] = $user->errors->full_messages();
      $_SESSION['fail'][] = 'The user could not be updated.';

      // redirect
      header( 'Location: index.php?action=edit&id=' . $user->id );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'User was updated successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }

  function delete ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !User::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a category.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // delete the record
    $category = User::find( $post['id'] );
    $category->delete();

    $_SESSION['success'] = 'The user was deleted successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  /* Action Handler & ActiveRecord */
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-14/examples/config.php';

  /* Authentication */
  request_is_authenticated( $_REQUEST, ['create', 'add'] );

  $yield = action_handler( ['index', 'create', 'edit', 'add', 'update', 'delete'], $_REQUEST );