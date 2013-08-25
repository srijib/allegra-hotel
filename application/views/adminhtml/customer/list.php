<div class="container">
    <div class="row">
        <div class="span12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>username</th>
                        <th>email</th>
                        <th>title</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <!-- <th>
                            <form name="email_filter" action="<?php echo base_url('admin/customer/list') ?>" method="post">
                                <input name="email_filter_checkbox" type="checkbox" value="1">
                                Show customers on email list.
                                <input type="submit" value="Refresh" class="btn" />
                            </form>
                        </th> -->
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <?php
                    foreach ($customers as $c):
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $c->get('id') ?></td>
                        <td><?php echo $c->get('customer_username') ?></td>
                        <td><?php echo $c->get('customer_email') ?></td>
                        <td><?php echo $c->get('customer_title') ?></td>
                        <td><?php echo $c->get('customer_fname') ?></td>
                        <td><?php echo $c->get('customer_lname') ?></td>
                        <td><?php echo $c->get('customer_phone') ?></td>
                        <td><?php echo $c->get('customer_country') ?></td>
                        <td><a href="<?php echo site_url('admin/customer/edit/'.$c->get("id"))?>" class="btn btn-primary btn-medium">Detail</a></td>
                        <!-- <td><a href="<?php echo site_url('admin/customer/delete/'.$c->get("id"))?>" class="btn btn-danger btn-medium" onclick="return deleteAlert()">Delete</a></td> -->
                        <script>
                            /*function deleteAlert()
                            {
                                if(confirm("Are you sure you want to delete this customer?"))
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
        <?php echo 'Totally ' . count($customers) . ' records.' ?>
        <a href="<?php echo site_url('admin/customer/new_redirect')?>" class="btn btn-primary btn-medium pull-right">Add New Customer</a>
    </div>
</div>