<?php

  require_once( 'class.games.php' );

  $games = new Games();

  if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    $sortables = $games->getSortables( $_GET['name'] );

    $js_sortables = json_encode( $sortables, true );
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PHP Connection Exercise</title>
    <script type="text/javascript" src="http://underscorejs.org/underscore-min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="interactive-game.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.css">
    <link rel="stylesheet" type="text/css" href="interactive-example.css">

    <script type="text/javascript">
      $(function(){
        var js_sortables = $.parseJSON('<?= $js_sortables ?>');
        new InteractiveGame({
          gameArray: js_sortables
        });
      });
    </script>

    <ul id="sortable">
    </ul>
    
  </body>
</html>