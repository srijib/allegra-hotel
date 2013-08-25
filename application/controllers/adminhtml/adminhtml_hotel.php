<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Hotel extends Adminhtml
{
    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['title'] = 'Hotel';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function hotel_index() {
        redirect('admin/hotel/list');
    }

    public function hotel_list() {
        
        $this->data['title'] = 'Hotels';
        $hotels = new Hotel_collection();
        $hotels->loadAll();
        $all_hotels = $hotels->getAll();

        $this->data['hotels'] = $all_hotels;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/hotel/list', $this->data);
        $this->load->view('adminhtml/include/footer');
    }

    public function hotel_edit($id=NULL) {
        
        $hotel = new Hotel();
        if($id)
        {
            $_SESSION['hotel_id'] = $id;
            $this->data['hotel'] = $hotel->load($id);

            $this->load->view('adminhtml/include/header', $this->data);
            $this->load->view('adminhtml/hotel/edit', $this->data);
            $this->load->view('adminhtml/include/footer', $this->data);
        }
        else
        {
            $this->form_validation->set_rules('inputName', 'Hotel Name', 'required');
            $this->form_validation->set_rules('inputLocation', 'Location', 'required');
            $this->form_validation->set_rules('inputDescription', 'Description', 'required');

            if($this->form_validation->run() === FALSE)
            {
                redirect('admin/hotel/list');
            }
            else
            {
                $hotel_array = array(
                    'hotel_name' => $this->input->post('inputName'),
                    'hotel_location' => $this->input->post('inputLocation'),
                    'hotel_description' => $this->input->post('inputDescription')
                );
                
                $hotel->load($_SESSION['hotel_id']);

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
                redirect('admin/hotel/list');
            }
        } 
    }

    public function hotel_new_redirect() {

        $this->data['title'] = 'All Hotels';

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/hotel/new', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function hotel_new() {
            
        $this->form_validation->set_rules('inputName', 'Hotel Name', 'required');
        $this->form_validation->set_rules('inputLocation', 'Location', 'required');
        $this->form_validation->set_rules('inputDescription', 'Description', 'required');

        if($this->form_validation->run() === FALSE)
        {
            redirect('admin/hotel/list');
        }
        else
        {
            $hotel_array = array(
                'hotel_name' => $this->input->post('inputName'),
                'hotel_location' => $this->input->post('inputLocation'),
                'hotel_description' => $this->input->post('inputDescription')
            );

            $hotel = new Hotel();
            $hotel->create($hotel_array);
            $hotel->save();

            redirect('admin/hotel/list');
        }
    }

    public function hotel_delete($id) {

        $hotel = new Hotel();
        $hotel->load($id);
        $hotel->drop();
        redirect('admin/hotel/list');
    }

    public function hotel_save() {
    
    }
}