<?php

  // the activerecord library
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/config.php';

  // the header file
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/header.php';
  
?>

<div class="container">
  <h1 class="page-header">New Category</h1>

  <?php require_once 'form.php' ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/footer.php' ?>