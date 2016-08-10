<?php
  
  class Superhero extends ActiveRecord\Model {

    /* Sanitizations */
    // setter
    public function set_alias ( $alias ) {
      $this->assign_attribute( 'alias', filter_var( $alias, FILTER_SANITIZE_STRING ) );
    }

    public function set_first_name ( $first_name ) {
      $this->assign_attribute( 'first_name', filter_var( $first_name, FILTER_SANITIZE_STRING ) );
    }

    public function set_last_name ( $last_name ) {
      $this->assign_attribute( 'last_name', filter_var( $last_name, FILTER_SANITIZE_STRING ) );
    }

    // getter
    public function get_alias () {
      return htmlentities( $this->read_attribute( 'alias' ) );
    }

    public function get_first_name () {
      return htmlentities( $this->read_attribute( 'first_name' ) );
    }

    public function get_last_name () {
      return htmlentities( $this->read_attribute( 'last_name' ) );
    }


    /* Validations */
    static $validates_presence_of = array(
      array( 'alias', 'message' => 'must be present.' )
    );

    static $validates_size_of = array(
      array( 'alias', 'maximum' => 100, 'too_long' => 'is way too long.' ),
      array( 'first_name', 'maximum' => 50, 'too_long' => 'is way too long.' ),
      array( 'last_name', 'maximum' => 50, 'too_long' => 'is way too long.' )
    );

  }