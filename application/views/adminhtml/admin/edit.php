<div class="container">
    <div class="row">
        <div class="span12">
            <?php if ($error = validation_errors()): ?>
                <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
            <?php endif ?>

            <div class="tabbable tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab"><h4>Admin Username</h4></a></li>
                    <li><a href="#tab2" data-toggle="tab"><h4>Change Password</h4></a></li>
                    <li><a href="#tab3" data-toggle="tab"><h4>Forgot Password?</h4></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="row">
                            <div class="span6">
                                <form action="" id="formEdit" class="form-horizontal span6"
                                method="post">
                                <fieldset>
                                  <div class="control-group">
                                    <label class="control-label" for="inputUsername">Username</label>
                                    <div class="controls">
                                      <input type="text" name="inputUsername" value="<?php echo $admin->get('admin_username')?>" class="required" disabled>
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <div class="controls">
                                        <button class="btn btn-primary" id="editInfo">Edit</button>
                                        <button class="btn btn-success" id="saveInfo">Save</button>
                                        <a href="<?php echo base_url('admin/admin/list'); ?>" class="btn" id="saveInfo">Cancel</a>
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
                                                    url: '<?php echo base_url('/ajax/saveAdmin/' . $admin->get('id')); ?>',
                                                    data: postData,
                                                    method: 'POST'
                                                }).done(function() {
                                                    $("#formEdit input, #formEdit select")
                                                        .attr('disabled','disabled')
                                                        .removeClass('valid');
                                                    window.location = "<?php echo base_url('admin/admin/list'); ?>";
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
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="row">
                            <div class="span6">
                                <?php if ($error = validation_errors()): ?>
                                <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
                                <?php endif ?>

                                <form action="<?php echo site_url('admin/admin/changePassword'); ?>" id="formChangePassword" class="form-horizontal span6"
                                method="post">
                                <fieldset>
                                  <div class="control-group">
                                    <label class="control-label" for="inputOldPassword"><h4>Old Password</h4></label>
                                    <div class="controls">
                                      <input type="password" name="inputOldPassword" class="required">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="inputNewPassword"><h4>New Password</h4></label>
                                    <div class="controls">
                                      <input type="password" name="inputNewPassword" class="required">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="inputConfirmPassword"><h4>Confirm Password</h4></label>
                                    <div class="controls">
                                        <input type="password" name="inputConfirmPassword" class="required">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <div class="controls">
                                        <input type="submit" id="changePasswordSubmit" class="submit btn btn-primary" value="Confirm" >
                                        <input type="submit" class="btn" value="Cancel">
                                    </div>
                                  </div>
                                </fieldset>
                                </form>
                                <script>
                                    jQuery(document).ready(function($){
                                        $("#formChangePassword").validate();
                                        $('#changePasswordSubmit').on('click', function(event){
                                            event.preventDefault();
                                            var form = $("#formChangePassword"),
                                                postURL = form.attr("action");
                                            $.ajax({
                                                url:postURL,
                                                data: form.serialize(),
                                                method: 'POST',
                                                dataType: 'json'
                                            }).done(function(data){
                                                var returnCode = data.code,
                                                    returnMsg = data.des;
                                                alert(data.des);
                                            });
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="row">
                            <div class="span6">
                                <center>
                                <h3>Please Enter Your Username And Email Address</h3>
                                <form method="post" action="<?php echo site_url('admin/admin/sendpassword'); ?>" class="form form-inline">
                                    <input type="text" class="input" placeholder="username" name="username">
                                    <input type="text" class="input email" placeholder="Email" name="email">
                                    <button id="emailSubmit" type="submit" class="btn btn-primary">Send Password</button>
                                </form>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>