<div class="container" style="margin-top:100px;margin-bottom:100px;">
    <div class="row">
        <div class="span8 offset2">
            <center>
            <h3>Please Login</h3>
            <form method="post" action="<?php echo site_url('admin/login/loginPost'); ?>" class="form form-inline">
                <input type="text" class="input" placeholder="Username" name="username">
                <input type="password" class="input" placeholder="Password" name="password">
                <button id="loginSubmit" type="submit" class="btn btn-primary">Sign in</button>
                <?php
                    if (isset($error_message)) :
                ?>
                    <br/>
                    <div class="alert alert-error" style="margin:10px auto;">
                        <?php echo $error_message;?>
                    </div>
                <?php
                    endif;
                ?>
            </form>
            </center>
        </div>
    </div>
</div>
