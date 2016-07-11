<?php

  // verify the passed query contains an id and it is numeric
  if ( !isset( $_GET['id'] ) || !is_numeric( $_GET['id'] ) ) {
    // set a fail message and redirect the user
    $_SESSION['fail'] = 'You have been redirected as you must select a category to edit first.';
    header( 'Location: index.php' );
    exit;
  }

  // the activerecord library
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/config.php';

  // get the category or redirect if incorrect ID is provided
  try {
    $category = Category::find( 'first', $_GET['id'] );
  } catch ( ActiveRecord\RecordNotFound $e ) {
    $_SESSION['fail'] = 'You must select an existing category to edit.';
    header( 'Location: index.php' );
    exit;
  }

  // set the action
  $action = 'edit';

  // output the header
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/header.php';

?>

<div class="container">
  <h1 class="page-header">Edit Category</h1>

  <?php require_once 'form.php' ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/footer.php' ?>