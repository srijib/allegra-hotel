<?php if (!defined('BASEPATH')) die();

class ContactusPage extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $email_config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.126.com',
            'smtp_port' => '465',
            'smtp_user' => 'allegrahotel@126.com',
            'smtp_pass' => 'bboyallegrahotel',
            'mailtype' => 'text',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        /*$email_config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'email-smtp.us-east-1.amazonaws.com',
            'smtp_port' => '465',
            'smtp_user' => 'AKIAJ6UBIOGSEGZQW4DA',
            'smtp_pass' => 'Aj2W6xc/HtOHJqhqrHu5RDBU/SDT8glXXS9ci1iNf+TT',
            'mailtype' => 'text',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );*/
        $this->load->library('email', $email_config);
    }

	public function index()
	{
        $option = new Opt();
        $contactus_content = array(
            array(
                'Telephone', 'Fax', 'Postal address'
                ),
            array(
                $option->get('contactus_phone'), $option->get('contactus_fax'), $option->get('contactus_postal')
                )
        );

        $data['contactus_content'] = $contactus_content;
		$data['title'] = 'Contact Us';
		$this->load->view('include/header', $data);
		$this->load->view('contactuspage');
		$this->load->view('include/footer');
	}

    public function sendemail()
    {
        $title = $this->input->post('inputTitle');
        $fname = $this->input->post('inputFname');
        $lname = $this->input->post('inputLname');
        $phone = $this->input->post('inputPhone');
        $country = $this->input->post('inputCountry');
        $state = $this->input->post('inputState');
        $city = $this->input->post('inputCity');
        $address = $this->input->post('inputAddress');
        $cemail = $this->input->post('inputEmail');
        $comment = $this->input->post('inputComments');

        $this->email->from('allegrahotel@126.com', 'Allegra Hotel');
        $this->email->to('allegrahotel@126.com');
        $this->email->subject('Admin Password');
        $this->email->message($title . "\n" . $fname . "\n" .$lname . "\n" .
            $phone. "\n" . $country . "\n" .$state . "\n" . $city . "\n" . $address . "\n" .
            $cemail . "\n" . $comment);

        $this->email->send();

        $this->data['title'] = 'Message Sent';
        $this->load->view('include/header', $this->data);
        $this->load->view('customer/messagesent', $this->data);
        $this->load->view('include/footer');
    }
}