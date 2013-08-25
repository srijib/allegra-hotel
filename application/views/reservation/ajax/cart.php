<div class="row">
<div class="span3">
    <?php
        if($roomtype === NULL):
            echo '<legend>No room selected.</legend>';
            $_SESSION['cart']['offering'] = array();
    ?>
    <?php else: ?>
    <?php 
        $rt = new Roomtype();
        $rt->load($roomtype);
    ?>
    <div class="row">
        <div class="span3">
            <legend>Your cart</legend>
            <h4>
                Room $ <?php echo $roomtype_price['total_all']?>
                <span data-opt="remove_roomtype" data-id="<?php echo $roomtype; ?>" class="btn btn-danger btn-mini pull-right">Remove</span>
            </h4>
            <a href="#" id="showhideRoomPriceDetail">Show Price Details</a>
            <dl class="dl-horizontal">
                <dt>Roomtype</dt>
                <dd><?php echo $rt->get('roomtype_type');?></dd>
                <dt>Class</dt>
                <dd><?php echo $rt->get('roomtype_class');?></dd>
                <dt>No of People</dt>
                <dd><?php echo $rt->get('roomtype_numOfPeople');?></dd>
            </dl>
        </div>
    </div>

    <div class="row" id="roomPriceDetail" style="display:none">
        <div class="span3">
            <dl class="dl-horizontal">
                <dt>Base price</dt>
                <dd>$ <?php echo $roomtype_price['total']?> / room</dd>
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
    </div>

    <div class="row">
        <div class="span3">
            <h4>Offerings</h4>
            <?php foreach($offerings as $id=>$a): ?>
            <hr>
            <dl class="dl-horizontal">
                <dt>
                    <?php echo $a['title']; ?>
                </dt>
                <dd>
                    <span data-opt="remove_offering" data-id="<?php echo $id; ?>" class="btn btn-danger btn-mini">Remove</span>
                </dd>
                <dt>Price</dt>
                <dd><?php echo $a['price']; ?> $/offering</dd>
                <dt>Quantity</dt>
                <dd><?php echo $a['qty']?></dd>
                <dt>Total Price</dt>
                <dd><?php echo $a['total_price']?> $</dd>
            </dl>
            <?php endforeach ?>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="span3">
            <h4>Total price: $ <?php echo $price_of_everythig; ?></h4>
        </div>
    </div>
    <?php endif ?>
</div>
</div>
