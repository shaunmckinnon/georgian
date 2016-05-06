<!DOCTYPE html>
<html>
  <head>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css' integrity='sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O' rel='stylesheet'>
    <title>Add New Artist</title>
  </head>
  <body>
    <div class='container'>
      <div class='row'>
        <div class='col-xs-12'>
          <h1 class='page-header'>Add New Artist</h1>
        </div>
        <div class='col-xs-12'>
          <form action='add_artist.php' method='post'>
            <fieldset>
              <legend>Artist Information</legend>
              <div class='form-group'>
                <label for='name'>
                  Artist Name
                </label>
                <input class='form-control' id='name' name='name' placeholder='White Stripes' required type='text'>
              </div>
              <div class='form-group'>
                <label for='minutes'>
                  Artist Founded Date
                </label>
                <input class='form-control' id='founded-date' name='founded-date' type='date'>
              </div>
              <div class='form-group'>
                <label for='bio-link'>
                  Bio Link
                </label>
                <input class='form-control' id='bio-link' name='bio-link' placeholder='https://en.wikipedia.org/wiki/The_White_Stripes' type='url'>
              </div>
              <div class='form-group'>
                <label for='website'>
                  Official Website
                </label>
                <input class='form-control' id='website' name='website' placeholder='https://thirdmanrecords.com/about/artists/the-white-stripes' type='url'>
              </div>
            </fieldset>
            <div class='form-group'>
              <button class='btn btn-default'>
                <i class='fa fa-plus'></i>
                Add Artist
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script crossorigin='anonymous' integrity='sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=' src='https://code.jquery.com/jquery-2.2.3.js'></script>
    <script crossorigin='anonymous' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  </body>
</html>
