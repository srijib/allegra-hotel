<?php

/**
 * This file defines the class Object, parent of all raw data table, including
 * CUSTOMER, HOTEL, ITEM, OFFERING, PACKAGE, ROOMTYPE.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This class is the root of singular object.
 */
abstract class Object {

    /**
     * Once the object been loaded, it stores the id of the object.
     * @property   int      $id
     */
    protected $id = NULL;

    /**
     * Remembers the type of the object, i.e. the table related
     * @property   string      $query_table
     */
    protected $query_table = NULL;

    /**
     * Once the object been loaded, this stores all the meta key=>value pairs
     * @property   array      $meta
     */
    protected $meta = array();

    /**
     * Once the object been loaded, this stores all the meta, as long as the meta information.
     * @property   array      $meta_extend
     */
    protected $meta_extend = array();

    /**
     * Default constructor, load database instance.
     */
    function __construct() {
        
    }

    /**
     * Create a new object
     * 
     * @param   array   $attr       The array contains the property of the new object. The
     * format is basically $meta_key=>$value, for example, 'first_name'=>'Peter'.
     * 
     * @return  Object      Return the new added object.
     */
    function create($attr = array()) {
        $CI = & get_instance();
        $CI->load->database();

        $add_buffer = array();
        foreach ($attr as $meta_key => $value) {
            $query = $CI->db->query('
                SELECT meta_id FROM meta WHERE meta_key="' . $meta_key . '"
            ');
            $result = $query->result();
            if (count($result) === 1) {
                $add_buffer[$result[0]->meta_id] = $value;
            } else {
                trigger_error("The meta_key '" . $meta_key . "' does not exist.", E_USER_ERROR);
                exit();
            }
        }

        $query_insert_object = $CI->db->query('
            INSERT INTO '.$this->query_table.' ('.$this->query_table.'_id) VALUES (NULL)
        ');
        
        $new_obj_id = $CI->db->insert_id();
        
        foreach ($add_buffer as $meta_id => $value) {
            $query_insert_meta = $CI->db->query('
                INSERT INTO '.$this->query_table.'_has_meta ('.$this->query_table.'_id, meta_id, value)
                VALUES ('.$new_obj_id.','.$meta_id.',"'.$value.'")
            ');
        }
        
        return $this->load($new_obj_id);
    }

    /**
     * Load the object by ID.
     * 
     * @param   int      $id          The ID of the object been loaded.
     * 
     * @return  Object   Return this object. If the ID of the object his not NULL when load,
     * this function just return the loaded object, and it will NOT load a new one.
     */
    function load($id) {
        if ($this->id !== NULL) {
            trigger_error("You must have an empty Object to run load.", E_USER_ERROR);
            exit();
        }

        $this->id = intval($id);
        $this->_load();
        return $this;
    }

    /**
     * Get the meta value of this object with key
     * 
     * @param   string   $key         The key of the meta record.
     * 
     * @return  int|string  If request ID, then return an ID with type of integer,
     * otherwise, return a string with the value of corresponding key.
     */
    function get($key) {
        if ($key === 'id')
            return $this->id;
        else
            return $this->meta[$key];
    }

    /**
     * Get the meta information of this object
     * 
     * @param   bool     $extended    (default FALSE) Whether to return the extended version of
     * meta data.
     * 
     * @return  array    When extended=TRUE, return extended version of the meta records with meta
     * information, otherwise, return an array of all meta keys and values.
     */
    function getMeta($extended = FALSE) {
        if ($extended)
            return $this->meta_extend;
        else
            return $this->meta;
    }

    /**
     * Change the value in one field (key) of the object to a new value. Please pay attention, this
     * function does NOT change the databse, it only stores the value in this Object, if you want to
     * store your changes in the database, you have to call save();
     * 
     * @param   string   $key         The key of the meta record.
     * @param   string   $value       New value of the meta record.
     * @param   bool     $force       (default FALSE) Whether to forcefully set the value. When set
     * to TRUE, the object will create the connection between itself and the meta, if originally it
     * does not contain that meta record (insert). When set to FALSE by default, this function will work only
     * when the meta record exists (update only). If it does not exist and force=FALSE, it will try
     * to protect the database been accidentally changed.
     *
     * @return  Object   This object.
     */
    function set($key, $value, $force = FALSE) {
        if (isset($this->meta[$key])) {
            $this->meta[$key] = $value;
            $this->meta_extend[$key]['value'] = $value;
        } else {
            if ($force === TRUE) {
                $CI = & get_instance();
                $CI->load->database();
                $query = $CI->db->query('
					INSERT INTO ' . $this->query_table . '_has_meta (' . $this->query_table . '_id, meta_id, value)
					VALUES (' . $this->id . ',(SELECT meta_id FROM meta WHERE meta_key="' . $key . '"),"' . $value . '")
				');
            } else {
                return $this;
            }
        }
    }

    /**
     * Save this object to database.
     * 
     * @return  void
     */
    function save() {
        foreach ($this->meta as $key => $value) {
            $CI = & get_instance();
            $CI->load->database();
            $query = $CI->db->query('
				UPDATE ' . $this->query_table . '_has_meta
				SET value="' . $value . '"
				WHERE
					' . $this->query_table . '_id=' . $this->id . ' AND
					meta_id=(
						SELECT meta_id FROM meta
						WHERE meta_key="' . $key . '")
			');
        }
    }

    /**
     * Drop the current object in the database immediately
     * 
     * @param       bool    $force      (default FALSE) If set to true, this function will
     * drop all records related to this meta in the OBJECT_has_meta table, and then drop
     * the object itslef in the OBJECT table. If set to false, this function will only remove
     * the object in the OBJECT table if no meta is linked to this object.
     *
     * @return      void
     */
    function drop($force = FALSE) {
        $CI = & get_instance();
        $CI->load->database();
        
        $check_meta_query = $CI->db->query('
            SELECT '.$this->query_table.'_id FROM '.$this->query_table.'_has_meta WHERE '.$this->query_table.'_id='.$this->id.'
        ');
        $check_result = $check_meta_query->result();

        if (count($check_result) > 0 && $force === FALSE) {
            trigger_error("This object has meta data, delete all meta or use force drop.", E_USER_ERROR);
            exit();
        } elseif (count($check_result) > 0 && $force === TRUE) {
            $remove_meta = $CI->db->query('
                DELETE FROM '.$this->query_table.'_has_meta WHERE '.$this->query_table.'_id='.$this->id.'
            ');
        }
        
        $remove_obj = $CI->db->query('
            DELETE FROM '.$this->query_table.' WHERE '.$this->query_table.'_id='.$this->id.'
        ');
    }

    /**
     * The function that actrually load the information and fill the array.
     * 
     * @return  Meta    This Meta object.
     */
    private function _load() {
        if ($this->id === NULL || $this->query_table === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
			SELECT meta.*, ' . $this->query_table . '_has_meta.value
			FROM meta, ' . $this->query_table . '_has_meta
			WHERE
				' . $this->query_table . '_has_meta.' . $this->query_table . '_id = ' . $this->id . ' AND
				' . $this->query_table . '_has_meta.meta_id = meta.meta_id
		');

        foreach ($query->result() as $row) {
            $this->meta[$row->meta_key] = $row->value;
            $this->meta_extend[$row->meta_key] = array(
                'value' => $row->value,
                'label' => $row->meta_label,
                'datatype' => $row->meta_datatype,
                'system' => $row->meta_system,
                'required' => $row->meta_required,
                'default' => $row->meta_default
            );
        }

        return $this;
    }

}
