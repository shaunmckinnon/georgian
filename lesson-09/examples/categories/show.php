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
    $category = Category::find( 'first', $_GET['id'], array( 'order' => 'name' ) );
  } catch ( ActiveRecord\RecordNotFound $e ) {
    $_SESSION['fail'] = 'You must select an existing category to edit.';
    header( 'Location: index.php' );
    exit;
  }

  // output the header
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/includes/header.php';

?>

<div class="container">
  <h1 class="page-header"><?= $category->name ?></h1>
  <p><a href="/lesson-09/examples/products/new.php?category_id=<?= $category->id ?>"><i class="fa fa-plus"></i>&nbsp;New Product</a></p>
  
  <?php if ( $category->products ): ?>
    <table class="table table-striped table-condensed table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ( $category->products as $product ): ?>
        <tr>
          <td><?= $product->name ?></td>
          <td><?= $product->price_formatted ?></td>
          <td><a href="/lesson-09/examples/products/edit.php?id=<?= $product->id ?>"><i class="fa fa-pencil"></i></a></td>
          <td>
            <form action="/lesson-09/examples/products/process.php" method="post">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $product->id ?>">
              <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure want to permanantly delete <?= $product->name ?>')">
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