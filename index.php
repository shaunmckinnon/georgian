<?php

  $Directory = new RecursiveDirectoryIterator('./');
  $ritit = new RecursiveIteratorIterator($Directory, RecursiveIteratorIterator::CHILD_FIRST);

  $r = array();

  foreach ($ritit as $splFileInfo) {
    $path = $splFileInfo->isDir() ? array($splFileInfo->getFilename() => array()) : array($splFileInfo->getFilename());
    for ($depth = $ritit->getDepth() - 1; $depth >= 0; $depth--) {
      $path = array($ritit->getSubIterator($depth)->current()->getFilename() => $path);
    } 
    
    $r = array_merge_recursive($r, $path);
  }

  function printArrayList($array) {
    echo "<ul>";

    foreach($array as $k => $v) {
      if (is_array($v)) {
        echo "<li>" . $k . "</li>";
        printArrayList($v);
        continue;
      }

      echo "<li>" . $v . "</li>";
    }

    echo "</ul>";
  }

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <title>Index Page</title>
  </head>

  <body>
    <div class="container">
      <h1 class="page-header"></h1>
      <?php printArrayList( $r ); ?>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>