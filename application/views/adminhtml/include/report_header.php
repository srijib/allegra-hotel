<div class="container">
    <div class="row">
        <div class="span12">
            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                    Reservations
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('admin/report/listReservation/')?>">All Reservations</a></li>
                    <li>
                        <a
                        <?php $current_mon = Date('m'); ?> 
                        href="<?php echo site_url('admin/report/listReservation/'.$current_mon)?>">
                        All Current Month Reservations
                        </a>
                    </li>
                    <li class="dropdown-submenu">
                        <a tabindex="-1" href="#">Choose Month</a>
                        <ul class="dropdown-menu">
                        <?php for($i = 1; $i <= 12; $i++): ?>
                        <li>
                            <a
                            <?php 
                            $month = mktime(0,0,0,date("m")+$i,0,0);
                            $mon = date("m", $month);
                            $month =  date("F", $month); ?> 
                            href="<?php echo site_url('admin/report/listReservation/'.$mon)?>">
                            <?php echo $month ?>
                        </a>
                        </li>
                        <?php endfor ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                    Packages
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('admin/report/listPackage')?>">All Packages</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                    Customers
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('admin/report/listAllCustomer')?>">All Customers</a></li>
                    <li><a href="<?php echo site_url('admin/report/listCustomer')?>">Customers on email list</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                    Financial Statement
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('admin/report/finStatement/')?>">Financial Statement of All Period</a></li>
                    <li>
                        <a
                        <?php $current_mon = Date('m'); ?> 
                        href="<?php echo site_url('admin/report/finStatement/'.$current_mon)?>">
                        Financial Statement of Current Month
                        </a>
                    </li>
                    <li class="dropdown-submenu">
                        <a tabindex="-1" href="#">Choose Month</a>
                        <ul class="dropdown-menu">
                        <?php for($i = 1; $i <= 12; $i++): ?>
                        <li>
                            <a
                            <?php 
                            $month = mktime(0,0,0,date("m")+$i,0,0);
                            $mon = date("m", $month);
                            $month =  date("F", $month); ?> 
                            href="<?php echo site_url('admin/report/finStatement/'.$mon)?>">
                            <?php echo $month ?>
                        </a>
                        </li>
                        <?php endfor ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">