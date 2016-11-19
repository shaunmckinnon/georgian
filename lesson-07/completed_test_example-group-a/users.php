<?php

  /* Step 1 - Connect to the database */
  $dbh = new PDO('mysql:host=localhost;dbname=comp-1006-lesson-examples;', 'root', 'root');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Build the SQL sentence
  $sql = 'SELECT term1_users.id, term1_users.first_name, term1_users.last_name, term1_users.date_of_birth, term1_cities.name as city FROM term1_users JOIN term1_cities ON term1_cities.id = term1_users.city_id';


  /* Step 3 - Prepare, Execute, and Fetch the results and store them in a variable named $users */
  $users = $dbh->query( $sql );

  /* Step 4 - Close the connection */
  $dbh = null;

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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>City</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ( $users as $user ): ?>
            <tr>
              <td><?= $user['first_name'] ?></td>
              <td><?= $user['last_name'] ?></td>
              <td><?= $user['date_of_birth'] ?></td>
              <td><?= $user['city'] ?></td>
              <td>
                <a href="edit_user.php?user_id=<?= $user['id'] ?>"><i class="fa fa-pencil"></i></a>
              </td>
              <td>
                <form method="post" action="delete_user.php?user_id=<?= $user['id'] ?>">
                  <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
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