<div class="container">
  <h1 class="page-header">Categories</h1>
  <?php if ( is_authenticated() ): ?>
    <p><a href="?action=create"><i class="fa fa-plus">&nbsp;</i>Create Category</a></p>
  <?php endif ?>

  <?php if ( isset( $categories ) ): ?>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Show</th>
          <?php if ( is_authenticated() ): ?>
            <th>Edit</th>
            <th>Delete</th>
          <?php endif ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $categories as $category ): ?>
          <tr>
            <td><?= $category->name ?></td>
            <td><a href="?action=show&id=<?= $category->id ?>"><i class="fa fa-eye"></i></a></td>
            <?php if ( is_authenticated() ): ?>
              <td><a href="?action=edit&id=<?= $category->id ?>"><i class="fa fa-pencil"></i></a></td>
              <td>
                <form action="controller.php" method="post">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $category->id ?>">
                  <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure you want to permanently delete <?= $category->name ?>')">
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