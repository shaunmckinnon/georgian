<?php

  require_once 'class.database.php';
  require_once 'class.validation.php';
  require_once 'class.notification.php';

  /**
  * CRUD methods
  * Don't forget: the parent class (Database) will
  * immediately execute its constructor giving you
  * a database object to work with
  */
  class CRUD extends Database
  {

    public $validator;
    public $notification;

    // instantiate the parent with a parameter
    public function __construct( $config ) {
      parent::__construct( $config );
      $this->validator = new Validation;
      $this->notification = new Notification;
    }
    
    // creates a new record in the database
    public function add_record ( $table, $post ) {
      // build the sql data and assign the returned values to the three variables
      list( $columns, $placeholders, $values ) = $this->get_sql_build_data( $post );

      // prepare the SQL
      $column_str = implode( ', ', $columns );
      $placeholder_str = implode( ', ' , $placeholders );
      $sql = "INSERT INTO {$table} ({$column_str}) VALUES ({$placeholder_str})";
      $this->prepare( $sql );

      // bind the data
      for ( $i = 0; $i < count( $columns ); $i++ ) {
        $this->bind( $placeholders[$i], $values[$i] );
      }

      // execute
      $this->execute();
    }

    // updates an existing record in the database
    public function update_record ( $table, $id, $post ) {
      // build the sql data and assign the returned values to the three variables
      list( $columns, $placeholders, $values ) = $this->get_sql_build_data( $post );

      // build the SET statements
      $set = [];
      for ( $i = 0; $i < count( $columns ); $i++ ) {
        // don't add the ID
        if ( $columns[$i] == 'id' ) continue;

        // add string to $set
        array_push( $set, "{$columns[$i]} = {$placeholders[$i]}" );
      }

      // join the set statements
      $set = implode( ', ', $set );

      // prepare the SQL
      $this->prepare( "UPDATE {$table} SET {$set} WHERE id = :id" );

      // bind the data
      for ( $i = 0; $i < count( $columns ); $i++ ) {
        $this->bind( $placeholders[$i], $values[$i] );
      }

      // execute
      $this->execute();
    }

    // deletes an existing record in the database
    public function delete_record ( $table, $id ) {
      // prepare the SQL statement
      $this->prepare( "DELETE FROM {$table} WHERE id = :id" );
      $this->bind( ':id', $id );
      $this->execute();
    }

    // create the sql build data
    private function get_sql_build_data ( $post ) {
      $columns = [];
      $placeholders = [];
      $values = [];

      foreach ( $post as $key => $value ) {
        // add the key to the column name
        array_push( $columns, $key );

        // add the colon (:) to the key and add to the placeholders
        array_push( $placeholders, ":{$key}" );

        // add all the values to values array
        array_push( $values, $value );
      }

      // return the arrays
      return [$columns, $placeholders, $values];
    }

    public function get_recordset ( $table, $column = 'id', $value = null, $single = false ) {
      // check if value is present and build the WHERE clause for it
      $where = !is_null( $value ) ? ' WHERE ' . $column . ' = :value' : "";

      // build the SQL sentence
      $sql = 'SELECT * FROM ' . $table . $where;
      // prepare it
      $this->prepare( $sql );

      // bind it if id isn't null
      if ( !is_null( $value ) ) $this->bind( ':value', $value, PDO::PARAM_INT, 11 );

      // execute
      $this->execute();

      // get our results
      $result = $single ? $this->singleRecord() : $this->allRecords();

      // close the cursor
      $this->close_cursor();

      // return the resultset
      return $result;
    }

    /* Auto Functions including Validating and Notifying */
    public function vsn_add_record ( $post, $rules, $table, $resource = false ) {
      // if the validator can't validate
      if ( !$this->validator->validate_and_sanitize( $rules, $post ) ) {
        // set the error notifications
        $this->notification->set_validation_fails( $this->get_invalid() );

        // return false
        return false;
      }

      // sanitize
      $post = array_merge( $post, $this->validator->get_sanitized() );

      // update record
      $this->add_record( $table, $post );
      if ( $this->get_error_message() ) return false;

      // return true
      return true;
    }

    public function vsn_update_record ( $id, $post, $rules, $table ) {
      // if the validator can't validate
      if ( !$this->validator->validate_and_sanitize( $rules, $post) ) {
        // set the error notifications
        $this->notification->set_validation_fails( $this->get_invalid() );

        // return false
        return false;
      }

      // sanitize
      $post = array_merge( $post, $this->validator->get_sanitized() );

      // update record
      $this->update_record( $table, $id, $post );
      if ( $this->get_error_message() ) return false;

      // return true
      return true;
    }

    public function vsn_delete_record ( $id, $table ) {
      if ( !is_numeric( $id ) || !filter_var( (int)$id, FILTER_VALIDATE_INT ) ) {
        $this->notification->set_fail( 'You have accessed an invalid page and have been redirected.' );
        return false;
      }


      // update record
      $this->delete_record( $table, $id );
      if ( $this->get_error_message() ) return false;

      // return true
      return true;
    }
    
  }