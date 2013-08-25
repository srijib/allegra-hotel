<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

	<title><?php echo $title ?></title>

	<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/datepicker.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-formhelpers.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-formhelpers-countries.flags.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.validate.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.jeditable.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.pwdstr-1.0.source.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-phone.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-phone.format.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.en_US.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.de_DE.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.es_ES.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.pt_BR.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-selectbox.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>

	<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  
</head>
<body>

<style>
    .header-background {
        margin-bottom: 20px;
        padding-bottom: 20px;
        padding-top: 20px;
-webkit-box-shadow:  0px 2px 2px 2px rgba(0, 0, 0, 0.2);
        box-shadow:  0px 2px 2px 2px rgba(0, 0, 0, 0.2);
        background-color: #FAFAFA;
    }
</style>

<div class="header-background">
<div class="container">
	<div class="row">
   		<div class="span5">
   			<a href="<?php echo base_url("/"); ?>">
                <img src="<?php echo base_url("assets/img/logo.png"); ?>" alt="Allegra Hotel Logo" class="hotel_logo"/>
            </a>
   		</div>
        <div class="span7" id="sidebar" style="text-align:right">
            <div class="notLoggedIn" style="<?php if (is_logged_in()) echo 'display:none'; ?>">
                <form method="post" action="<?php echo site_url('customer/loginPost'); ?>" class="form-inline">
                  <input type="text" class="input-small" placeholder="Username" name="username">
                  <input type="password" class="input-small" placeholder="Password" name="password">
                  <button id="loginSubmit" type="submit" class="btn btn-primary">Sign in</button>
                  <a href="<?php echo site_url('customer/signup'); ?>" class="btn btn-info">Sign up</a>
                </form>
            </div>
            <a href="<?php echo site_url('customer/sendemail'); ?>">Forgot Your Password?</a>
            <div class="loggedIn" style="<?php if (!is_logged_in()) echo 'display:none'; ?>">
                <span class='login_userinfo'>Hello, <?php if (is_logged_in()) echo logged_fullname(); ?>.</span>
                <a href="<?php echo site_url('customer/showAccount'); ?>">My Account</a>
                <a href="<?php echo site_url('customer/logoutPost'); ?>" class="btn btn-info">Log out</a>
            </div>
        </div>
        <script>
            jQuery(document).ready(function($){
                $("#loginSubmit").on('click', function(event) {
                    event.preventDefault();
                    var form = $("#sidebar form"),
                        postURL = form.attr("action");

                    $.ajax({
                        url: postURL,
                        data: form.serialize(),
                        method: 'POST',
                        dataType: 'json'
                    }).done(function(data) {
                        var returnCode = data.code,
                            returnMsg = data.des,
                            returnHTML = data.HTML;

                        if (returnCode == 0) {
                            $(".notLoggedIn").hide();
                            $(".login_userinfo").text(returnHTML);
                            $(".loggedIn").show();
                            if ($("#res-complete-info").length > 0 ||
                                $("#res-top li").eq(2).hasClass("active")) {
                                $("#res-top li").eq(2).click();
                            }
                        } else {
                            alert(data.des);
                        }
                    });
                });
            });
        </script>
    </div>
	<div class="row">
        <nav class="span12 navbar navbar-converse home_navbar">
            <div class="navbar-inner home_navbar_inner">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                </a>
                <div class="nav-collapse">
                    <ul class="nav home_nav" id="tabs" role="navigation">
                        <li><a href="<?php echo site_url('/'); ?>"><h4>Home</h4></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="<?php echo site_url('offeringpage'); ?>"><h4>Offering</h4></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="<?php echo site_url('packagepage'); ?>"><h4>Package</h4></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="<?php echo site_url('eventpage'); ?>"><h4>Events</h4></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="<?php echo site_url('aboutuspage'); ?>"><h4>About Us</h4></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="<?php echo site_url('contactuspage'); ?>"><h4>Contact Us</h4></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="<?php echo site_url('faq'); ?>"><h4>FAQs</h4></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <script>
            jQuery(document).ready(function($){
                $("ul#tabs > li > a").on('click', function(){
                    $(this).parent("li").addClass("active");
                });
            });
        </script>
   	</div>
</div>
</div>
<div class="container">
