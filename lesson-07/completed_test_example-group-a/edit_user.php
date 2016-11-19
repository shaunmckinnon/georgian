<?php

  /* Step 1 - Assign the $_GET value to a variable called $user_id */
  $user_id = $_GET['user_id'];

  /* OPTIONAL (4 bonus points) - Validate the ID exists */
  if ( empty( $user_id ) ) {
    session_start();
    /* Redirect with a fail message if not validated */
    $_SESSION['fail'] = "You must select a user.<br>";
    header( 'Location: confirmed.php' );
    exit;
  }

  /* Step 2 - Connect to the database */
  $dbh = new PDO('mysql:host=localhost;dbname=comp-1006-lesson-examples;', 'root', 'root');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  /* Step 3 - Build a SQL string to select the user based on the provided id */
  $sql = 'SELECT * FROM term1_users WHERE id = :user_id';

  /* Step 4 - Prepare the SQL statement */
  $sth = $dbh->prepare( $sql );

  /* Step 5 - Bind the value */
  $sth->bindParam( ':user_id', $user_id, PDO::PARAM_INT );

  /* Step 6 - Execute the statement */
  $sth->execute();

  /* Step 7 - Fetch and store the result in a variable named $user */
  /* HINT: You are only fetching ONE result */
  $user = $sth->fetch();

  /* Step 8 - Close the cursor to reset the connection */
  $sth->closeCursor();

  /* Step 9 - Build a SQL string to select all the cities in the table term1_cities */
  $sql = 'SELECT * FROM term1_cities';

  /* Step 10 - Prepare, Execute, and Fetch the results */
  $cities = $dbh->query( $sql );

  /* Step 11 - Close the connection */
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
      <form action="update_user.php" method="post">
        <fieldset>
          <legend>User Information</legend>

          <div class="form-group">
            <label for="first_name">First Name</label>
            <input name="first_name" class="form-control" value="<?= $user['first_name'] ?>" required>
          </div>

          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input name="last_name" class="form-control" value="<?= $user['last_name'] ?>" required>
          </div>

          <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input name="date_of_birth" class="form-control" value="<?= $user['date_of_birth'] ?>" type="date">
          </div>

          <div class="form-group">
            <select name="city_id" class="form-control">
              <option value="">...select a city...</option>
              <!-- Step 5 - create a select field populated from term1_cities -->
              <!-- NOTE: each option must have the value of the 'id' and label of the 'name' -->
              <!-- OPTIONAL bonus (2 points): preselect the current city -->
              <?php foreach ( $cities as $city ): ?>
                <option value="<?= $city['id'] ?>" <?= ($city['id'] == $user['city_id']) ? 'selected' : '' ?>><?= $city['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </fieldset>

        <div class="form-group">
          <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
          <button class="btn btn-danger"><i class="fa fa-pencil"></i>&nbsp;Update User</button>
        </div>
      </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>