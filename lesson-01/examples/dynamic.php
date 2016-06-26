<?php
  $recipe_name = 'Grilled Cheese';
  $ingredients = ['2 tbl spns of butter', '2 slices of home baked bread', '2 slices of monteray jack cheese', '1 slice of old cheddar', '1 slice of mozzarella'];
  $preparation_steps = ['Butter one side of each slice of bread', 'Place buttered side of each slice on griddle', 'Place on piece of monteray jack on each piece of bread', 'Place cheddar cheese on one slice of bread', 'Place mozzarella on the opposite piece', 'Once golden brown, combine both pieces', 'Cut into triangles and serve with favourite your ketchup'];
  $date = date("l jS \of F Y", strtotime('2016-04-28'));
?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Lesson 01 - Example</title>
  </head>

  <body>
    <div class="container">

      <header>
        <h1 class="page-header">Lesson 01 Example<small>&nbsp;&mdash;&nbsp;Grilled Dynamic Pages</small></h1>
      </header>

      <section>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">World's Greatest <?= $recipe_name; ?></h3>
          </div>

          <div class="panel-body">
            <div class="pull-left">
              <img src="https://s-media-cache-ak0.pinimg.com/736x/af/3f/ea/af3fea1fc7bb28efe8356945bcec4633.jpg" class="img-responsive thumbnail">
            </div>
            <div class="pull-right">
              <h3>Recipe Ingredients</h3>
              <ul>
                <?php foreach ($ingredients as $ingredient): ?>
                  <li>
                    <?= $ingredient; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
              <h3>Recipe Preparation Method</h3>
              <ol>
                <?php foreach ($preparation_steps as $step): ?>
                  <li>
                    <?= $step; ?>
                  </li>
                <?php endforeach; ?>
              </ol>
            </div>
          </div>

          <div class="panel-footer">
            <small><strong>Preparation Date: <?= $date; ?></strong></small>
          </div>
        </div>
      </section>
      
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>