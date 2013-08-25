<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Admin extends Adminhtml {
    
    private $data = array();
    protected $edit_id;

    public function __construct() {
        parent::__construct();

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
        $this->data['title'] = 'Admin';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function admin_index() {
        redirect('admin/admin/list');
    }

    public function admin_list() {
        
        $this->data['title'] = 'All Users';

        $admins = new Admin_collection();
        $admins->loadAll();
        $all_admins = $admins->getAll();

        $this->data['admins'] = $all_admins;
        
        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/admin/list', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function admin_edit($id=NULL) 
    {
        $admin = new Admin();
        $_SESSION['edit_id'] = $id;
        $this->data['admin'] = $admin->load($id);
        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/admin/edit', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function admin_changePassword()
    {
        $this->form_validation->set_rules('inputOldPassword', 'Old Password', 'required');
        $this->form_validation->set_rules('inputNewPassword', 'New Password', 'required');
        $this->form_validation->set_rules('inputConfirmPassword', 'Confirm Password', 'required');

        $passwords = array(
            'old_password' => $this->input->post('inputOldPassword'),
            'new_password' => $this->input->post('inputNewPassword'),
            'confirm_password' => $this->input->post('inputConfirmPassword')
            );

        $admin = new Admin();
        $admin->load($_SESSION['edit_id']);

        $result = array();

        if($admin->get('admin_password') !== $passwords['old_password']){
            $result['code'] = 1;
            $result['des'] = 'Please check your old password again!';
        }
        else if($passwords['new_password'] !== $passwords['confirm_password']){
            $result['code'] = 1;
            $result['des'] = 'New password and confirm password do not match, please check again!';
        }
        else {
            $result['code'] = 0;
            $result['des'] = 'Password successfully changed.';
            $admin->set('admin_password', $passwords['confirm_password']);
            $admin->save();
            redirect('/');
        }
        echo json_encode($result);
    }

    public function admin_sendpassword()
    {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = NULL;

        $admins = new Admin_collection();
        $admins->loadAll();
        $admins = $admins->getAll();

        foreach($admins as $admin)
        {
            if($admin->get('admin_username') == $username)
            {
                $password = $admin->get('admin_password');
            }
        }
        $this->email->from('allegrahotel@126.com', 'Allegra Hotel');
        $this->email->to($email);
        $this->email->subject('Admin Password');
        $this->email->message('Your password is:' . $password);

        $this->email->send();

        $this->data['title'] = 'Password Sent';
        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/admin/passwordsent', $this->data);
        $this->load->view('adminhtml/include/footer');
    }
}
