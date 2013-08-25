<?php if (!defined('BASEPATH')) die();

class Adminhtml extends CI_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->_validateLogin();
        $this->data['title'] = 'Admin Home';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function index() {
        if ($_SESSION['adminloggedin'] === true)
        {
            // redirect('admin/home');
            $this->load->view('adminhtml/include/header', $this->data);
            $this->load->view('adminhtml/home');
            $this->load->view('adminhtml/include/footer');
        }
        else
            redirect('admin/login');
    }

    private function _validateLogin() {
        if (!isset($_SESSION['adminloggedin']) ||
            $_SESSION['adminloggedin'] === false) {
            $_SESSION['adminloggedin'] = false;
            redirect('admin/login');
        }
    }
}
