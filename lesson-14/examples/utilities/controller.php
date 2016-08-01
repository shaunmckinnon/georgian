<?php

  // start our session to avoid headers issue
  session_start();

  /* ACTION HANDLER */
  // attach PHP ActiveRecord
  require_once $_SERVER['DOCUMENT_ROOT'] . '/lesson-14/examples/config.php';

  /* VIEWS */
  // index
  function product_seeder () {
    return get_included_file_contents( 'views/product_seeder.php' );
  }


  /* PROCESSES */
  function product_seeder_process () {
    // verify there is a file and it's a CSV
    if ( $_FILES['csv']['error'] !== 0 || !preg_match( "/csv/i", $_FILES['csv']['type'] ) ) {
      $_SESSION['fail'][] = "You must upload a valid CSV (comma-separated values) file.";
      header( 'Location: index.php?action=product_seeder' );
      exit;
    }

    // convert the file into an associative array
    $csv = build_csv_array( file( $_FILES['csv']['tmp_name'] ) );

    /* populate the database */
    foreach ( $csv as $row ) {
      // check if the category exists
      if ( Category::exists( ['name' => $row['category']] ) ) {
        $category_id = Category::find( 'first', ['name' => $row['category']] )->id;
      } else {
        $category_id = Category::create( ['name' => $row['category']] )->id;
      }

      // check if the product exists
      if ( !Product::exists( ['name' => $row['product'], 'category_id' => $category_id] ) ) {
        Product::create( ['name' => $row['product'], 'category_id' => $category_id, 'price' => $row['price']] );
      }
    }

    header( 'Location: ../categories/index.php?action=index' );
    exit;
  }

  function build_csv_array ( $csv ) {
    // get the rows
    $rows = array_map( 'str_getcsv', $csv );

    // get the header row
    $header = array_shift( $rows );

    // build the CSV associative array
    $csv = [];
    foreach ( $rows as $row ) {
      $csv[] = array_combine( $header, $row );
    }

    return $csv;
  }


  /* Authentication Block */
  request_is_authenticated( $_REQUEST, [] );

  // action handler for REQUEST
  $yield = action_handler( ['product_seeder', 'product_seeder_process'], $_REQUEST );