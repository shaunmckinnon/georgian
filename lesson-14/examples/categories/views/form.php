<form action="controller.php" method="post">
  
  <fieldset>
    <legend>Category Information</legend>

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" value="<?= isset( $category ) ? $category->name : '' ?>" required maxlength="100">
    </div>

    <div class="form-group">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'add' ?>">

      <?php if ( isset( $action ) && $action == 'update' ): ?>
        <input type="hidden" name="id" value="<?= $category->id ?>">
        <button type="submit" class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Category</button>
      <?php else: ?>
        <button type="submit" class="btn btn-danger"><i class="fa fa-plus">&nbsp;</i>Add Category</button>
      <?php endif ?>
    </div>
  </fieldset>

</form>