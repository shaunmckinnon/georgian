<?php session_start(); ?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>New Category</title>
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

      <h1 class="page-header">New Category</h1>

      <form action="add_category.php" method="post">
        <fieldset>
          <legend>Category Information</legend>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>

          <div>
            <button class="btn btn-primary">Add Category</button>
          </div>
        </fieldset>
      </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>