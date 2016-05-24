<?php

  // connection to database
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

  $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // build the SQL statment with placeholders
  $sql = 'SELECT artists.name as artist, songs.id as song_id, artists.id as artist_id, songs.title, songs.length FROM songs JOIN artists ON songs.artist_id = artists.id';

  $songs = $dbh->query( $sql );
  $row_count = $songs->rowCount();

?>

<!DOCTYPE html>
<html>
  <head>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css' integrity='sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O' rel='stylesheet'>
    <title>All Songs</title>
  </head>
  <body>
    <div class='container'>
      <header>
        <h3 class='page-header'>All Songs</h3>
      </header>
      <section>
        <?php if ( $row_count > 0 ): ?>
          <table class='table'>
            <thead>
              <tr>
                <td>Artist</td>
                <td>Title</td>
                <td>Length</td>
                <td>Actions</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ( $songs as $song ): ?>
                <tr>
                  <td><a href="artist.php?id=<?= $song['artist_id'] ?>"><?= $song['artist'] ?></a></td>
                  <td><?= $song['title'] ?></td>
                  <td><?= $song['length'] ?></td>
                  <td><a href="song.php?id=<?= $song['song_id'] ?>"><i class="fa fa-eye"></i></a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-warning">
            No song information to display.
          </div>
        <?php endif ?>
      </section>
    </div>
  </body>
</html>
