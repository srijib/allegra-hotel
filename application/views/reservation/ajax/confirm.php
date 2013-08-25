<?php 
    $rt = new Roomtype();
    $rt->load($roomtype);
?>
<div id="res-confirm-order" data-step="4" class="span9">
<div class="row">
    <legend>Confirm Your Booking</legend>
    <div class="span4">
        <h4 style="color: darkblue;">Your reservation will be forfeited until you confirm this order.</h4>
        <h4>Room</h4>
        <dl class="dl-horizontal">
            <dt>Roomtype</dt>
            <dd><?php echo $rt->get('roomtype_type');?></dd>
            <dt>Class</dt>
            <dd><?php echo $rt->get('roomtype_class');?></dd>
            <dt>No of People</dt>
            <dd><?php echo $rt->get('roomtype_numOfPeople');?></dd>
        </dl>   
        <dl class="dl-horizontal">
            <dt>Total Price</dt>
            <dd>$ <?php echo $roomtype_price['total_all'];?></dd>
        </dl>   
        <dl class="dl-horizontal">
            <?php foreach($roomtype_price['days'] as $date=>$price): ?>
                <?php echo '<dt>'.$date.'</dt><dd>$ '.$price.' / room<dd>';?>
            <?php endforeach ?>
        </dl>
        <dl class="dl-horizontal">
            <?php foreach($roomtype_price['days_all'] as $date=>$price): ?>
                <?php echo '<dt>'.$date.'</dt><dd>$ '.$price.' / all rooms<dd>';?>
            <?php endforeach ?>
        </dl>
    </div>

    <div class="span4">
        <h4>Offerings</h4>
        <?php foreach($offerings as $id=>$a): ?>
        <dl class="dl-horizontal">
            <dt>
                <?php echo $a['title']; ?>
            </dt>
            <dd>&nbsp;
            </dd>
            <dt>Price</dt>
            <dd><?php echo $a['price']; ?> $/offering</dd>
            <dt>Quantity</dt>
            <dd><?php echo $a['qty']?></dd>
            <dt>Total Price</dt>
            <dd><?php echo $a['total_price']?> $</dd>
        </dl>
        <?php endforeach ?>
    </div>
</div>

<div class="row">
    <div class="span9">
        <h4>Billing Information</h4>
        <dl class="dl-horizontal">
            <dt>Payment type</dt>
            <dd><?php echo $payment['type']; ?></dd>
            <dt>Card number</dt>
            <dd><?php echo $payment['cardno']; ?></dd>
            <dt>Card Holder</dt>
            <dd><?php echo $payment['holder']; ?></dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="span12">
        <h4 style="color: darkblue;">You can cancel your reservation 24 hours before the check-in date.</h4>
    </div>
</div>
</div>
