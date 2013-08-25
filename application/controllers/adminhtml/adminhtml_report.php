<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Report extends Adminhtml {

    public function __construct() {
        parent::__construct();

        $this->data['title'] = 'Reports';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function report_index() {

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/include/report_header', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function report_listCustomer() {

        $this->data['title'] = 'Customers on email list';

        $customers = new Customer_collection();
        $customers->loadAll();
        $all_customers = $customers->getAll();

        $customers_onmail = new Customer_collection();
        foreach($all_customers as $customer_onmail)
        {
            if($customer_onmail->get('customer_onmail') === '1')
            {
                $customers_onmail->append($customer_onmail);
            }
        }
        $this->data['customers'] = $customers_onmail->getAll();

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/include/report_header', $this->data);
        $this->load->view('adminhtml/report/listCustomers', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);  
    }

    public function report_listAllCustomer() {

        $this->data['title'] = 'All Customers';

        $customers = new Customer_collection();
        $customers->loadAll();
        $all_customers = $customers->getAll();

        $this->data['customers'] = $all_customers;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/include/report_header', $this->data);
        $this->load->view('adminhtml/report/listAllCustomers', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);  
    }

    public function report_listPackage() {
        $this->data['title'] = 'All Packages';

        $packages = new Package_collection();
        $packages->loadAll();
        $all_packages = $packages->getAll();
                        
        $this->data['packages'] = $all_packages;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/include/report_header', $this->data);
        $this->load->view('adminhtml/report/listPackages', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    
    public function report_listReservation($mon=NULL) {
        $this->data['title'] = 'Reservations Report';

        $reservations = new Reservation_collection();
        $filter_resetvations = new Reservation_collection();
        $reservations->loadAll();
        $all_reservations = $reservations->getAll();

        if($mon === NULL)
        {
            $this->data['reservations'] = $all_reservations;
        }
        else
        {
            foreach ($all_reservations as $r)
            {
                $create_time = $r->get('create_time');
                $date = new DateTime($create_time);
                $create_mon = $date->format('m');
                //var_dump($create_mon);
                if($create_mon == $mon)
                {
                    $filter_resetvations->append($r);
                }
            }
            $filter_resetvations = $filter_resetvations->getAll();
            $this->data['reservations'] = $filter_resetvations;
        }

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/include/report_header', $this->data);
        $this->load->view('adminhtml/report/listReservations', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function report_finStatement($mon=NULL)
    {
        $this->data['title'] = 'Reservations Report';

        $reservations = new Reservation_collection();
        $reservations->loadAll();
        $all_reservations = $reservations->getAll();
        $filter_resetvations = new Reservation_collection();

        if($mon === NULL)
        {
            $this->data['reservations'] = $all_reservations;
        }

        else
        {
            foreach ($all_reservations as $r)
            {
                $create_time = $r->get('create_time');
                $date = new DateTime($create_time);
                $create_mon = $date->format('m');
                if($create_mon == $mon)
                {
                    $filter_resetvations->append($r);
                }
            }
            $filter_resetvations = $filter_resetvations->getAll();
            $this->data['reservations'] = $filter_resetvations;
        }

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/include/report_header', $this->data);
        $this->load->view('adminhtml/report/finStatement', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }
}