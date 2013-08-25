<div class="row">
    <div class="span12">
        <legend>Customers on Email List</legend>
    </div>
</div>
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
                    <?php endforeach ?>
                </tr>
            </tbody>
        </table>  
    </div>
</div>