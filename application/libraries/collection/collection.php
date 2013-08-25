<?php
/**
 * This file has the class that controls all the objects as a collection.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * This class is the root of plural objects as a collection.
 */
abstract class Collection
{
    /**
     * Defines the type of the objects in the collection.
     * @property   string      $collection_type
     */
	protected $collection_type = NULL;
    /**
     * The array that actrually holds the objects
     * @property   array      $collection
     */
	protected $collection = array();

    /**
     * Default constructor, load database instance.
     */
	function __construct() {
        
	}

	
    /**
     * Load all objects with the current type to this collection. If the collection is
     * not empty, it will NOT reload the collection.
     * 
     * @return  Collection      This collection.
     */
	function loadAll() {
		if ( !empty($this->collection) ){
			trigger_error("You must have an empty Collection if you want to load Objects in it.", E_USER_ERROR);
            exit();
        }
		
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->query('
			SELECT '.$this->collection_type.'.'.$this->collection_type.'_id
			FROM '.$this->collection_type.'
		');

		foreach ($query->result() as $row) {
			$id_name = $this->collection_type.'_id';
			$newObj = new $this->collection_type;
			$newObj->load($row->$id_name);
			$this->collection[$row->$id_name] = $newObj;
		}
		
		return $this;
	}

    /**
     * Return all the elements in the collection as an array
     * 
     * @return  array
     */
	function getAll() {
		return $this->collection;
	}
	
    /**
     * Get element according to the key, it can be value or anything else.
     * 
     * @param   string   $key      The key you want to search
     * @param   mixed[int|string]    $value     If search by ID, it is an int. If
     * you want to search by other key, it will be string.
     * 
     * @return  mixed    If you search by ID, then it will return the
     * object if found. If you search by other key of the element other than ID, it
     * will return an array with all objects found.
     */
	function get($key, $value) {
		if ($key === 'id') {
			return $this->collection[$value];
		} else {
			$return_array = array();
			foreach ($this->collection as $id => $object) {
				if ($object->get($key) === $value)
					$return_array[$object->get('id')] = $object;
			}
			return $return_array;
		}
	}
    
    /**
     * Append an object to this collection
     * 
     * @param   mixed      $object          The object that has the same type of the
     * objects in this collection will be append to this collection. If the type does
     * not match, it will do nothing and just return you the collection.
     * 
     * @return  Collection      This collection.
     */
	function append($object) {
		if (strtoupper(get_class($object)) === strtoupper($this->collection_type)) {
			$this->collection[$object->get('id')] = $object;
		}
		return $this;
	}
	
    /**
     * Drop element from this collection
     * 
     * @param   string      $key    The way you want to find the object. You can find it
     * by ID or by other key of the object.
     * @param   mixed   If you want to drop by the ID of the
     * element, put the ID here as an int, otherwise, put the key as string.
     * 
     * @return  Object   Return this object. If the ID of the object his not NULL when load,
     * this function just return the loaded object, and it will NOT load a new one.
     */
	function drop($key, $value) {
		if ($key === 'id') {
			unset($this->collection[$value]);
		} else {
			$unset_element = $this->getElement($key, $value);
			foreach ($unset_element as $e)
				unset($this->collection[$e->get('id')]);
		}
	}
}
