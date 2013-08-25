<div class="container">
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
                    <th></th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($packages as $p):
                        $package_offerings = $p->load_offering($p->get('id'));
                ?>
                <tr>
                    <td><?php echo $p->get('id') ?></td>
                    <td><?php echo $p->get('package_title') ?></td>
                    <td>
                        <?php 
                        $roomtype = $p->load_roomtype($p->get('id'));
                        echo $roomtype->get('roomtype_type') . ' ' . $roomtype->get('roomtype_class');
                        ?>
                    </td>
                    <td class="center">
                        <?php 
                            foreach ($package_offerings as $pf)
                            {
                                echo $pf->get('id');
                                echo "<br>";
                            }  
                        ?>
                    </td>
                    <td class="center">
                        <?php 
                            foreach ($package_offerings as $pf)
                            {
                                echo $pf->get('offering_title');
                                echo "<br>";
                            }  
                        ?>
                    </td>
                    <td class="center">
                        <?php 
                            foreach ($package_offerings as $pf)
                            {
                                echo $p->get_offering_quantity($p->get('id'), $pf->get('id'));
                                echo "<br>";
                            }  
                        ?>
                    </td>
                    <td><a href="<?php echo site_url('admin/package/edit/'.$p->get("id"))?>" class="btn btn-primary btn-medium">Detail</a></td>
                    <!-- <td><a href="<?php echo site_url('admin/package/delete/'.$p->get("id"))?>" class="btn btn-danger btn-medium" onclick="return deleteAlert()">Delete</a></td> -->
                </tr>
                <?php endforeach ?>
            </tbody>
            </table> 
            <script>
                function deleteAlert()
                {
                    if(confirm("Are you sure you want to delete this package?"))
                        return true;
                    else
                        return false;
                }
            </script> 
        </div>
    </div>
    <div class="row">
        <?php echo 'Totally ' . count($packages) . ' records.' ?>
        <a href="<?php echo site_url('admin/package/new_redirect')?>" class="btn btn-primary btn-medium-primary pull-right">Add New Package</a>
    </div>
</div>