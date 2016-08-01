<?php
  
  class Category extends ActiveRecord\Model {

    // associations/relationships
    static $has_many = array( 'products' );

    /* Sanitizations */
    // setter
    public function set_name ( $name ) {
      $this->assign_attribute( 'name', filter_var( $name, FILTER_SANITIZE_STRING ) );
    }

    // getter
    public function get_name () {
      return htmlentities( $this->read_attribute( 'name' ) );
    }


    /* Validations */
    static $validates_presence_of = array(
      array( 'name', 'message' => 'must be present.' )
    );

    static $validates_size_of = array(
      array( 'name', 'maximum' => 100, 'too_long' => 'is way too long.' )
    );

    static $validates_uniqueness_of = array(
      array( 'name', 'message' => 'already exists.' )
    );

  }