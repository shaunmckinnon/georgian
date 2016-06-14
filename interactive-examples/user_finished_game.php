<?php

  require 'class.interactive_example_users.php';

  $ieu = new InteractiveExampleUsers();
  $game_code_id = $ieu->getGameCodeId( $_POST['user_id'] );

  if ( $ieu->updateTotalTime( $_POST['user_id'], $_POST['total_time'] ) ) {
    echo json_encode( $game_code_id );
  }