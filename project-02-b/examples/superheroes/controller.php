<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/project-02-b/examples/config.php';

  /* VIEWS */
  // index
  function index () {
    $superheroes = Superhero::all( array( 'order' => 'alias' ) );
    return get_included_file_contents( 'views/index.php', ['superheroes' => $superheroes] );
  }


  // create
  function create () {
    return get_included_file_contents( 'views/create.php' );
  }


  // edit
  function edit ( $get ) {
   if ( !isset( $get['id'] ) || !Superhero::exists( $get['id'] ) ) {
      $_SESSION['fail'] = "You must select a superhero.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    $superhero = Superhero::find( 'first', $get['id'] );
    return get_included_file_contents( 'views/edit.php', ['superhero' => $superhero] );
  }


  /* PROCESSES */
  // add
  function add ( $post ) {
    // create a new record
    $superhero = new Superhero;

    // assign the values
    $superhero->alias = $post['alias'];
    $superhero->first_name = $post['first_name'];
    $superhero->last_name = $post['last_name'];

    // when we save, we apply our assigned properties and write them to the database
    $superhero->save();

    // redirect if there is an error
    if ( $superhero->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $superhero->errors->full_messages();
      $_SESSION['fail'][] = 'The superhero could not be created.';

      // redirect
      header( 'Location: index.php?action=create' );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'Superhero was created successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  // update
  function update ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !Superhero::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a superhero.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // get existing record
    $superhero = Superhero::find( $post['id'] );

    // assign the values
    $superhero->alias = $post['alias'];
    $superhero->first_name = $post['first_name'];
    $superhero->last_name = $post['last_name'];

    // when we save, we apply our assigned properties and write them to the database
    $superhero->save();

    // redirect if there is an error
    if ( $superhero->is_invalid() ) {
      // set the fail messages
      $_SESSION['fail'][] = $superhero->errors->full_messages();
      $_SESSION['fail'][] = 'The superhero could not be updated.';

      // redirect
      header( 'Location: index.php?action=edit&id=' . $superhero->id );
      exit;
    }

    // set the success message
    $_SESSION['success'] = 'Superhero was updated successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  // delete
  function delete ( $post ) {
    // redirect user if here accidentally
    if ( !isset( $post['id'] ) || !Superhero::exists( $post['id'] ) ) {
      $_SESSION['fail'] = "You must select a superhero.";
      header( 'Location: index.php?action=index' );
      exit;
    }

    // delete the record
    $superhero = Superhero::find( $post['id'] );
    $superhero->delete();

    $_SESSION['success'] = 'The superhero was deleted successfully.';
    header( 'Location: index.php?action=index' );
    exit;
  }


  /* Authentication Block */
  request_is_authenticated( $_REQUEST, ['index'] );

  // action handler for REQUEST
  $yield = action_handler( ['add', 'update', 'delete', 'index', 'create', 'edit'], $_REQUEST );