<?php
  
  // validate
  session_start();

  // assign the get param to a variable
  $artist_id = $_GET['id'];

  // check if the artist id is empty
  if ( empty($artist_id) ) {
    $_SESSION['fail'] = "You must select an artist to edit.<br>";
    header( 'Location: confirmed.php' );
    exit;
  }

  // connect to the database
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
  $artist_sql = 'SELECT * FROM artists WHERE id = :id LIMIT 1';

  // prepare the SQL statement
  $artist_sth = $dbh->prepare( $artist_sql );

  // bind our value
  $artist_sth->bindParam( ':id', $artist_id, PDO::PARAM_INT );

  // execute
  $artist_sth->execute();

  // store the result
  $artist = $artist_sth->fetch();

  // close the DB
  $dbh = null;

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Update Artist</title>
  </head>

  <body>
    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="container">
      <h1 class="page-header">Update Artist</h1>
      <section>
        <form action="update_artist.php" method="post">
          <fieldset>
            <legend>Artist Information</legend>
            <div class="form-group">
              <label for="name">Artist Name</label>
              <input class="form-control" type="text" name="name" required value="<?= strip_tags( $artist['name'] ) ?>">
            </div>

            <div class="form-group">
              <label for="bio_link">Bio Link</label>
              <input class="form-control" type="url" name="bio_link" value="<?= strip_tags( $artist['bio_link'] ) ?>">
            </div>

            <div>
              <input type="hidden" name="id" value="<?= $artist['id'] ?>">
              <button class="btn btn-danger"><i class="fa fa-pencil"></i>&nbsp;Update Artist</button>
            </div>
          </fieldset>
        </form>
      </section>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>