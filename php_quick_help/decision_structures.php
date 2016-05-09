<?php

  // if, else, if else
  $foo = "day";
  if ( $foo == "day" ) {
    echo "Good Morning<br>";
  } else if ( $foo == "afternoon" ) {
    echo "Good Afternoon<br>";
  } else {
    echo "Good Night<br>";
  }

  // switch
  switch ($foo) {
    case "day":
      echo "Good Morning<br>";
      break;

    case "afternoon":
      echo "Good Afternoon<br>";
      break;
    default:
      echo "Good Night<br>";
      break;
  }

?>