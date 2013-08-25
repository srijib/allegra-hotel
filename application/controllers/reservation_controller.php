<?php

class Reservation_Controller extends CI_Controller
{
    protected $data = array();

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array(
                'hotel'      => NULL,
                'check_in'   => NULL,
                'check_out'  => NULL,
                'no_of_room' => NULL,
                'roomtype'   => NULL,
                'offering'  => array(),
            );
        }
        $this->data['title'] = "Reservation";
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->data['room_string'] = implode(',',$_POST);
        } else {
            if (isset($_SESSION['cart']))
                $this->data['room_string'] = $_SESSION['cart']['hotel'] . "," .
                                             $_SESSION['cart']['check_in'] . "," .
                                             $_SESSION['cart']['check_out'] . "," .
                                             $_SESSION['cart']['no_of_room'];
        }
        $this->load->view('include/header', $this->data);
        $this->load->view('reservation/index', $this->data);
        $this->load->view('include/footer');
    }

    public function ajax_room() {
        $hotel                          = $_GET['hotel'];
        $checkin                        = $_GET['checkin'];
        $checkout                       = $_GET['checkout'];
        $noOfRoom                       = $_GET['noOfRoom'];

        $_SESSION['cart']['hotel']      = $hotel;
        $_SESSION['cart']['check_in']   = $checkin;
        $_SESSION['cart']['check_out']  = $checkout;
        $_SESSION['cart']['no_of_room'] = $noOfRoom;

        $res = new Reservation();
        $available_rooms = $res->searchRoomType($hotel, $checkin, $checkout, $noOfRoom);
        $this->data['rc'] = $available_rooms;

        $this->load->view('reservation/ajax/room', $this->data);
    }

    public function ajax_add_roomtype($id) {
        $_SESSION['cart']['roomtype'] = $id;
    }

    public function ajax_remove_roomtype() {
        $_SESSION['cart']['roomtype'] = NULL;
    }

    public function ajax_offering() {
        /*$offering_collection = new Offering_collection();
        $offering_collection->loadAll();
        $this->data['offerings'] = $offering_collection->getAll();*/
        $offer_collection = new Offering_collection();
        $offer_collection->loadAll();
        $all_offerings = $offer_collection->getAll();
        $movie_offering_collection = new Offering_collection();
        $sport_offering_collection = new Offering_collection();
        $culture_offering_collection = new Offering_collection();
        $tourism_offering_collection = new Offering_collection();

        foreach($all_offerings as $offering)
        {
            if($offering->get('offering_type') === 'movie')
            {
                $movie_offering_collection->append($offering);
            }
            elseif($offering->get('offering_type') === 'sport')
            {
                $sport_offering_collection->append($offering);
            }
            elseif($offering->get('offering_type') === 'culture')
            {
                $culture_offering_collection->append($offering);
            }
            elseif($offering->get('offering_type') === 'tourism')
            {
                $tourism_offering_collection->append($offering);
            }
        }
        $movie_offerings = $movie_offering_collection->getAll();
        $sport_offerings = $sport_offering_collection->getAll();
        $culture_offerings = $culture_offering_collection->getAll();
        $tourism_offerings = $tourism_offering_collection->getAll();

        $this->data['movie_offerings'] = $movie_offerings;
        $this->data['sport_offerings'] = $sport_offerings;
        $this->data['culture_offerings'] = $culture_offerings;
        $this->data['tourism_offerings'] = $tourism_offerings;

        $this->load->view('reservation/ajax/offering', $this->data);
    }

    public function ajax_add_offering($id, $no) {
        if (isset($_SESSION['cart']['offering'][$id])) {
            $_SESSION['cart']['offering'][$id] += (int)$no;
        } else {
            $_SESSION['cart']['offering'][$id] = (int)$no;
        }
    }

    public function ajax_remove_offering($id) {
        if (isset($_SESSION['cart']['offering'][$id])) {
            unset($_SESSION['cart']['offering'][$id]);
        }
    }

    public function ajax_form() {

        if (is_logged_in()) {
            $cid = logged_in_id();
            $c = new Customer();
            $c->load($cid);
            $this->data['customer'] = $c->getMeta();
        }

        $this->load->view('reservation/ajax/form', $this->data);
    }

    public function ajax_confirm() {
        $this->_load_room_and_offering();
        $postData = $_GET;
        $this->_load_payment($postData);
        $this->load->view('reservation/ajax/confirm', $this->data);
    }

    public function ajax_thankyou() {
        $this->load->view('reservation/ajax/thankyou', $this->data);
    }

    public function ajax_cart() {
        $this->_load_room_and_offering();
        
        $this->load->view('reservation/ajax/cart', $this->data);
    }

    public function ajax_session() {
    
    }

    protected function _load_room_and_offering() {
        //load roomtype
        $roomtype = $_SESSION['cart']['roomtype'];
        $total_room_price = 0;
        if ($roomtype !== NULL) {

            $this->data['roomtype'] = $roomtype;

            $roomtype_price = calculate_roomtype_price(
                $roomtype, $_SESSION['cart']['check_in'], $_SESSION['cart']['check_out'],
                $_SESSION['cart']['no_of_room']
            );
            $this->data['roomtype_price'] = $roomtype_price;
            $total_room_price = $roomtype_price['total_all'];
        }
        else {
            $this->data['roomtype_price'] = 0;
        }

        //load offering
        foreach ($_SESSION['cart']['offering'] as $index=>$qty) {
            if (gettype($index) === 'undefined')
                unset($_SESSION['cart']['offering'][$index]);
        }
        $all_offerings = $_SESSION['cart']['offering'];
        $offerings = array();
        $total_offering_price = 0;
        if (!empty($all_offerings)) {
            foreach ($all_offerings as $o_id=>$qty) {
                $o = new Offering();
                $o->load($o_id);

                $offerings[$o_id] = array(
                    'title'       => $o->get('offering_title'),
                    'qty'         => $qty,
                    'price'       => $o->get('offering_price'),
                    'total_price' => $o->get('offering_price') * $qty,
                );
                $total_offering_price += $o->get('offering_price') * $qty;
            }
        }
        $this->data['offerings'] = $offerings;
        $this->data['price_of_everythig'] = $total_room_price + $total_offering_price;

        if (!isset($this->data['roomtype'])) {
            $this->data['roomtype'] = NULL;
        }

        if (!isset($this->data['offering'])) {
            $this->data['offering'] = NULL;
        }
    }

    protected function _load_payment($postData) {

        $_SESSION['payment']         = array();
        $_SESSION['payment']['type'] = $postData['paymentMethod'];
        if ($_SESSION['payment']['type'] === 'cc') {
            $_SESSION['payment']['cardtp'] = $postData['inputCardType'];
            $_SESSION['payment']['cardno'] = $postData['inputCardNumber'];
            $_SESSION['payment']['holder'] = $postData['inputCardHolder'];
            $_SESSION['payment']['expm']   = $postData['inputExpMonth'];
            $_SESSION['payment']['expy']   = $postData['inputExpYear'];
            $_SESSION['payment']['sec']    = $postData['inputSecCode'];
        } else {
            $_SESSION['payment']['cardno'] = 'N/A';
            $_SESSION['payment']['holder'] = 'N/A';
        }

        $this->data['payment'] = $_SESSION['payment'];
        
    }

    public function create() {
        Reservation::create();
        redirect('reservation/succeeded');
    }

    public function succeeded() {
        $this->load->view('include/header', $this->data);
        $this->load->view('reservation/succeeded');
        $this->load->view('include/footer');
    }

    public function bypackagePost() {
        var_dump($_POST);
        $_SESSION['cart']['hotel']      = 1;
        $_SESSION['cart']['check_in']   = '05-05-2013';
        $_SESSION['cart']['check_out']  = '10-05-2013';
        $_SESSION['cart']['no_of_room'] = 1;
        $this->ajax_add_roomtype($_POST['roomtype']);
        $offerings = explode(',',$_POST['offerings']);
        foreach ($offerings as $oid) {
            $this->ajax_add_offering($oid, 1);
        }
        redirect('reservation');
    }
}
