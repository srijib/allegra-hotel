<?php

?>
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
    <link href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-formhelpers.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-formhelpers-countries.flags.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/admin.css') ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.validate.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.jeditable.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-phone.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-phone.format.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.en_US.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.de_DE.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.es_ES.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-countries.pt_BR.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-formhelpers-selectbox.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/admin.js') ?>"></script>

	<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  
</head>
<body class="<?php echo $body_class; ?>">

<div class="container header">
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span12">
					<h2><strong><em>Allegra Hotel </em></strong>Administration System
<?php
    if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] === true) :
?>
                    <a href="<?php echo base_url('admin/login/logout'); ?>" class="btn pull-right">Log out</a>
                    <a href="/assets/backup.zip" class="btn btn-success pull-right" style="margin-right:10px;">One-key Backup</a></h2>
				</div>
			</div>
			<div class="row">
				<div class="span12">
		    		<ul class="nav nav-tabs">
                        <li data-uri="admin_customer">
                            <a href="<?php echo base_url('admin/customer'); ?>">Customers</a>
                        </li>
    					<li data-uri="admin_reservation">
                            <a href="<?php echo base_url('admin/reservation'); ?>">Reservation</a>
                        </li>
    					<li data-uri="admin_hotel">
                            <a href="<?php echo base_url('admin/hotel'); ?>">Hotel</a>
                        </li>
    					<li data-uri="admin_room">
                            <a href="<?php echo base_url('admin/room'); ?>">Room</a>
                        </li>
    					<li data-uri="admin_offering">
                            <a href="<?php echo base_url('admin/offering'); ?>">Offering</a>
                        </li>
    					<li data-uri="admin_package">
                            <a href="<?php echo base_url('admin/package'); ?>">Package</a>
                        </li>
                        <li data-uri="admin_package">
                            <a href="<?php echo base_url('admin/item'); ?>">Item</a>
                        </li>
                        <li data-uri="admin_report">
                            <a href="<?php echo base_url('admin/report'); ?>">Reports</a>
                        </li>
                        <li data-uri="admin_option">
                            <a href="<?php echo base_url('admin/option'); ?>">Options</a>
                        </li>
                        <li data-uri="admin_meta" class="pull-right">
                            <a href="<?php echo base_url('admin/meta'); ?>">Attribute Description</a>
                        </li>
                        <?php if($_SESSION['admin_username'] == 'admin_user1'): ?>
                        <li data-uri="admin_admin" class="pull-right">
                            <a href="<?php echo base_url('admin/admin'); ?>">System Users</a>
                        </li> 
                        <?php endif ?>
    				</ul>
<?php
    endif;
?>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<div class="container">
