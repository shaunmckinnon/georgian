<?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/vendors/php-activerecord/ActiveRecord.php';

  $config['user'] = 'root';
  $config['password'] = 'root';
  $config['host'] = 'localhost';
  $config['dbname'] = 'comp-1006-lesson-examples';

  ActiveRecord\Config::initialize( function( $cfg ) use ( $config ) {
    $cfg->set_model_directory( $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/models' );
    $cfg->set_connections( 
      array(
        'development' => "mysql://{$config['user']}:{$config['password']}@{$config['host']}/{$config['dbname']}"
      )
    );
  });