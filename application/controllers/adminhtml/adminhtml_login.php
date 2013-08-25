<?php if (!defined('BASEPATH')) die();

class Adminhtml_Login extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Administration Login';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function login_index() {
        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/login', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function login_loginPost() {

        $admin_cl = new Admin_collection();
        $admin_cl->loadAll();
        $admins = $admin_cl->getAll();
        $_SESSION['admin_username'] = $this->input->post('username');
        //var_dump($admins);

        foreach($admins as $admin)
        {
            if ($admin->get('admin_username') === $_POST['username'] &&
                $admin->get('admin_password') === $_POST['password']) {
            $_SESSION['adminloggedin'] = true;
            }
        }
        if($_SESSION['adminloggedin'] == true)
        {
            $this->load->view('adminhtml/include/header', $this->data);
            $this->load->view('adminhtml/home');
            $this->load->view('adminhtml/include/footer');
        }
        else
        {
            $this->data['error_message'] = 'Wrong Username and Password';
            $this->load->view('adminhtml/include/header', $this->data);
            $this->load->view('adminhtml/login', $this->data);
            $this->load->view('adminhtml/include/footer', $this->data);
        }
        /*
        if (Opt::get('admin_username') === $_POST['username'] &&
            Opt::get('admin_password') === $_POST['password']) {
            $_SESSION['adminloggedin'] = true;
            $this->load->view('adminhtml/include/header', $this->data);
            $this->load->view('adminhtml/home');
            $this->load->view('adminhtml/include/footer');
            // redirect('admin/home');
        } else {
            $this->data['error_message'] = 'Wrong Username and Password';
            $this->load->view('adminhtml/include/header', $this->data);
            $this->load->view('adminhtml/login', $this->data);
            $this->load->view('adminhtml/include/footer', $this->data);
        }*/
    }

    public function login_logout() {
        $_SESSION['adminloggedin'] = false;
        redirect('admin/login');
    }
}
