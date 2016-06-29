<?php

  /* Step 1 - Connect to the database */

  // Build the SQL sentence
  $sql = 'SELECT term1_products.id, term1_products.name, term1_products.description, term1_products.price, term1_categories.name as category FROM term1_products JOIN term1_categories ON term1_categories.id = term1_products.category_id';


  /* Step 2 - Prepare, Execute, and Fetch the results and store them in a variable named $products */

  /* Step 3 - Close the connection */

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>title</title>
  </head>

  <body>
    <?php require 'navigation.php' ?>

    <div class="container">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Product</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ( $products as $product ): ?>
            <tr>
              <td><?= $product['name'] ?></td>
              <td><?= $product['description'] ?></td>
              <td><?= $product['price'] ?></td>
              <td><?= $product['category'] ?></td>
              <td>
                <a href="edit_product.php?product_id=<?= $product['id'] ?>"><i class="fa fa-pencil"></i></a>
              </td>
              <td>
                <form method="post" action="delete_product.php?product_id=<?= $product['id'] ?>">
                  <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                  <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure?')"><i class="fa fa-remove"></i></button>
                </form>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>