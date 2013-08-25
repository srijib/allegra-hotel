<?php
/**
 * This file defines the class Package_collection.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * This class defines the behaviours for Package_collection specifically
 */
class Package_collection extends Collection
{
    /**
     * Default constructor from parent, load query table.
     */
	function __construct() {
		parent::__construct();
		$this->collection_type = 'package';
	}

    public function nameToSelectOptions() {
        if (empty($collection))
            $this->loadAll();

        $return_array = array();
        foreach ($this->getAll() as $p) {
            $return_array[] = array(
                'value' => $p->get('id'),
                'label' => $p->get('package_title'),
            );
        }

        return $return_array;
    }
}
