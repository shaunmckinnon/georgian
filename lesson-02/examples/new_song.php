<!DOCTYPE html>
<html>
  <head>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
    <script crossorigin='anonymous' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
    <title>Add New Song</title>
  </head>
  <body>
    <div class='container'>
      <div class='row'>
        <div class='col-xs-12'>
          <header>
            <h1 class='page-header'>Add New Song</h1>
          </header>
        </div>
        <div class='col-xs-12'>
          <section>
            <form action='add_artist.php' method='post'>
              <fieldset>
                <legend>Song Information</legend>
                <div class='form-group'>
                  <label for='title'>
                    Song Title
                  </label>
                  <input class='form-control' id='title' name='title' placeholder='Love Interruption' required type='text'>
                </div>
                <div class='form-group'>
                  <label for='time'>
                    Song Length
                  </label>
                  <div class='form-inline'>
                    <div class='input-group'>
                      <input class='form-control' id='minutes' max='59' min='0' name='time[minutes]' placeholder='2' required type='number'>
                      <div class='input-group-addon'>min</div>
                    </div>
                    :
                    <div class='input-group'>
                      <input class='form-control' id='seconds' max='59' min='0' name='time[seconds]' placeholder='36' required type='number'>
                      <div class='input-group-addon'>sec</div>
                    </div>
                  </div>
                </div>
              </fieldset>
            </form>
          </section>
        </div>
        <div class='col-xs-12'>
          <footer></footer>
        </div>
      </div>
    </div>
  </body>
</html>
