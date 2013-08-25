<div class="row">
    <div class="span6 offset3">
        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="" id="formEdit" class="form-horizontal span6"
        method="post">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="inputUsername">Username</label>
            <div class="controls">
              <input type="text" name="inputUsername" value="<?php echo $customer->get('customer_username')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
              <input type="email" name="inputEmail" value="<?php echo $customer->get('customer_email')?>" class="required email" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputTitle">Title</label>
            <div class="controls">
                <input type="text" name="inputTitle" value="<?php echo $customer->get('customer_title')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputFname">First Name</label>
            <div class="controls">
              <input type="text" name="inputFname" value="<?php echo $customer->get('customer_fname')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputLname">Last Name</label>
            <div class="controls">
              <input type="text" name="inputLname" value="<?php echo $customer->get('customer_lname')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPhone">Phone</label>
            <div class="controls">
              <input type="text" name="inputPhone" value="<?php echo $customer->get('customer_phone')?>" class="bfh-phone required" data-format="(+dd) dd-ddd-dddd" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputCountry">Country</label>
            <div class="controls">
              <input type="text" name="inputCountry" value="<?php echo $customer->get('customer_country')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputState">State</label>
            <div class="controls">
              <input type="text" name="inputState" value="<?php echo $customer->get('customer_state')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputCity">City</label>
            <div class="controls">
              <input type="text" name="inputCity" value="<?php echo $customer->get('customer_city')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputAddress">Address</label>
            <div class="controls">
              <input type="text" name="inputAddress" value="<?php echo $customer->get('customer_address')?>" class="required" disabled>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" id="editInfo">Edit</button>
                <button class="btn btn-success" id="saveInfo">Save</button>
                <a href="<?php echo base_url('admin/customer/list'); ?>" class="btn" id="saveInfo">Cancel</a>
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
                            url: '<?php echo base_url('/ajax/editCustomer/' . $customer->get('id')); ?>',
                            data: postData,
                            method: 'POST'
                        }).done(function() {
                            $("#formEdit input, #formEdit select")
                                .attr('disabled','disabled')
                                .removeClass('valid');
                            window.location = "<?php echo base_url('admin/customer/list'); ?>";
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
