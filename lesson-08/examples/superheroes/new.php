<?php 
  // the title for our page
  $page_title = 'New Superhero';

  // the action for our form
  $action = 'new';

  // get the header
  require_once '../includes/header.php';
?>

  <div class="container">
    <h1 class="page-header">New Superhero</h1>

    <?php require_once 'form.php' ?>
  </div>
<?php require_once '../includes/footer.php' ?>