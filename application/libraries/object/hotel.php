<?php
/**
 * This file defines the class Hotel, it maps the HOTEL database.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class defines the behaviours for Hotel specifically
 */
class Hotel extends Object
{
    /**
     * Default constructor from parent, load query table.
     */
	function __construct() {
		parent::__construct();
		$this->query_table = 'hotel';
	}
}
