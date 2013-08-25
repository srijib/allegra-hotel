<div class="row">
    <div class="span6 offset3">
        <?php
            $reservation_offerings = $reservation->load_offering($reservation->get('id'));
            $offering_price = 0;
            foreach($reservation_offerings as $ro)
            {
                $offering_price += $reservation->get_offering_price($reservation->get('id'), $ro->get('id')); 
            }
            $reservation_a = $reservation->load_room($reservation->get('id'));
            $price = $offering_price  + $reservation_a['room_price'];
         ?>

        <form action="" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="inputTitle">#</label>
            <div class="controls">
              <input type="text" name="inputTitle" value="<?php echo $reservation->get('id')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputDescription">CustomerID</label>
            <div class="controls">
              <input type="text" name="inputDescription" value="<?php echo $reservation->get('customer_id')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputRoomType">Room#</label>
            <div class="controls">
                <select id="room_id" name="room_id" disabled>
                    <?php 
                        $i = 1;
                        $r = $reservation->load_room($reservation->get('id'));
                        $r_room = new Room();
                        $r_room->load($r['room_id']);
                        foreach ($rooms as $room):
                    ?>
                    <option 
                        value="<?php echo $room->get('id')?>" 
                        <?php if($room->get('id') === $r_room->get('id')) {echo 'selected';} ?>
                        >
                        <?php echo $room->get('room_number'); ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
          </div>
          <?php 
            $reservation_offerings = $reservation->load_offering($reservation->get('id'));
            $i = 1;
            foreach($reservation_offerings as $offering):
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
                    <?php $q = $reservation->get_offering_quantity($reservation->get('id'), $offering->get('id'));?>
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
                <label class="control-label" for="inputCreateTime">Created Time</label>
                <div class="controls">
                    <input type="text" name="inputCreateTime" value="<?php echo $reservation->get('create_time')?>" class="required" disabled>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputStatus">Status</label>
                <div class="controls">
                    <input type="text" name="inputStatus" value="<?php echo $reservation->get('status')?>" class="required" disabled>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputReview">Review</label>
                <div class="controls">
                    <input type="text" name="inputReview" value="<?php echo $reservation->get('review')?>" class="required" disabled>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPrice">Price</label>
                <div class="controls">
                    <input type="text" name="inputPrice" value="<?php echo $price?>" class="required" disabled>
                </div>
            </div>
          <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" id="editInfo">Edit</button>
                <button class="btn btn-success" id="saveInfo">Save</button>
                <a href="<?php echo base_url('admin/reservation/list'); ?>" class="btn">Cancel</a>
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
                            url: '<?php echo site_url('/ajax/savereservation/' . $reservation->get('id')); ?>',
                            data: postData,
                            method: 'POST'
                        }).done(function() {
                            $("#formEdit input, #formEdit select")
                                .attr('disabled','disabled')
                                .removeClass('valid');
                            window.location = "<?php echo base_url('admin/reservation/list'); ?>";
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
