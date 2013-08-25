<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in'))
{
    function is_logged_in() {
        if (isset($_SESSION['customer']['logged_in']))
            return $_SESSION['customer']['logged_in'];
        else
            return false;
    }
}

if ( ! function_exists('logged_in_id'))
{
    function logged_in_id() {
        if (isset($_SESSION['customer']['cus_id']))
            return $_SESSION['customer']['cus_id'];
        else
            return false;
    }
}

if ( ! function_exists('logged_in_fullname'))
{
    function logged_fullname() {
        if (isset($_SESSION['customer']['full_name']))
            return $_SESSION['customer']['full_name'];
        else
            return false;
    }
}

if ( ! function_exists('logged_in_username'))
{
    function logged_username() {
        if (isset($_SESSION['customer']['user_name']))
            return $_SESSION['customer']['user_name'];
        else
            return false;
    }
}
