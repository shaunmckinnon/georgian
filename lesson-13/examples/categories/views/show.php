<div class="container">
  <h1 class="page-header"><?= $category->name ?></h1>
  <?php if ( is_authenticated() ): ?>
    <p><a href="../products/?action=create"><i class="fa fa-plus">&nbsp;</i>Create Product</a></p>
  <?php endif ?>

  <?php if ( $category->products ): ?>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>Thumbnail</th>
          <th>Name</th>
          <th>Price</th>
          <?php if ( is_authenticated() ): ?>
            <th>Edit</th>
            <th>Delete</th>
          <?php endif ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $category->products as $product ): ?>
          <tr>
            <td>
              <?php if ( !empty( $product->image ) ): ?>
                <img style="max-width: 100px; max-height: 100px;" class="img-thumbnail" src="../uploads/images/<?= $product->image ?>" alt="Product Image">
              <?php endif ?>
            </td>
            <td><?= $product->name ?></td>
            <td><?= $product->price_formatted ?></td>
            <?php if ( is_authenticated() ): ?>
              <td><a href="../products/index.php?action=edit&id=<?= $product->id ?>"><i class="fa fa-pencil"></i></a></td>
              <td>
                <form action="../products/controller.php">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $product->id ?>">
                  <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure you want to delete <?= $product->name ?>')"><i class="fa fa-remove"></i></button>
                </form>
              </td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>