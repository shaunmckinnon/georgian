<form action="process.php" method="post">
  <div class="form-group">
    <label for="alias">Alias</label>
    <input class="form-control" type="text" name="alias" maxlength="50" value="<?= isset( $superhero['alias'] ) ? $superhero['alias'] : '' ?>">
  </div>

  <div class="form-group">
    <label for="first_name">First Name</label>
    <input class="form-control" type="text" name="first_name" maxlength="50" value="<?= isset( $superhero['first_name'] ) ? $superhero['first_name'] : '' ?>">
  </div>

  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input class="form-control" type="text" name="last_name" maxlength="50" value="<?= isset( $superhero['last_name'] ) ? $superhero['last_name'] : '' ?>">
  </div>

  <div class="form-group">
    <input type="hidden" name="action" value="<?= isset( $action ) ? $action : '' ?>">

    <?php if ( $action == 'edit' ): ?>
      <input type="hidden" name="id" value="<?= $superhero['id'] ?>">
      <button type="submit" class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Superhero</button>
    <?php else: ?>
      <button type="submit" class="btn btn-danger"><i class="fa fa-plus">&nbsp;</i>Add Superhero</button>
    <?php endif ?>
  </div>
</form>