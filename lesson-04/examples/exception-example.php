<?php

  try {
    echo "I'm intentionally throwing an exception.";
    throw new Exception("Here it is.");
  } catch ( Exception $e ) {
    echo '<pre>', var_dump($e), '</pre>';
  }