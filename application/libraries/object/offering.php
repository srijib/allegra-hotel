<?php
/**
 * This file defines the class Offering, it maps the OFFERING database.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class defines the behaviours for Offering specifically
 */
class Offering extends Object
{
    /**
     * Default constructor from parent, load query table.
     */
	function __construct() {
		parent::__construct();
		$this->query_table = 'offering';
	}
}
