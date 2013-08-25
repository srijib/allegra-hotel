<div class="container">
    <div class="row">
        <div class="span12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Date &amp; Time</th>
                        <th>Price</th>
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <?php
                    foreach ($offerings as $of):
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $of->get('id') ?></td>
                        <td><?php echo $of->get('offering_title') ?></td>
                        <td><?php echo $of->get('offering_type') ?></td>
                        <td><?php echo $of->get('offering_time') ?></td>
                        <td>$ <?php echo $of->get('offering_price') ?></td>
                        <td><a href="<?php echo site_url('admin/offering/edit/'.$of->get("id"))?>" class="btn btn-primary btn-medium">Detail</a></td>
                        <!-- <td><a href="<?php echo site_url('admin/offering/delete/'.$of->get("id"))?>" class="btn btn-danger btn-medium" onclick="return deleteAlert()">Delete</a></td> -->
                        <script>
                            /*function deleteAlert()
                            {
                                if(confirm("Are you sure you want to delete this offering?"))
                                    return true;
                                else
                                    return false;
                            }*/
                        </script>
                        <?php endforeach ?>
                    </tr>
                </tbody>
            </table>  
        </div>
    </div>
    <div class="row">
        <?php echo 'Totally ' . count($offerings) . ' records.' ?>
        <a href="<?php echo site_url('admin/offering/new_redirect')?>" class="btn btn-primary btn-medium pull-right">Add New offering</a>
    </div>
</div>