<?php

  /**
  * Person Class
  */
  class Person
  {
    
    /* Properties */
    private $first_name;
    private $last_name;
    private $dob;
    private $person_info;


    /* Constructor Method */
    public function __construct ( $first_name, $last_name, $dob ) {
      $this->set_first_name( $first_name );
      $this->set_last_name( $last_name );
      $this->set_dob( $dob );
    }


    /* Methods */
    /* Setters */
    public function set_first_name ( $first_name ) {
      $this->first_name = $first_name;
    }

    public function set_last_name ( $last_name ) {
      $this->last_name = $last_name;
    }

    public function set_dob ( $dob ) {
      $this->dob = $dob;
    }


    /* Getters */
    public function get_first_name () {
      return $this->first_name;
    }

    public function get_last_name () {
      return $this->last_name;
    }

    public function get_dob () {
      return $this->dob;
    }

    public function get_person_info () {
      return [
        'first_name' => $this->get_first_name(),
        'last_name' => $this->get_last_name(),
        'dob' => $this->get_dob()
      ];
    }


    /* Helper Methods */
    public function full_name () {
      return $this->first_name . ' ' . $this->last_name;
    }

    public function age ( $date = null ) {
      // 2016-12-22
      $dob = new DateTime( $this->dob );
      $current = is_null( $date ) ? new DateTime : new DateTime( $date );
      $diff = $dob->diff( $current );
      return $diff->format( '%Y' );
    }

  }