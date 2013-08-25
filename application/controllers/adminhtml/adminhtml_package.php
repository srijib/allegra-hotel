<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Package extends Adminhtml {

    private $data = array();

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['title'] = 'Package';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function package_index() {
        redirect('admin/package/list');
    }

    public function package_list() {
        
        $this->data['title'] = 'All Packages';
        $packages = new Package_collection();
        $packages->loadAll();
        $all_packages = $packages->getAll();
                        
        $this->data['packages'] = $all_packages;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/package/list', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function package_edit($id=NULL) {

        $package = new Package();
        if($id)
        {
            $_SESSION['package_id'] = $id;
            $this->data['package'] = $package->load($id);

            $current_roomtype = $package->load_roomtype($package->get('id'));
            $this->data['current_roomtype'] = $current_roomtype;

            $roomtypes = new Roomtype_collection();
            $roomtypes->loadAll();
            $roomtypes = $roomtypes->getAll();
            $this->data['roomtypes'] = $roomtypes;

            $offerings = new Offering_collection();
            $offerings->loadAll();
            $offerings = $offerings->getAll();
            $this->data['offerings'] = $offerings;

            $this->load->view('adminhtml/include/header', $this->data);
            $this->load->view('adminhtml/package/edit', $this->data);
            $this->load->view('adminhtml/include/footer', $this->data);
        }
        else
        {
            $this->form_validation->set_rules('inputTitle', 'Title', 'required');
            $this->form_validation->set_rules('inputDescription', 'Description', 'required');
            if($this->form_validation->run() === FALSE)
            {
                redirect('admin/package/edit');
            }
            else
            {
                $package_array = array(
                    'package_title' => $this->input->post('inputTitle'),
                    'package_description' => $this->input->post('inputDescription'),
                    'roomtype_id' => $this->input->post('roomtype_id'),
                    'offering_id' => $this->input->post('offering_id')
                );
                $package->load($_SESSION['package_id']);
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
                redirect('admin/package/list');
            }
        }
    }

    public function package_new_redirect() {

        $this->data['title'] = 'All Packages';

        $roomtypes = new Roomtype_collection();
        $roomtypes->loadAll();
        $roomtypes = $roomtypes->getAll();
        $this->data['roomtypes'] = $roomtypes;

        $offerings = new Offering_collection();
        $offerings->loadAll();
        $offerings = $offerings->getAll();
        $this->data['offerings'] = $offerings;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/package/new', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function package_new() {

        $this->form_validation->set_rules('inputTitle', 'Title', 'required');
        $this->form_validation->set_rules('inputDescription', 'Description', 'required');
        if($this->form_validation->run() === FALSE)
        {
            redirect('admin/package/edit');
        }
        else
        {
            $package_array = array(
                'package_title' => $this->input->post('inputTitle'),
                'package_description' => $this->input->post('inputDescription')
            );
            
            $roomtype_id = $this->input->post('roomtype_id');
            $offering_id = $this->input->post('offering_id');

            $package = new Package();
            $package->create($package_array);

            $package->add_roomtype($package->get('id'), intval($roomtype_id));

            $package->save();
            redirect('admin/package/list');
        }
    }

    public function package_delete($id) {
        $package = new Package();
        $package->load($id);

        $package->delete_link($id);
        $package->drop();

        redirect('admin/package/list');
    }
}
