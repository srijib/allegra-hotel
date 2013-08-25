<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Customer extends Adminhtml {

    private $data = array();

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->data['title'] = 'Admin';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

	public function customer_index() {
        redirect('admin/customer/list');
	}

    public function customer_list() {
        
        $this->data['title'] = 'All Customers';

        $customers = new Customer_collection();
        $customers->loadAll();
        $all_customers = $customers->getAll();

        if($this->input->post('email_filter_checkbox') === '1')
        {
            $customers_onmail = new Customer_collection();
            foreach($all_customers as $customer_onmail)
            {
                if($customer_onmail->get('customer_onmail') === '1')
                {
                    $customers_onmail->append($customer_onmail);
                }
            }
            $this->data['customers'] = $customers_onmail->getAll();
        }
        else
        {
            $this->data['customers'] = $all_customers;
        }
        
		$this->load->view('adminhtml/include/header', $this->data);
		$this->load->view('adminhtml/customer/list', $this->data);
		$this->load->view('adminhtml/include/footer', $this->data);
    }

    public function customer_new_redirect() {

        $this->data['title'] = 'All Customers';

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/customer/new', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function customer_edit($id=NULL) 
    {
        $customer = new Customer();
        $_SESSION['customer_id'] = $id;
        $this->data['customer'] = $customer->load($id);
        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/customer/edit', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function customer_new() {

        $this->form_validation->set_rules('inputUsername', 'Username', 'required');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required');
        $this->form_validation->set_rules('inputEmail', 'Email', 'required');
        $this->form_validation->set_rules('inputFname', 'First Name', 'required');
        $this->form_validation->set_rules('inputLname', 'Last Name', 'required');
        $this->form_validation->set_rules('inputPhone', 'Phone', 'required');
        $this->form_validation->set_rules('inputCountry', 'Country', 'required');
        $this->form_validation->set_rules('inputState', 'State', 'required');
        $this->form_validation->set_rules('inputCity', 'City', 'required');

        if($this->form_validation->run() === FALSE)
        {
            redirect('admin/customer/list');
        }
        else
        {
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
            $customer->create($cus_array);
            $customer->save();
            redirect('admin/customer/list');
        }
    }

    public function customer_delete($id) {
    
        $customer = new Customer();
        $customer->load($id);

        $customer->drop();
        redirect('admin/customer/list');

    }

    public function customer_save() {
    
    }
}
