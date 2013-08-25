<?php 
    $package = $package_details[0];
?>
<div class="span6">
    <h4><?php echo $package->get('package_title')?></h4>
    <p><?php echo $package->get('package_description')?></p>
</div>

<?php 
    $i = 1;
    foreach ($package_details[1] as $offering):
        if($i % 2 === 1) echo '<div class="row">';
?>
<div class="span6">
    <img 
        src="<?php echo base_url($offering->get("offering_img_url")) ?>" 
        class="img-rounded" 
        alt="<?php echo $offering->get('offering_abbr')?>"
    >
    <h4><?php echo $offering->get('offering_title')?></h4>
    <p><?php echo $offering->get('offering_description')?></p>
    <a href="<?php echo $offering->get('offering_link_url')?>">More</a>
</div>
<?php 
    if ($i++ % 2 === 0) echo '</div>';
    endforeach 
?>
