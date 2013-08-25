<?php if (!defined('BASEPATH')) die();

class AboutusPage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
        $option = new Opt();
        $aboutus_content = array(
            array(
                'Overview', 'Policy', 'Responsibility'
                ),
            array(
                $option->get('aboutus_overview'), $option->get('aboutus_policy'), $option->get('aboutus_responsibility')
                )
        );

        $data['aboutus_content'] = $aboutus_content;
		$data['title'] = 'About Us';
		$this->load->view('include/header', $data);
		$this->load->view('aboutuspage');
		$this->load->view('include/footer');
	}
}