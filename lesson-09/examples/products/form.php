<form action="process.php" method="post">

  <fieldset>
    <legend>Product Information</legend>

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" maxlength="100" required value="<?= isset( $product->name ) ? $product->name : '' ?>">
    </div>

    <div class="form-group">
      <label for="price">Price</label>
      <input class="form-control" type="number" min="0.01" step="any" name="price" maxlength="100" required value="<?= isset( $product->price ) ? $product->price : '' ?>">
    </div>

    <div class="form-group">
      <label for="category_id">Category</label>
      <select class="form-control" name="category_id" required>
        <option value="">...select a category...</option>
        <?php foreach ( $categories as $category ): ?>
          <option value="<?= $category->id ?>" <?= ( isset( $current_category_id ) && $current_category_id == $category->id ? 'selected' : ''  ) ?>><?= $category->name ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="form-grou">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'new' ?>">
      <?php if ( isset( $action ) && $action == 'edit' ): ?>
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <button class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Product</button>
      <?php else: ?>
        <button class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Add Product</button>
      <?php endif ?>
    </div>
  </fieldset>
  
</form>