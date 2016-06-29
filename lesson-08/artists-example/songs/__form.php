<?php
  
  // initiate Database with the $config that exists on index page
  $crud = new CRUD( $config );

  // get all the artists
  $artists = $crud->get_recordset( 'artists' );

  // if an ID is present, query the database
  if ( !empty( $_GET['id'] ) ) {
    // get the song
    $song = $crud->get_recordset( 'songs', 'id', $_GET['id'], true );

    // set the song length
    list( $song['hours'], $song['minutes'], $song['seconds'] ) = explode( ':', $song['length'] );

    // set the action
    $action = $baseurl . '/songs/update.php';
  } else {
    // set the action
    $action = $baseurl . '/songs/add.php';
  }

?>

<form action="<?= $action ?>" method="post">
  <fieldset>
    <legend>Song Information</legend>
    <div class='form-group'>
      <label for='artist'>
        Artist
      </label>
      <select class='form-control' id='artist' name='artist_id' type='text' required>
        <option value="">...select an artist...</option>
        <?php foreach ( $artists as $artist ): ?>
          <option value="<?= htmlspecialchars( $artist['id'] ) ?>" <?= (isset( $song ) && $artist['id'] == $song['artist_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars( $artist['name'] ) ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class='form-group'>
      <label for='title'>
        Song Title
      </label>
      <input class='form-control' type="text" name='title' placeholder="We're Going to Be Friends" required value="<?= isset( $song ) ? $song['title'] : "" ?>">
    </div>
    <div class='form-group'>
      <div class='form-inline'>
        <div class='input-group'>
          <label class='input-group-addon' for="length[hours]">hours</label>
          <input class='form-control' max='59' min='0' name='length[hours]' type="number" value="<?= isset( $song ) ? $song['hours'] : "0" ?>">
        </div>
        <div class='input-group'>
          <label class='input-group-addon' for="length[minutes]">minutes</label>
          <input class='form-control' max='59' min='0' name='length[minutes]' type="number" value="<?= isset( $song ) ? $song['minutes'] : "0" ?>">
        </div>
        <div class='input-group'>
          <label class='input-group-addon' for="length[seconds]">seconds</label>
          <input class='form-control' max='59' min='0' name='length[seconds]' type="number" value="<?= isset( $song ) ? $song['seconds'] : "0" ?>">
        </div>
      </div>
    </div>
    
    <div class='form-group'>
      <?php if ( isset( $_GET['id'] ) ): ?>
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <button class='btn btn-default'><i class='fa fa-plus'>&nbsp;</i>Add Song</button>
      <?php else: ?>
        <button class='btn btn-default'><i class='fa fa-pencil'>&nbsp;</i>Update Song</button>
      <?php endif ?>
    </div>
  </fieldset>
</form>