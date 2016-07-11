<?php

  /**
  * Validate
  */
  class Validate
  {

    private $valid;

    public function __construct () {
      $this->valid = true;
    }

    public function get_valid () {
      return $this->valid;
    }

    public function exists ( $value ) {
      if ( isset( $value ) ) {
        return true;
      } else {
        $this->valid = false;
        return false;
      }
    }

    public function number ( $value ) {
      if ( is_int( $value ) || is_numeric( $value ) ) {
        return true;
      } else {
        $this->valid = false;
        return false;
      }
    }
    
    public function required ( $value ) {
      if ( !empty( $value ) ) {
        return true;
      } else {
        $this->valid = false;
        return false;
      }
    }

    public function email ( $value ) {
      if ( filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
        return true;
      } else {
        $this->valid = false;
        return false;
      }
    }

    public function url ( $value ) {
      if ( filter_var( $value, FILTER_VALIDATE_URL ) ) {
        return true;
      } else {
        $this->valid = false;
        return false;
      }
    }

    public function match ( $value1, $value2 ) {
      if ( $value1 === $value2 ) {
        return true;
      } else {
        $this->valid = false;
        return false;
      }
    }

  }