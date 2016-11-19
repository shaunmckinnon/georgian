<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Forms Explored Processed</title>
  </head>

  <body>
    <div class="container">

      <header>
        <h1 class="page-header">Forms Explored<small>&nbsp;&mdash;&nbsp;Processed</small></h1>
      </header>

      <section>
        <br><br>
        <h2>Testing $_POST</h2><hr>
        <?php
          echo '<pre>', var_dump($_POST), '</pre>';
        ?>
      </section>

      <p>
        <a href="forms-explored.php">Back</a>
      </p>
      
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>