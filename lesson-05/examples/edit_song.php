<?php

  // validate
  session_start();

  // assign the GET value to a variable
  $song_id = $_GET['id'];

  // check if we have the song id
  if ( empty( $song_id ) ) {
    // set our fail message
    $_SESSION['fail'] = "You must select a song to edit.<br>";

    // redirect the user
    header( 'Location: confirmed.php' );
    exit;
  }

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

  // connect to our DB
  $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // build the song SQL
  $song_sql = 'SELECT * FROM songs WHERE id = :id LIMIT 1';

  // prepare the SQL statement
  $song_sth = $dbh->prepare( $song_sql );

  // bind our value
  $song_sth->bindParam( ':id', $song_id, PDO::PARAM_INT );

  // execute
  $song_sth->execute();

  // store the result
  $song = $song_sth->fetch();

  // reset our connection
  $song_sth->closeCursor();

  // build the SQL statment with placeholders
  $sql = 'SELECT id, name FROM artists';

  // prepare, execute, and fetch our resultset
  $artists = $dbh->query( $sql );

  // close the DB connection
  $dbh = null;

  // recreate the length array
  if ( !is_null( $song['length'] ) ) {
    $length = explode( ':', strip_tags( $song['length'] ) );
  } else {
    $length = [0, 0, 0];
  }

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
      <section>
        <form action='update_song.php' method='post'>
          <fieldset>
            <legend>Song Information</legend>
            <div class='form-group'>
              <label for='artist'>
                Artist
              </label>
              <select class='form-control' id='artist' name='artist' type='text' required>
                <option value="">...select an artist...</option>
                <?php foreach ( $artists as $artist ): ?>
                  <option value="<?= htmlspecialchars($artist['id']) ?>" <?= ($artist['id'] == $song['artist_id']) ? "selected" : "" ?>><?= strip_tags($artist['name']) ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class='form-group'>
              <label for='title'>
                Song Title
              </label>
              <input class='form-control' type="text" name='title' placeholder="We're Going to Be Friends" required value="<?= strip_tags( $song['title'] ) ?>">
            </div>
            <div class='form-group'>
              <div class='form-inline'>
                <div class='input-group'>
                  <label class='input-group-addon' for="length[hours]">hours</label>
                  <input class='form-control' max='59' min='0' name='length[hours]' type="number" value="<?= $length[0] ?>">
                </div>
                <div class='input-group'>
                  <label class='input-group-addon' for="length[minutes]">minutes</label>
                  <input class='form-control' max='59' min='0' name='length[minutes]' type="number" value="<?= $length[1] ?>">
                </div>
                <div class='input-group'>
                  <label class='input-group-addon' for="length[seconds]">seconds</label>
                  <input class='form-control' max='59' min='0' name='length[seconds]' type="number" value="<?= $length[2] ?>">
                </div>
              </div>
            </div>
            
            <div class='form-group'>
              <input type="hidden" name="id" value="<?= $song['id'] ?>">
              <button class='btn btn-danger'>
                <i class='fa fa-pencil'></i>
                Update Song
              </button>
            </div>
          </fieldset>
        </form>
      </section>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>