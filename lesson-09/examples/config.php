<?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/vendors/php-activerecord/ActiveRecord.php';

  ActiveRecord\Config::initialize( function( $cfg ) {
    $cfg->set_model_directory( $_SERVER['DOCUMENT_ROOT'] . '/lesson-09/examples/models' );
    $cfg->set_connections( 
      array(
        'development' => 'mysql://root:root@localhost/comp-1006-lesson-examples'
      )
    );
  });