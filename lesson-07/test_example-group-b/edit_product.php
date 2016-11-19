<?php

  /* Step 1 - Assign the $_GET value to a variable called $product_id */

  /* OPTIONAL (4 bonus points) - Validate the ID exists */
    /* Redirect with a fail message if not validated */

  /* Step 2 - Connect to the database */

  /* Step 3 - Build a SQL string to select the product based on the provided id */

  /* Step 4 - Prepare the SQL statement */

  /* Step 5 - Bind the value */

  /* Step 6 - Execute the statement */

  /* Step 7 - Fetch and store the result in a variable named $product */
  /* HINT: You are only fetching ONE result */

  /* Step 8 - Close the cursor to reset the connection */

  /* Step 9 - Build a SQL string to select all the categories in the table term1_categories */

  /* Step 10 - Prepare, Execute, and Fetch the results */

  /* Step 11 - Close the connection */
  
?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Add New product</title>
  </head>

  <body>
    <?php require 'navigation.php' ?>

    <div class="container">
      <h1 class="page-header">Create New product</h1>
      <!-- The products Form -->
      <form action="update_product.php" method="post">
        <fieldset>
          <legend>product Information</legend>

          <div class="form-group">
            <label for="name">Product</label>
            <input name="name" class="form-control" value="<?= $product['name'] ?>" required>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <input name="description" class="form-control" value="<?= $product['description'] ?>" required>
          </div>

          <div class="form-group">
            <label for="price">Price</label>
            <input name="price" class="form-control" value="<?= $product['price'] ?>" type="date">
          </div>

          <div class="form-group">
            <select name="category_id" class="form-control">
              <option value="">...select a category...</option>
              <!-- Step 5 - create a select field populated from term1_categories -->
              <!-- NOTE: each option must have the value of the 'id' and label of the 'name' -->
              
              <!-- OPTIONAL bonus (2 points): preselect the current category -->
            </select>
          </div>
        </fieldset>

        <div class="form-group">
          <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
          <button class="btn btn-danger"><i class="fa fa-pencil"></i>&nbsp;Update product</button>
        </div>
      </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>