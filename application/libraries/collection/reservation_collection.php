<?php
/**
 * This file defines the class Reservation_collection.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * This class defines the behaviours for Reservation_collection specifically
 */
class Reservation_collection extends Collection
{
    /**
     * Default constructor from parent, load query table.
     */
    function __construct() {
        parent::__construct();
        $this->collection_type = 'reservation';
    }
}
