<?php
/**
 * This file defines the class Offering_collection.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * This class defines the behaviours for Offering_collection specifically
 */
class Offering_collection extends Collection
{
    /**
     * Default constructor from parent, load query table.
     */
	function __construct() {
		parent::__construct();
		$this->collection_type = 'offering';
	}
}
