<?php
/**
 * This file defines the class Customer, it maps the CUSTOMER database.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class defines the behaviours for Customer specifically
 */
class Customer extends Object
{
    /**
     * Default constructor from parent, load query table.
     */
	function __construct() {
		parent::__construct();
		$this->query_table = 'customer';
	}
}
