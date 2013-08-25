<?php 
/**
 * This file defines the class Package, it maps the PACKAGE database.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class defines the behaviours for Package specifically
 */
class Package extends Object
{
    protected $package_offering = array();
    protected $package_offerings = array();
    protected $valid_offerings;
    protected $offering_quantity;
    protected $roomtype;
    protected $data = array();
    /**
     * Default constructor from parent, load query table.
     */
	function __construct() {
		parent::__construct();
		$this->query_table = 'package';
	}

    /**
    * Load offerings that related to this package
    */
    function load_offering($package_id = NULL)
    {
        if ($package_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT package_has_offering.*
            FROM package_has_offering
            WHERE 
                package_id = ' . $package_id . '
        ');
     
        $offering_collection = new Offering_collection();
        $offering_collection->loadAll();
        $offerings = $offering_collection->getAll();

        $valid_offerings_cl = new Offering_collection();

        foreach($query->result() as $row)
        {
            foreach($offerings as $offering)
            {
                if($offering->get('id') == $row->offering_id)
                {
                    $valid_offerings_cl->append($offering);
                }    
            }
        }
   
        $this->valid_offerings = $valid_offerings_cl->getAll();
        return $this->valid_offerings;
    }

    /**
    * Get the quantity of a offering in the package
    */
    function get_offering_quantity($package_id = NULL, $offering_id = NULL){
        if ($package_id === NULL || $offering_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT package_has_offering.*
            FROM package_has_offering
            WHERE 
                package_id = ' . $package_id . ' AND
                offering_id = ' . $offering_id . '
        ');

        foreach($query->result() as $row)
        {
            $this->offering_quantity = $row->quantity;
        }
        return $this->offering_quantity;
    }

    /**
    * Change an offering linked to a package
    */
    function change_offering($package_id = NULL, $old_offering_id = NULL, $new_offering_id = NULL, $quantity = NULL)
    {
        if($package_id === NULL || $offering_id === NULL)
        {
            return NULL;
        }
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            UPDATE package_has_offering
            SET offering_id = '. $new_offering_id .', quantity = '. $quantity .'
            WHERE package_id = ' . $package_id . ' AND offering_id = '. $old_offering_id .'
        ');
    }

    /**
    * Load the roomtype related to the package
    */
    function load_roomtype($package_id = NULL)
    {
        if ($package_id === NULL) {
            return NULL;
        }
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT roomtype_id
            FROM package_has_roomtype
            WHERE 
                package_id = ' . $package_id . '
        ');

        $roomtype_collection = new Roomtype_collection();
        $roomtype_collection->loadAll();
        $roomtypes = $roomtype_collection->getAll();

        foreach($query->result() as $row)
        {
            foreach($roomtypes as $roomtype)
            {
                if($roomtype->get('id') == $row->roomtype_id)
                {
                    $this->roomtype = $roomtype;
                }    
            }
        }
        $this->data['old_roomtype_id'] = $this->roomtype->get('id');
        return $this->roomtype;
    }

    /**
    * Add a roomtype to a package
    */
    function add_roomtype($package_id = NULL, $roomtype_id = NULL)
    {
        if($package_id === NULL || $roomtype_id === NULL)
        {
            return NULL;
        }
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            INSERT INTO package_has_roomtype
            VALUES(' . $package_id . ', ' . $roomtype_id . ')
        ');
    }

    /**
    * Change a roomtype linked to a package
    */
    function change_roomtype($package_id = NULL, $roomtype_id = NULL)
    {
        if($package_id === NULL || $roomtype_id === NULL)
        {
            return NULL;
        }
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            UPDATE package_has_roomtype
            SET roomtype_id = '. $roomtype_id .'
            WHERE package_id = ' . $package_id . '
        ');
        $this->data['new_roomtype_id'] = $roomtype_id;
    }

    /**
    * Delete the link between a package and a roomtype
    */
    function delete_link($package_id = NULL)
    {
        if($package_id === NULL)
        {
            return NULL;
        }
        $CI = & get_instance();
        $CI->load->database();
        $query1 = $CI->db->query('
            DELETE package_has_roomtype.* FROM package_has_roomtype
            WHERE package_id = ' . $package_id . '
        ');

        $query2 = $CI->db->query('
            DELETE package_has_offering.* FROM package_has_offering
            WHERE package_id = ' . $package_id . '
        ');
    }

    /*
    * Save the package
    *
    public function save($package_id = NULL)
    {
        parent::save();
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            UPDATE package_has_roomtype
            SET roomtype_id = ' . $this->data['new_roomtype_id'] . ', 
            WHERE package_id = ' . $package_id .'
            AND roomtype_id = ' . $this->data['old_roomtype_id'] . '
        ');
    }*/
}