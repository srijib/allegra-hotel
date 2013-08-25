<div class="container" style="margin-top:100px;margin-bottom:100px;">
    <div class="row">
        <div class="span8 offset2">
            <center>
            <h3>Please Enter Your Username And Email Address</h3>
            <form method="post" action="<?php echo site_url('customer/sendpassword'); ?>" class="form form-inline">
                <input type="text" class="input" placeholder="username" name="username">
                <input type="text" class="input email" placeholder="Email" name="email">
                <button id="emailSubmit" type="submit" class="btn btn-primary">Send Password</button>
            </form>
            </center>
        </div>
    </div>
</div>
