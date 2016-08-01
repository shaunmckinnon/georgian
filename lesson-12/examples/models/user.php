<?php
  
  class User extends ActiveRecord\Model {

    // define extra attributes/properties
    public $confirm_password;


    // callbacks
    static $before_save = array( 'hash_it' );


    /* Validations */
    static $validates_presence_of = array(
      array( 'first_name', 'message' => 'must be present.' ),
      array( 'last_name', 'message' => 'must be present.' ),
      array( 'email', 'message' => 'must be present.' ),
      array( 'password', 'message' => 'must be present.', 'on' => array( 'create' ) )
    );

    static $validates_size_of = array(
      array( 'first_name', 'maximum' => 100, 'too_long' => 'is way too long.' ),
      array( 'last_name', 'maximum' => 100, 'too_long' => 'is way too long.' ),
      array( 'email', 'maximum' => 100, 'too_long' => 'is way too long.' ),
      array( 'password', 'maximum' => 100, 'too_long' => 'is way too long.', 'on' => array( 'create' ) ),
      array( 'password', 'minimum' => 8, 'too_short' => 'must be at least 8 characters.', 'on' => array( 'create' ) ),
    );

    static $validates_uniqueness_of = array(
      array( 'email', 'message' => 'is already registered.' )
    );

    public function validate () {
      // validate that password matches confirm_password
      if( $this->attribute_is_dirty( 'password' ) && $this->password !== $this->confirm_password ) {
        $this->errors->add( 'password', 'must match the password confirmation.' );
      }
    }

    // callbacks
    public function hash_it () {
      if ( $this->attribute_is_dirty( 'password' ) ) {
        $this->password = password_hash( $this->password, PASSWORD_DEFAULT );
      }
    }

  }