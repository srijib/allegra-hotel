<?php 
/**
 * This file defines the class Meta, links to meta table.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * This class controls the meta table in the database system
 */
class Meta
{
    /**
     * The array that stores meta value after load() function.
     * @property   array   $meta_table
     */
	private $meta_table = array();

    /**
     * Default constructor, load database instance.
     */
	function __construct() {

	}

    function isEmpty() {
        return empty($this->meta_table);
    }
    
    /**
     * Create a new meta record in the meta table.
     * 
     * @param   string   $key         The key of the meta record.
     * @param   string   $label       The label displayed in the frontend.
     * @param   string   $datatype    The data type of this meta record, in MySQL format.
     * @param   int      $system      Whether the value is a system value (1==true,0==false).
     * @param   int      $required    Whether this field is required in the frontend.
     * @param   string   $default     The default value for this field.
     *
     * @return  Meta    This Meta object.
     */
	function create($key, $label, $datatype, $system = 1, $required = 0, $default = "NULL") {
		if (!empty($this->meta_table)) {
			trigger_error("You must have an empty Meta Object to create new meta.", E_USER_ERROR);
            exit();
        }
			
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->query('
			INSERT INTO meta(meta_id, meta_key, meta_label, meta_datatype, meta_system, meta_required, meta_default)
			VALUES (NULL,"'.$key.'", "'.$label.'", "'.$datatype.'", '.$system.', '.$required.', '.$default.')
		');
		if ($CI->db->affected_rows() === 1) {
			$this->load($key);
		}
        return $this;
	}

    /**
     * Load the content of meta to this Meta object.
     * 
     * @param   mixed   $id_or_key    The ID of the meta record or the KEY of the meta record.
     *
     * @return  Meta    This Meta object.
     */
	function load($id_or_key) {
        $CI =& get_instance();
        $CI->load->database();
		if (is_int($id_or_key)) {
            $query = $CI->db->query('
				SELECT * FROM meta WHERE meta_id='.$id_or_key.'
			');
		} else {
			$query = $CI->db->query('
				SELECT * FROM meta WHERE meta_key="'.$id_or_key.'"
			');
		}
		
		foreach ($query->result() as $row) {
			$this->meta_table['id']			= intval($row->meta_id);
			$this->meta_table['key']		= $row->meta_key;
			$this->meta_table['label']		= $row->meta_label;
			$this->meta_table['datatype']	= $row->meta_datatype;
			$this->meta_table['system']		= $row->meta_system;
			$this->meta_table['required']	= $row->meta_required;
			$this->meta_table['default']	= $row->meta_default;
		}
		
		return $this;
	}

    /**
     * Get the value of a specific meta_key.
     * 
     * @param   string      $field    The field of the meta record
     *
     * @return  int|string          ID will returned as int, other value will return as string.
     */
	function get($field) {
		return $this->meta_table[$field];
	}

    /**
     * Update the value of the meta object
     * 
     * @param       string      $field      The field you want to update.
     * @param       string      $value      The new value stores in this object.
     *
     * @return      Meta    This meta object.
     */
    function set($field, $value) {
        if (empty($this->meta_table)) {
            trigger_error("This meta object is empty, need to load before drop", E_USER_ERROR);
            exit();
        }
        
        if ($field === 'id' || $field === 'key') {
            trigger_error("You cannont change the $field.", E_USER_ERROR);
            exit();
        } else {
            if ( isset($this->meta_table[$field]) ) {
                $this->meta_table[$field] = $value;
            } else {
                trigger_error("The field '$field' does not exist.", E_USER_ERROR);
                exit();
            }
        }
        return $this;
    }
    
    /**
     * Save the current state of the Meta to the database
     * 
     * @return      void
     */
    function save() {
        if (empty($this->meta_table)) {
            trigger_error("This meta object is empty, need to load before drop", E_USER_ERROR);
            exit();
        }
        
        $CI = & get_instance();
        $CI->load->database();
        
        $query = $CI->db->query(
            'UPDATE meta
             SET meta_label="'.$this->meta_table['label'].'",meta_datatype="'.$this->meta_table['datatype'].'",
                 meta_system="'.$this->meta_table['system'].'",meta_required="'.$this->meta_table['required'].'",
                 meta_default="'.$this->meta_table['default'].'"
             WHERE meta_key="'.$this->meta_table['key'].'"
        ');
    }
    
    /**
     * Drop the current meta in the database immediately
     * 
     * @param       bool    $force      (default FALSE) If set to true, this function will
     * drop all records related to this meta in the OBJECT_has_meta table, and then drop
     * the meta itslef in the meta table. If set to false, this function will only remove
     * the meta in the meta table if no OBJECT is linked to this meta.
     *
     * @return      void
     */
    function drop($force = FALSE) {
        
        if (empty($this->meta_table)) {
            trigger_error("This meta object is empty, need to load before drop", E_USER_ERROR);
            exit();
        }
        
        $tables = array(
            'offering', 'package', 'hotel', 'room', 'item', 'customer'
        );
        
        $has_meta_info = FALSE;
        
        $CI = & get_instance();
        $CI->load->database();
        
        foreach ($tables as $obj) {
            $query = $CI->db->query('
                SELECT meta_id FROM '.$obj.'_has_meta
                WHERE meta_id='.$this->meta_table['id'].'
            ');
            $r = $query->result();
            if (count($r) > 0) {
                $has_meta_info = TRUE;
                break;
            }
        }

        if ( $has_meta_info ) {
            if ( $force ) {
                // drop OBJECT_has_meta
                foreach ($tables as $obj) {
                    $query = $CI->db->query('
                        DELETE FROM  '.$obj.'_has_meta
                        WHERE meta_id='.$this->meta_table['id'].'
                    ');
                }
            } else {
                trigger_error("There are values stored for this meta.", E_USER_ERROR);
                exit();
            }
        }

        $query = $CI->db->query('
            DELETE FROM  meta
            WHERE meta_id='.$this->meta_table['id'].'
        ');
    }
}
