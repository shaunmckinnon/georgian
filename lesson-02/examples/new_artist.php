<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>New Artist</title>
  </head>

  <body>
    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="container">
      <h1 class="page-header">Add Artist</h1>
      
      <form method="POST" action="add_artist.php">
        <fieldset>
          <legend>Artist Information</legend>
          <div class="form-group">
            <label>Artist Name</label>
            <input class="form-control" name='name' placeholder="White Stripes" required>
          </div>
          
          <div class="form-group">
            <label>Bio Link</label>
            <input class="form-control" name="bio_link" placeholder="https://en.wikipedia.org/wiki/The_White_Stripes">
          </div>

          <div class="form-group">
            <button class="btn btn-danger" type="submit">
              <i class="fa fa-plus"></i>&nbsp;
              Add Artist
            </button>
          </div>
        </fieldset>
      </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>