<?php
/**
 * This file defines the class Admin, it maps the Admin database.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class defines the behaviours for Admin specifically
 */
class Admin extends Object
{
    /**
     * Default constructor from parent, load query table.
     */
    function __construct() {
        parent::__construct();
        $this->query_table = 'admin';
    }
}
