<?php
  
  require 'class.game_codes.php';

  class Games {

    private $db;

    public function __construct () {
      $this->db = new Database();
    }

    public function createGame ( $name, $sortables ) {
      // create game code record
        $this->db->query( 'INSERT INTO scm_games (name, sortables) VALUES (:name, :sortables)' );
        $this->db->bind( ':name', $name );
        $this->db->bind( ':sortables', $sortables );
        $this->db->execute();

        if ( $this->db->error ) {
          return false;
        } else {
          $id = $this->db->lastInsertId();
          return $id;
        }
    }

    public function getGame ( $identification ) {
      if ( !is_numeric( $identification ) ) {
        $identification = $this->getGameId( $identification );
      }

      $this->db->query( 'SELECT * FROM scm_games WHERE id = :id' );
      $this->db->bind( ':id', $identification );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        $result = $this->db->single();
        return $result;
      }
    }

    public function getAllGames () {
      $this->db->query( 'SELECT * FROM scm_games' );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        $result = $this->db->resultset();
        return $result;
      }
    }

    public function getSortables ( $identification ) {
      $game = $this->getGame( $identification );

      return array_map( 'addslashes', array_map( 'trim', explode(PHP_EOL, $game['sortables']) ) );
    }

    private function getGameId ( $name ) {
      $this->db->query( 'SELECT id FROM scm_games WHERE name = :name' );
      $this->db->bind( ':name', $name );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        $result = $this->db->single();
        return $result['id'];
      }
    }

    public function destroyGame ( $identification ) {
      if ( !is_numeric( $identification ) ) {
        $identification = $this->getGameId( $identification );
      }

      $this->db->query( 'DELETE FROM scm_games WHERE id = :id' );
      $this->db->bind( ':id', $identification );
      $this->db->execute();

      if ( $this->db->error ) {
        return false;
      } else {
        return true;
      }
    }

  }