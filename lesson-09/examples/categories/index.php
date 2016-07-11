<?php

  // the activerecord library
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/config.php';

  // the header file
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/header.php';
  
  $categories = Category::all( array( 'order' => 'name' ) );

?>

<div class="container">
  <h1 class="page-header">Categories</h1>
  <p><a href="new.php"><i class="fa fa-plus"></i>&nbsp;New Category</a></p>
  
  <?php if ( !empty( $categories ) ): ?>
  <table class="table table-striped table-condensed table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Show</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ( $categories as $category ): ?>
        <tr>
          <td><?= $category->name ?></td>
          <td><a href="show.php?id=<?= $category->id ?>"><i class="fa fa-eye"></i></a></td>
          <td><a href="edit.php?id=<?= $category->id ?>"><i class="fa fa-pencil"></i></a></td>
          <td>
            <form action="process.php" method="post">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $category->id ?>">
              <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure want to permanantly delete <?= $category->name ?>')">
                <i class="fa fa-remove"></i>
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <?php endif ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/footer.php' ?>