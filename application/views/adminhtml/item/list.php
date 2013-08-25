<div class="container">
    <div class="row">
        <div class="span12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <?php
                    foreach ($items as $i):
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $i->get('id') ?></td>
                        <td><?php echo $i->get('item_type') ?></td>
                        <td><?php echo $i->get('item_price') ?></td>
                        <td><?php echo $i->get('item_description') ?></td>
                        <td><a href="<?php echo site_url('admin/item/edit/'.$i->get("id"))?>" class="btn btn-primary">Detail</a></td>
                        <!-- <td><a href="<?php echo site_url('admin/item/delete/'.$i->get("id"))?>" class="btn btn-danger" onclick="return deleteAlert()">Delete</a></td> -->
                        <script>
                            /*function deleteAlert()
                            {
                                if(confirm("Are you sure you want to delete this item?"))
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
        <?php echo 'Totally ' . count($items) . ' records.' ?>
        <a href="<?php echo site_url('admin/item/new_redirect')?>" class="btn btn-primary btn-medium pull-right">Add New item</a>
    </div>
</div>