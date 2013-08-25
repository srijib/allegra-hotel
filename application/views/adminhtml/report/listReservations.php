<div class="container">
    <div class="row">
        <div class="span12">
            <legend>Reservation Reports</legend>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <table class="table">
            <thead>                
                <tr class="info">
                    <th>ID</th>
                    <th>CustomerID</th>
                    <th>Customer</th>
                    <th>Room#</th>
                    <th>Roomtype</th>
                    <th>Hotel</th>
                    <th>Offering#</th>
                    <th>Offering Title</th>
                    <th>Quantity</th>
                    <th>Created Time</th>
                    <th>Length</th>
                    <th>Status</th>
                    <th>Review</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($reservations as $r):
                    $reservation_extend = $r->load_room($r->get('id'));
                    $reservation_offerings = $r->load_offering($r->get('id'));
                    $offering_price = 0;
                    foreach($reservation_offerings as $ro)
                    {
                        $offering_price += $r->get_offering_price($r->get('id'), $ro->get('id'));
                    } 
                ?>
                <tr>
                    <td><?php echo $r->get('id') ?></td>
                    <td>
                        <?php 
                            $customer = new Customer();
                            $cus_id = $r->get('customer_id');
                            $customer->load($cus_id);
                            echo  $customer->get('id');
                        ?>
                    </td>
                    <td>
                        <?php 
                            $customer = new Customer();
                            $cus_id = $r->get('customer_id');
                            $customer->load($cus_id);
                            echo  $customer->get('customer_title') . ' ' . $customer->get('customer_fname') . ' ' . $customer->get('customer_lname');
                        ?>
                    </td>
                    <td>
                        <?php 
                            $room = new Room();
                            $room->load($reservation_extend['room_id']);
                            echo $room->get('room_number'); 
                        ?>
                    </td>
                    <td>
                        <?php 
                            $roomtype_id = $room->get('roomtype_id');
                            $roomtype = new Roomtype();
                            $roomtype->load($roomtype_id);
                            echo $roomtype->get('roomtype_type');
                            
                        ?>
                    </td>
                    <td>
                        <?php
                        $hotel = new Hotel();
                        $hotel->load($room->get('hotel_id'));
                        echo $hotel->get('hotel_name');
                         ?>
                    </td>
                    <td class="center">
                        <?php 
                            foreach($reservation_offerings as $ro)
                            {
                                echo $ro->get('id');
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td class="center">
                        <?php 
                            foreach($reservation_offerings as $ro)
                            {
                                echo $ro->get('offering_title');
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td class="center">
                        <?php 
                            foreach($reservation_offerings as $ro)
                            {
                                echo $r->get_offering_quantity($r->get('id'), $ro->get('id'));
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td><?php echo $r->get('create_time') ?></td>
                    <td>
                        <?php
                            $resDates = $r->load_dates($r->get('id'));
                            $noOfDates = count($resDates);
                            echo $noOfDates; ?>
                    </td>
                    <td><?php echo $r->get('status') ?></td>
                    <td><?php echo $r->get('review') ?></td>
                    <td>
                        <?php
                        $reservation = $r->load_room($r->get('id'));
                        $price = $offering_price  + $roomtype->get('roomtype_price') * $noOfDates;
                        echo '$ '. $price;
                         ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
            </table> 
        </div>
    </div>
</div>