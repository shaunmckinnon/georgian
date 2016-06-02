<?php

  // SHAUN'S CONNECTION DETAILS (YOU NEED TO USE YOUR OWN OR REPLACE THE VALUES)
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

  // connect to the DB
  $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // build the artist SQL
  $artist_sql = 'SELECT * FROM artists WHERE id = :id';

  // assign the GET param to a variable
  $artist_id = $_GET['id'];

  // prepare the SQL statement
  $artist_sth = $dbh->prepare( $artist_sql );

  // fill the placeholders
  $artist_sth->bindParam( ':id', $artist_id, PDO::PARAM_INT );

  // execute the artist SQL
  $artist_sth->execute();

  // store the result
  $artist = $artist_sth->fetch();

  // close the cursor so we can execute the next statement
  $artist_sth->closeCursor();

  // build the songs SQL
  $songs_sql = "SELECT * FROM songs WHERE artist_id = :id";

  // get songs by artist
  $songs_sth = $dbh->prepare( $songs_sql );

  // fill the placeholders
  $songs_sth->bindParam( ':id', $artist_id, PDO::PARAM_INT );

  // execute the songs SQL
  $songs_sth->execute();

  // store the results
  $songs = $songs_sth->fetchAll();

  // count the number of rows returned
  $row_count = $songs_sth->rowCount();

  // close the connection
  $dbh = null;

?>

<!DOCTYPE html>
<html>
  <head>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css' integrity='sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O' rel='stylesheet'>
    <title>All Songs By <?= $artist['name'] ?></title>
  </head>
  <body>
    <div class='container'>
      <header>
        <h1 class="page-header">
          <?= $artist['name'] ?>
        </h1>
        <p>
          <small><a href="<?= $artist['bio_link'] ?>"><?= $artist['bio_link'] ?></a></small>
        </p>
      </header>
      
      <?php if ( $row_count > 0 ): ?>
      <section>
        <table class="table">
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
      <?php else: ?>
        <div class="alert alert-info">
          There are no songs listed for this artist.
        </div>
      <?php endif ?>
    </div>
  </body>
</html>