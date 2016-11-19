<div class="container">
  <h1 class="page-header">Superheroes</h1>
  <?php if ( is_authenticated() ): ?>
    <p><a href="?action=create"><i class="fa fa-plus">&nbsp;</i>Create Superhero</a></p>
  <?php endif ?>

  <?php if ( isset( $superheroes ) ): ?>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>Alias</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Show</th>
          <?php if ( is_authenticated() ): ?>
            <th>Edit</th>
            <th>Delete</th>
          <?php endif ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $superheroes as $superhero ): ?>
          <tr>
            <td><?= $superhero->alias ?></td>
            <td><?= $superhero->first_name ?></td>
            <td><?= $superhero->last_name ?></td>
            <td><a href="?action=show&id=<?= $superhero->id ?>"><i class="fa fa-eye"></i></a></td>
            <?php if ( is_authenticated() ): ?>
              <td><a href="?action=edit&id=<?= $superhero->id ?>"><i class="fa fa-pencil"></i></a></td>
              <td>
                <form action="controller.php" method="post">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $superhero->id ?>">
                  <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure you want to permanently delete <?= $superhero->alias ?>')">
                    <i class="fa fa-remove"></i>
                  </button>
                </form>
              </td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>