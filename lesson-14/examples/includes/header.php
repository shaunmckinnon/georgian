<?php

  if ( session_status() == PHP_SESSION_NONE ) session_start();

  $messages = [
    'success' => isset( $_SESSION['success'] ) ? $_SESSION['success'] : null,
    'fail' => isset( $_SESSION['fail'] ) ? $_SESSION['fail'] : null
  ];

  unset( $_SESSION['success'] );
  unset( $_SESSION['fail'] );

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title><?= isset( $page_title ) ? $page_title : 'COMP-1006' ?></title>
  </head>

  <body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-14/examples/includes/notify.php' ?>
    <ul class="nav nav-pills">
      <li><a href="/lesson-14/examples/categories/?action=index">Categories</a></li>
      <?php if ( is_authenticated() ): ?>
        <li><a href="/lesson-14/examples/categories/?action=create">New Category</a></li>
        <li><a href="/lesson-14/examples/products/?action=create">New Product</a></li>
        <li><a href="/lesson-14/examples/utilities/?action=product_seeder">Product Seeder</a></li>
        <li><a href="/lesson-14/examples/users/?action=index">Users</a></li>
        <li><a href="/lesson-14/examples/authentication/?action=logout"><i class="fa fa-sign-out">&nbsp;</i>Sign Out</a></li>
      <?php else: ?>
        <li><a href="/lesson-14/examples/authentication/?action=login"><i class="fa fa-sign-in">&nbsp;</i>Sign In</a></li>
      <?php endif ?>
      <li><a href="/lesson-14/examples/users/?action=create">New User</a></li>
    </ul>