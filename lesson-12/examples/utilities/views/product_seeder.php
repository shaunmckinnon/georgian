<div class="container">
  <h1 class="page-header">Product Seeder</h1>
  
  <form action="controller.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend>CSV File</legend>

      <div class="form-group">
        <label for="csv">Upload CSV</label>
        <input type="file" name="csv">
      </div>

      <div class="form-group">
        <input type="hidden" name="action" value="product_seeder_process">
        <button type="submit" class="btn btn-danger"><i class="fa fa-file">&nbsp;</i>Upload CSV</button>
      </div>
    </fieldset>
  </form>
</div>