<?php

  /* Step 1 - Connect to the database */
  $dbh = new PDO('mysql:host=localhost;dbname=comp-1006-lesson-examples;', 'root', 'root');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  /* Step 2 - Build a SQL string to select all the cities in the table term1_cities */
  $sql = 'SELECT * FROM term1_cities';

  /* Step 3 - Prepare, Execute, and Fetch the results */
  $cities = $dbh->query( $sql );

  /* Step 4 - Close the connection */
  $dbh = null;
  
?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Add New User</title>
  </head>

  <body>
    <?php require 'navigation.php' ?>

    <div class="container">
      <h1 class="page-header">Create New User</h1>
      <!-- The Users Form -->
      <form action="add_user.php" method="post">
        <fieldset>
          <legend>User Information</legend>

          <div class="form-group">
            <label for="first_name">First Name</label>
            <input name="first_name" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input name="last_name" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input name="date_of_birth" class="form-control" type="date">
          </div>

          <div class="form-group">
            <select name="city_id" class="form-control">
              <option value="">...select a city...</option>
              <!-- Step 5 - create a select field populated from term1_cities -->
              <!-- NOTE: each option must have the value of the 'id' and label of the 'name' -->
              <?php foreach ( $cities as $city ): ?>
                <option value="<?= $city['id'] ?>"><?= $city['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </fieldset>

        <div class="form-group">
          <button class="btn btn-danger"><i class="fa fa-plus"></i>&nbsp;Add User</button>
        </div>
      </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>