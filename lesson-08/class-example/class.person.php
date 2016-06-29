<?php

  /*
  * Classes are a blueprint containing properties
  * and methods. Classes are a handy construct for
  * keeping code organized, maintained, and secure.
  * 
  * A very cool thing about classes is there ability
  * to be extended. Extending a class allows us to
  * apply methods and properties from another class
  * to our class. For example, a Person class may
  * extend a Mammal class. The Mammal class may give us
  * the methods eat, drink, sleep, and breathe, where as
  * the Person class may gave us the methods talk, sing,
  * celebrate_birthday.
  *
  * When researching classes, you may come across 2
  * other versions known as 'interfaces' and 'abstract classes'.
  * We won't be discussing these constructs, but, over-simplified,
  * they are like contracts for classes, stating what the
  * class must implement.
  */
  class Person
  {

    /*
    * Properties and Methods have a proceeding
    * attribute that define its scope. These are
    * public, private, and protected.
    *
    * public: scope is available to the class its defined in,
    * classes extended by the class, and objects instantiating
    * the class.
    *
    * private: scope is availabe to the class its defined in
    * and classes extending the class. Objects are prohibited
    * from accessing private properties and methods.
    *
    * protected: scope is available only to the class its defined in.
    * Extended classes and objects instantiating the class are
    * prohibited from accessing protected properties and methods.
    */
    
    /*
    * Properties are stored values that are accessible
    * by the class (public, private, protected), extended classes (public, private), or the object (public)
    * instantiating the class.
    */
    private $first_name;
    private $last_name;
    private $dob;
    private $person_info;


    /*
    * Constructors execute instantly when
    * the class is instantiated. Instantiated
    * simply means 'created'. Constructors are
    * an optional part of a class. It is
    * important to remember, that if a contructor
    * isn't present, and you are extending another
    * class, the extended class' constructor will
    * be called by default instead. However, if you
    * have a constructor, the extended class' constructor
    * won't be called unless you call parent::__construct()
    * within your child class.
    */
    public function __construct( $first_name, $last_name, $dob ) {
      $this->set_first_name( $first_name );
      $this->set_last_name( $last_name );
      $this->set_dob( $dob );
    }


    /* Methods */
    /*
    * Setters set our properties for us.
    * While you can use public properties,
    * it is better practice to use Getters
    * & Setters. Setters will permit us to
    * validate, sanitize, format, or mutate
    * data before we assign it to a property.
    */
    public function set_first_name ( $first_name ) {
      $this->first_name = $first_name;
    }

    public function set_last_name ( $last_name ) {
      $this->last_name = $last_name;
    }

    public function set_dob ( $dob ) {
      $this->dob = $dob;
    }
    

    /*
    * Getters will permit us to perform
    * logic on the property before we
    * return it to the script.
    */
    public function get_first_name () {
      return $this->first_name;
    }

    public function get_last_name () {
      return $this->last_name;
    }

    public function get_dob () {
      return $this->dob;
    }


    /*
    * On occasion, you may want to retrieve
    * all the properties of a person. It is
    * much cleaner to have a method do it for
    * you then to call every getter yourself.
    */
    public function get_person_info () {
      return [
        'first_name' => $this->get_first_name(),
        'last_name' => $this->get_last_name(),
        'age' => $this->get_dob()
      ];
    }


    /*
    * Helper methods are great for formatting or
    * mutating data without creating another property.
    */
    public function full_name () {
      return $this->first_name . ' ' . $this->last_name;
    }
    

    /*
    * Optional parameters allow the user pass
    * an argument that can enhance the functionality
    * of a method, but also provide a default operation
    * if the argument is missing.
    */
    public function age ( $date = null ) {
      $dob = new DateTime( $this->dob );
      $current = is_null( $date ) ? new DateTime : new DateTime( $date );
      $diff = $dob->diff( $current );
      return $diff->format( '%Y' );
    }
  }