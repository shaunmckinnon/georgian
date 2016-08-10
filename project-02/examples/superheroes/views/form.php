<form action="controller.php" method="post">
  
  <fieldset>
    <legend>Superhero Information</legend>

    <div class="form-group">
      <label for="alias">Alias</label>
      <input class="form-control" type="text" name="alias" value="<?= isset( $superhero ) ? $superhero->alias : '' ?>" required maxlength="100">
    </div>

    <div class="form-group">
      <label for="first_name">First Name</label>
      <input class="form-control" type="text" name="first_name" value="<?= isset( $superhero ) ? $superhero->first_name : '' ?>" required maxlength="50">
    </div>

    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input class="form-control" type="text" name="last_name" value="<?= isset( $superhero ) ? $superhero->last_name : '' ?>" required maxlength="50">
    </div>

    <div class="form-group">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'add' ?>">

      <?php if ( isset( $action ) && $action == 'update' ): ?>
        <input type="hidden" name="id" value="<?= $superhero->id ?>">
        <button type="submit" class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Superhero</button>
      <?php else: ?>
        <button type="submit" class="btn btn-danger"><i class="fa fa-plus">&nbsp;</i>Add Superhero</button>
      <?php endif ?>
    </div>
  </fieldset>

</form>