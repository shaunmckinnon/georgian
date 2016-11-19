<?php

  /* Step 1 - Connect to the database */

  /* Step 2 - Build a SQL string to select all the categories in the table term1_categories table */

  /* Step 3 - Prepare, Execute, and Fetch the results */

  /* Step 4 - Close the connection */
  
?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Add New Product</title>
  </head>

  <body>
    <?php require 'navigation.php' ?>

    <div class="container">
      <h1 class="page-header">Create New Product</h1>
      <!-- The Products Form -->
      <form action="add_product.php" method="post">
        <fieldset>
          <legend>Product Information</legend>

          <div class="form-group">
            <label for="name">Name</label>
            <input name="name" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>

          <div class="form-group">
            <label for="price">Price</label>
            <input name="price" class="form-control" type="date">
          </div>

          <div class="form-group">
            <select name="category_id" class="form-control">
              <option value="">...select a category...</option>
              <!-- Step 5 - create a select field populated from term1_categories -->
              <!-- NOTE: each option must have the value of the 'id' and label of the 'name' -->
            </select>
          </div>
        </fieldset>

        <div class="form-group">
          <button class="btn btn-danger"><i class="fa fa-plus"></i>&nbsp;Add product</button>
        </div>
      </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>