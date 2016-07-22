<?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/vendors/php-activerecord/ActiveRecord.php';

  if ( preg_match('/Heroku|georgian\.shaunmckinnon\.ca/i', $_SERVER['HTTP_HOST']) ) {
    // remote server
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $config['host'] = $url["host"];
    $config['dbname'] = substr($url["path"], 1);
    $config['user'] = $url["user"];
    $config['password'] = $url["pass"];
    $config['model_directory'] = $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/models';
  } else { // localhost
    $config['host'] = 'localhost';
    $config['dbname'] = 'comp-1006-lesson-examples';
    $config['user'] = 'root';
    $config['password'] = 'root';
    $config['model_directory'] = $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/models';
  }

  ActiveRecord\Config::initialize( function( $cfg ) use ( $config ) {
    $cfg->set_model_directory( $config['model_directory'] );
    $cfg->set_connections( 
      array(
        'development' => "mysql://{$config['user']}:{$config['password']}@{$config['host']}/{$config['dbname']}"
      )
    );
  });