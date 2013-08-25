<?php if (!defined('BASEPATH')) die();

class Ajax extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function saveCustomer() {
        $cus_array = array(
            'customer_username' => $this->input->post('inputUsername'),
            'customer_password' => md5($this->input->post('inputPassword')),
            'customer_email' => $this->input->post('inputEmail'),
            'customer_title' => $this->input->post('inputTitle'),
            'customer_fname' => $this->input->post('inputFname'),
            'customer_lname' => $this->input->post('inputLname'),
            'customer_phone' => $this->input->post('inputPhone'),
            'customer_country' => $this->input->post('inputCountry'),
            'customer_state' => $this->input->post('inputState'),
            'customer_city' => $this->input->post('inputCity'),
            'customer_address' => $this->input->post('inputAddress')
            );       

        $customer = new Customer();
        $customer->load(logged_in_id());

        if($customer->get('customer_username') !== $cus_array['customer_username'])
        { $customer->set('customer_username', $cus_array['customer_username']); }

        if($customer->get('customer_email') !== $cus_array['customer_email'])
        { $customer->set('customer_email', $cus_array['customer_email']); }

        if($customer->get('customer_title') !== $cus_array['customer_title'])
        { $customer->set('customer_title', $cus_array['customer_title']); }

        if($customer->get('customer_fname') !== $cus_array['customer_fname'])
        { $customer->set('customer_fname', $cus_array['customer_fname']); }

        if($customer->get('customer_lname') !== $cus_array['customer_lname'])
        { $customer->set('customer_lname', $cus_array['customer_lname']); }

        if($customer->get('customer_phone') !== $cus_array['customer_phone'])
        { $customer->set('customer_phone', $cus_array['customer_phone']); }

        if($customer->get('customer_country') !== $cus_array['customer_country'])
        { $customer->set('customer_country', $cus_array['customer_country']); }

        if($customer->get('customer_state') !== $cus_array['customer_state'])
        { $customer->set('customer_state', $cus_array['customer_state']); }

        if($customer->get('customer_city') !== $cus_array['customer_city'])
        { $customer->set('customer_city', $cus_array['customer_city']); }

        if($customer->get('customer_address') !== $cus_array['customer_address'])
        { $customer->set('customer_address', $cus_array['customer_address']); }

