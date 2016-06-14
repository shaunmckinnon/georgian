<?php

  require_once 'class.database.php';
  
  class Admin extends Database {

    public static function verify ( $username, $password, $table = 'scm_admin' ) {
      error_log("LOG: Verifying User\n");

      $db = new Database();
      $db->query('SELECT COUNT(*) FROM ' . $table . ' WHERE username = :username AND password = :password ' );

      // hash it up
      $username = password_hash( $username, PASSWORD_DEFAULT );
      $password = password_hash( $password, PASSWORD_DEFAULT );

      $db->bind( ':username', $username );
      $db->bind( ':password', $password );
      $db->execute();

      if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
      }

      $_SESSION['authenticated'] = ( $db->rowCount() > 0 );
      $db->closeDB();
    }

    public static function verified () {
      error_log("LOG: Checking if user is verified\n");

      if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
      }

      if ( isset( $_SESSION['authenticated'] ) ) {
        return true;
      } else {
        return false;
      }
    }

    public static function notVerifiedRedirect ( $location ) {
      error_log("LOG: Checking if user is verified then redirecting\n");

      if ( Admin::verified() == false ) {
        header( 'Location: ' . $location );
      }
    }

    public static function logout () {
      error_log("LOG: Logging Out\n");

      if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
      }

      session_unset();

      if ( !isset( $_SESSION['authenticated'] ) ) {
        return true;
      } else {
        return false;
      }
    }

  }