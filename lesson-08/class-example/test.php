<?php
  
  /*
  * In order to use the class, we have to require it
  * first. PHP has a library which can simplify this
  * process by auto-loading all the classes.
  */
  require_once 'class.person.php';


  /*
  * We instantiate (create) the class to create a new object
  * and store it in a variable. Every instantiation of the
  * class will create a new object. The benefits of this is
  * our objects will abide by the same blueprint, and therefore
  * have the same properties and methods available to them.
  * This is great for keeping our code organized.
  */
  $shaun = new Person( 'Shaun', 'McKinnon', '1978-12-22' );
  $janel = new Person( 'Janel', 'McKinnon', '1984-04-28' );


  /*
  * Here we are simply outputting the response from the
  * get_person_info() method of our $shaun object.
  * var_dump is a handy PHP function that outputs the
  * value of its argument including properties pertaining
  * to that value such as length and datatype. If you
  * pass an array or object to var_dump, it will output
  * those as well. Dumped objects will show you the current
  * values of all the properties. Dumped arrays will show
  * the values of all the elements including nested arrays.
  */
  var_dump( $shaun );
  var_dump( $shaun->get_person_info() );


  /*
  * To call a method, we reference our object, use a
  * skinny arrow, and then the method name:
  * $object->method_name();
  * You may recognize this from our use of PDO.
  * To reference a property, you first must be sure
  * it is a PUBLIC property, as private and protected properties
  * and methods are unavailable. You access the property with
  * following syntax:
  * $object->property_name;
  */
  echo "<h1>{$shaun->full_name()}</h1>";
  echo "<p>{$shaun->get_first_name()} is {$shaun->age('2020-06-30')} years old.</p>";
  echo "<p>{$janel->get_first_name()} is {$janel->age()} years old.</p>";