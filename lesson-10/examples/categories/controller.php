<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/config.php';
  foreach ( $config as $key => $value ) { if ( !in_array( 'password', 'user' ) ) echo $value }

  /* VIEWS */
  // index
  function index () {
    $categories = Category::all( array( 'order' => 'name' ) );
    ob_start();
    include 'views/index.php';
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }


  // show
  function show ( $get ) {
    // redirect user if here accidentally
    if ( !isset( $get['id'] ) || !Category::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a category.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $category = Category::find( $get['id'] );
    ob_start();
    include 'views/show.php';
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }


  // create
  function create () {
    ob_start();
    include 'views/create.php';
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }


  // edit
  function edit ( $get ) {
    if ( isset( $get['id'] ) && Category::exists( $get['id'] ) ) {
      $category = Category::find( 'first', $get['id'] );
      ob_start();
      include 'views/edit.php';
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
    } else {
      $_SESSION['fail'] = "You must select a category.";
      header( 'Location: index.php?action=index' );
      exit;
    }
  }


  /* PROCESSES */
  // add
  function add ( $post ) {
    // create a new record
    $category = new Category;

    // assign the values
    $category->name = $post['name'];

    // when we save, we apply our assigned properties and write them to the database
    $category->save();

    // redirect if there is an error
    if ( $category->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $category->errors->full_messages();
      $_SESSION['fail'][] = 'The category could not be created.';

      // redirect
      header( 'Location: index.php?action=create' );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'Category was created successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  // update
  function update ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !Category::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a category.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // create a new record
    $category = Category::find( $post['id'] );

    // assign the values
    $category->name = $post['name'];

    // when we save, we apply our assigned properties and write them to the database
    $category->save();

    // redirect if there is an error
    if ( $category->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $category->errors->full_messages();
      $_SESSION['fail'][] = 'The category could not be updated.';

      // redirect
      header( 'Location: index.php?action=edit&id=' . $category->id );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'Category was updated successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  // delete
  function delete ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !Category::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a category.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // delete the record
    $category = Category::find( $post['id'] );
    $category->delete();

    $_SESSION['success'] = 'The category was deleted successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  /* Authentication Block */


  // action handler for REQUEST
  if ( isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], ['add', 'update', 'delete', 'index', 'show', 'create', 'edit'] ) ) {
    $yield = call_user_func( $_REQUEST['action'], $_REQUEST );
  } else {
    header( 'Location: ../categories/index.php?action=index' );
    exit;
  }



























