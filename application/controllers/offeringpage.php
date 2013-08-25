<?php if (!defined('BASEPATH')) die();

class OfferingPage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
        $offer_collection = new Offering_collection();
        $offer_collection->loadAll();
        $all_offerings = $offer_collection->getAll();
        $movie_offering_collection = new Offering_collection();
        $sport_offering_collection = new Offering_collection();
        $culture_offering_collection = new Offering_collection();
        $tourism_offering_collection = new Offering_collection();

        foreach($all_offerings as $offering)
        {
            if($offering->get('offering_type') === 'movie')
            {
                $movie_offering_collection->append($offering);
            }
            elseif($offering->get('offering_type') === 'sport')
            {
                $sport_offering_collection->append($offering);
            }
            elseif($offering->get('offering_type') === 'culture')
            {
                $culture_offering_collection->append($offering);
            }
            elseif($offering->get('offering_type') === 'tourism')
            {
                $tourism_offering_collection->append($offering);
            }
        }
        $movie_offerings = $movie_offering_collection->getAll();
        $sport_offerings = $sport_offering_collection->getAll();
        $culture_offerings = $culture_offering_collection->getAll();
        $tourism_offerings = $tourism_offering_collection->getAll();

        $data['movie_offerings'] = $movie_offerings;
        $data['sport_offerings'] = $sport_offerings;
        $data['culture_offerings'] = $culture_offerings;
        $data['tourism_offerings'] = $tourism_offerings;

		$data['title'] = 'Offerings';
		$this->load->view('include/header', $data);
		$this->load->view('offeringpage', $data);
		$this->load->view('include/footer');
	}
}