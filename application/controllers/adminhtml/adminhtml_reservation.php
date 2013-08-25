<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Reservation extends Adminhtml
{
    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->data['title'] = 'Reservation';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function reservation_index() {
        redirect('admin/reservation/list');
    }

    public function reservation_list() {
        $this->data['title'] = 'Reservations';

        $reservations = new Reservation_collection();
        $reservations->loadAll();
        $all_reservations = $reservations->getAll();

        $this->data['reservations'] = $all_reservations;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/reservation/list', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function reservation_edit($id=NULL)
    {
        $reservation = new Reservation();
        $this->data['reservation'] = $reservation->load($id);
        $this->data['title'] = 'Reservation Detail';

        $rooms = new Room_collection();
        $rooms->loadAll();
        $rooms = $rooms->getAll();

        $offerings = new Offering_collection();
        $offerings->loadAll();
        $offerings = $offerings->getAll();

        $this->data['offerings'] = $offerings;
        $this->data['rooms'] = $rooms;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/reservation/edit', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function reservation_delete($id=NULL)
    {
        $reservation = new Reservation();
        $reservation->load($id);
        $reservation->drop($id);

        redirect('admin/reservation/list');
    }
}
