<div class="container">
  <h1 class="page-header">Login</h1>
  <form action="controller.php" method="post">
    <fieldset>
      <legend>Login Details</legend>
      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" maxlength="100" name="email" required="true" type="email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" maxlength="100" minlength="8" name="password" required="true" type="password">
      </div>
      <div class="form-group">
        <input name="action" type="hidden" value="authenticate"></input>
        <button class="btn btn-danger" type="submit">
          <i class="fa fa-sign-in"></i>
          Login
        </button>
      </div>
    </fieldset>
  </form>
</div>
