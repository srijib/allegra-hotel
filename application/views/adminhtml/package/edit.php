<div class="row">
    <div class="span6 offset3">
        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="inputTitle">Title</label>
            <div class="controls">
              <input type="text" name="inputTitle" value="<?php echo $package->get('package_title')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDescription">Description</label>
            <div class="controls">
              <input type="text" name="inputDescription" value="<?php echo $package->get('package_description')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputRoomType">RoomType</label>
            <div class="controls">
                <select id="roomtype_id" name="roomtype_id" disabled>
                    <?php 
                        $i = 1;
                        foreach ($roomtypes as $roomtype):
                    ?>
                    <option 
                        value="<?php echo $roomtype->get('id')?>" 
                        <?php if($roomtype->get('id') === $current_roomtype->get('id')) {echo 'selected';} ?>
                        >
                        <?php echo $roomtype->get('roomtype_type') . ' ' . $roomtype->get('roomtype_class'); ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
          </div>
          <?php 
            $package_offerings = $package->load_offering($package->get('id'));
            $i = 1;
            foreach($package_offerings as $offering):
            ?>
              <div class="control-group">
                <label class="control-label" for="inputOffering<?php echo $i?>">Offering <?php echo $i;?></label>
                <div class="controls">
                    <select id="offering<?php echo $i?>" name="offering<?php echo $i?>" disabled>
                        <?php $id = 1; foreach($offerings as $o): ?>
                            <option 
                            <?php if($o->get('id') === $offering->get('id'))
                            echo 'selected'; ?>
                            value="<?php echo $o->get('id')?>"><?php echo $o->get('offering_title')?></option>
                        <?php endforeach ?>
                    </select>
                    <?php $q = $package->get_offering_quantity($package->get('id'), $offering->get('id'));?>
                    <select id="quantity<?php echo $i?>" name="quantity<?php echo $i?>" class="input-mini" disabled>
                        <?php for($j = 1; $j <= 10; $j++): ?>
                                <option 
                                <?php 
                                if($j == $q)
                                echo 'selected';?>
                                value="<?php echo $j?>"><?php echo $j?></option>
                        <?php endfor ?>
                    </select>
                </div>
              </div>
            <?php $i++; endforeach ?>
          <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" id="editInfo">Edit</button>
                <button class="btn btn-success" id="saveInfo">Save</button>
                <a href="<?php echo base_url('admin/package/list'); ?>" class="btn">Cancel</a>
            </div>
            <script>
                (function(){
                    var ed = $("#editInfo"), sa = $("#saveInfo");
                    ed.show();sa.hide();
                    ed.on('click', function(event) {
                        event.preventDefault();
                        $("#formEdit input, #formEdit select").removeAttr('disabled');
                        ed.hide();sa.show();
                        $("#formEdit").validate();
                    });
                    sa.on('click', function(event) {
                        event.preventDefault();
                        var postData = $("#formEdit").serialize();
                        $.ajax({
                            url: '<?php echo site_url('/ajax/savePackage/' . $package->get('id')); ?>',
                            data: postData,
                            method: 'POST'
                        }).done(function() {
                            $("#formEdit input, #formEdit select")
                                .attr('disabled','disabled')
                                .removeClass('valid');
                            //window.location = "<?php echo base_url('admin/package/list'); ?>";
                        });
                    });
                })();
            </script>
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
