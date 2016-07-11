<?php 
  // the title for our page
  $page_title = 'Edit Superhero';

  // the action for our form
  $action = 'edit';

  // require the database and validation classes
  require_once '../classes/class.database.php';

  // start the session for error message
  session_start();

  // validate the ID is set and is a number
  if ( !isset( $_GET['id'] ) || !is_numeric( $_GET['id'] ) ) {
    // redirect with an error and exit
    $_SESSION['fail'] = 'You must first select a superhero.';
    header( 'Location: superheroes.php' );
    exit;
  }

  // get the requested superhero or redirect with an error
  $dbh = new Database;
  if ( !$superhero = $dbh->all( 'superheroes' ) ) {
    // redirect with an error and exit
    $_SESSION['fail'] = 'You must first select a superhero that exists.';
    header( 'Location: superheroes.php' );
    exit;
  }

  // get the header
  require_once '../includes/header.php';
?>

  <div class="container">
    <h1 class="page-header">Edit Superhero</h1>

    <?php require_once 'form.php' ?>
  </div>
<?php require_once '../includes/footer.php' ?>