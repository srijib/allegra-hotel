<?php
/**
 * This file defines the class Roomtype, it maps the ROOMTYPE database.
 *
 * @author  Xinyun Zhou <me@xyzhou.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class defines the behaviours for Roomtype specifically
 */
class Roomtype extends Object
{
    /**
     * Default constructor from parent, load query table.
     */
	function __construct() {
		parent::__construct();
		$this->query_table = 'roomtype';
	}

    function getReview() {
        $CI = & get_instance();
        $CI->load->database();

        if ($this->id !== NULL) {
            $query = $CI->db->query(
                "select r.review from reservation r, reservation_has_room rr, room ro\n"
                . "where r.reservation_id=rr.reservation_id\n"
                . "AND rr.room_id=ro.room_id\n"
                . "AND ro.roomtype_id=$this->id"
            );
            $results = $query->result();
            if (empty($results)) {
                return 0;
            } else {
                $total = 0;
                foreach ($results as $r) {
                    if ($r->review > 0) $total += $r->review;
                }
                return round($total / count($results),1);
            }
        } else {
            return false;
        }
    }
}
