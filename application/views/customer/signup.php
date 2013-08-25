
<div class="row">
	<div class="span6 offset2">

        <?php if ($error = validation_errors()): ?>
            <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="<?php echo base_url('customer/signupPost'); ?>" id="formSignup" class="form-horizontal span6"
        method="post">
        <fieldset>
		  <div class="control-group">
		    <label class="control-label" for="inputUsername">Username</label>
		    <div class="controls">
		      <input type="text" name="inputUsername" placeholder="Username" class="required">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputPassword">Password</label>
		    <div class="controls">
		      <input type="password" name="inputPassword" placeholder="Password" class="required" id="password">
              <br/><span style="font-size:80%;color:#333;">May be cracked in <span id="time">N/A</span>
		    </div>
            <script>
                (function(){
                    $("#password").pwdstr('#time');
                })();
            </script>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">Email</label>
		    <div class="controls">
		      <input type="email" name="inputEmail" placeholder="test@example.com" class="required email">
		    </div>
		  </div>
          <div class="control-group">
            <div class="controls">
              <label class="checkbox" for="checkboxEmail">
                <input type="checkbox" name="checkboxEmail" value="1">
                Join our email list to receive news and promotions.
              </label>
            </div>
          </div>
		  <div class="control-group">
		    <label class="control-label" for="inputTitle">Title</label>
		    <div class="controls">
		      <select name="inputTitle" id="inputTitle" class="required">
		        <option selected></option>
		        <option>Mr.</option>
		        <option>Mrs.</option>
		        <option>Ms.</option>
		        <option>Miss</option>
		      </select>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputFname">First Name</label>
		    <div class="controls">
		      <input type="text" name="inputFname" placeholder="First Name" class="required">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputLname">Last Name</label>
		    <div class="controls">
		      <input type="text" name="inputLname" placeholder="Last Name" class="required">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputPhone">Phone</label>
		    <div class="controls">
		      <input type="text" name="inputPhone" placeholder="Phone" class="bfh-phone required" data-format="(+dd) dd-ddd-dddd">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputCountry">Country</label>
		    <div class="controls">
		        <!-- <input type="text" name="inputCountry" placeholder="Country" class="required"> -->
                <div class="bfh-selectbox bfh-countries" data-country="AU" data-flags="true">
                    <input type="hidden" name="inputCountry" value="" class="required">
                    <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
                        <span class="bfh-selectbox-option input-medium" data-option=""></span>
                        <b class="caret"></b>
                    </a>
                    <div class="bfh-selectbox-options">
                        <input type="text" class="bfh-selectbox-filter">
                        <div role="listbox">
                            <ul role="option">
                            </ul>
                        </div>
                    </div>
                </div>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputState">State</label>
		    <div class="controls">
		      <input type="text" name="inputState" placeholder="State" class="required">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputCity">City</label>
		    <div class="controls">
		      <input type="text" name="inputCity" placeholder="City" class="required">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputAddress">Address</label>
		    <div class="controls">
		      <input type="text" name="inputAddress" placeholder="Address" class="required">
		    </div>
		  </div>
		  <div class="control-group">
		  	<div class="controls">
		    	<input type="submit" class="submit btn btn-primary" value="Sign up">
		    	<input type="submit" class="btn" value="Cancel">
		    </div>
		  </div>
        </fieldset>
		</form>
        <script>
            jQuery(document).ready(function($){
                $("#formSignup").validate();
            });
        </script>
	</div>
</div>
