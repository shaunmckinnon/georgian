<?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/vendors/php-activerecord/ActiveRecord.php';

  if ( preg_match('/Heroku|georgian\.shaunmckinnon\.ca/i', $_SERVER['HTTP_HOST']) ) {
    // remote server
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $config['host'] = $url["host"];
    $config['dbname'] = substr($url["path"], 1);
    $config['user'] = $url["user"];
    $config['password'] = $url["pass"];
  } else { // localhost
    $config['host'] = 'localhost';
    $config['dbname'] = 'comp-1006-lesson-examples';
    $config['user'] = 'root';
    $config['password'] = 'root';
  }

  $config['model_directory'] = $_SERVER['DOCUMENT_ROOT'] . '/lesson-10/examples/models';

  ActiveRecord\Config::initialize( function( $cfg ) use ( $config ) {
    $cfg->set_model_directory( $config['model_directory'] );
    $cfg->set_connections( 
      array(
        'development' => "mysql://{$config['user']}:{$config['password']}@{$config['host']}/{$config['dbname']}"
      )
    );
  });

  // our action handler moved into our config file as a function
  function action_handler ( $actions, $error_redirect ) {
    if ( isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $actions ) ) {
      return call_user_func( $_REQUEST['action'], $_REQUEST );
    } else {
      header( 'Location: ' . $error_redirect );
      exit;
    }
  }

  // pass the params as an array so they can be dynamically built
  function get_included_file_contents ( $path, $params = [] ) {
    // check if the file doesn't exist
    if ( !file_exists( $path ) ) return false;

    // PHP allows for dynamic variables to be created where the label is decided at runtime
    if ( !empty( $params ) ) {
      foreach ( $params as $label => $value ) { $$label = $value; }
    }

    // start the buffer
    ob_start();
    include $path;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }









