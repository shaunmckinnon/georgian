<?php

  // helper function to flatten multidimensional arrays
  function flatten ( $array ) {
    // check to see if the array is an array
    if ( is_array( $array ) ) {
      // set a variable to hold the new flattened array
      $flattened = [];

      // recursively walk through the array and apply the anonymous function's code
      array_walk_recursive( $array, function ( $value ) use ( &$flattened ) {
        // 'use' allows us to reference a variable outside of the anonymouse function's scope
        // here we set push the value onto the referenced array
        $flattened[] = $value;
      } );

      // return the array
      // array_filter removes empty elements
      // array_values will reorder the numbered keys
      return array_values( array_filter( $flattened ) );
    }
  }

  // check to see if there are any messages and that messages is an array
  if ( !empty( $messages) && is_array( $messages ) ) {
    // if there are success messages
    if ( !empty( $messages['success'] ) ) {
      // if its an array, flatten it, otherwise just assign it
      $success = is_array( $messages['success'] ) ? flatten( $messages['success'] ) : $messages['success'];
    }

    // if there are fail messages
    if ( !empty( $messages['fail'] ) ) {
      // if its an array, flatten it, otherwise just assign it
      $fail = is_array( $messages['fail'] ) ? flatten( $messages['fail'] ) : $messages['fail'];
    }
  }

?>

<?php if ( isset( $success ) ): ?>
  <div class="alert alert-success">
    <?php if ( is_array( $success ) ): // if its an array, iterate and output the value ?>
      <?php foreach ( $success as $message ): ?>
        <p><?= $message ?></p>
      <?php endforeach ?>
    <?php else: // otherwise, just output the value ?>
      <p><?= $success ?></p>
    <?php endif ?>
  </div>
<?php endif ?>

<?php if ( isset( $fail ) ): ?>
  <div class="alert alert-danger">
    <?php if ( is_array( $fail ) ): // if its an array, iterate and output the value ?>
      <?php foreach ( $fail as $message ): ?>
        <p><?= $message ?></p>
      <?php endforeach ?>
    <?php else: // otherwise, just output the value ?>
      <p><?= $fail ?></p>
    <?php endif ?>
  </div>
<?php endif ?>