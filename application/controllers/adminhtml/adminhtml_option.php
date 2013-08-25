<?php if (!defined('BASEPATH')) die();

include('adminhtml.php');

class Adminhtml_Option extends Adminhtml
{
    private $data = array();

    private $unadded_fields = array();
    private $unadded_form = "";

    public function __construct() {
        parent::__construct();
        $this->data['title'] = 'Option';
        $this->data['body_class'] = $this->uri->segment(1)."_".$this->uri->segment(2);
    }

    public function option_index() {
        $this->data['title'] = 'Options';

        // About Us
        $this->_addfield('aboutus_overview',
            array(
                'label' => 'About Us Overview',
                'type'  => 'textarea',
                'value' => Opt::get('aboutus_overview')
        ));

        $this->_addfield('aboutus_policy',
            array(
                'label' => 'About Us Policy',
                'type'  => 'textarea',
                'value' => Opt::get('aboutus_policy')
        ));

        $this->_addfield('aboutus_responsibility',
            array(
                'label' => 'About Us Responsibility',
                'type'  => 'textarea',
                'value' => Opt::get('aboutus_responsibility')
        ));

        $this->_addForm('About Us', 'aboutus');

        // Package
        $package_collection = new Package_collection();
        $package_names = $package_collection->nameToSelectOptions();

        $this->_addfield('homepage_package_slider1',
            array(
                'label' => 'Homepage Slider1 Package',
                'type' => 'select',
                'value' => Opt::get('slider_1'),
                'options' => $package_names,
        ));

        $this->_addfield('homepage_package_slider2',
            array(
                'label' => 'Homepage Slider2 Package',
                'value' => Opt::get('slider_2'),
                'type' => 'select',
                'options' => $package_names,
        ));

        $this->_addfield('homepage_package_slider3',
            array(
                'label' => 'Homepage Slider3 Package',
                'value' => Opt::get('slider_3'),
                'type' => 'select',
                'options' => $package_names,
        ));

        $this->_addForm('Homepage Sliders', 'slider');

        $this->load->view('adminhtml/include/header', $this->data);
        $this->load->view('adminhtml/option/index', $this->data);
        $this->load->view('adminhtml/include/footer', $this->data);
    }

    protected function _addfield($key, $opt) {
        if (isset($this->unadded_fields[$key])) {
            throw new Exception("Duplicated feild $key found.");
        } else {
            $this->unadded_fields[$key] = $opt;   
        }

    }

    protected function _addform($legend, $key) {
        if ($this->unadded_form !== "") {
            throw new Exception("Unadded form $this->unadded_form found.");
        } else {
            if (empty($this->unadded_fields)) {
                throw new Exception("No added fields found.");
            } else {
                $this->data['forms'][$key]['legend'] = $legend;
                $this->data['forms'][$key]['fields'] = $this->unadded_fields;
                $this->unadded_fields = array();
            }
        }
    }

    public function option_save() {
        var_dump($_POST);
    }
}
