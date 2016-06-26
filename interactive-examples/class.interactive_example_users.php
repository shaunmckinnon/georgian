<?php

  require_once 'class.game_codes.php' ;

  class InteractiveExampleUsers {

    private $db;

    public function __construct () {
      // redirect if not logged in
      $this->db = new Database();
    }

    public function createUser ( $username, $provided_code ) {
      if ( $username && is_string( $provided_code ) && count( $provided_code ) <= 16 ) {
        // check if the code delivers an id
        $gc = new GameCodes();
        $game_code_id = $gc->getGameCodeId( $provided_code );

        if ( $game_code_id ) {
          $this->db->query( 'INSERT INTO scm_interactive_example_users (name, game_code_id) VALUES (:name, :game_code_id)' );
          $this->db->bind( ':name', $username );
          $this->db->bind( ':game_code_id', $game_code_id );
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
    }

    public function getGameCodeId ( $user_id ) {
      // create game code record
      $this->db->query( 'SELECT game_code_id FROM scm_interactive_example_users WHERE id = :user_id LIMIT 1' );
      $this->db->bind( ':user_id', $user_id );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        $result = $this->db->single();
        return $result['game_code_id'];
      }
    }

    public function destroyUser ( $id ) {
      $this->db->query( 'DELETE FROM scm_interactive_example_users WHERE id = :id' );
      $this->db->bind( ':id', $id );
      $this->db->execute();

      if ( $this->error ) {
        return false;
      } else {
        return true;
      }
    }

    public function updateTotalTime ( $id, $total_time ) {
      $this->db->query( 'UPDATE scm_interactive_example_users SET total_time = :total_time WHERE id = :id' );
      $this->db->bind( ':id', $id );
      $this->db->bind( ':total_time', date( 'H:i:s', mktime(0,0,$total_time) ) );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        return true;
      }
    }

    public function getFinishedUsers ( $provided_code ) {
      if ( !is_numeric( $provided_code ) ) {
        $gc = new GameCodes();
        $provided_code = $gc->getGameCodeId( $provided_code );
      }

      $this->db->query( 'SELECT * FROM scm_interactive_example_users WHERE game_code_id = :game_code_id ORDER BY total_time ASC' );
      $this->db->bind( ':game_code_id', $provided_code );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        return $this->db->resultset();
      }
    }

  }