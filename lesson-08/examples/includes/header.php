<?php

  session_start();
  $success = isset( $_SESSION['success'] ) ? $_SESSION['success'] : false;
  $fail = isset( $_SESSION['fail'] ) ? $_SESSION['fail'] : false;
  session_unset();

?>
<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title><?= isset( $page_title ) ? $page_title : '' ?></title>
  </head>

  <body>
    <?php
      if ( $success ) {
        echo "<div class='alert alert-success'>";
        if ( is_array( $success ) ) {
          foreach ( $success as $msg ) {
            echo "<p>{$msg}</p>";
          }
        } else {
          echo "<p>{$success}</p>";
        }
        echo "</div>";
      }
    ?>

    <?php
      if ( $fail ) {
        echo "<div class='alert alert-danger'>";
        if ( is_array( $fail ) ) {
          foreach ( $fail as $msg ) {
            echo "<p>{$msg}</p>";
          }
        } else {
          echo "<p>{$fail}</p>";
        }
        echo "</div>";
      }
    ?>
    <?php require_once 'navigation.php' ?>