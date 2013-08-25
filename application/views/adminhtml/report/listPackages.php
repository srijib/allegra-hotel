<div class="container">
    <div class="row">
        <div class="span12">
            <legend>Package Report</legend>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <table class="table">
            <thead>                
                <tr class="info">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Accommodation</th>
                    <th>Offering#</th>
                    <th>Offering Title</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($packages as $p):
                        $i = 1;
                        $package_offerings = $p->load_offering($p->get('id'));
                        foreach ($package_offerings as $pf):
                ?>
                <tr>
                    <?php if($i === 1): ?>
                        <td><?php echo $p->get('id') ?></td>
                        <td><?php echo $p->get('package_title') ?></td>
                        <td>
                            <?php 
                            $roomtype = $p->load_roomtype($p->get('id'));
                            echo $roomtype->get('roomtype_type') . ' ' . $roomtype->get('roomtype_class');
                            ?>
                        </td>
                    <?php else : ?>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php endif ?>
                        <td class="center"><?php echo $pf->get('id') ?></td>
                        <td class="center"><?php echo $pf->get('offering_title') ?></td>
                        <td class="center"><?php echo $p->get_offering_quantity($p->get('id'), $pf->get('id')); ?></td>
                    <?php if($i === 1): ?>
                    <?php else : ?>
                    <?php endif ?>
                </tr>
                    <?php
                        $i++;
                        endforeach
                    ?>
                <?php endforeach ?>
            </tbody>
            </table> 
        </div>
    </div>
</div>