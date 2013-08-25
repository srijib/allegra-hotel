<div class="row">
    <div class="span6 offset3">
        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="<?php echo base_url('admin/hotel/new'); ?>" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="inputName">Hotel Name</label>
            <div class="controls">
              <input type="text" name="inputName" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputLocation">Location</label>
            <div class="controls">
              <input type="text" name="inputLocation" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDescription">Description</label>
            <div class="controls">
                <input type="text" name="inputDescription" class="required">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
                <input type="submit" class="submit btn btn-primary" value="Create">
                <a href="<?php echo base_url('admin/hotel/list'); ?>" class="btn">Cancel</a>
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
