<?php

  class Product extends ActiveRecord\Model {

    // associations
    static $belongs_to = array( 'category' );

    // setters
    public function set_name ( $name ) {
      $this->assign_attribute( 'name', filter_var( $name, FILTER_SANITIZE_STRING ) );
    }

    public function set_price ( $price ) {
      $this->assign_attribute( 'price', filter_var( $price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
    }

    // getters
    public function get_name () {
      return htmlentities( $this->read_attribute( 'name' ) );
    }

    // create a getter to pull formatted prices
    public function get_price_formatted () {
      return '$' . number_format( $this->read_attribute( 'price' ), 2, '.', ',' );
    }

    // validations
    static $validates_presence_of = array(
      array( 'name', 'message' => 'must be present' ),
      array( 'price', 'message' => 'must be present' )
    );

    static $validates_uniqueness_of = array(
      array(
        array( 'name', 'category_id' ),
        'message' => 'this product already exists for this category'
      )
    );

    static $validates_numeralicity_of = array(
      array( 'price', 'greater_than' => 0.01, 'message' => 'must be greater than 1 cent' )
    );

    public function validate () {
      // validate the presence of the category
      if ( !Category::exists( $this->category_id ) ) $this->errors->add( 'category_id', "the selected category doesn't exist" );
    }

  }