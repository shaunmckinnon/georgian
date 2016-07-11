<?php

  if ( !isset( $_GET['id'] ) || !is_numeric( $_GET['id'] ) ) {
    $_SESSION['fail'] = 'You have been redirected as you must select a product to edit first.';
    header( 'Location: /lesson-09/examples/categories/index.php' );
    exit;
  }

  // the activerecord library
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/config.php';

  // get the category or redirect if incorrect ID is provided
  try {
    $product = Product::find( 'first', $_GET['id'] );
  } catch ( ActiveRecord\RecordNotFound $e ) {
    $_SESSION['fail'] = 'You must select an existing product to edit.';
    header( 'Location: /lesson-09/examples/categories/index.php' );
    exit;
  }

  // get the categories
  $categories = Category::all();

  // check if we have a category id selected
  if ( isset( $product->category->id ) ) $current_category_id = $product->category->id;

  // set the action
  $action = 'edit';

  // output the header
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/header.php';

?>

<div class="container">
  <h1 class="page-header">Edit Product</h1>

  <?php require_once 'form.php' ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/footer.php' ?>