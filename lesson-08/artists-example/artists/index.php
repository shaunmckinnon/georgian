<?php

  // initiate Database with the $config that exists on index page
  $crud = new CRUD( $config );

  // get the artists
  $artists = $crud->get_recordset( 'artists' );

?>

<table class='table'>
  <thead>
    <tr>
      <th>Artist</th>
      <th>Bio</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ( $artists as $artist ): ?>
      <tr>
        <td><a href="<?= $baseurl ?>/index.php/artists/<?= $artist['id'] ?>"><?= strip_tags($artist['name']) ?></a></td>
        <td><a href="<?= htmlspecialchars( $artist['bio_link'] ) ?>"><?= strip_tags($artist['bio_link']) ?></a></td>
        <td><a href="<?= $baseurl ?>/index.php/artists/edit/<?= $artist['id'] ?>"><i class="fa fa-pencil"></i></a></td>
        <td>
          <form action="<?= $baseurl ?>/artists/delete.php" method="post">
            <input type="hidden" name="id" value="<?= $artist['id'] ?>">
            <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure want to permanantly delete <?= strip_tags($artist['name']) ?>')">
              <i class="fa fa-remove"></i>
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>