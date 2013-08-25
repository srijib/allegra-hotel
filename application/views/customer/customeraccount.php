<div class="row">
    <h1>Welcome, <?php echo $customer_info['customer_username']?></h1>
    <h4>You can change your information here.</h4>
</div>

<div class="row">
    <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab"><h4>My Account Detail</h4></a></li>
            <li><a href="#tab3" data-toggle="tab"><h4>Change Password</h4></a></li>
            <li><a href="#tab4" data-toggle="tab"><h4>My Booking</h4></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div class="row">
                    <div class="span6 offset2">
                        <h4>Username: <?php echo $customer_info['customer_username']; ?></h4>
                        <h4>Email: <?php echo $customer_info['customer_email']; ?></h4>
                        <h4>Title: <?php echo $customer_info['customer_title']; ?></h4>
                        <h4>First Name: <?php echo $customer_info['customer_fname']; ?></h4>
                        <h4>Last Name: <?php echo $customer_info['customer_lname']; ?></h4>
                        <h4>Phone: <?php echo $customer_info['customer_phone']; ?></h4>
                        <h4>Country: <?php echo $customer_info['customer_country']; ?></h4>
                        <h4>State: <?php echo $customer_info['customer_state']; ?></h4>
                        <h4>City: <?php echo $customer_info['customer_city']; ?></h4>
                        <h4>Address: <?php echo $customer_info['customer_address']; ?></h4>
                        <div class="control-group">
                            <div class="controls">
                                <a href="#tab2" data-toggle="tab" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div class="row">
                    <div class="span6">
                        <?php if ($error = validation_errors()): ?>
                            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
                        <?php endif ?>

                        <form action="<?php echo base_url('customer/editPost'); ?>" id="formEdit" class="form-horizontal span6"
                        method="post">
                        <fieldset>
                          <div class="control-group">
                            <label class="control-label" for="inputUsername">Username</label>
                            <div class="controls">
                              <input type="text" name="inputUsername" value="<?php echo $customer_info['customer_username']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputEmail">Email</label>
                            <div class="controls">
                              <input type="email" name="inputEmail" value="<?php echo $customer_info['customer_email']?>" class="required email">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputTitle">Title</label>
                            <div class="controls">
                                <input type="text" name="inputTitle" value="<?php echo $customer_info['customer_title']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputFname">First Name</label>
                            <div class="controls">
                              <input type="text" name="inputFname" value="<?php echo $customer_info['customer_fname']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputLname">Last Name</label>
                            <div class="controls">
                              <input type="text" name="inputLname" value="<?php echo $customer_info['customer_lname']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputPhone">Phone</label>
                            <div class="controls">
                              <input type="text" name="inputPhone" value="<?php echo $customer_info['customer_phone']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputCountry">Country</label>
                            <div class="controls">
                              <input type="text" name="inputCountry" value="<?php echo $customer_info['customer_country']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputState">State</label>
                            <div class="controls">
                              <input type="text" name="inputState" value="<?php echo $customer_info['customer_state']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputCity">City</label>
                            <div class="controls">
                              <input type="text" name="inputCity" value="<?php echo $customer_info['customer_city']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputAddress">Address</label>
                            <div class="controls">
                              <input type="text" name="inputAddress" value="<?php echo $customer_info['customer_address']?>" class="required">
                            </div>
                          </div>
                          <div class="control-group">
                            <div class="controls">
                                <input type="submit" class="submit btn btn-primary" value="Edit">
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
            </div>

            <div class="tab-pane" id="tab3">
                <div class="row">
                    <div class="span6">
                        <?php if ($error = validation_errors()): ?>
                            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
                        <?php endif ?>

                        <form action="<?php echo base_url('customer/changePassword'); ?>" id="formChangePassword" class="form-horizontal span6"
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
            <div class="tab-pane" id="tab4">
                <?php 
                    foreach($reservations as $r): 
                        $reservation_extend = $r->load_room($r->get('id'));

                        $room = new Room();
                        $room->load($reservation_extend['room_id']);

                        $roomtype_id = $room->get('roomtype_id');
                        $roomtype = new Roomtype();
                        $roomtype->load($roomtype_id);

                        $img_url = $roomtype->get('roomtype_img_url');

                        $resDates = $r->load_dates($r->get('id'));
                        $noOfDates = count($resDates);

                        $reservation_offerings = $r->load_offering($r->get('id'));
                        $offering_price = 0;
                        foreach($reservation_offerings as $ro)
                        {
                            $offering_price += $r->get_offering_price($r->get('id'), $ro->get('id'));
                        }
                ?>
                <div class="row">
                    <div class="span8 well">
                        <h5>Reservation Number: <?php echo $r->get('id'); ?></h5>
                        <div class="span4">
                            <img src="<?php echo base_url($img_url); ?>" class="img-rounded" alt="roomtype">
                            <h3>Package:</h3>
                            <h3><?php echo ucfirst($ro->get('offering_type')); ?> Package</h3>
                            <?php 
                                $timestamp = strtotime($resDates[0]);
                                $checkindate = date('F-d-Y', $timestamp);
                                $checkout = strtotime("+$noOfDates day", $timestamp);
                                $checkoutdate = date('F-d-Y', $checkout);
                            ?>
                                <h5>Check-In:  <?php echo $checkindate; ?></h5>
                                <h5>Check-Out: <?php echo $checkoutdate; ?></h5>
                        </div>
                        <div class="span3">
                            <h4>Include:</h4>
                            <h5>Acommodation:</h5>
                            <p><?php echo $roomtype->get('roomtype_type') . ' ' . $roomtype->get('roomtype_class'); ?></p>
                            <p class="rating">Please rate this acommondation:<br/>
                                <input type="radio" name="rt<?php echo $roomtype->get('id'); ?>" value="1">&nbsp;1
                                <input type="radio" name="rt<?php echo $roomtype->get('id'); ?>" value="2">&nbsp;2
                                <input type="radio" name="rt<?php echo $roomtype->get('id'); ?>" value="3">&nbsp;3
                                <input type="radio" name="rt<?php echo $roomtype->get('id'); ?>" value="4">&nbsp;4
                                <input type="radio" name="rt<?php echo $roomtype->get('id'); ?>" value="5">&nbsp;5
                            </p>
                            <h5>Offering:</h5>
                            <?php 
                                foreach($reservation_offerings as $ro):
                            ?>
                                <h6><?php echo $ro->get('offering_title'); ?></h6>
                                <p>Type: <?php echo $ro->get('offering_type'); ?></p>
                                <p>Time: <?php echo $ro->get('offering_time'); ?></p>
                            <?php endforeach ?>
                            <h5>Other Services:</h5>
                            <p>Breakfast, free parking.</p>
                            <?php
                                $reservation = $r->load_room($r->get('id'));
                                $price = $offering_price  + $reservation['room_price'];
                            ?>
                            <h3>Total Price:</h3>
                            <h3>$ <?php echo $price; ?></h3>
                            <button class="btn btn-danger">Remove From List</button>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    $(".rating input").on('click', function() {
        $(".rating").html("Thanks for your feedback!").css("color","blue");
    });
})();
</script>
