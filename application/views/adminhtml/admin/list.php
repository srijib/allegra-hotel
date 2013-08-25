<div class="container">
    <div class="row">
        <div class="span12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>admin username</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                    foreach ($admins as $a):
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $a->get('id') ?></td>
                        <td><?php echo $a->get('admin_username') ?></td>
                        <td><a href="<?php echo site_url('admin/admin/edit/'.$a->get("id"))?>" class="btn btn-primary btn-medium">Detail</a></td>
                        <td><a href="<?php echo site_url('admin/admin/delete/'.$a->get("id"))?>" class="btn btn-danger btn-medium" onclick="return deleteAlert()">Delete</a></td>
                        <script>
                            function deleteAlert()
                            {
                                if(confirm("Are you sure you want to delete this customer?"))
                                    return true;
                                else
                                    return false;
                            }
                        </script>
                        <?php endforeach ?>
                    </tr>
                </tbody>
            </table>  
        </div>
    </div>
    <div class="row">
        <?php echo 'Totally ' . count($admins) . ' records.' ?>
        <a href="<?php echo site_url('admin/admin/new_redirect')?>" class="btn btn-primary btn-medium pull-right">Add New System Users</a>
    </div>
</div>