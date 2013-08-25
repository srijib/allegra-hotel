
<div class="row">
    <div class="span5">

        <?php if ($error = validation_errors()): ?>
        <?php echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
        <?php endif ?>

        <form action="<?php echo base_url('contactuspage/sendemail'); ?>" id="formContact" class="form-horizontal"
        method="post">
            <legend>Fill the form to send us an email.</legend>
            <fieldset>
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
                        <input type="text" name="inputPhone" placeholder="Phone" class="required">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputCountry">Country</label>
                    <div class="controls">
                        <input type="text" name="inputCountry" placeholder="Country" class="required">
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
                    <label class="control-label" for="inputEmail">Email</label>
                    <div class="controls">
                        <input type="email" name="inputEmail" placeholder="test@example.com" class="required email">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputComments">Comments</label>
                    <div class="controls">
                        <input type="text" name="inputComments" placeholder="Comments" class="required">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" class="submit btn btn-primary" value="Submit">
                        <input type="submit" class="btn" value="Cancel">
                    </div>
                </div>
            </fieldset>
        </form>
        <script>
            jQuery(document).ready(function($){
            $("#formContact").validate();
            });
            </script>
        </div>

        <div class="span5 offset1">
            <legend>Here is our contact details</legend>
            <div class="row" id="contactInfo">
                <?php for($i = 0; $i < count($contactus_content[0]); $i++): ?>
                <div class="span4">
                    <h6>
                        <?php echo $contactus_content[0][$i]; ?>: 
                    </h6>
                    <p>
                        <?php echo $contactus_content[1][$i] ;?>
                    </p>
                </div>
                <?php endfor ?>
            </div>
            <iframe width="500" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msa=0&amp;msid=200441416091782482761.0004ddaae88e5a6686512&amp;ie=UTF8&amp;t=m&amp;ll=-37.833378,144.984169&amp;spn=0.081347,0.102997&amp;z=12&amp;output=embed"></iframe><br /><small>View <a href="https://maps.google.com/maps/ms?msa=0&amp;msid=200441416091782482761.0004ddaae88e5a6686512&amp;ie=UTF8&amp;t=m&amp;ll=-37.833378,144.984169&amp;spn=0.081347,0.102997&amp;z=12&amp;source=embed" style="color:#0000FF;text-align:left">Allegra Hotel</a> in a larger map</small>
    </div>

</div>
