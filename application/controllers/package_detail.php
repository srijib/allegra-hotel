<?php if (!defined('BASEPATH')) die();

class Package_detail extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function view($id)
    {
        $package = New Package();
        $package->load($id);

        $valid_offerings = $package->load_offering($id);

        $data['package_details'] = array(
            $package,
            $valid_offerings
        );

        $data['title'] = 'Package Detail';
        $this->load->view('include/header', $data);
        $this->load->view('package_detail', $data);
        $this->load->view('include/footer');
    }
}