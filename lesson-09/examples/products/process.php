<?php

  // require the ActiveRecord library
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/config.php';

  // start the session
  session_start();

  // redirect the user if they've come to this page accidentally
  if ( $_SERVER['REQUEST_METHOD'] != 'POST' || !isset( $_POST['action'] ) ) {
    header( 'Location: /lesson-09/examples/categories/index.php' );
    exit;
  }

  // set messages and perform database operations
  switch ( $_POST['action'] ) {
    case 'new':
      // set the success message
      $success = "Product was created successfully.";

      // store error messages in an array
      $fail = "Product couldn't be created.";

      // create new record
      $product = new Product;

      // assign the values
      $product->name = $_POST['name'];
      $product->price = $_POST['price'];
      $product->category_id = $_POST['category_id'];

      // when we save, we apply our assigned properties and write them to the DB
      $product->save();
      break;
    case 'edit':
      // set the success message
      $success = "Product was updated successfully.";

      // store error messages in an array
      $fail = "Product couldn't be updated.";

      // get existing record
      $product = Product::find( $_POST['id'] );

      // assign the values
      $product->name = $_POST['name'];
      $product->price = $_POST['price'];
      $product->category_id = $_POST['category_id'];

      // save the updated fields
      $product->save();
      break;
    case 'delete':
      // set the success message
      $success = "Product was deleted successfully.";

      // store error messages in an array
      $fail = "Product couldn't be deleted.";

      // get existing record
      $product = Product::find( $_POST['id'] );

      // delete the user
      $product->delete();
      break;
  }

  // handle any errors
  if ( $product->is_valid() === false ) {
    // set the fail messages
    $_SESSION['fail'][] = $fail;
    $_SESSION['fail'][] = $product->errors->full_messages();

    // if action is new or edit, assign the post to session 'post'
    if ( in_array( $_POST['action'], ['new', 'edit'] ) ) $_SESSION['post'] = $_POST;

    // set redirects
    if ( $_POST['action'] == 'new' ) header( 'Location: new.php' );
    if ( $_POST['action'] == 'edit' ) header( 'Location: edit.php?id=' . $_POST['id'] );
    if ( $_POST['action'] == 'delete' ) header( 'Location: /lesson-09/examples/categories/index.php' );
    exit;
  }

  // redirect with the success message
  $_SESSION['success'] = $success;
  header( 'Location: /lesson-09/examples/categories/show.php?id=' . $product->category->id );
  exit;