<div class="row">
    <div class="span6 offset3">
        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="<?php echo base_url('admin/customer/new'); ?>" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="inputUsername">Username</label>
            <div class="controls">
              <input type="text" name="inputUsername" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPassword">Password</label>
            <div class="controls">
              <input type="password" name="inputPassword" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
              <input type="email" name="inputEmail" class="required email">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputTitle">Title</label>
            <div class="controls">
              <select name="inputTitle" id="inputTitle" class="required">
                <option selected></option>
                <option>Mr.</option>
                <option>Mrs.</option>
                <option>Ms.</option>
                <option>Miss</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputFname">First Name</label>
            <div class="controls">
              <input type="text" name="inputFname" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputLname">Last Name</label>
            <div class="controls">
              <input type="text" name="inputLname" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPhone">Phone</label>
            <div class="controls">
              <input type="text" name="inputPhone" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputCountry">Country</label>
            <div class="controls">
              <input type="text" name="inputCountry" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputState">State</label>
            <div class="controls">
              <input type="text" name="inputState" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputCity">City</label>
            <div class="controls">
              <input type="text" name="inputCity" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputAddress">Address</label>
            <div class="controls">
              <input type="text" name="inputAddress" class="required">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
                <input type="submit" class="submit btn btn-primary" value="Create">
                <a href="<?php echo base_url('admin/customer/list'); ?>" class="btn">Cancel</a>
            </div>
          </div>
        </fieldset>
        </form>
        <script>
            jQuery(document).ready(function($){
                $("#formEdit").validate();
            });
        </script>
    </div>
</div>
