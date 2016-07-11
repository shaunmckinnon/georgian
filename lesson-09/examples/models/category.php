<?php

  class Category extends ActiveRecord\Model {

    // associations
    static $has_many = array( 'products' );

    // setters
    public function set_name ( $name ) {
      $this->assign_attribute( 'name', filter_var( $name, FILTER_SANITIZE_STRING ) );
    }

    // getters
    public function get_name () {
      return htmlentities( $this->read_attribute( 'name' ) );
    }

    // validations
    static $validates_presence_of = array(
      array( 'name', 'message' => 'must be present' )
    );

    static $validates_uniqueness_of = array(
      array( 'name', 'message' => 'this category already exists' )
    );

  }