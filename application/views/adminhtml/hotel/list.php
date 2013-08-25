<div class="container">
    <div class="row">
        <div class="span12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <?php
                    foreach ($hotels as $h):
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $h->get('id') ?></td>
                        <td><?php echo $h->get('hotel_name') ?></td>
                        <td><?php echo $h->get('hotel_location') ?></td>
                        <td><a href="<?php echo site_url('admin/hotel/edit/'.$h->get("id"))?>" class="btn btn-primary">Detail</a></td>
                        <!-- <td><a href="<?php echo site_url('admin/hotel/delete/'.$h->get("id"))?>" class="btn btn-danger" onclick="return deleteAlert()">Delete</a></td> -->
                        <script>
                            /*function deleteAlert()
                            {
                                if(confirm("Are you sure you want to delete this hotel?"))
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
        <?php echo 'Totally ' . count($hotels) . ' records.' ?>
        <a href="<?php echo site_url('admin/hotel/new_redirect')?>" class="btn btn-primary btn-medium pull-right">Add New hotel</a>
    </div>
</div>