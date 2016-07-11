<?php

  // the activerecord library
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/config.php';

  // get the categories
  if ( count( $categories = Category::all() ) == 0 ) {
    $_SESSION['fail'] = 'There are currently no categories. Please add a new one.';
    header( 'Location: /lesson-09/examples/categories/new.php' );
    exit;
  }

  // check if we have a category id selected
  if ( isset( $_GET['category_id'] ) && is_numeric( $_GET['category_id'] ) && Category::exists( $_GET['category_id'] ) ) $current_category_id = $_GET['category_id'];

  // set the action
  $action = 'new';

  // the header file
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/header.php';
  
?>

<div class="container">
  <h1 class="page-header">New Product</h1>

  <?php require_once 'form.php' ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/footer.php' ?>