<?php

  class Product extends ActiveRecord\Model {

    // associations/relationships
    static $belongs_to = array( 'category' );

    /* Sanitizations */
    // setter
    public function set_name ( $name ) {
      $this->assign_attribute( 'name', filter_var( $name, FILTER_SANITIZE_STRING ) );
    }

    public function set_price ( $price ) {
      $this->assign_attribute( 'price', filter_var( $price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
    }

    // getter
    public function get_name () {
      return htmlentities( $this->read_attribute( 'name' ) );
    }

    public function get_price_formatted () {
      return '$' . number_format( $this->read_attribute( 'price' ), 2, '.', ',' ); // $1,222.56
    }


    /* Validations */
    static $validates_presence_of = array(
      array( 'name', 'message' => 'must be present.' ),
      array( 'price', 'message' => 'must be present.' )
    );

    static $validates_size_of = array(
      array( 'name', 'maximum' => 100, 'too_long' => 'is way too long.' )
    );

    static $validates_numeralicity_of = array(
      array( 'price', 'greater_than' => 0.01, 'message' => 'must be greater than 1 cent' )
    );

    static $validates_uniqueness_of = array(
      array(
        array( 'name', 'category_id' ),
        'message' => 'exists for this category already.'
      )
    );

    public function validate () {
      // validate the presence of the category in the database
      if ( Category::exists( $this->category_id ) === false ) {
        $this->errors->add( 'category_id', "doesn't exist." );
      }
    }

  }