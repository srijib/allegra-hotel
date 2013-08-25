<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Opt
{
	static function get($key) {
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT options_value FROM options WHERE options_key="'.$key.'"
		');
        
        foreach ($query->result() as $row) {
            return $row->options_value;
        }
        return false;
    }

    static function set($key, $value) {
        $CI = & get_instance();
        $CI->load->database();
        
        $query = $CI->db->query('
             UPDATE options
             SET options_value="'.$value.'"
             WHERE options_key="'.$key.'"
        ');
    }
}
