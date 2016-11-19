<?php

  /* require configuration */
  require_once '../config/config.database.php';
  
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
    public function __construct () {
      // set the configurations
      $this->host = DBHOST;
      $this->dbname = DBNAME;
      $this->user = DBUSER;
      $this->password = DBPASS;

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
    public function closeCursor () {
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

      // bind our parameter
      $this->sth->bindParam( $param, $value, $type );
    }

    // Execute SQL
    public function execute () {
      try {
        $this->sth->execute();
        return true;
      } catch ( PDOException $e ) {
        $this->error = $e;
        return false;
      }
    }

    // Fetch a single record
    public function singleRecord () {
      try {
        $result = $this->sth->fetch();
        $this->closeCursor();
        return $result;
      } catch ( PDOException $e ) {
        $this->error = $e;
      }
    }

    // Fetch all the records
    public function allRecords () {
      try {
        $result = $this->sth->fetchAll();
        $this->closeCursor();
        return $result;
      } catch ( PDOException $e ) {
        $this->error = $e;
      }
    }

    // Common READ operations
    public function all ( $table ) {
      $this->prepare( "SELECT * FROM {$table}" );
      $this->execute();
      $result = $this->allRecords();
      return $result;
    }

    public function byId( $table, $id ) {
      if ( !filter_var( (int)$id, FILTER_VALIDATE_INT ) ) return false;
      $this->prepare( "SELECT * FROM {$table} WHERE id = :id" );
      $this->bind( ':id', $id );
      $this->execute();
      $result = $this->get_error_message() ? false : $this->singleRecord();
      return $result;
    }

    public function byField( $table, $field, $value ) {
      // sanitize the value
      if ( is_numeric( $value ) ) {
        $value = filter_var( (int)$value, FILTER_SANITIZE_NUMBER_INT );
      } else {
        $value = filter_var( $value, FILTER_SANITIZE_STRING );
      }
      $this->prepare( "SELECT * FROM {$table} WHERE {$field} = :{$field}" );
      $this->bind( ":{$field}", $value );
      $this->execute();
      $result = $this->get_error_message() ? false : $this->allRecords();
      return $result;
    }

    public function raw ( $sql ) {
      $this->prepare( $sql );
      $this->execute();
      $result = $this->allRecords();
      return $result;
    }

    // Common CREATE, UPDATE, and DELETE operations
    public function create ( $table, $post ) {
      // get all the column names
      $columns = array_keys( $post );

      // get all the values
      $values = array_values( $post );

      // convert the column names into placeholders using array_map();
      $placeholders = array_map( function ( $column ) {
        return ":{$column}";
      }, $columns );

      // create the SQL statement
      $col_sentc = implode( ", ", $columns );
      $ph_sentc = implode( ", ", $placeholders );
      $this->prepare( "INSERT INTO {$table} ({$col_sentc}) VALUES ({$ph_sentc})" );

      // bind the parameters
      for ( $i = 0; $i < count( $columns ); $i++ ) {
        $this->bind( $placeholders[$i], $values[$i] );
      }

      // execute and return boolean
      return $this->execute();
    }

    public function update ( $table, $post ) {
      // return false if the ID is missing or not a numeric value
      if ( empty( $post['id'] ) || !is_numeric( $post['id'] ) ) return false;

      // set the ID and unset it from post
      $id = $post['id'];
      unset( $_POST['id'] );

      // get all the column names
      $columns = array_keys( $post );

      // get all the values
      $values = array_values( $post );

      // create placeholders using array_map();
      $placeholders = array_map( function ( $column ) {
        return ":{$column}";
      }, $columns );

      // create set sentences using array_map();
      $sets = array_map( function ( $column ) {
        return "$column = :{$column}";
      }, $columns );

      // create the SQL statement
      $set_sentc = implode( ", ", $sets );
      $this->prepare( "UPDATE {$table} SET {$set_sentc} WHERE id = :id" );

      // bind the parameters
      for ( $i = 0; $i < count( $columns ); $i++ ) {
        $this->bind( $placeholders[$i], $values[$i] );
      }

      // execute and return boolean
      return $this->execute();
    }

    public function delete ( $table, $id ) {
      // return false if the ID is missing or not a numeric value
      if ( empty( $id ) || !is_numeric( $id ) ) return false;

      // create the SQL statemetn
      $this->prepare( "DELETE FROM {$table} WHERE id = :id" );

      // bind the param
      $this->bind( ':id', $id );

      // execute and return a boolean
      return $this->execute();
    }

  } // close class























