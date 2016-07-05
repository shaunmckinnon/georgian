<?php

  require_once 'class.person.php';

  $shaun = new Person( 'Shaun', 'McKinnon', '1978-12-22' );
  $janel = new Person( 'Janel', 'McKinnon', '1984-04-28' );
  $dimitrius = new Person( 'Dimitrius', 'McKinnon', '2002-10-29' );

  var_dump( $shaun->get_person_info() );

  $shaun->set_first_name( 'Shaun Cameron' );

  echo $shaun->full_name() . ' is ' . $shaun->age() . ' years old.<br>';
  echo $janel->full_name() . ' is ' . $janel->age() . ' years old.<br>';
  echo $dimitrius->full_name() . ' is ' . $dimitrius->age() . ' years old.<br>';