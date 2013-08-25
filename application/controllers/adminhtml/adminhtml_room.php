<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Room extends Adminhtml
{
    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['title'] = 'Room';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function room_index()
    {
        redirect('admin/room/list');
    }

    public function room_list() 
    {
        $room_collection = new Room_collection();
        $room_collection->loadAll();
        $rooms = $room_collection->getAll();

        $all_rooms = array();
        foreach($rooms as $room)
        {
            $hotel = new Hotel();
            $hotel->load($room->get('hotel_id'));
            $roomtype = new Roomtype();
            $roomtype->load($room->get('roomtype_id'));
            $all_rooms[$room->get('id')] = array(
                'room_#' => $room->get('room_number'),
                'hotel' => $hotel->get('hotel_name'),
                'roomtype' => $roomtype->get('roomtype_type'),
                'class' => $roomtype->get('roomtype_class'),
                'size' => $roomtype->get('roomtype_size'),
                'numOfPeople' => $roomtype->get('roomtype_numOfPeople'),
                'price' => $roomtype->get('roomtype_price')
            );
        }

        $this->data['rooms'] = $all_rooms;
        $this->data['title'] = 'Rooms';

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/room/list', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function room_edit($id=NULL) {
        
        $room = new Room();
        $current_hotel = new Hotel();
        $current_roomtype = new Roomtype();
        if($id)
        {
            $_SESSION['room_id'] = $id;
            $this->data['room'] = $room->load($id);

            $current_hotel->load($room->get('hotel_id'));
            $this->data['current_hotel'] = $current_hotel;

            $hotel_cl = new Hotel_collection();
            $hotel_cl->loadAll();
            $hotels = $hotel_cl->getAll();
            $this->data['hotels'] = $hotels;
            
            $current_roomtype->load($room->get('roomtype_id'));
            $this->data['current_roomtype'] = $current_roomtype;

            $roomtype_cl = new Roomtype_collection();
            $roomtype_cl->loadAll();
            $roomtypes = $roomtype_cl->getAll();
            $this->data['roomtypes'] = $roomtypes;

            $this->load->view('adminhtml/include/header', $this->data);
            $this->load->view('adminhtml/room/edit', $this->data);
            $this->load->view('adminhtml/include/footer', $this->data);
        }
        else
        {
            $this->form_validation->set_rules('inputRoom', 'Room$', 'required');

            if($this->form_validation->run() === FALSE)
            {
                redirect('admin/room/list');
            }
            else
            {
                $room_array = array(
                    'room_number' => $this->input->post('inputRoom'),
                    'hotel_id' => $this->input->post('hotel_id'),
                    'roomtype_id' => $this->input->post('roomtype_id')
                ); 
                $room->load($_SESSION['room_id']);

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
                redirect('admin/room/list');
            }
        } 
    }

    public function room_new_redirect()
    {
        $this->data['title'] = 'All Rooms';

        $hotel_cl = new Hotel_collection();
        $hotel_cl->loadAll();
        $hotels = $hotel_cl->getAll();
        $this->data['hotels'] = $hotels;

        $roomtype_cl = new Roomtype_collection();
        $roomtype_cl->loadAll();
        $roomtypes = $roomtype_cl->getAll();
        $this->data['roomtypes'] = $roomtypes;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/room/new', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function room_new()
    {
        $this->form_validation->set_rules('inputRoom', 'Room$', 'required');

        if($this->form_validation->run() === FALSE)
        {
            redirect('admin/room/list');
        }
        else
        {
            $room_array = array(
                'room_number' => $this->input->post('inputRoom'),
                'hotel_id' => $this->input->post('hotel_id'),
                'roomtype_id' => $this->input->post('roomtype_id')
            );
            var_dump($room_array);
            $hotel_id = $room_array['hotel_id'];
            $roomtype_id = $room_array['roomtype_id'];

            $room = new Room();
            $room->create(intval($hotel_id), intval($roomtype_id), intval($room_array['room_number']));

            redirect('admin/room/list');
        }
    }

    public function room_delete($id=NULL)
    {
        $room = new Room();
        $room->load($id);
        $room->drop();
        redirect('admin/room/list');
    }
}
