<?php

  session_start();
  
  // validate the id
  if ( empty($_GET['id']) ) {
    session_start();
    $_SESSION['fail'] = "Please click a category to see the products by that category.";
    header( "Location: categories.php" );
  } else {
    $category_id = $_GET['id'];
  }

  // connect to the database
  // Heroku
  if ( preg_match('/Heroku|georgian\.shaunmckinnon\.ca/i', $_SERVER['HTTP_HOST']) ) {
    // remote server
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $host = $url["host"];
    $dbname = substr($url["path"], 1);
    $username = $url["user"];
    $password = $url["pass"];
  } else { // localhost
    $host = 'localhost';
    $dbname = 'comp-1006-lesson-examples';
    $username = 'root';
    $password = 'root';
  }
  // The above isn't required. You are welcome to enter the parameters directly in the connection string.
  $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );

  // add error checking
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // build the SQL
  $category_sql = 'SELECT * FROM categories WHERE id = :id';
  $products_sql = "SELECT * FROM products WHERE category_id = :id";

  // prepare the first SQL statement
  $category_sth = $dbh->prepare( $category_sql );

  // bind the placeholders
  $category_sth->bindParam( ':id', $category_id, PDO::PARAM_INT );

  // execute the SQL
  $category_sth->execute();

  // store the result
  $category = $category_sth->fetch();

  // close the cursor so we can execute the next statement
  $category_sth->closeCursor();

  // prepare the first SQL statement
  $product_sth = $dbh->prepare( $products_sql );

  // bind the placeholders
  $product_sth->bindParam( ':id', $category_id, PDO::PARAM_INT );

  // execute the SQL
  $product_sth->execute();

  // store the result
  $products = $product_sth->fetchAll();
  $row_count = $product_sth->rowCount();

  // close the connection
  $dbh = null;

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Products By Category</title>
  </head>

  <body>
    <!-- success and fail messages -->
    <?php if ( !empty($_SESSION['fail']) ): ?>
      <div class="alert alert-danger"><?= $_SESSION['fail'] ?></div>
    <?php endif ?>
    <?php if ( !empty($_SESSION['success']) ): ?>
      <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
    <?php endif ?>
    <?php session_unset(); ?>

    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="container">
      <nav>
        <ul class="nav nav-tabs">
          <li><a href="new_category.php">New Category</a></li>
          <li><a href="new_product.php">New Product</a></li>
          <li><a href="categories.php">Show Categories</a></li>
          <li><a href="products.php">Show Products</a></li>
        </ul>
      </nav>

      <h1 class="page-header"><?= $category['name'] ?></h1>

      <?php if ( $row_count > 0 ): ?>
        <table class='table'>
          <thead>
            <tr>
              <td>Name</td>
              <td>Description</td>
              <td>Price</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $products as $product ): ?>
              <tr>
                <td><?= $product['name'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><?= $product['price'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert-warning">
          No category/product information to display.
        </div>
      <?php endif ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>