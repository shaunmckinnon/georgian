<?php

  /**
  * Validation and Sanitization
  */
  class Validation
  {
    
    /*
    * The validated property can be checked
    * to see the state of the validation.
    */
    private $invalid;

    /*
    * The sanitization property is used to
    * store the sanitized values in the
    * same structure style as $_POST.
    */
    private $sanitized;

    /*
    * Temporarily store our post
    */
    private $post;

    /*
    * The constructor will initially set
    * the property validated to true,
    * as we can assume everything is ok.
    * In addition, we will initialize the
    * property sanitized with an empty array.
    */
    public function __construct( $post = [] ) {
      $this->invalid = [];
      $this->sanitized = [];
      $this->post = $post;
    }

    /*
    * Getters
    */
    public function get_invalid () {
      return empty( $this->invalid ) && is_array( $this->invalid ) ? false : $this->invalid;
    }

    public function get_sanitized () {
      return empty( $this->sanitized ) && is_array( $this->sanitized ) ? false : $this->sanitized;
    }

    public function get_post () {
      return empty( $this->post ) && is_array( $this->sanitized ) ? false : $this->post;
    }

    /*
    * Setters
    */
    public function set_invalid () {
      return empty( $this->invalid ) && is_array( $this->invalid ) ? false : $this->invalid;
    }

    public function set_sanitized () {
      return empty( $this->sanitized ) && is_array( $this->sanitized ) ? false : $this->sanitized;
    }

    public function set_post () {
      return empty( $this->post ) && is_array( $this->sanitized ) ? false : $this->post;
    }

    /*
    * The validate method requires two
    * parameters, the $_POST associative array
    * (or a structure similar),
    * and the rule_and_fields associative array,
    * structured as so:
    * [
    *   'rule 1' => ['field 1', 'field 2'],
    *   'rule 2' => ['field 3', 'field 1']
    * ]
    * Rule options and the required parameters are as follows:
    * 'required' = array('required field', 'required field'),
    * 'email' = array('valid email'),
    * 'url' = array('valid url')
    */
    public function validate ( $rule_and_fields, $post = null ) {
      // store the post
      $this->post = is_null( $post ) ? $this->post : $post ;

      // iterate through the rules
      foreach ( $rule_and_fields as $rule => $fields ) {
        // check which rule must apply
        switch ( $rule ) {
          case 'required':
            $this->validate_required( $fields );
            break;

          case 'email':
            $this->validate_email( $fields );
            break;

          case 'url':
            $this->validate_url( $fields );
            break;
        }
      }

      // return false if invalid has content
      $this->get_invalid() == false ? true : false;
    }

    /*
    * The sanitize method will sanitize the data
    * based on the validation method used. The
    * sanitized keys and values are used to rebuild
    * the $_POST structure which can then be accessed
    * by the user. The structure of $rule_and_fields is
    * the same as the structure for validate.
    */
    public function sanitize ( $rule_and_fields, $post = null ) {
      // store the post
      $this->post = is_null( $post ) ? $this->post : $post ;

      // iterate through the rules
      foreach ( $rule_and_fields as $rule => $fields ) {
        // check which rule must apply
        switch ( $rule ) {
          case 'required':
            $this->sanitize_required( $fields );
            break;

          case 'email':
            $this->sanitize_email( $fields );
            break;

          case 'url':
            $this->sanitize_url( $fields );
            break;
        }
      }

      // sanitize all the fields (just ensures they're strings and integers without HTML)
      $this->sanitize_required( array_keys( $post ) );
    }

    /* The validate_and_sanitize method will run
    * both the validate method and the sanitize method
    * on the same post and same rules, and return
    * either an invalid state (false) or the sanitized
    * associative array.
    * All sanitizations are performed first by the
    * rule, and second by the datatype. For example,
    * if the rule is email, it will be sanitized using
    * the method sanitize_email. If it is required and
    * the datatype is a string, it will be sanitized using
    * the method sanitize_string.
    */
    public function validate_and_sanitize( $post, $rule_and_fields ) {
      $this->validate( $post, $rule_and_fields );
      if ( $this->get_invalid() == false ) {
        $this->sanitize( $post, $rule_and_fields );
        return true;
      } else {
        return false;
      }
    }

    /* Validation Methods */
    public function verify_post () {
      return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }

    public function verify_get () {
      return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }

    private function validate_required ( $fields ) {
      // iterate through each field and if any are empty set validated to false
      foreach ( $fields as $field ) {
        if ( empty( $this->post[$field] ) ) $this->invalid['required'][] = $field;
      }
    }

    private function validate_email ( $fields ) {
      // iterate through each field and if any are invalid emails set validated to false
      foreach ( $fields as $field ) {
        if ( !empty( $this->post[$field] ) && !filter_var( $this->post[$field], FILTER_VALIDATE_EMAIL ) ) $this->invalid['email'][] = $field;
      }
    }

    private function validate_url ( $fields ) {
      // iterate through each field and if any are invalid urls set validated to false
      foreach ( $fields as $field ) {
        if ( !empty( $this->post[$field] ) && !filter_var( $this->post[$field], FILTER_VALIDATE_URL ) ) $this->invalid['url'][] = $field;
      }
    }

    /* Sanitization Methods */
    public function sanitize_required ( $fields ) {
      // iterate through each field
      foreach ( $fields as $field ) {
        $temp = $this->post[$field];
        if ( is_numeric( $temp ) ) {
          $temp = filter_var( $temp, FILTER_SANITIZE_NUMBER_INT );
        }
        if ( is_string( $temp ) ) {
          $temp = filter_var( $temp, FILTER_SANITIZE_STRING );
        }
        $this->sanitized[$field] = $temp;
      }
    }

    public function sanitize_email ( $fields ) {
      // iterate through each field
      foreach ( $fields as $field ) {
        $temp = $this->post[$field];
        $temp = filter_var( $temp, FILTER_SANITIZE_EMAIL );
        $this->sanitized[$field] = $temp;
      }
    }

    public function sanitize_url ( $fields ) {
      // iterate through each field
      foreach ( $fields as $field ) {
        $temp = $this->post[$field];
        $temp = filter_var( $temp, FILTER_SANITIZE_URL );
        $this->sanitized[$field] = $temp;
      }
    }

  }