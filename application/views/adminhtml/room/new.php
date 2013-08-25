<div class="row">
    <div class="span6 offset3">
        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="<?php echo base_url('admin/room/new'); ?>" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="inputRoom">Room#</label>
                <div class="controls">
                    <input type="text" name="inputRoom" class="required">
                </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="inputHotel">Hotel</label>
            <div class="controls">
                <select id="hotel_id" name="hotel_id">
                    <?php foreach ($hotels as $hotel): ?>
                    <option value="<?php echo $hotel->get('id')?>" >
                        <?php echo $hotel->get('hotel_name'); ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputRoomType">RoomType</label>
                <div class="controls">
                    <select id="roomtype_id" name="roomtype_id">
                        <?php foreach ($roomtypes as $roomtype): ?>
                        <option value="<?php echo $roomtype->get('id')?>" >
                            <?php echo $roomtype->get('roomtype_type') . ' ' . $roomtype->get('roomtype_class'); ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="submit" class="submit btn btn-primary" value="Save">
                    <input type="submit" class="btn" value="Cancel">
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
