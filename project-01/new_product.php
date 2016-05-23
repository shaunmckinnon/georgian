<?php
  
  // begin session for any plausible messages
  session_start();

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
  $sql = 'SELECT id, name FROM categories';
  $sth = $dbh->prepare( $sql );
  $sth->execute();

  // get all of the results
  $result = $sth->fetchAll();

  // count the results
  $row_count = $sth->rowCount();

  // close the connection
  $dbh = null;

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>New Product</title>
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

      <h1 class="page-header">New Product</h1>
      <?php if ( $row_count > 0 ): ?>
      <form action="add_product.php" method="post">
        <fieldset>
          <legend>Product Information</legend>
          <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" required>
              <option selected>...select a category...</option>
              <?php foreach ( $result as $row ): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>

          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" min="0" step="any" class="form-control" required>
          </div>

          <div>
            <button class="btn btn-primary">Add Product</button>
          </div>
        </fieldset>
      </form>
    <?php else: ?>
      <div class="alert alert-warning">
        <p>You currently don't have any categories. Please enter some categories before adding a new product.</p>
        <a href="new_category.php">New Category</a>
      </div>
    <?php endif ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>