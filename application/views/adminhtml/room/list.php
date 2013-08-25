<div class="container">
    <div class="row">
        <div class="span12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hotel</th>
                        <th>Room Type</th>
                        <th>Class</th>
                        <th>Size(m^2)</th>
                        <th>Maxium People</th>
                        <th>Base Price</th>
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rooms as $id=>$value):
                    ?>
                    <tr>
                        <td><?php echo $value['room_#'] ?></td>
                        <td><?php echo $value['hotel'] ?></td>
                        <td><?php echo $value['roomtype'] ?></td>
                        <td><?php echo $value['class'] ?></td>
                        <td><?php echo $value['size'] ?></td>
                        <td><?php echo $value['numOfPeople'] ?></td>
                        <td>$ <?php echo $value['price'] ?> /night</td>
                        <td><a href="<?php echo site_url('admin/room/edit/'.$id)?>" class="btn btn-primary btn-medium">Detail</a></td>
                        <!-- <td><a href="<?php echo site_url('admin/room/delete/'.$id)?>" class="btn btn-danger btn-medium" onclick="return deleteAlert()">Delete</a></td> -->
                        <script>
                            /*function deleteAlert()
                            {
                                if(confirm("Are you sure you want to delete this offering?"))
                                    return true;
                                else
                                    return false;
                            }*/
                        </script>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>  
        </div>
    </div>
    <div class="row">
        <?php echo 'Totally ' . count($rooms) . ' records.' ?>
        <a href="<?php echo site_url('admin/room/new_redirect')?>" class="btn btn-primary btn-medium pull-right">Add New Room</a>
    </div>
</div>