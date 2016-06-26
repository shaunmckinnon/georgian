<?php

  require_once 'class.admin.php';

  if ( Admin::verified() ) {

    if ( Admin::logout() ) {
      header( 'Location: login.php' );
    }

  }