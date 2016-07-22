<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/config.php';

  /* VIEWS */
  // create
  function create () {
    $categories = Category::all();
    ob_start();
    include 'views/create.php';
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }


  // edit
  function edit ( $get ) {
    if ( !isset( $get['id'] ) || !Product::exists( $get['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a product to edit.';
      header( 'Location: ../categories/index.php?action=index' );
      exit;
    }

    $product = Product::find( $get['id'] );
    $categories = Category::all();
    ob_start();
    include 'views/edit.php';
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }


  /* PROCESSES */
  // add
  function add ( $post ) {
    $product = New Product;

    $product->name = $post['name'];
    $product->price = $post['price'];
    $product->category_id = $post['category_id'];

    $product->save();

    if ( $product->is_invalid() ) {
      $_SESSION['fail'][] = $product->error->full_messages();
      $_SESSION['fail'][] = 'The product could not be created.';

      header( 'Location: index.php?action=create' );
      exit;
    }

    $_SESSION['success'] = 'Product was created successfully.';
    header( 'Location: ../categories/index.php?action=show&id=' . $product->category->id );
    exit;
  }


  // update
  function update ( $post ) {
    if ( !isset( $post['id'] ) || !Product::exists( $post['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a product to edit.';
      header( 'Location: ../categories/index.php?action=index' );
      exit;
    }

    $product = Product::find( $post['id'] );

    $product->name = $post['name'];
    $product->price = $post['price'];
    $product->category_id = $post['category_id'];

    $product->save();

    if ( $product->is_invalid() ) {
      $_SESSION['fail'][] = $product->error->full_messages();
      $_SESSION['fail'][] = 'The product could not be updated.';

      header( 'Location: index.php?action=edit&id=' . $product->id );
      exit;
    }

    $_SESSION['success'] = 'Product was updated successfully.';
    header( 'Location: ../categories/index.php?action=show&id=' . $product->category->id );
    exit;
  }


  // delete
  function delete ( $post ) {
    if ( !isset( $post['id'] ) || !Product::exists( $post['id'] ) ) {
      $_SESSION['fail'] = 'You must choose a product to edit.';
      header( 'Location: ../categories/index.php?action=index' );
      exit;
    }

    $product = Product::find( $post['id'] );
    $category = $product->category;
    $product->delete();

    $_SESSION['success'] = 'The product was deleted successfully.';
    header( 'Location: ../categories/index.php?action=show&id=' . $category->id );
  }


  /* Authentication Block */


  // action handler for REQUEST
  if ( isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], ['add', 'update', 'delete', 'create', 'edit'] ) ) {
    $yield = call_user_func( $_REQUEST['action'], $_REQUEST );
  } else {
    header( 'Location: ../categories/index.php?action=index' );
    exit;
  }