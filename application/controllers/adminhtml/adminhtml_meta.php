<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Meta extends Adminhtml {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->data['title'] = 'Admin';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function meta_index() {
        redirect('admin/meta/list');
    }

    public function meta_list() {
        
        $CI =& get_instance();
        $CI->load->database();       
        $query = $CI->db->query('
            SELECT meta_id, meta_key, meta_label FROM meta
        ');

        $offering_meta = array();
        $package_meta  = array();
        $hotel_meta    = array();
        $roomtype_meta     = array();
        $item_meta     = array();
        $customer_meta = array();

        foreach ($query->result() as $row) {
            $exploder = explode("_", $row->meta_key);
            $type = $exploder[0];

            ${$type . '_meta'}[$row->meta_id] = array(
                $row->meta_key, $row->meta_label,
            );
        }

        $this->data['allmeta'] = array(
            'offering' => $offering_meta, 'package' => $package_meta,
            'hotel' => $hotel_meta, 'roomtype' => $roomtype_meta,
            'item' => $item_meta, 'customer' => $customer_meta
        );

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/meta/list', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function meta_edit($key) {
        $this->data['operation'] = 'edit';

        $exploder = explode("_", $key);
        $this->data['meta_type'] = $exploder[0];

        $meta = new Meta();
        $meta->load($key);

        $this->data['meta'] = $meta;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/meta/edit', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function meta_new($type) {
        $this->data['operation'] = 'new';
        $this->data['meta_type'] = $type;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/meta/edit', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    public function meta_save() {
        $key = $_POST['meta_type'].'_'.$_POST['meta_key'];

        if (isset($_POST['meta_required']))
            $required = 1;
        else
            $required = 0;

        $meta = new Meta();
        $meta->load($key);

        if (!$meta->isEmpty()) {
            $opt = $_POST['opt'];
            if ($opt === 'save') {
                if ($meta->get('system')) {
                    if ($opt === 'save') {
                        $meta->set('label', $_POST['meta_label']);
                        $meta->set('required', $required);
                    }
                } else {
                    if ($opt === 'save') {
                        $meta->set('label', $_POST['meta_label']);
                        $meta->set('key', $key);
                        $meta->set('datatype', $_POST['meta_datatype']);
                        $meta->set('required', $required);
                    } elseif ($opt === 'delete') {
                        try {
                            $meta->drop();
                        } catch(Exception $e) {

                        }
                    }
                }
                $meta->save();
            } elseif ($opt === 'delete') {
            
            }
        } else {
            $meta->create();
        }
    }
}
