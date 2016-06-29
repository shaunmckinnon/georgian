<?php

  // set the base
  $basename = $_SERVER['DOCUMENT_ROOT'] . '/lesson-08/examples';

  // get the route
  $path = isset( $_SERVER['PATH_INFO'] ) ? htmlspecialchars( $_SERVER['PATH_INFO'] ) : false;

  if ( $path !== false ) {
    $path_array = array_values( array_filter( explode( '/', $path ) ) );
    $resource = empty( $path_array ) ? '/' : $path_array[0];
    
    /* Your routes go here */
    // build the routes

    // matches root of application
    if ( preg_match( "/^\/|^$/", $path ) ) $url = false;

    // matches all of resource
    if ( preg_match( "/^\/$resource/", $path ) ) $url = "{$basename}/{$resource}/index.php";

    // matches show one of resource
    if ( preg_match( "/^\/$resource\/(?<id>\d+)/", $path, $match ) ) {
      $url = "{$basename}/{$resource}/show.php";
      $_GET['id'] = $match['id'];
    }

    // matches a new resource
    if ( preg_match( "/^\/$resource\/new/", $path) ) $url = "{$basename}/{$resource}/new.php";

    // matches edit one of resource
    if ( preg_match( "/^\/$resource\/edit\/(?<id>\d+)/", $path, $match ) ) {
      $url = "{$basename}/{$resource}/edit.php";
      $_GET['id'] = $match['id'];
    }

    /* Routes ended */
  }