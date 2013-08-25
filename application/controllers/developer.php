<?php if (!defined('BASEPATH')) die();

class Developer extends CI_Controller {

	public function index() {
        /*if ($_GET['d'] === 'y')
            session_destroy();
        else
            var_dump($_SESSION);
        var_dump('done!');*/
        $rt = new Roomtype();
        $rt->load(1);
        var_dump($rt->getReview());
    }
}
