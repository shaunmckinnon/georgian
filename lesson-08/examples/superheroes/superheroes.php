<?php
  // connect and get the superheros
  require_once '../classes/class.database.php';
  $dbh = new Database;

  // get all the superheroes and all of their powers
  $superheroes = $dbh->raw( "SELECT * FROM superheroes" );
  // the title for our page
  $page_title = 'Superheroes';

  // get the header
  require_once '../includes/header.php';
?>

  <div class="container">
    <h1 class="page-header">Superheroes</h1>

    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th>Alias</th>
          <th>Name</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $superheroes as $superhero ): ?>
        <tr>
          <td>
            <?= htmlentities( $superhero['alias'] ) ?>
          </td>
          <td>
            <?= htmlentities( $superhero['first_name'] ) ?>&nbsp;<?= htmlentities( $superhero['last_name'] ) ?>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
<?php require_once '../includes/footer.php' ?>