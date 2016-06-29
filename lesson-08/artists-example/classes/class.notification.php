<?php

  require_once 'class.validation.php';

  /**
  * Notifications
  */
  class Notification
  {
    
    /* contructor */
    public function __construct () {
      // start the session if it isn't already
      if ( session_status() == PHP_SESSION_NONE ) session_start();

      // if notifications exist, assign them to the property notification
      $_SESSION['notifications'] = isset( $_SESSION['notifications'] ) ? $_SESSION['notifications'] : [];
    }


    /* methods */
    // clear current notifications
    public function clear_notifications () {
      // unset the notifications
      if ( isset( $_SESSION['notifications'] ) ) unset( $_SESSION['notifications'] );
    }

    // set a notification
    public function set_notification ( $label, $notification ) {
      $_SESSION['notifications'][$label] = [
        'notification' => $notification
      ];
    }

    // get the notification
    public function get_notifications ( $label ) {
      return isset( $_SESSION['notifications'][$label] ) ? $_SESSION['notifications'][$label] : false;
    }

    // get all notifications
    public function get_all_notifications () {
      return $_SESSION['notifications'];
    }

    // common notification functions
    public function set_success ( $notification ) {
      // if there are success messages, just append ours
      if ( isset( $_SESSION['notifications']['successes'] ) ) {
        $_SESSION['notifications']['successes'][] = $notification;
      } else {
        $_SESSION['notifications']['successes'] = [$notification];
      }
    }

    // return the successes or false
    public function get_successes () {
      return isset( $_SESSION['notifications']['successes'] ) ? $_SESSION['notifications']['successes'] : false;
    }

    public function set_fail ( $notification ) {
      // if there are success messages, just append ours
      if ( isset( $_SESSION['notifications']['fails'] ) ) {
        $_SESSION['notifications']['fails'][] = $notification;
      } else {
        $_SESSION['notifications']['fails'] = [$notification];
      }
    }

    // return the fails or false
    public function get_fails () {
      return isset( $_SESSION['notifications']['fails'] ) ? $_SESSION['notifications']['fails'] : false;
    }

    // build fails from the errors returned (requires the rules format from validation)
    public function set_validation_fails ( $errors, $rule_messages = null ) {
      // clear the current fail notifications
      $this->clear_notifications();

      // build some default messages for rules
      $rule_messages = $rule_messages ? $rule_messages : [
        'required' => '[field] is required.',
        'email' => '[field] must be in a valid email format.',
        'url' => '[field] must be in a valid URL format.'
      ];

      // iterate through the rules
      foreach ( $errors as $rule => $fields ) {
        // iterate through the fields and add the error message
        foreach ( $fields as $field ) {
          $field = str_replace(['-', '_'], ' ', $field);
          $message = str_replace( ['[field]', '[rule]'], [$field, $rule], $rule_messages[$rule] );
          $this->set_fail( ucfirst( $message ) );
        }
      }
    }

    // redirect helper
    public function redirect( $location ) {
      // redirect
      header( 'Location: ' . $location );
      exit;
    }

  }