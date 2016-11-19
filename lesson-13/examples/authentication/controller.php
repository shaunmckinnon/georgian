<?php

  session_start();

  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-14/examples/config.php';


  /* views */
  function login () {
    return get_included_file_contents( 'views/login.php' );
  }


  /* processes */
  function authenticate ( $post ) {
    $user = User::find( 'first', array( 'email' => $post['email'] ) );
    if ( $user && password_verify( $post['password'], $user->password ) ) {
      $_SESSION['success'] = 'You have successfully logged in.';
      $_SESSION['authenticated'] = true;
      $_SESSION['email'] = $user->email;
      header( 'Location: ../categories/index.php?action=index' );
      exit;
    } else {
      $_SESSION['fail'] = 'You could not be logged in at this time.';
      header( 'Location: index.php?action=login' );
      exit;
    }
  }

  function logout () {
    if ( isset( $_SESSION['authenticated'] ) ) {
      unset( $_SESSION['authenticated'] );
      unset( $_SESSION['email'] );
      $_SESSION['success'] = 'You have been logged out successfully.';
      header( 'Location: index.php?action=login' );
      exit;
    }
  }


  request_is_authenticated( $_REQUEST, ['login', 'authenticate'] );

  $yield = action_handler( ['login', 'logout', 'authenticate'], $_REQUEST );