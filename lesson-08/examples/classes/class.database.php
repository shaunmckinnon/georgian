<?php

  /* require configuration */
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-08/examples/config/config.database.php';

  /**
  * Database Class
  * Connection, disconnection, PDO methods, and common CRUD methods
  */
  class Database
  {
    
    /* Properties */
    // defined connection properties
    private $host;
    private $dbname;
    private $user;
    private $password;

    // connection, statement, and error properties
    private $dbh;
    private $sth;
    private $error;


    /* Constructor/Initializer */
    // connect to the database
    public function __construct () {
      // set the configuration
      $this->host = DBHOST;
      $this->dbname = DBNAME;
      $this->user = DBUSER;
      $this->password = DBPASS;

      // connect
      try {
        $this->dbh = new PDO( "mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password );
        $this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      } catch ( PDOException $e ) {
        $this->error = $e;
      }
    }


    /* Methods */
    public function get_error () {
      return is_null( $this->error ) ? false : $this->error->getMessage();
    }

    public function dump_query () {
      return $this->sth->debugDumpParams();
    }

    // prepared
    public function prepare ( $sql ) {
      $this->sth = $this->dbh->prepare( $sql );
    }

    // execute
    public function execute () {
      try {
        $this->sth->execute();
        return true;
      } catch ( PDOException $e ) {
        $this->error = $e;
        return false;
      }
    }

    // bind parameters
    public function bind ( $param, $value, $type = null ) {
      // if type isn't set
      if ( is_null( $type ) ) {
        switch ( true ) {
          case is_null( $value ):
            $type = PDO::PARAM_NULL;
            break;

          case is_numeric( $value ):
            $type = PDO::PARAM_INT;
            break;

          case is_bool( $value ):
            $type = PDO::PARAM_BOOL;
            break;

          default:
            $type = PDO::PARAM_STR;
            break;
        }
      }

      $this->sth->bindParam( $param, $value, $type );
    }

    // fetch a single record
    public function singleRecord () {
      return $this->sth->fetch();
    }

    // fetch all the records
    public function allRecords () {
      return $this->sth->fetchAll();
    }

  }