        $customer->save();
    }

    public function editCustomer($id=NULL) {
        $cus_array = array(
            'customer_username' => $this->input->post('inputUsername'),
            'customer_email' => $this->input->post('inputEmail'),
            'customer_title' => $this->input->post('inputTitle'),
            'customer_fname' => $this->input->post('inputFname'),
            'customer_lname' => $this->input->post('inputLname'),
            'customer_phone' => $this->input->post('inputPhone'),
            'customer_country' => $this->input->post('inputCountry'),
            'customer_state' => $this->input->post('inputState'),
            'customer_city' => $this->input->post('inputCity'),
            'customer_address' => $this->input->post('inputAddress')
            );       

        $customer = new Customer();
        $customer->load($id);

        if($customer->get('customer_username') !== $cus_array['customer_username'])
        { $customer->set('customer_username', $cus_array['customer_username']); }

        if($customer->get('customer_email') !== $cus_array['customer_email'])
        { $customer->set('customer_email', $cus_array['customer_email']); }

        if($customer->get('customer_title') !== $cus_array['customer_title'])
        { $customer->set('customer_title', $cus_array['customer_title']); }

        if($customer->get('customer_fname') !== $cus_array['customer_fname'])
        { $customer->set('customer_fname', $cus_array['customer_fname']); }

        if($customer->get('customer_lname') !== $cus_array['customer_lname'])
        { $customer->set('customer_lname', $cus_array['customer_lname']); }

        if($customer->get('customer_phone') !== $cus_array['customer_phone'])
        { $customer->set('customer_phone', $cus_array['customer_phone']); }

        if($customer->get('customer_country') !== $cus_array['customer_country'])
        { $customer->set('customer_country', $cus_array['customer_country']); }

        if($customer->get('customer_state') !== $cus_array['customer_state'])
        { $customer->set('customer_state', $cus_array['customer_state']); }

        if($customer->get('customer_city') !== $cus_array['customer_city'])
        { $customer->set('customer_city', $cus_array['customer_city']); }

        if($customer->get('customer_address') !== $cus_array['customer_address'])
        { $customer->set('customer_address', $cus_array['customer_address']); }
        
        $customer->save();
    }

    public function saveHotel($id=NULL) {
        
        $hotel = new Hotel();
        
        $hotel_array = array(
            'hotel_name' => $this->input->post('inputName'),
            'hotel_location' => $this->input->post('inputLocation'),
            'hotel_description' => $this->input->post('inputDescription')
        );
            
        $hotel->load($id);

        if($hotel->get('hotel_name') !== $hotel_array['hotel_name'])
        {
            $hotel->set('hotel_name', $hotel_array['hotel_name']);
        }
        if($hotel->get('hotel_location') !== $hotel_array['hotel_location'])
        {
            $hotel->set('hotel_location', $hotel_array['hotel_location']);
        }
        if($hotel->get('hotel_description') !== $hotel_array['hotel_description'])
        {
            $hotel->set('hotel_description', $hotel_array['hotel_description']);
        }

        $hotel->save();
    }

    public function saveOffering($id=NULL) 
    {
        
        $offering = new Offering();
        $offering_array = array(
            'offering_title' => $this->input->post('inputTitle'),
            'offering_description' => $this->input->post('inputDescription'),
            'offering_type' => $this->input->post('inputType'),
            'offering_price' => $this->input->post('inputPrice'),
            'offering_time' => $this->input->post('inputDateTime'),
            'offering_abbr' => $this->input->post('inputAbbr'),
            'offering_img_url' => $this->input->post('inputImgurl')
        );
        $offering->load($id);

        if($offering->get('offering_title') !== $offering_array['offering_title'])
        {
            $offering->set('offering_title', $offering_array['offering_title']);
        }
        if($offering->get('offering_description') !== $offering_array['offering_description'])
        {
            $offering->set('offering_description', $offering_array['offering_description']);
        }
        if($offering->get('offering_type') !== $offering_array['offering_type'])
        {
            $offering->set('offering_type', $offering_array['offering_type']);
        }
        if($offering->get('offering_price') !== $offering_array['offering_price'])
        {
            $offering->set('offering_price', $offering_array['offering_price']);
        }
        if($offering->get('offering_time') !== $offering_array['offering_time'])
        {
            $offering->set('offering_time', $offering_array['offering_time']);
        }
        if($offering->get('offering_abbr') !== $offering_array['offering_abbr'])
        {
            $offering->set('offering_abbr', $offering_array['offering_abbr']);
        }
        if($offering->get('offering_img_url') !== $offering_array['offering_img_url'])
        {
            $offering->set('offering_img_url', $offering_array['offering_img_url']);
        }

        $offering->save();
    }

    public function saveRoom($id=NULL) {
        
        $room = new Room();
        $room_array = array(
                'room_number' => $this->input->post('inputRoom'),
                'hotel_id' => $this->input->post('hotel_id'),
                'roomtype_id' => $this->input->post('roomtype_id')
            ); 
        $room->load($id);

        if($room->get('room_number') !== $room_array['room_number'])
        {
            $room->set('room_number', $room_array['room_number'], $room->get('id'));
        }
        if($room->get('hotel_id') != $room_array['hotel_id'])
        {
            $room->set('hotel_id', intval($room_array['hotel_id']), $room->get('id'));
        }
        if($room->get('roomtype_id') != $room_array['roomtype_id'])
        {
            $room->set('roomtype_id', intval($room_array['roomtype_id']), $room->get('id'));
        }

        $room->save();
    }

    public function savePackage($id=NULL) {
        
        $package = new Package();
        $offerings = new Offering_collection();
        $offerings->loadAll();
        $offerings = $offerings->getAll();
        $selectedOfferings = new Offering_collection();

        $package_array = array(
            'package_title' => $this->input->post('inputTitle'),
            'package_description' => $this->input->post('inputDescription'),
            'roomtype_id' => $this->input->post('roomtype_id'),
            'offering_id' => $this->input->post('offering_id')
        );
        $package->load($id);
        $package_offerings = $package->load_offering($package->get('id'));
        $i = 1;
        $j = 1;
        //var_dump($this->input->post('quantity'.$i));
        for($i = 1; $i <= count($package_offerings); $i++)
        {
            foreach($offerings as $offering)
            {
                var_dump($this->input->post('offering'.$i));
                if($offering->get('id') == $this->input->post('offering'.$i))
                {
                    $selectedOfferings->append($offering);
                    
                }
            }
        }
        foreach($selectedOfferings as $offering)
        {
            $old_offering = $package_offerings[$j-1];
            $package->change_offering($package->get('id'), $old_offering->get('id'), $offering->get('id'), intval($this->input->post('quantity'.$j)));
            $j++;
        }
        
        $selectedOfferings = $selectedOfferings->getAll();
        //var_dump($selectedOfferings);

        if($package->get('package_title') !== $package_array['package_title'])
        {
            $package->set('package_title', $package_array['package_title']);
        }
        if($package->get('package_description') !== $package_array['package_description'])
        {
            $package->set('package_description', $package_array['package_description']);
        }
        $current_roomtype = $package->load_roomtype($package->get('id'));
        if($current_roomtype->get('id') != $package_array['roomtype_id'])
        {
            $package->change_roomtype($package->get('id'), intval($package_array['roomtype_id']));
        }

        $package->save();
        //$package->save($id);
    }

    public function saveReservation()
    {
        
    }

    public function saveAdmin($id=NULL)
    {
        $admin = new Room();
        $new_username = $this->input->post('inputUsername');
        $admin->load($id);

        if($admin->get('admin_username') !== $new_username)
        {
            $admin->set('admin_username', $new_username);
        }
        $admin->save();
    }
}
