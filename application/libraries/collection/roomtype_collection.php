<?php
/**
 * This file defines the class Roomtype_collection.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * This class defines the behaviours for Roomtype_collection specifically
 */
class Roomtype_collection extends Collection
{
    /**
     * Default constructor from parent, load query table.
     */
	function __construct() {
		parent::__construct();
		$this->collection_type = 'roomtype';
	}
}
