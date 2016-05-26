<?php

  require_once 'class.database.php';
  
  class Admin extends Database {

    public static function verify ( $username, $password, $table = 'scm_admin' ) {
      $db = new Database();
      $db->query('SELECT COUNT(*) FROM ' . $table . ' WHERE username = :username AND password = :password ' );

      // hash it up
      $username = password_hash( $username, PASSWORD_DEFAULT );
      $password = password_hash( $password, PASSWORD_DEFAULT );

      $db->bind( ':username', $username );
      $db->bind( ':password', $password );
      $db->execute();

      echo $db->error;

      if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
      }

      $_SESSION['authenticated'] = ( $db->rowCount() > 0 );
      $db->closeDB();
    }

    public static function verified () {
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
      if ( Admin::verified() == false ) {
        header( 'Location: ' . $location );
      }
    }

  }