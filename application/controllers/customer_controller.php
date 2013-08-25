<?php

    class Customer_Controller extends CI_Controller{

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
            $this->load->library('email', $email_config);
        }
        
        public function showAccount()
        {
            $customer = new Customer();
            $customer->load(logged_in_id());
            $data['customer_info'] = array(
                'customer_username' => $customer->get('customer_username'),
                'customer_email' => $customer->get('customer_email'),
                'customer_title' => $customer->get('customer_title'),
                'customer_fname' => $customer->get('customer_fname'),
                'customer_lname' => $customer->get('customer_lname'),
                'customer_phone' => $customer->get('customer_phone'),
                'customer_country' => $customer->get('customer_country'),
                'customer_state' => $customer->get('customer_state'),
                'customer_city' => $customer->get('customer_city'),
                'customer_address' => $customer->get('customer_address')
                );

            $reservations = new Reservation_collection();
            $reservations->loadAll();
            $reservations = $reservations->getAll();
            $customer_reservations = new Reservation_collection();

            foreach($reservations as $reservation)
            {   
                if($reservation->get('customer_id') == $customer->get('id'))
                {
                    $customer_reservations->append($reservation);
                }
            }
            $customer_reservations = $customer_reservations->getAll();

            $data['reservations'] = $customer_reservations;
            $data['title'] = 'My Account';
            $this->load->view('include/header', $data);
            $this->load->view('customer/customeraccount', $data);
            $this->load->view('include/footer');
        }

        public function signup()
        {
            $data['title'] = 'Sign Up';
            $this->load->view('include/header', $data);
            $this->load->view('customer/signup');
            $this->load->view('include/footer');
        }

        public function signupPost()
        {
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
                redirect('customer/signup');
            }
            else
            {
                $cus_array = array(
                    'customer_username' => $this->input->post('inputUsername'),
                    'customer_password' => md5($this->input->post('inputPassword')),
                    'customer_email' => $this->input->post('inputEmail'),
                    'customer_onmail' => intval($this->input->post('checkboxEmail')),
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

                $session['cus_id'] = $customer->get('id');
                $session['user_name'] = $customer->get('customer_username');
                $session['full_name'] = $customer->get('customer_fname') . " " .
                                        $customer->get('customer_lname');
                $session['logged_in'] = TRUE;

                $_SESSION['customer'] = $session;
                redirect('/');
            }
        }

        public function loginPost()
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password_en = md5(trim($password));

            $result = array();

            if (!empty($username) && !empty($password_en)) {
                $customer_collection = new Customer_collection();
                $customer_collection->loadAll();

                $valid_customer_array = $customer_collection->get('customer_username', $username);
                if (empty($valid_customer_array)) {
                    $result['code'] = 1;
                    $result['des'] = 'username does not exist';
                } else {
                    $valid_customer = array_shift($valid_customer_array);

                    if ($valid_customer->get('customer_password') === $password_en) {
                        $result['code'] = 0;

                        $session['cus_id'] = $valid_customer->get('id');
                        $session['user_name'] = $valid_customer->get('customer_username');
                        $session['full_name'] = $valid_customer->get('customer_fname') . " " .
                                                $valid_customer->get('customer_lname');
                        $session['logged_in'] = TRUE;

                        $_SESSION['customer'] = $session;

                        $result['HTML'] = 'Hello, ' . $session['full_name'] . ".";

                    } else {
                        $result['code'] = 1;
                        $result['des'] = 'wrong password';
                    }
                }
            } else {
                $result['code'] = 1;
                $result['des'] = 'input invalid';
            }

            echo json_encode($result);
        }

        public function logoutPost()
        {
            $session = array(
                'cus_id' => NULL,
                'user_name' => NULL,
                'full_name' => NULL,
                'logged_in' => FALSE
            );
            $_SESSION['customer'] = $session;
            redirect('/');
        }

        public function editPost()
        {
            $this->form_validation->set_rules('inputUsername', 'Username', 'required');
            $this->form_validation->set_rules('inputEmail', 'Email', 'required');
            $this->form_validation->set_rules('inputFname', 'First Name', 'required');
            $this->form_validation->set_rules('inputLname', 'Last Name', 'required');
            $this->form_validation->set_rules('inputPhone', 'Phone', 'required');
            $this->form_validation->set_rules('inputCountry', 'Country', 'required');
            $this->form_validation->set_rules('inputState', 'State', 'required');
            $this->form_validation->set_rules('inputCity', 'City', 'required');

            if($this->form_validation->run() === FALSE)
            {
                redirect('customer/showAccount');
            }
            else
            {
                $cus_array = array(
                    'customer_username' => $this->input->post('inputUsername'),
                    // 'customer_password' => md5($this->input->post('inputPassword')),
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
                $customer->load(logged_in_id());
                if($customer->get('customer_username') !== $cus_array['customer_username'])
                {
                    $customer->set('customer_username', $cus_array['customer_username']);
                }
                if($customer->get('customer_email') !== $cus_array['customer_email'])
                {
                    $customer->set('customer_email', $cus_array['customer_email']);
                }
                if($customer->get('customer_title') !== $cus_array['customer_title'])
                {
                    $customer->set('customer_title', $cus_array['customer_title']);
                }
                if($customer->get('customer_fname') !== $cus_array['customer_fname'])
                {
                    $customer->set('customer_fname', $cus_array['customer_fname']);
                }
                if($customer->get('customer_lname') !== $cus_array['customer_lname'])
                {
                    $customer->set('customer_lname', $cus_array['customer_lname']);
                }
                if($customer->get('customer_phone') !== $cus_array['customer_phone'])
                {
                    $customer->set('customer_phone', $cus_array['customer_phone']);
                }
                if($customer->get('customer_country') !== $cus_array['customer_country'])
                {
                    $customer->set('customer_country', $cus_array['customer_country']);
                }
                if($customer->get('customer_state') !== $cus_array['customer_state'])
                {
                    $customer->set('customer_state', $cus_array['customer_state']);
                }
                if($customer->get('customer_city') !== $cus_array['customer_city'])
                {
                    $customer->set('customer_city', $cus_array['customer_city']);
                }
                if($customer->get('customer_address') !== $cus_array['customer_address'])
                {
                    $customer->set('customer_address', $cus_array['customer_address']);
                }
                $customer->save();

                $session['cus_id'] = $customer->get('id');
                $session['user_name'] = $customer->get('customer_username');
                $session['full_name'] = $customer->get('customer_fname') . " " .
                                        $customer->get('customer_lname');
                $session['logged_in'] = TRUE;

                $this->session->set_userdata($session);

                redirect('/');
            }
        }

        public function changePassword()
        {
            $this->form_validation->set_rules('inputOldPassword', 'Old Password', 'required');
            $this->form_validation->set_rules('inputNewPassword', 'New Password', 'required');
            $this->form_validation->set_rules('inputConfirmPassword', 'Confirm Password', 'required');

            $passwords = array(
                'old_password' => $this->input->post('inputOldPassword'),
                'new_password' => $this->input->post('inputNewPassword'),
                'confirm_password' => $this->input->post('inputConfirmPassword')
                );

            $customer = new Customer();
            $customer->load(logged_in_id());

            $result = array();

            if($customer->get('customer_password') !== md5(trim($passwords['old_password']))){
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
                $customer->set('customer_password', md5(trim($password['confirm_password'])));
                $customer->save();
                redirect('/');
            }
            echo json_encode($result);
        }

        public function sendemail()
        {
            $data['title'] = 'Forgot Password';
            $this->load->view('include/header', $data);
            $this->load->view('customer/forgotPassword', $data);
            $this->load->view('include/footer');
        }

        public function sendpassword()
        {
            $data['title'] = 'Password Sent';
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = 'jason';

            $customers = new Customer_collection();
            $customers->loadAll();
            $customers = $customers->getAll();
            foreach($customers as $customer)
            {
                if($customer->get('customer_username') == $username)
                {
                    //$password = $customer->get('customer_password');
                }
            }

            $this->email->from('allegrahotel@126.com', 'Allegra Hotel');
            $this->email->to($email);
            $this->email->subject('Your Password at Allegra Hotel');
            $this->email->message('Your password is:' . $password);

            $this->email->send();
            $this->load->view('include/header', $data);
            $this->load->view('customer/passwordsent', $data);
            $this->load->view('include/footer');
        }
    }

 ?>
