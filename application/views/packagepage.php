<div class="row">
    <div class="span12">
        <legend>Get a whole package of happiness.</legend>
    </div>
</div>
<div class="row">
<?php 
    //$i = 1;
    foreach ($packages as $package):
        $id = $package->get('id');
        //if($i % 2 === 1) echo '<div class="row">';
        $roomtype = $package->load_roomtype($package->get('id'));
        $offerings = $package->load_offering($package->get('id'));
 ?>
    <form action="<?php echo site_url('reservation/bypackagePost') ?>" method="post" accept-charset="utf-8">
    
    <input type="hidden" name="roomtype" value="<?php echo $roomtype->get('id'); ?>">
    <?php
        $ao = array();
        foreach ($offerings as $o) {
            $ao[] = $o->get('id');
        }
    ?>
    <input type="hidden" name="offerings" value="<?php echo implode(',',$ao); ?>">
    
    <div class="span12">
        <div class="row">
        <div class="span4">
            <img 
            src="<?php echo base_url($roomtype->get("roomtype_img_url")) ?>" 
            class="img-rounded" 
            alt="roomtype"
            >
            <h3><?php echo $package->get('package_title')?> Package</h3>
            <p><?php echo $package->get('package_description')?></p>
        </div>
        <div class="span8">
            <div class="row">
                <div class="span8">
                    <h4>What's Included:</h4>
                </div>
            </div>
            <div class="row">
                <div class="span4">
                    <h4>Acommodation:</h4>
                    <p><strong><?php echo $roomtype->get('roomtype_type') . " " . $roomtype->get('roomtype_class'); ?></strong></p>
                    <p>Rating: <?php echo $roomtype->getReview(); ?>/5</p>
                    <p><?php echo $roomtype->get('roomtype_size'); ?> square meters</p>
                    <p><?php echo $roomtype->get('roomtype_description'); ?></p>
                </div>
                <div class="span4">
                    <?php
                        if (!empty($offerings)) :
                    ?>
                    <h4>Offering:</h4>
                    <?php foreach($offerings as $offering): 
                        $offering_price = 0; 
                        $offering_price += $offering->get('offering_price');
                    ?>
                        <h5><?php echo $offering->get('offering_title'); ?></h5>
                        <p><?php echo $offering->get('offering_description'); ?></p>
                        <p>Type: <?php echo $offering->get('offering_type'); ?></p>
                        <p>Time: <?php echo $offering->get('offering_time'); ?></p>
                    <?php endforeach ?>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="span8">
                    <h4>Other Services:</h4>
                    <p>Breakfast, free parking.</p>
                </div>
            </div>
            <?php $price = $roomtype->get('roomtype_price') + $offering_price; ?>
            <h3 class="pull-right">
                $ <?php echo $price; ?>
                <input type="submit" class="btn btn-primary" value="Book Now" />
            </h3>
        </div>
        </div>
        <hr>
    </div>

    </form>

    <?php 
        //if ($i++ % 2 === 0) echo '</div>';
        endforeach
    ?>
 </div>
