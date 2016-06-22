<?php

  /* Dynamic Menu Generation */

  // get all the files in the directory
  $files = glob( './*.php' );

  // our filter list for excluding files
  $filters = [
    'add_',
    'edit_',
    'update_',
    'delete_',
    'confirmed.php',
    'artist_songs.php',
    'xss-example.php',
    'navigation.php'
  ];

  // use array_filter to filter out our excluded items
  $pages = array_filter( $files, function ( $file ) use ( $filters ) {
    foreach ( $filters as $filter ) {
      // if the file is in the exclusion filter list, return false and move on to the next file
      if ( preg_match( '/' . $filter . '/', basename( $file ) ) ) return false;
    }

    // if the file isn't in the exclusion filter list
    return $file;
  });

  // build a list of sources and labels
  $nav_list = [];
  foreach ( $pages as $page ) {
    // get the source
    $source = basename( $page );

    // create the label
    $label = ucwords( str_replace( ['_', '.php'], [' ', ''], $source ) );

    // add to the nav_list
    $nav_list[$label] = $source;
  }

?>

<ul class="nav nav-pills">
  <?php foreach ( $nav_list as $label => $source ): ?>
    <li>
      <a href="<?= $source ?>"><?= $label ?></a>
    </li>
  <?php endforeach ?>
</ul>
















