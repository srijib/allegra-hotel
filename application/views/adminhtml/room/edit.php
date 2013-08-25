<div class="row">
    <div class="span6 offset3">
        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="inputRoom">Room#</label>
                <div class="controls">
                    <input type="text" name="inputRoom" value="<?php echo $room->get('room_number')?>" class="required" disabled>
                </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="inputHotel">Hotel</label>
            <div class="controls">
                <select id="hotel_id" name="hotel_id" disabled>
                    <?php 
                        $i = 1;
                        foreach ($hotels as $hotel):
                    ?>
                    <option 
                        value="<?php echo $hotel->get('id')?>" 
                        <?php if($hotel->get('id') === $current_hotel->get('id')) {echo 'selected';} ?>
                        >
                        <?php echo $hotel->get('hotel_name'); ?>
                    </option>
                    <?php endforeach ?>
                </select>
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
            <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" id="editInfo">Edit</button>
                <button class="btn btn-success" id="saveInfo">Save</button>
                <a href="<?php echo base_url('admin/room/list'); ?>" class="btn">Cancel</a>
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
                            url: '<?php echo site_url('/ajax/saveRoom/' . $room->get('id')); ?>',
                            data: postData,
                            method: 'POST'
                        }).done(function() {
                            $("#formEdit input, #formEdit select")
                                .attr('disabled','disabled')
                                .removeClass('valid');
                            window.location = "<?php echo base_url('admin/room/list'); ?>";
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
