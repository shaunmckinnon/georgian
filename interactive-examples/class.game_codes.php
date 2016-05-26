<?php
  
  require_once 'class.admin.php';

  class GameCodes extends Admin {

    private $db;

    public function __construct () {
      // redirect if not logged in
      Admin::notVerifiedRedirect( 'login.php' );
      $this->db = new Database();
    }

    public function createGameCode ( $provided_code ) {
      // verify code is a string and equal to or less than 16 characters
      if ( is_string( $provided_code ) && count( $provided_code ) <= 16 ) {

        // create game code record
        $this->db->query( 'INSERT INTO scm_game_codes (code, date) VALUES (:code, ' . date('Y-m-d') . ')' );
        $this->db->bind( ':code', $provided_code );
        $this->db->execute();

        if ( $this->db->error ) {
          return false;
        } else {
          $id = $this->db->lastInsertId();
          return $id;
        }
      } else {
        return false;
      }
    }

    public function getGameCodeId ( $provided_code ) {
      if ( is_string( $provided_code ) && count( $provided_code ) <= 16 ) {

        // create game code record
        $this->db->query( 'SELECT id FROM scm_game_codes WHERE code = :code' );
        $this->db->bind( ':code', $provided_code );
        $this->db->execute();

        if ( $this->db->error ) {
          return false;
        } else {
          $result = $this->db->single();
          return $result['id'];
        }
      } else {
        return false;
      }
    }

    private function updateActiveField ( $set_to, $id ) {
      // update game code record
      $this->db->query( 'UPDATE scm_game_codes SET active = :set_to WHERE id = :id' );
      $this->db->bind( ':set_to', $set_to );
      $this->db->bind( ':id', $id );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        return true;
      }
    }

    public function deactivateGameCode ( $provided_code ) {
      // get id of code
      if ( !is_numeric( $provided_code ) ) {
        $provided_code = $this->getGameCodeId( $provided_code );
      }

      // update the active field
      return $this->updateActiveField( 0, $provided_code );
    }

    public function activateGameCode ( $provided_code ) {
      // get id of code
      if ( !is_numeric( $provided_code ) ) {
        $provided_code = $this->getGameCodeId( $provided_code );
      }

      // update the active field
      return $this->updateActiveField( 1, $provided_code );
    }

    public function getAllGameCodes() {
      $this->db->query( 'SELECT * FROM scm_game_codes' );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        $result = $this->db->resultset();
        return $result;
      }
    }

    public function destroyGameCode ( $provided_code ) {
      // get id of code
      if ( !is_numeric( $provided_code ) ) {
        $provided_code = $this->getGameCodeId( $provided_code );
      }

      // remove all the users from the game
      $this->db->query( 'DELETE FROM scm_interative_example_users WHERE game_code_id = :provided_code' );
      $this->db->bind( ':provided_code', $provided_code );
      $this->db->execute();

      // destroy game code record
      $this->db->query( 'DELETE FROM scm_game_codes WHERE id = :code' );
      $this->db->bind( ':code', $provided_code );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        return true;
      }
    }

  }
