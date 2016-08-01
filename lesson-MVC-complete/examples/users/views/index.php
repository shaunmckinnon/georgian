<div class="container">
  <h1 class="page-header">Users</h1>
  <p><a href="?action=create"><i class="fa fa-plus">&nbsp;</i>Create User</a></p>

  <?php if ( isset( $users ) ): ?>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Show</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $users as $user ): ?>
          <tr>
            <td><?= $user->first_name ?></td>
            <td><?= $user->last_name ?></td>
            <td><?= $user->email ?></td>
            <td><a href="?action=show&id=<?= $user->id ?>"><i class="fa fa-eye"></i></a></td>
            <td><a href="?action=edit&id=<?= $user->id ?>"><i class="fa fa-pencil"></i></a></td>
            <td>
              <form action="controller.php" method="post">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= $user->id ?>">
                <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure you want to permanently delete <?= $user->first_name . ' ' . $user->last_name ?>')">
                  <i class="fa fa-remove"></i>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>