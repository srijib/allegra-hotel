<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('add_roomtype_url'))
{
    function add_roomtype_url($type_id) {
        $base_url = base_url('res/ajax/add_roomtype');
        return "$base_url/$type_id";
    }
}

if ( ! function_exists('remove_roomtype_url'))
{
    function remove_roomtype_url($type_id) {
        $base_url = base_url('res/ajax/remove_roomtype');
        return "$base_url/$type_id";
    }
}

if ( ! function_exists('calculate_roomtype_price'))
{
    function calculate_roomtype_price($type_id, $checkin, $checkout, $no_of_room) {
        $range = get_date_range_array($checkin, $checkout);

        $price = array(
            'total' => 0,
            'days' => array(),
            'total_all' => 0,
            'days_all' => array(),
        );

        foreach ($range as $day) {
            $rate = Adjustment::getRate($day);
            $rt = new Roomtype();
            $rt->load($type_id);
            $p = $rt->get('roomtype_price');

            $fp = round($p * $rate, 2);
            $fpr = $fp * $no_of_room;

            $price['days'][date('d-m-Y', $day)] = $fp;
            $price['total'] += $fp;
            $price['days_all'][date('d-m-Y', $day)] = $fpr;
            $price['total_all'] += $fpr;
        }

        return $price;
    }
}

if ( ! function_exists('get_date_range_array'))
{
    function get_date_range_array($in_date_raw, $out_date_raw) {
        $in_date = strtotime($in_date_raw);
        $out_date = strtotime($out_date_raw);

        if (!$in_date) {
            throw new Exception("Check-in date not valid");
            return false;
        }

        if (!$out_date) {
            throw new Exception("Check-out date not valid");
            return false;
        }
        $no_of_days = ($out_date - $in_date) / 86400;

        $return_days = array();

        for ($i = 0; $i < $no_of_days; $i++) {
            $return_days[] = $in_date + $i * 86400;
        }

        return $return_days;
    }
}


if ( ! function_exists('get_reservation_room_array'))
{
    function get_reservation_room_array($hotel, $roomtype, $no_of_room, $check_in, $check_out) {

        $cart = $_SESSION['cart'];

        // get certain number of rooms = no_of_room

        $rooms = array();

        $rc = new Room_collection();
        $rc->loadAll();

        foreach ($rc->rooms as $r) {
            if ($r->get('hotel_id') === $cart['hotel'] &&
                $r->get('roomtype_id') === $cart['roomtype']) {
                $rt = new Roomtype(); $rt->load($r->get('roomtype_id'));
                $rooms[$r->get('id')] = $rt->get('roomtype_price');
            }
            if (count($rooms) === intval($cart['no_of_room'])) {
                break;
            }
        }

        $dates = get_date_range_array($cart['check_in'], $cart['check_out']);

        $final_array = array();

        foreach ($dates as $date) {
            $rate = Adjustment::getRate($date);
            foreach ($rooms as $room_id=>$room_oprice) {
                $room_fprice = round($room_oprice * $rate, 2);
                $final_array[] = array(
                    'room_id' => $room_id,
                    'date' => $date,
                    'price' => $room_fprice
                );
            }
        }
        
        return $final_array;
    }
}
