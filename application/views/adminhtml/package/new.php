<div class="row">
    <div class="span6 offset3">
        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="<?php echo base_url('admin/package/new'); ?>" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="inputTitle">Title</label>
            <div class="controls">
              <input type="text" name="inputTitle" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDescription">Description</label>
            <div class="controls">
              <input type="text" name="inputDescription" class="required">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputRoomType">RoomType</label>
            <div class="controls">
                <select id="roomtype_id" name="roomtype_id">
                    <?php 
                        $i = 1;
                        foreach ($roomtypes as $roomtype):
                    ?>
                    <option value="<?php echo $roomtype->get('id')?>" >
                        <?php echo $roomtype->get('roomtype_type') . ' ' . $roomtype->get('roomtype_class'); ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputOffering">Offering</label>
            <div class="controls">
                <select id="offering_id" name="offering_id">
                    <?php 
                        $i = 1;
                        foreach ($offerings as $offering): 
                    ?>
                    <option value="<?php echo $offering->get('id')?>"><?php echo $offering->get('offering_title')?></option>
                    <?php endforeach ?>
                </select>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
                <input type="submit" class="submit btn btn-primary" value="Save">
                <a href="<?php echo base_url('admin/package/list'); ?>" class="btn">Cancel</a>
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
