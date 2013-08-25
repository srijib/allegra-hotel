<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Home extends Adminhtml {

    private $data = array();

    public function __construct() {
        parent::__construct();
		$this->data['title'] = 'Admin';
        $this->load->database();
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

	public function home_index()
	{
        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/home');
        $this->load->view('adminhtml/include/footer');
	}
}
