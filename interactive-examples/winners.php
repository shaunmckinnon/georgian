<!DOCTYPE HTML>
<html lang="en">

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <title>Winners</title>
  </head>

  <body>
    <div class="container">
      <h1 class="page-header">Player Positions</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <td>Player</td>
            <td>Time</td>
          </tr>
        </thead>

        <tbody>
          
        </tbody>
      </table>
    </div>

    <input type="hidden" id="game_code_id" value="<?= $_GET['game_code_id'] ?>">

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script>
      $(function () {

        function getWinnerFeed() {
          $.get( 'winner_feed.php', {
            game_code_id: $('#game_code_id').val()
          }).done(function (data) {
            $('table').find('tbody').html('');
            $.each( $.parseJSON(data), function() {
              $('table').find('tbody').append('<tr><td>' + this.name + '</td><td>' + this.total_time + '</td></tr>');
            });
          });
        }

        getWinnerFeed();
        setInterval(getWinnerFeed, 2500);

      });
    </script>
  </body>
  
</html>