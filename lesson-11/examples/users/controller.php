<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-11/examples/config.php';


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
    // create a new record
    $user = new User;

    // assign the values
    $user->first_name = $post['first_name'];
    $user->last_name = $post['last_name'];
    $user->email = $post['email'];

    // confirm the passwords match
    if ( $post['password'] == $post['confirm_password'] ) {
      // hash the password
      $user->password = password_hash( $post['password'], PASSWORD_DEFAULT );

      // set the confirm password to the new hashed password so it passes validation
      $user->confirm_password = $user->password;
    } else {
      // set the password to the current post password
      $user->password = $post['password'];

      // set the confirm password so it fails the compare validation
      $user->confirm_password = null;
    }

    // when we save, we apply our assigned properties and write them to the database
    $user->save();

    // redirect if there is an error
    if ( $user->is_invalid() ) {
      // set the fail messages
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

    // if not empty, update
    if ( !empty( $post['password'] ) ) {
      // confirm the passwords match
      if ( $post['password'] == $post['confirm_password'] ) {
        // hash the password
        $user->password = password_hash( $post['password'], PASSWORD_DEFAULT );

        // set the confirm password to the new hashed password so it passes validation
        $user->confirm_password = $user->password;
      } else {
        // set the password to the current post password
        $user->password = $post['password'];

        // set the confirm password so it fails the compare validation
        $user->confirm_password = null;
      }
    }

    // when we save, we apply our assigned properties and update them in the database
    $user->save();

    // redirect if there is an error
    if ( $user->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $user->errors->full_messages();
      $_SESSION['fail'][] = 'The user could not be updated.';

      // redirect
      header( 'Location: index.php?action=edit&id=' . $post['id'] );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'User was updated successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }

  function delete ( $post ) {}


  /* Authentication */
  request_is_authenticated( $_REQUEST, ['create', 'add'] );


  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'index', 'create', 'edit'], $_REQUEST );