<?php
  
  require_once 'config.database.php' ;

  class Database {
    
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    private $dbh;
    public $error;

    private $stmt;

    public function __construct () {
      // Set DSN
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

      // Set options
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      // create a new PDO instance
      try {
        $this->dbh = new PDO( $dsn, $this->user, $this->pass, $options );
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function query ( $query ) {
      error_log("QUERY: {$query}");
      
      try {
        $this->stmt = $this->dbh->prepare( $query );
        error_log( $query );
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function bind ( $param, $value, $type = null ) {
      if (is_null($type)) {
        switch (true) {
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
        }
      }
      try {
        $this->stmt->bindValue($param, $value, $type);
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function execute () {
      try{
        return $this->stmt->execute();
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function resultset () {
      try {  
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function single () {
      try {
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function rowCount () {
      try {
        return $this->stmt->rowCount();
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function lastInsertId () {
      try {  
        return $this->dbh->lastInsertId();
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function beginTransaction () {
      try {  
        return $this->dbh->beginTransaction();
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function endTransaction () {
      try {  
        return $this->dbh->commit();
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function cancelTransaction () {
      try {  
        return $this->dbh->rollBack();
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function debugDumpParams () {
      try {  
        return $this->stmt->debugDumpParams();
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

    public function closeDB () {
      try {  
        $this->dbh = null;
      } catch ( PDOException $e ) {
        $this->error = $e->getMessage();
        error_log($db->error);
      }
    }

  }