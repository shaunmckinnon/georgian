<?php
  
  if ( !empty( $_GET['id'] ) ) {
    // initiate Database with the $config that exists on index page
    $crud = new CRUD( $config );

    $artist = $crud->get_recordset( 'artists', 'id', $_GET['id'], true );
    $songs = $crud->get_recordset( 'songs', 'artist_id', $_GET['id'] );
  }

?>

<div class="container">
  <h2 class="page-header">
    <?= $artist['name'] ?>
    <small>&nbsp;&mdash;&nbsp;<?= $artist['bio_link'] ?></small>    
  </h2>
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Length</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ( $songs as $song ): ?>
        <tr>
          <td><?= strip_tags($song['title']) ?></td>
          <td><?= strip_tags($song['length']) ?></td>
          <td><a href="<?= $baseurl ?>/songs/edit/<?= $song['id'] ?>"><i class="fa fa-pencil"></i></a></td>
          <td>
            <form action="<?= $baseurl ?>/songs/delete.php" method="post">
              <input type="hidden" name="id" value="<?= $song['id'] ?>">
              <input type="hidden" name="artist_id" value="<?= $song['artist_id'] ?>">
              <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure want to permanantly delete <?= strip_tags($song['title']) ?>')">
                <i class="fa fa-remove"></i>
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>