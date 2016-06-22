<?php

  require 'class.interactive_example_users.php';

  $ieu = new InteractiveExampleUsers();

  echo json_encode( $ieu->getFinishedUsers( $_GET['game_code_id'] ) );