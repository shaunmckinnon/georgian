<?php
  
  /* CONDITIONAL-CONTROLLED LOOPS */
  // while loop
  $foo = true;
  while ( $foo == true ) {
    // execute this while $foo is equal to true
    echo "Hello World<br>";

    // set $foo to false (or anything else) and the loop will stop as $foo will no longer equal true
    $foo = false;
  }

  // do-while loop
  do {
    // execute this before the condition is evaluated
    echo "Hello World<br>";

    // setting $foo to false
    $foo = false;

    // the condition is not met, so the loop will exit
  } while ( $foo == true );


  /* COUNT-CONTROLLED LOOPS */
  // for loop (will execute till $i is greater than or equal to 2)
  for ( $i = 0; $i < 2; $i++ ) {
    // execute the following each iteration
    echo "Hello World<br>";
  }

  // foreach loop (will execute till it runs out of values)
  $arr = array('value 1', 'value 2', 'value 3');
  foreach ($arr as $value) {
    echo $value . '<br>';
  }

  // foreach loop with an associative array
  $as_arr = array('key 1' => 'value 1', 'key 2' => 'value 2', 'key 3' => 'value 3');
  foreach ($as_arr as $key => $value) {
    echo $key . ' = ' . $value . '<br>';
  }

  // shorthand foreach loop
  foreach ($arr as $value):
    echo $key . ' = ' . $value . '<br>';
  endforeach;

?>