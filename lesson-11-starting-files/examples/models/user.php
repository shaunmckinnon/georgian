<?php

  class User extends ActiveRecord\Model {

    // callbacks
    static $before_save = array( 'hash_it' );

    // define extra attributres/properties
    public $confirm_password;


    /* Validations */
    static $validates_presence_of = array(
      array( 'first_name', 'message' => 'must be present.' ),
      array( 'last_name', 'message' => 'must be present.' ),
      array( 'email', 'message' => 'must be present.' ),
      array( 'password', 'message' => 'must be present.', 'on' => 'create' )
    );

    static $validates_size_of = array(
      array( 'first_name', 'maximum' => 50, 'too_long' => 'is way too long.' ),
      array( 'last_name', 'maximum' => 50, 'too_long' => 'is way too long.' ),
      array( 'email', 'maximum' => 50, 'too_long' => 'is way too long.' ),
      array( 'password', 'maximum' => 100, 'too_long' => 'is way too long.' ),
      array( 'password', 'minimum' => 8, 'too_short' => 'is way too short.' )
    );

    static $validates_uniqueness_of = array(
      array( 'email', 'message' => 'is already registered.' )
    );

    public function validate () {
      // validate that password matches confirm_password
      if ( $this->attribute_is_dirty( 'password' ) && $this->password !== $this->confirm_password ) {
        $this->errors->add( 'password', 'must match the password confirmation.' );
      }
    }

    // callbacks
    public function hash_it () {
      $this->password = password_hash( $this->password, PASSWORD_DEFAULT );
    }

  }