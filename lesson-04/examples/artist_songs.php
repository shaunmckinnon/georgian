<?php

  // connect to the DB
  $dbh = new PDO( "mysql:host=localhost;dbname=comp-1006-lesson-examples", "root", "root" );
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // get artist
  $artist_sql = 'SELECT * FROM artists WHERE id = :id LIMIT 1';

  // assign the artist id to a variable
  $artist_id = $_GET['artist_id'];

  // prepare the SQL statement
  $artist_sth = $dbh->prepare( $artist_sql );
  $artist_sth->bindParam( ':id', $artist_id, PDO::PARAM_INT );

  // execute the artist SQL
  $artist_sth->execute();

  // store the result
  $artist = $artist_sth->fetch();

  // close the cursor so we can execute the next statement
  $artist_sth->closeCursor();

  // song SQL
  $songs_sql = 'SELECT * FROM songs WHERE artist_id = :id';

  // prepare the SQL
  $songs_sth = $dbh->prepare( $songs_sql );

  // fill the placeholders
  $songs_sth->bindParam( ':id', $artist_id, PDO::PARAM_INT );

  // execute
  $songs_sth->execute();

  // store the results
  $songs = $songs_sth->fetchAll();

  // close the connection
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
    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="container">
      <h1 class="page-header"><?= $artist['name'] ?></h1>
      <p><small>
        <a href="<?= $artist['bio_link'] ?>"><?= $artist['bio_link'] ?></a>
      </small></p>

      <section>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Title</th>
              <th>Length</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ( $songs as $song ): ?>
              <tr>
                <td><?= $song['title'] ?></td>
                <td><?= $song['length'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </section>

    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>