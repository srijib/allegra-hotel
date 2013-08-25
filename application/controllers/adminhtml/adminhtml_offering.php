<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Offering extends Adminhtml
{
    private $data = array();

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['title'] = 'Offering';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function offering_index() {
        redirect('admin/offering/list');
    }

    public function offering_list() {
        $this->data['title'] = 'Offerings';
        $offerings = new Offering_collection();
        $offerings->loadAll();
        $all_offerings = $offerings->getAll();

        $this->data['offerings'] = $all_offerings;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/offering/list', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function offering_edit($id=NULL) {
        
        $offering = new Offering();
        $_SESSION['offering_id'] = $id;
        $this->data['offering'] = $offering->load($id);
        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/offering/edit', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function offering_new_redirect() {

        $this->data['title'] = 'All Offerings';

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/offering/new', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function offering_new() {
        
        $this->form_validation->set_rules('inputTitle', 'Title', 'required');
        $this->form_validation->set_rules('inputDescription', 'Description', 'required');
        $this->form_validation->set_rules('inputType', 'Type', 'required');
        $this->form_validation->set_rules('inputPrice', 'Price: &', 'required');
        $this->form_validation->set_rules('inputAbbr', 'Abbreviation', 'required');
        $this->form_validation->set_rules('inputImgurl', 'Img URL', 'required');
        $this->form_validation->set_rules('inputDateTime', 'inputDateTime', 'required');

        if($this->form_validation->run() === FALSE)
        {
            redirect('admin/offering/list');
        }
        else
        {
            $offering_array = array(
                'offering_title' => $this->input->post('inputTitle'),
                'offering_description' => $this->input->post('inputDescription'),
                'offering_type' => $this->input->post('inputType'),
                'offering_price' => $this->input->post('inputPrice'),
                'offering_time' => $this->input->post('inputDateTime'),
                'offering_abbr' => $this->input->post('inputAbbr'),
                'offering_img_url' => $this->input->post('inputImgurl')
            );
            
            $offering = new Offering();
            $offering->create($offering_array);
            $offering->save();
            redirect('admin/offering/list');
        }
    }

    public function offering_delete($id) {

        $offering = new Offering();
        $offering->load($id);

        $offering->drop();
        redirect('admin/offering/list');
    }

    public function offering_save() {
    
    }
}
