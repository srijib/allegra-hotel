<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Reservation
{
    protected $id = NULL;

    protected $reservation = array();
    protected $reservation_extend = array();
    protected $valid_offerings = array();
    protected $offering_quantity;
    protected $offering_price;
    protected $room;
    protected $resDates = array();

    static public function create() {

        $customer_id = $_SESSION['customer']['cus_id'];
        $cart        = $_SESSION['cart'];
        $payment     = $_SESSION['payment'];
        $time        = date('Y-m-d H:i:s');

        $CI = & get_instance();
        $CI->load->database();

        // create reservation
        $query = $CI->db->query("
            INSERT INTO `reservation`(`reservation_id`, `customer_id`, `create_time`, `status`, `review`)
            VALUES (NULL, $customer_id, '$time', 'reserved', '0')
        ");
        $insert_id = $CI->db->insert_id();

        // create reservation_has_offering
        foreach ($cart['offering'] as $o_id=>$o_qty) {

            $offering = new Offering();
            $offering->load($o_id);

            $o_price = $offering->get('offering_price');
            $o_price_all = $o_price * $o_qty;

            $query2 = $CI->db->query("
                INSERT INTO `reservation_has_offering`(`reservation_id`, `offering_id`, `quantity`, `price`)
                VALUES ($insert_id, $o_id, $o_qty, $o_price_all)
            ");
        }

        // create reservation_has_room
        $res_array = get_reservation_room_array($cart['hotel'], $cart['roomtype'],
            $cart['no_of_room'],$cart['check_in'], $cart['check_out']);

        foreach ($res_array as $res) {
            $CI->db->query("
                INSERT INTO `reservation_has_room`(`reservation_id`, `room_id`, `reserve_date`, `price`)
                VALUES ($insert_id,".$res['room_id'].",'".date('Y-m-d H:i:s', $res['date'])."',".$res['price'].")
            ");
        }
        
        // create payment information
        $pay_type = $_SESSION['payment']['type'];
        $CI->db->query("
            INSERT INTO `payment`(`payment_id`, `reservation_id`, `use_id`, `payment_time`, `payment_method`, `status`)
            VALUES (NULL,$insert_id,NULL,'$time','$pay_type','complete')
        ");
    }

    //return room collection
    public function searchRoom($dest, $in_date_raw, $out_date_raw, $no_of_room) {

        $all_dates = get_date_range_array($in_date_raw, $out_date_raw);

        $rc = new Room_collection();
        $rc->loadAll();

        $type_count = array();

        foreach ($rc->rooms as $room) {

            $valid = true;

            //check location
            if ($room->get('hotel_id') != $dest) {
                $valid = false;
            }
            
            //check date
            foreach ($all_dates as $one_date) {
                if (!Reservation_room::check($room->get('id'), $one_date)) 
                    $valid = false;
            }

            if (!$valid) {
                $rc->drop($room->get('id'));
            } else {
                //add room to count
                $type = $room->get('roomtype_id');
                if (isset($type_count[$type])) {
                    $type_count[$type] += 1;
                } else {
                    $type_count[$type] = 1;
                }
            }
        }

        //check number of rooms
        if (!empty($type_count)) {
            foreach ($type_count as $i=>$c) {
                if ($no_of_room > $c) {
                    foreach ($rc->rooms as $room) {
                        if ($room->get('roomtype_id') == $i)
                            $rc->drop($room->get('id'));
                    }
                }
            }            
        }

        return $rc;
    }

    public function searchRoomType($dest, $in_date_raw, $out_date_raw, $no_of_room) {
        $rc = $this->searchRoom($dest, $in_date_raw, $out_date_raw, $no_of_room);

        $type_count = array();

        foreach ($rc->getAll() as $room) {
            $type = $room->get('roomtype_id');
            if (isset($type_count[$type])) {
                $type_count[$type] += 1;
            } else {
                $type_count[$type] = 1;
            }           
        }

        return $type_count;
    }

    function load($id) {
        if ($this->id !== NULL) {
            trigger_error("You must have an empty Object to run load.", E_USER_ERROR);
            exit();
        }
        
        $this->id = intval($id);

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT reservation_id, customer_id, create_time, status, review
            FROM reservation
            WHERE reservation_id = ' . $id . '
        ');

        foreach ($query->result() as $row) {
            $this->reservation[$row->reservation_id] = $row->reservation_id;
            $this->reservation['reservation_id'] = $row->customer_id;
            $this->reservation['customer_id'] = $row->customer_id;
            $this->reservation['create_time'] = $row->create_time;
            $this->reservation['status'] = $row->status;
            $this->reservation['review'] = $row->review;
        }

        return $this;
    }

    function get($key) {
        if ($key === 'id')
            return $this->id;
        else
            return $this->reservation[$key];
    }

    /**
    * Load offerings that related to this reservation
    */
    function load_offering($reservation_id = NULL)
    {
        if ($reservation_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT reservation_has_offering.*
            FROM reservation_has_offering
            WHERE 
                reservation_id = ' . $reservation_id . '
        ');
     
        $offering_collection = new Offering_collection();
        $offering_collection->loadAll();
        $offerings = $offering_collection->getAll();

        $valid_offerings_cl = new Offering_collection();

        foreach($query->result() as $row)
        {
            foreach($offerings as $offering)
            {
                if($offering->get('id') == $row->offering_id)
                {
                    $valid_offerings_cl->append($offering);
                }    
            }
        }
   
        $this->valid_offerings = $valid_offerings_cl->getAll();
        return $this->valid_offerings;
    }

    /**
    * Get the quantity of a offering in the reservation
    */
    function get_offering_quantity($reservation_id = NULL, $offering_id = NULL){
        if ($reservation_id === NULL || $offering_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT reservation_has_offering.*
            FROM reservation_has_offering
            WHERE 
                reservation_id = ' . $reservation_id . ' AND
                offering_id = ' . $offering_id . '
        ');

        foreach($query->result() as $row)
        {
            $this->offering_quantity = $row->quantity;
        }
        return $this->offering_quantity;
    }

    /**
    * Get the price of a offering in the reservation
    */
    function get_offering_price($reservation_id = NULL, $offering_id = NULL){
        if ($reservation_id === NULL || $offering_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT reservation_has_offering.*
            FROM reservation_has_offering
            WHERE 
                reservation_id = ' . $reservation_id . ' AND
                offering_id = ' . $offering_id . '
        ');

        foreach($query->result() as $row)
        {
            $this->offering_price = $row->price;
        }
        return $this->offering_price;
    }

    /**
    * Load room that related to this reservation
    */
    function load_room($reservation_id = NULL)
    {
        if ($reservation_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT reservation_has_room.*
            FROM reservation_has_room
            WHERE 
                reservation_id = ' . $reservation_id . '
        ');

        foreach ($query->result() as $row) {
            $this->reservation[$row->reservation_id] = $row->reservation_id;
            $this->reservation['room_id'] = $row->room_id;
            $this->reservation['reserve_date'] = $row->reserve_date;
            $this->reservation['room_price'] = $row->price;
        }
        return $this->reservation;
    }


    function load_dates($reservation_id = NULL)
    {
        if ($reservation_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT reservation_has_room.*
            FROM reservation_has_room
            WHERE 
                reservation_id = ' . $reservation_id . '
        ');

        foreach($query->result() as $row)
        {
            array_push($this->resDates, $row->reserve_date);
        }
        return $this->resDates;
    }

    function drop($reservation_id = NULL)
    {
        if ($reservation_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query1 = $CI->db->query('
            DELETE reservation_has_offering.*
            FROM reservation_has_offering
            WHERE reservation_has_offering.reservation_id = ' . $reservation_id . '
        ');

        $query2 = $CI->db->query('
            DELETE reservation_has_room.*
            FROM reservation_has_room
            WHERE reservation_has_room.reservation_id = ' . $reservation_id . '
        ');

        $query3 = $CI->db->query('
            DELETE payment.*
            FROM payment
            WHERE payment.reservation_id = ' . $reservation_id . '
        ');

        $query4 = $CI->db->query('
            DELETE reservation.*
            FROM reservation
            WHERE reservation.reservation_id = ' . $reservation_id . '
        ');
    }
}
