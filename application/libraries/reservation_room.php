<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Reservation_room
{
    public static function check($room_id, $date) {
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->query("
            SELECT room_id, reserve_date FROM reservation_has_room
            WHERE room_id = $room_id
        ");   

        foreach ($query->result() as $row) {
            $date_str = $row->reserve_date;
            $date_stamp = strtotime($date_str);
            if ($date_stamp === $date) {
                return false;
            }
        }
        return true;
    }
}
