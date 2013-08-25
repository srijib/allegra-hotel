<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Room
{

    protected $id = NULL;
    protected $data = array();
    protected $items = array();
    protected $item_quantity;
    protected $item_price;

    public function __construct() {
    
    }

    public function create($hotel_id, $roomtype_id, $room_number) {

        if ($this->id !== NULL) {
            throw new Exception("The room object is not empty");
            return false;
        }

        $CI = & get_instance();
        $CI->load->database();

        $query = $CI->db->query("
            SELECT room_id FROM room
            WHERE hotel_id=$hotel_id
                AND roomtype_id=$roomtype_id
                AND room_number=\"$room_number\"
        ");
        $result = $query->result();
        if (count($result) === 1) {
            throw new Exception("This room has been created.");
            return false;
        }

        $query_insert = $CI->db->query("
            INSERT INTO room (room_id, hotel_id, roomtype_id, room_number)
            VALUES (NULL, $hotel_id, $roomtype_id, \"$room_number\")
        ");

        $new_room_id = $CI->db->insert_id();
        $this->id = $new_room_id;

        return $this->load($this->id);
    }

    public function load($id) {
        if ($this->id !== NULL) {
            return $this;
        }

        $this->id = intval($id);
        $this->_load();
        return $this;   
    }

    protected function _load() {
        if ($this->id === NULL)
            return $this;

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query("
            SELECT * FROM room
            WHERE room_id = $this->id
        ");

        $result = $query->result();
        $row = $result[0];
        $this->data['room_id'] = $row->room_id;
        $this->data['hotel_id'] = $row->hotel_id;
        $this->data['roomtype_id'] = $row->roomtype_id;
        $this->data['room_number'] = $row->room_number;

        return $this;
    }

    public function get($key) {
        if ($key === 'id')
            return $this->id;
        elseif (isset($this->data[$key]))
            return $this->data[$key];
        else
            return false;
    }

    public function set($key, $value, $position) {
        if (isset($this->data[$key]))
            $this->data[$key] = $value;
        return $this;
    }

    public function save()
    {
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            UPDATE room
            SET room.hotel_id = ' . $this->data['hotel_id'] . ', 
                room.roomtype_id = ' . $this->data['roomtype_id']. ',
                room.room_number = ' . $this->data['room_number'] . '
            WHERE room.room_id = ' . $this->data['room_id'] .'
        ');
    }

    public function drop() {
        if ($this->id === NULL) {
            throw new Exception('You have to load the object before delete');
            return false;
        }

        $CI = & get_instance();
        $CI->load->database();
        $check_exists = $CI->db->query("
            SELECT room_id FROM room WHERE room_id=$this->id
        ");

        if (count($check_exists->result()) > 0) {
            $remove = $CI->db->query("
                DELETE FROM room WHERE room_id=$this->id
            ");
        }
    }

    public function load_items($room_id=NULL)
    {
        if ($room_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT room_has_item.*
            FROM room_has_item
            WHERE 
                room_id = ' . $room_id . '
        ');
     
        $item_collection = new Item_collection();
        $item_collection->loadAll();
        $items = $item_collection->getAll();

        $valid_items_cl = new Item_collection();

        foreach($query->result() as $row)
        {
            foreach($items as $item)
            {
                if($item->get('id') == $row->item_id)
                {
                    $valid_items_cl->append($item);
                }    
            }
        }
   
        $this->items = $valid_items_cl->getAll();
        return $this->items;
    }

    function get_item_quantity($room_id = NULL, $item_id = NULL){
        if ($room_id === NULL || $item_id === NULL) {
            return NULL;
        }

        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT room_has_item.*
            FROM room_has_item
            WHERE 
                room_id = ' . $room_id . ' AND
                item_id = ' . $item_id . '
        ');

        foreach($query->result() as $row)
        {
            $this->item_quantity = $row->quantity;
        }
        return $this->item_quantity;
    }
}
