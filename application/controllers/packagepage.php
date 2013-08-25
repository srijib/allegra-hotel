<?php if (!defined('BASEPATH')) die();

class Packagepage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
        $package_collection = new Package_collection;
        $package_collection->loadAll();
        $packages = $package_collection->getAll();
        $data['packages'] = $packages;

		$data['title'] = 'Packages';
		$this->load->view('include/header', $data);
		$this->load->view('packagepage', $data);
		$this->load->view('include/footer');
	}
}