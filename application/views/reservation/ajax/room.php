<div id="res-select-room" data-spy="scroll" data-step="1" class="span9">
    <?php foreach($rc as $index=>$value):
        $roomtype = new Roomtype();
        $roomtype->load($index);
    ?>
    <div class="row">
    <div class="well span8">
        <div class="row">
            <div class="span8">
                <img class="img-rounded" src="/<?php echo $roomtype->get('roomtype_img_url'); ?>" alt="roomtype" />
                <div class="row">
                    <div class="span6">
                        <h3><?php echo $roomtype->get('roomtype_type') . " " . $roomtype->get('roomtype_class');?></h3>
                        <p>Rating: <?php echo $roomtype->getReview(); ?>/5</p>
                        <p><?php echo $roomtype->get('roomtype_description') ;?></p>
                    </div>
                    <div class="span2">
                        <h3>$ <?php echo $roomtype->get('roomtype_price') ;?></h3>
                        <h5>No of People: <?php echo $roomtype->get('roomtype_numOfPeople');?></h5>
                        <span data-opt="add_roomtype" data-id="<?php echo $index;?>" class="btn btn-primary">Book</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php endforeach ?>
</div>
