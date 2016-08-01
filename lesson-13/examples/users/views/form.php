<form action="controller.php" method="post">
  
  <fieldset>
    <legend>User Information</legend>

    <div class="form-group">
      <label for="first_name">First Name</label>
      <input class="form-control" type="text" name="first_name" value="<?= isset( $user ) ? $user->first_name : '' ?>" required maxlength="100">
    </div>

    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input class="form-control" type="text" name="last_name" value="<?= isset( $user ) ? $user->last_name : '' ?>" required maxlength="100">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="text" name="email" value="<?= isset( $user ) ? $user->email : '' ?>" required maxlength="100">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" <?= isset( $action ) && $action == 'update' ? '' : 'required' ?> maxlength="100" minlength="8">
    </div>

    <div class="form-group">
      <label for="confirm_password">Confirm Password</label>
      <input class="form-control" type="password" name="confirm_password" <?= isset( $action ) && $action == 'update' ? '' : 'required' ?> maxlength="100" minlength="8">
    </div>

    <div class="form-group">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'add' ?>">

      <?php if ( isset( $action ) && $action == 'update' ): ?>
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <button type="submit" class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update User</button>
      <?php else: ?>
        <button type="submit" class="btn btn-danger"><i class="fa fa-plus">&nbsp;</i>Add User</button>
      <?php endif ?>
    </div>
  </fieldset>

</form>