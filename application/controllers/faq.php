<?php if (!defined('BASEPATH')) die();

class Faq extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
        $hotel_collection = new Hotel_collection();
        $hotel_collection->loadAll();
        $all_hotels = $hotel_collection->getAll();
        foreach ($all_hotels as $hotel) {
            $hotels[] = array(
                'id' => $hotel->get('id'),
                'hotel_name' => $hotel->get('hotel_name')
            );
        }

        $data['hotels'] = $hotels;
		$data['title'] = 'FAQ - Allegra Hotels';
		$this->load->view('include/header', $data);
		$this->load->view('faq');
		$this->load->view('include/footer');
	}
}
