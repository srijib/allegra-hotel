<?php
/**
 * This file defines the class Adjustment
 *
 * @author  Pearl Xiong <149532607@qq.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * This class controls adjustment table and do the calculation for
 * a specific date.
 */
class Adjustment {
    /**
     * This array stores all the data of the adjustment table
     * @property   array   $records
     */
    public $records = array();
    
    /**
     * Default constructor, load the data to the object.
     */
    function __construct() {
        $this->_load();
    }

    /**
     * Input a date and the function will calculate the adjustment
     * rate of that specific date.
     * 
     * @param       string    $date     The date to be calculate.
     * 
     * @return      float     Return -1 if error, float value if the
     * date is correct.
     */
    static function getRate($date) {
        if (gettype($date) === 'string')
            $timestamp = strtotime($date);
        else
            $timestamp = $date;

        if (!$timestamp)
            return -1;

        $month = strtoupper(date('M', $timestamp));
        $day_of_week = strtoupper(date('D', $timestamp));

        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->query("SELECT * FROM adjustment");
        $adjustments = $query->result();

        $valid_records = array();

        foreach ($adjustments as $object) {
            $adjustment_type = $object->adjustment_type;

            if ($adjustment_type !== NULL) {
                //compare day_of_week || month
                if ($month === $adjustment_type || $day_of_week === $adjustment_type) {
                    $valid_records[] = $object;
                }
            } else {
                //compare date range
                $start_date = strtotime($object->adjustment_start);
                $end_date = strtotime($object->adjustment_end);

                if ($timestamp >= $start_date && $timestamp <= $end_date) {
                    $valid_records[] = $object;
                }
            }
        }

        // $valid_records is now the array we want to work on

        $base_rate = 1;
        $final_rate = $base_rate;
        $max_prio = 0;

        foreach ($valid_records as $valid_record) {
            $new_row_rate = $valid_record->adjustment_rate;
            $new_row_prio = intval($valid_record->adjustment_priority);

            if ($new_row_prio === $max_prio) {
                $final_rate = $final_rate * $new_row_rate;
            } elseif ($new_row_prio > $max_prio) {
                $max_prio = $new_row_prio;
                $final_rate = $base_rate * $new_row_rate;
            }
        }
        
        return $final_rate;
    }

    /**
     * Create a new record in the adjustment table
     * 
     * @param       string    $type     The type of the adjustment rate, accept values
     * are: MON, TUE, WED, THU, FRI, SAT, SUN, JAN, FEB, MAR, APR, MAY, JUN, JUL, AUG,
     * SEP, OCT, NOV, DEC for normal calendar days in the week or month of the year. If
     * it is a special value, put SPC means special.
     * @param       date      $start    Only apply if it is a special (SPC) record, put
     * NULL here otherwise.
     * @param       date      $end      Only apply if it is a special (SPC) record, put
     * NULL here otherwise.
     * @param       float     $rate     The adjust rate
     * @param       int       $priority The priority of the record, heighest priority
     * will be calculated first. If records with same heighest priority is found, then
     * multiply all of them and then return the value.
     * 
     * @return      Adjustment      This adjustment object.
     */
    function create($type = NULL, $start = NULL, $end = NULL, $rate = 1, $priority = 10) {
        if($type === NULL){

            if($start === NULL && $end === NULL){
                trigger_error('These three values $type,$start,$end cannot be null at the same time.', E_USER_ERROR);
                exit();
            }
            if($start === NULL || $end === NULL){
                trigger_error('The values $start and $end cannot be NULL when the value $type is NULL .', E_USER_ERROR); 
                exit();
            }

            $start_ts = strtotime($start);
            $end_ts = strtotime($end);

            if (!$start_ts) {
                trigger_error('$start is not a valid date string.', E_USER_ERROR);
                exit();
            }
            if (!$end_ts) {
                trigger_error('$end is not a valid date string.', E_USER_ERROR);
                exit();
            }

            if ($start_ts > $end_ts) {
                trigger_error('$start date should be earlier than $end date.', E_USER_ERROR);
                exit();
            }

        }
        else{
            $valid_type = array( 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN', 'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
            $key = array_search($type, $valid_type);
            if($key === false){
                trigger_error('The value $type is not valid type.', E_USER_ERROR);
                exit();
            }
            if($start !== NULL || $end !==NULL){
                trigger_error('The values $start and $end should be NULL at the same time when the value $type is not NULL .', E_USER_ERROR); 
                exit();
            } 
        }
        
        $CI =& get_instance();
        $CI->load->database();

        if ($type === NULL) {
            $query = '
               INSERT INTO adjustment(ADJUSTMENT_id, ADJUSTMENT_type, ADJUSTMENT_start,ADJUSTMENT_end,ADJUSTMENT_rate, ADJUSTMENT_priority) 
               VALUES (NULL, NULL, STR_TO_DATE("'.$start.'",\'%Y-%m-%d\'),STR_TO_DATE("'.$end.'",\'%Y-%m-%d\') , '.$rate.', '.$priority.')
            ';
        } else {
            $query = '
               INSERT INTO adjustment(ADJUSTMENT_id, ADJUSTMENT_type, ADJUSTMENT_start,ADJUSTMENT_end,ADJUSTMENT_rate, ADJUSTMENT_priority) 
               VALUES (NULL, "'.$type.'", NULL, NULL, '.$rate.', '.$priority.')
            ';
        }

        $query = $CI->db->query($query);
        $this->_load();
        return $this;
    }

    /**
     * Drop the record value that has the ID of $id
     * 
     * @param        int     $id
     * 
     * @return      void
     */
    function drop($id) {
        $CI = & get_instance();
        $CI->load->database();
        $query = $CI->db->query("
            DELETE FROM adjustment
            WHERE adjustment_id=$id
        ");
        $this->_load();
    }

    /**
     * Load all data in the table adjustment to the object, everytime
     * this function will empty all records to make sure there is no
     * duplication.
     * 
     * @return      Adjustment 
     */
    private function _load() {
        $this->records = array();
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->query('
            SELECT * FROM adjustment
        ');
        
        foreach ($query->result() as $row) {
            $this->records[$row->adjustment_id] = array(
                'type' => $row->adjustment_type,
                'start' => $row->adjustment_start,
                'end' => $row->adjustment_end,
                'rate' => $row->adjustment_rate,
                'priority' => $row->adjustment_priority
            );
        }    
        return $this;
    }
}
