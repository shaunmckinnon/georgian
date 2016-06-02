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
  $sql = 'SELECT artists.name as artist, songs.title, songs.length FROM songs JOIN artists ON songs.artist_id = artists.id WHERE songs.id = :id';

  // assign our GET value to a variable
  $song_id = $_GET['id'];

  // prepare the SQL statement
  $sth = $dbh->prepare( $sql );

  // fill the placeholders
  $sth->bindParam( ':id', $song_id, PDO::PARAM_INT );

  // execute the SQL
  $sth->execute();

  // store the result
  $song = $sth->fetch();

  // close the DB connection
  $dbh = null;

?>

<!DOCTYPE html>
<html>
  <head>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css' integrity='sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O' rel='stylesheet'>
    <title><?= $song['name'] ?></title>
  </head>
  <body>
    <div class='container'>
      <h1 class="page-header">
        <?= $song['title'] ?>
      </h1>

      <div class="song-info">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
              <?= $song['title'] ?> Info
            </h3>
          </div>
          
          <table class="table">
            <tbody>
              <tr>
                <td>Artist</td>
                <td><?= $song['artist'] ?></td>
              </tr>
              <tr>
                <td>Length:</td>
                <td><?= $song['length'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>