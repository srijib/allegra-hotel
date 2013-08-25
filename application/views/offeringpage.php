<div class="row">
    <div class="span12">
        <legend>We have plenty of good offers for you.</legend>
    </div>
</div>

<div class="row">
    <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab"><h5>Moive Tickets</h5></a></li>
            <li><a href="#tab2" data-toggle="tab"><h5>Sport Game Tickets</h5></a></li>
            <li><a href="#tab3" data-toggle="tab"><h5>Culture Events</h5></a></li> 
            <li><a href="#tab4" data-toggle="tab"><h5>Tourism</h5></a></li> 
        </ul>
        <div class="offset4">
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <?php 
                        $i = 1;
                        foreach ($movie_offerings as $offering):
                            if($i % 2 === 1 && count($movie_offerings) > 1) 
                                echo '<div class="row">';
                     ?>
                    <div class="span4">
                        <img 
                            src="<?php echo base_url($offering->get("offering_img_url")) ?>" 
                            class="img-rounded" 
                            alt="<?php echo $offering->get('offering_abbr')?>"
                        >
                        <h4><?php echo $offering->get('offering_title')?></h4>
                        <p><?php echo $offering->get('offering_description')?></p>
                        <p><?php echo $offering->get('offering_time');?></p>
                        <h4>$ <?php echo $offering->get('offering_price');?></h4>   
                    </div>
                    <?php 
                        if ($i++ % 2 === 0) echo '</div>';
                        endforeach 
                    ?>
                </div>

                <div class="tab-pane" id="tab2">
                    <?php 
                        $i = 1;
                        foreach ($sport_offerings as $offering):
                            if($i % 2 === 1 && count($sport_offerings) > 1) 
                                echo '<div class="row">';
                     ?>
                    <div class="span4">
                        <img 
                            src="<?php echo base_url($offering->get("offering_img_url")) ?>" 
                            class="img-rounded" 
                            alt="<?php echo $offering->get('offering_abbr')?>"
                        >
                        <h4><?php echo $offering->get('offering_title')?></h4>
                        <p><?php echo $offering->get('offering_description')?></p>
                        <p><?php echo $offering->get('offering_time');?></p>
                        <h4>$ <?php echo $offering->get('offering_price');?></h4>   
                    </div>
                    <?php 
                        if ($i++ % 2 === 0) echo '</div>';
                        endforeach 
                    ?>
                </div>

                <div class="tab-pane" id="tab3">
                    <?php 
                        $i = 1;
                        foreach ($culture_offerings as $offering):
                            if($i % 2 === 1 && count($culture_offerings) > 1) 
                                echo '<div class="row">';
                     ?>
                    <div class="span4">
                        <img 
                            src="<?php echo base_url($offering->get("offering_img_url")) ?>" 
                            class="img-rounded" 
                            alt="<?php echo $offering->get('offering_abbr')?>"
                        >
                        <h4><?php echo $offering->get('offering_title')?></h4>
                        <p><?php echo $offering->get('offering_description')?></p>
                        <p><?php echo $offering->get('offering_time');?></p>
                        <h4>$ <?php echo $offering->get('offering_price');?></h4>   
                    </div>
                    <?php 
                        if ($i++ % 2 === 0) echo '</div>';
                        endforeach 
                    ?>
                </div>

                <div class="tab-pane" id="tab4">
                    <?php 
                        $i = 1;
                        foreach ($tourism_offerings as $offering ):
                            if($i % 2 === 1 && count($tourism_offerings) > 1) 
                                echo '<div class="row">';
                     ?>
                    <div class="span4">
                        <img 
                            src="<?php echo base_url($offering->get("offering_img_url")) ?>" 
                            class="img-rounded" 
                            alt="<?php echo $offering->get('offering_abbr')?>"
                        >
                        <h4><?php echo $offering->get('offering_title')?></h4>
                        <p><?php echo $offering->get('offering_description')?></p>
                        <p><?php echo $offering->get('offering_time');?></p>
                        <h4>$ <?php echo $offering->get('offering_price');?></h4>   
                    </div>
                    <?php 
                        if ($i++ % 2 === 0) echo '</div>';
                        endforeach 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
