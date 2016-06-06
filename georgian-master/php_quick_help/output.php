<?php

  // single line comment
  /* multi line
     comment */

  /* ECHO */
  // echo is a language construct of PHP. You can comma separate values you wish to output with echo
  echo "This is output.<br>"; // straight forward output
  echo "So", " is ", "this.<br>"; // comma separated
  echo "So" . " is " . "this.<br>"; // concatenated output with double quotes
  echo 'So' . ' is ' . 'this.<br>'; // concatenated output with single quotes
  $interpolated = "this.<br>";
  echo "So is {$interpolated}"; // interpolated string (only works with double quoted strings)
  echo 'So is ' . $interpolated; // you can concatenate the variable with single quoted strings.

  // debugging with echo
  // You can use the var_dump or var_export functions to output a variable
  // If you use '<pre>', you can output the information formatted
  $example = ['string', 1, 2.0, true, ['nested', 'array'], $interpolated];
  echo var_export($example); // not formatted
  echo '<pre>', var_export($example), '</pre>'; // formatted

  // var_dump will output more information for each value (including data type and length)
  echo var_dump($example); // some servers will format this (Dreamhost does not)
  echo '<pre>', var_dump($example), '</pre>'; // this is always formatted (buy may not be syntax highlighted)

?>
<?= "This is a shorthand echo statement used usually for inline output within HTML.<br>" ?>

<?php

  // "print" can be used for the above as well. One minor difference is "print" has a return value when checked where echo does not. This means "print" can be used in expressions.

  // "printf" output a formatted string (%s represents a string, %d as a number). The order of data is important to the order of placeholders
  printf("%s is married to %s.", "Bobby B", "Whitney Houston");

?>