<?php

  // if an ID is present, query the database
  if ( !empty( $_GET['id'] ) ) {
    // get the record
    // initiate Database with the $config that exists on index page
    $crud = new CRUD( $config );
    $artist = $crud->get_recordset( 'artists', 'id', $_GET['id'], true );

    // set the action
    $action = $baseurl . '/artists/update.php';
  } else {
    // set the action
    $action = $baseurl . '/artists/add.php';
  }

?>

<form action="<?= $action ?>" method="post">
  <fieldset>
    <legend>Artist Information</legend>
    <div class="form-group">
      <label for="name">Artist Name</label>
      <input class="form-control" type="text" name="name" required value="<?= isset( $artist ) ? htmlspecialchars($artist['name']) : "" ?>">
    </div>

    <div class="form-group">
      <label for="bio_link">Bio Link</label>
      <input class="form-control" type="url" name="bio_link" value="<?= isset( $artist ) ? htmlspecialchars($artist['bio_link']) : "" ?>">
    </div>

    <div>
      <?php if ( isset( $_GET['id'] ) ): ?>
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <button class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Artist</button>
      <?php else: ?>
        <button class="btn btn-danger"><i class="fa fa-plus">&nbsp;</i>Add Artist</button>
      <?php endif ?>
    </div>
  </fieldset>
</form>