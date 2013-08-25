<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Room_collection
{

    public $rooms = array();

    public function loadAll() {
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->query('SELECT room_id FROM room');

        foreach ($query->result() as $row) {
            $r = new Room();
            $r->load($row->room_id);
            $this->rooms[$row->room_id] = $r;
            unset($r);
        }

        return $this->rooms;
    }

    public function drop($id) {
        foreach ($this->rooms as $index=>$r) {
            if ($index == $id) {
                unset($this->rooms[$index]);
                break;
            }
        }
        
        return $this->rooms;
    }

    public function getAll() {
        return $this->rooms;
    }
}
