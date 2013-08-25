<?php if (!defined('BASEPATH')) die();

class EventPage extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Events';
		$this->load->view('include/header', $data);
		$this->load->view('eventpage');
		$this->load->view('include/footer');
	}
}