<div class="row">
    <div class="span6 offset3">
        <form action="" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="inputName">Hotel Name</label>
            <div class="controls">
              <input type="text" name="inputName" value="<?php echo $hotel->get('hotel_name')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputLocation">Location</label>
            <div class="controls">
              <input type="text" name="inputLocation" value="<?php echo $hotel->get('hotel_location')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDescription">Description</label>
            <div class="controls">
                <input type="text" name="inputDescription" value="<?php echo $hotel->get('hotel_description')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" id="editInfo">Edit</button>
                <button class="btn btn-success" id="saveInfo">Save</button>
                <a href="<?php echo base_url('admin/hotel/list'); ?>" class="btn">Cancel</a>
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
                            url: '<?php echo site_url('/ajax/saveHotel/' . $hotel->get('id')); ?>',
                            data: postData,
                            method: 'POST'
                        }).done(function() {
                            $("#formEdit input, #formEdit select")
                                .attr('disabled','disabled')
                                .removeClass('valid');
                            window.location = "<?php echo base_url('admin/hotel/list'); ?>";
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
