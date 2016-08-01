<form action="controller.php" method="post" enctype="multipart/form-data">
  
  <fieldset>
    <legend>Product Information</legend>

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" maxlength="100" required value="<?= isset( $product ) ? $product->name : '' ?>">
    </div>

    <div class="form-group">
      <label for="price">Price</label>
      <input class="form-control" type="text" name="price" min="0.01" step="any" required value="<?= isset( $product ) ? $product->price : '' ?>">
    </div>

    <div class="form-group">
      <label for="category_id">Category</label>
      <select class="form-control" name="category_id" required>
        <option value="">...select a category...</option>
        <?php foreach ( $categories as $category ): ?>
          <option value="<?= $category->id ?>" <?= isset( $product ) && $product->category->id == $category->id ? 'selected' : '' ?>><?= $category->name ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="form-group">
      <input type="hidden" name="MAX_FILE_SIZE" value="30000">
      <label for="image">Upload Image</label>
      <input type="file" name="image">
    </div>

    <div class="form-group">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'add' ?>">

      <?php if ( isset( $action ) && $action == 'update' ): ?>
        <input type="hidden" name="current_image" value="<?= isset( $product->image ) ? $product->image : '' ?>">
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <button type="submit" class="btn btn-danger"><i class="fa fa-pencil">&nbsp;</i>Update Product</button>
      <?php else: ?>
        <button type="submit" class="btn btn-danger"><i class="fa fa-plus">&nbsp;</i>Add Product</button>
      <?php endif ?>
    </div>
  </fieldset>

</form>