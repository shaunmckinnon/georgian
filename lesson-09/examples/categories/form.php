<form action="process.php" method="post">

  <fieldset>
    <legend>Category Information</legend>

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" maxlength="100" value="<?= isset( $category->name ) ? $category->name : '' ?>">
    </div>

    <div class="form-grou">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'new' ?>">
      <?php if ( isset( $action ) && $action == 'edit' ): ?>
        <input type="hidden" name="id" value="<?= $category->id ?>">
        <button class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Category</button>
      <?php else: ?>
        <button class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Add Category</button>
      <?php endif ?>
    </div>
  </fieldset>
  
</form>