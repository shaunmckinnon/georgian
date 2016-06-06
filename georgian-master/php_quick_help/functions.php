<?php

  /* COMMON PREDEFINED FUNCTIONS */
  // these are predefined functions in PHP

  // date
  $date = date("Y-m-d H:i:s"); // returns current date and time on the server using the provided format
  echo $date;

  // list() combines a list of variable names with values from an array
  $user = ['Shaun', 37, '1978/12/22'];
  list($name, $age, $birthdate) = $user;


  // condition and data checks
  $value = "shaun";
  // isset()
  echo '<pre>Is Set: ', var_dump( isset($value) ), '</pre>'; // return true

  // empty()
  echo '<pre>Empty: ', var_dump( empty($value) ), '</pre>'; // returns false

  // is_null()
  echo '<pre>Is Null: ', var_dump( is_null($value) ), '</pre>'; // returns false

  // is_string(), is_int(), is_numeric(), is_bool(), is_array(), is_object()
  // empty()
  echo '<pre>Is String: ', var_dump( is_string($value) ), '</pre>'; // returns true
  echo '<pre>Is Integer: ', var_dump( is_int($value) ), '</pre>'; // returns true
  echo '<pre>Is Boolean: ', var_dump( is_bool($value) ), '</pre>'; // returns true
  echo '<pre>Is Array: ', var_dump( is_array($value) ), '</pre>'; // returns true
  echo '<pre>Is Object: ', var_dump( is_object($value) ), '</pre>'; // returns true


  // array functions
  $arr = ['Bob', 'Shaun', 'Maximus'];
  // count()
  echo count( $arr ) . "<br>"; // counts the number of elements within an array

  // sort()
  sort( $arr ); // sorts the elements within the array
  echo '<pre>Sorted: ', var_dump( $arr ), '</pre>'; // "sort" is destructive. It changes the original order even if assigned to a new variable. If you assign the result of sort( $arr ) to a variable, it will return a boolean value, not your array.


  /* CUSTOM FUNCTION CREATION */
  // defining a function
  function my_custom_fuction ( $argument_one, $argument_two ) {
    echo "You may use a function as a module if you have nothing to return.<br>";

    // else you can return a result
    return $argument_one . " & " . $argument_two . "<br>";
  }

  // calling a function
  echo my_custom_fuction( "Bobby B", "Whitney H" );
  echo my_custom_fuction( "Captain", "Tennille" );

?>