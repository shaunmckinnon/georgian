<?php
  
  /*
  * Database connection, disconnection, & error messages
  */
  class Database {
    
    /* Properties */
    // define connection properties
    private $host;
    private $dbname;
    private $user;
    private $password;

    // connection, statement, and error properties
    private $dbh;
    private $sth;
    private $error;

    
    /* Methods */
    /* Database connection and error handling methods */
    // connect to the database
    public function __construct( $config ) {
      // set the configurations
      $this->host = $config['host'];
      $this->dbname = $config['dbname'];
      $this->user = $config['user'];
      $this->password = $config['password'];

      try {
        $this->dbh = new PDO( "mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password );
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return true;
      } catch ( PDOException $e ) {
        $this->error = $e;
        return false;
      }
    }

    // get the prepared statement
    public function get_sth () {
      return $this->sth;
    }

    // get the error
    public function get_error_message () {
      return ( is_null( $this->error ) ) ? false : $this->error->getMessage();
    }

    // close the cursor
    public function close_cursor() {
      $this->sth->closeCursor();
    }

    // close the connection
    public function close () {
      $this->dbh = null;
    }


    /* PDO Methods Simplified */
    // Prepare SQL
    public function prepare ( $sql ) {
      $this->sth = $this->dbh->prepare( $sql );
    }

    // Query
    public function query ( $sql ) {
      return $this->dbh->query( $sql );
    }

    // Bind Parameters
    public function bind ( $param, $value, $type = null ) {
      // if type isn't set
      if ( is_null( $type ) ) {
        // auto select the type
        switch ( true ) {
          case is_null( $value ):
            $type = PDO::PARAM_NULL;
            break;

          case is_int( $value ):
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

      // bind our parameter
      $this->sth->bindParam( $param, $value, $type );
    }

    // Execute SQL
    public function execute () {
      try {
        $this->sth->execute();
      } catch ( PDOException $e ) {
        $this->error = $e;
      }
    }

    // Fetch a single record
    public function singleRecord () {
      try {
        $result = $this->sth->fetch();
        $this->close_cursor();
        return $result;
      } catch ( PDOException $e ) {
        $this->error = $e;
      }
    }

    // Fetch all the records
    public function allRecords () {
      try {
        $result = $this->sth->fetchAll();
        $this->close_cursor();
        return $result;
      } catch ( PDOException $e ) {
        $this->error = $e;
      }
    }

  } // close class