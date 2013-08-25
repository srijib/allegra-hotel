<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Item extends Adminhtml
{
    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['title'] = 'Item';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function item_index() {
        redirect('admin/item/list');
    }

    public function item_list() {
        
        $this->data['title'] = 'Items';
        $items = new Item_collection();
        $items->loadAll();
        $all_items = $items->getAll();

        $this->data['items'] = $all_items;

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/item/list', $this->data);
        $this->load->view('adminhtml/include/footer');
    }

}