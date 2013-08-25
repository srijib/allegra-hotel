<style>
    #res-complete-info .control-label {
        width: 100px;
    }
    #res-complete-info .controls {
        margin-left: 110px;
    }
</style>

<div id="res-complete-info" data-step="3" class="span9">

    <?php if (!is_logged_in()) : ?>
    <h5>Returning customer? Login above to automagically fill your information here!</h5>
    <?php else:
        //var_dump($customer);
    endif; ?>

    <form action="" id="reserveCustomer" class="form-horizontal row">
        <div class="span9">
            <legend>Your Information</legend>
        </div>
        <div class="span4">
          <div class="control-group">
            <label class="control-label" for="inputUsername">Username</label>
            <div class="controls">
              <input type="text" name="inputUsername" placeholder="Username" class="required"
              value="<?php if (is_logged_in()) echo $customer['customer_username']?>"
              <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPassword">Password</label>
            <div class="controls">
              <input type="password" name="inputPassword" placeholder="Password" class="required"
              <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
              <input type="email" name="inputEmail" placeholder="test@example.com" class="required email"
              value="<?php if (is_logged_in()) echo $customer['customer_email']?>"
              <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <label class="checkbox" for="checkboxEmail">
                <input type="checkbox" name="checkboxEmail" value="1"
                <?php if (is_logged_in() && $customer['customer_onmail'] == '1') echo 'checked'?>
                <?php if (is_logged_in()) echo 'disabled'?>>
                Join our email list to receive news and promotions.
              </label>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPhone">Phone</label>
            <div class="controls">
              <input type="text" name="inputPhone" placeholder="Phone" class="required"
              value="<?php if (is_logged_in()) echo $customer['customer_phone']?>"
                <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="control-group">
            <label class="control-label" for="inputTitle">Title</label>
            <div class="controls">
              <select name="inputTitle" id="inputTitle" class="required"
                <?php if (is_logged_in()) echo 'disabled'?>>
                <option></option>
                <option <?php if (is_logged_in() && $customer['customer_title'] == 'Mr.') echo 'selected' ?>>Mr.</option>
                <option <?php if (is_logged_in() && $customer['customer_title'] == 'Mrs.') echo 'selected' ?>>Mrs.</option>
                <option <?php if (is_logged_in() && $customer['customer_title'] == 'Ms.') echo 'selected' ?>>Ms.</option>
                <option <?php if (is_logged_in() && $customer['customer_title'] == 'Miss') echo 'selected' ?>>Miss</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputFname">First Name</label>
            <div class="controls">
              <input type="text" name="inputFname" placeholder="First Name" class="required"
              value="<?php if (is_logged_in()) echo $customer['customer_fname']?>"
                <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputLname">Last Name</label>
            <div class="controls">
              <input type="text" name="inputLname" placeholder="Last Name" class="required"
              value="<?php if (is_logged_in()) echo $customer['customer_lname']?>"
                <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputCountry">Country</label>
            <div class="controls">
              <input type="text" name="inputCountry" placeholder="Country" class="required"
              value="<?php if (is_logged_in()) echo $customer['customer_country']?>"
                <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputState">State</label>
            <div class="controls">
              <input type="text" name="inputState" placeholder="State" class="required"
              value="<?php if (is_logged_in()) echo $customer['customer_state']?>"
                <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputCity">City</label>
            <div class="controls">
              <input type="text" name="inputCity" placeholder="City" class="required"
              value="<?php if (is_logged_in()) echo $customer['customer_city']?>"
                <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputAddress">Address</label>
            <div class="controls">
              <input type="text" name="inputAddress" placeholder="Address" class="required"
              value="<?php if (is_logged_in()) echo $customer['customer_address']?>"
                <?php if (is_logged_in()) echo 'disabled'?>>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <?php if (is_logged_in()) : ?>
        <div style="text-align:center;">
            <button class="btn" id="editInfo">Click to edit this infomation</button>
            <button class="btn btn-success" id="saveInfo">Save</button>
        </div>
        <script>
            (function(){
                var ed = $("#editInfo"), sa = $("#saveInfo");
                ed.show();sa.hide();
                ed.on('click', function(event) {
                    event.preventDefault();
                    $("#reserveCustomer input, #reserveCustomer select").removeAttr('disabled');
                    ed.hide();sa.show();
                    $("#reserveCustomer").validate();
                });
                sa.on('click', function(event) {
                    event.preventDefault();
                    var postData = $("#reserveCustomer").serialize();
                    $.ajax({
                        url: '<?php echo base_url('/ajax/saveCustomer'); ?>',
                        data: postData,
                        method: 'POST'
                    }).done(function() {
                        $("#reserveCustomer input, #reserveCustomer select")
                            .attr('disabled','disabled')
                            .removeClass('valid');
                        sa.hide();ed.show();
                    });
                });
            })();
        </script>
        <?php endif; ?>

    </form>

    <form action="" id="reservePayment" class="form-horizontal row">
        <div class="span9">
            <legend>Payment Methods</legend>
            <div class="row">
                <div class="span4">
                  <div class="control-group">
                        <label class="control-label">Select payment</label>
                    <div class="controls">
                        <select name="paymentMethod" id="paymentMethod">
                            <option></option>
                            <option value="cc">Credit Card</option>
                            <option value="paypal">Paypal</option>
                            <option value="bpay">BPay</option>
                        </select>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row" id="pay-cc" style="display:none;">
                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="inputCardType">Card Type</label>
                    <div class="controls">
                      <select name="inputCardType" id="inputCardType" class="required">
                        <option></option>
                        <option>Mastcard</option>
                        <option>Visa</option>
                        <option>American Express</option>
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputHolderName">Card Holder</label>
                    <div class="controls">
                      <input type="text" name="inputCardHolder" placeholder="e.g. Jack Johns" class="required">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputSecCode">Security Code</label>
                    <div class="controls">
                      <input type="text" name="inputSecCode" placeholder="e.g. 123" class="required input-small">
                    </div>
                  </div>
                </div>
                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="inputCardNumber">Card Number</label>
                    <div class="controls">
                      <input type="text" name="inputCardNumber" placeholder="e.g. 1234567890123456" class="required">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Expire Date</label>
                    <div class="controls">
                      <select name="inputExpMonth" id="inputExpMonth" class="required input-small">
                        <option selected></option>
                        <?php
                            for ($i = 1; $i < 13; $i++) {
                                echo "<option value='$i'>".date("M", mktime(0, 0, 0, $i))."</option>";
                            }
                        ?>
                      </select>
                      <select name="inputExpYear" id="inputExpYear" class="required input-small">
                        <option selected></option>
                        <?php
                            for ($i = date("Y"); $i < date("Y") + 10; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        (function(){
            $("#paymentMethod").on('change', function() {
                var v = $(this).val(),
                    c = $("#pay-cc");
                (v == 'cc') ? c.slideDown() : c.slideUp();
            });
        })();
    </script>

    <form action="" id="reservePayment" class="form-horizontal row">
        <div class="span9">
            <legend>Terms and Conditions</legend>
        </div>
        <div class="span5">
            <div class="control-group">
            <div class="controls">
               <label class="checkbox" for="checkboxEmail">
                 <input type="checkbox" name="checkboxEmail" id="checkboxEmail">
                 I agreed to the terms and conditions.
               </label>
            </div>
            </div>
        </div>
    </form>
</div>
