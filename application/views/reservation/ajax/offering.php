<div id="res-select-offering"  data-step="2" class="span9">
    <div class="accordion" id="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading">
                <h4>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    Movies</a>
                </h4>
            </div>
            <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                <?php 
                    $i = 1;
                    foreach ($movie_offerings as $offering):
                        if ($i % 2 === 1) echo '<div class="row">';
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
                                <select class="input-mini">
                                    <?php for($j = 1; $j <= 10; $j++): ?>
                                        <option><?php echo $j?></option>
                                    <?php endfor ?>
                                </select>
                                <span data-opt="add_offering" data-id="<?php echo $offering->get('id');?>" class="btn btn-primary">Add</span>   
                            </div>
                <?php 
                        if ($i++ % 2 === 0) echo '</div>';
                    endforeach 
                ?>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <h4><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                Sports</a></h4>
                
            </div>
            <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner">
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
                    <select class="input-mini">
                        <?php for($j = 1; $j <= 10; $j++): ?>
                            <option><?php echo $j?></option>
                        <?php endfor ?>
                    </select>
                    <span data-opt="add_offering" data-id="<?php echo $offering->get('id');?>" class="btn btn-primary">Add</span>   
                </div>
                <?php 
                    if ($i++ % 2 === 0) echo '</div>';
                    endforeach 
                ?>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <h4><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                Culture Events</a></h4>
            </div>
            <div id="collapseThree" class="accordion-body collapse">
                <div class="accordion-inner">
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
                    <select class="input-mini">
                        <?php for($j = 1; $j <= 10; $j++): ?>
                            <option><?php echo $j?></option>
                        <?php endfor ?>
                    </select>
            <span data-opt="add_offering" data-id="<?php echo $offering->get('id');?>" class="btn btn-primary">Add</span>   
                </div>
                <?php 
                    if ($i++ % 2 === 0) echo '</div>';
                    endforeach 
                ?>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <h4><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                Tourism</a></h4>
            </div>
            <div id="collapseFour" class="accordion-body collapse">
                <div class="accordion-inner">
                <?php 
                    $i = 1;
                    foreach ($tourism_offerings as $offering):
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
                    <select class="input-mini">
                        <?php for($j = 1; $j <= 10; $j++): ?>
                            <option><?php echo $j?></option>
                        <?php endfor ?>
                    </select>
            <span data-opt="add_offering" data-id="<?php echo $offering->get('id');?>" class="btn btn-primary">Add</span>   
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
