<?php

  class Product extends ActiveRecord\Model {

    public $file = [];

    // callback function
    static $before_save = array( 'upload' );
    static $before_destroy = array( 'delete_image' );

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

      if ( !empty( $this->file['name'] ) && !empty( $this->image ) ) {
        // validate the type of file
        if ( !preg_match( "/png|gif|jpg|jpeg/i", $this->file['type'] ) ) {
          $this->errors->add( 'image', "is an invalid file" );
        }

        // validate size
        if ( $this->file['size'] > 30000 ) {
          $this->errors->add( 'image', "has an error." );
        }

        // validate other errors
        if ( $this->file['error'] !== 0 ) {
          $this->errors->add( 'image', "has an error." );
        }
      }
    }

    // callbacks
    public function upload () {
      if ( $this->is_valid() && !empty( $this->file['name'] ) ) {
        // upload the image
        $uploadfile = '../uploads/images/' . $this->file['name'];

        if ( move_uploaded_file( $this->file['tmp_name'], $uploadfile ) ) {
          // assign the name
          $this->image = $this->file['name'];
        } else {
          // throw an error
          $this->errors->add( 'image', "could not be uploaded." );
        }
      }
    }

    public function delete_image () {
      if ( file_exists( '../uploads/images/' . $this->image ) ) {
        unlink( '../uploads/images/' . $this->image );
      }
    }

  }





















