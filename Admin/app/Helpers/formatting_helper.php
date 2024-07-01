<?php

    function format_gender($kode){
        switch($kode){
            case 'l':
                return "Laki-laki";
            break;
            case 'p':
                return "Perempuan";
            break;
            default:
                return "Gender Dilarang!!";
        }
    }
    
    function generate_customer_code($number) {
        $number = max(1, intval($number));
        $formattedNumber = str_pad($number, 6, '0', STR_PAD_LEFT);
        return 'CNM-'.$formattedNumber;
    }
    
    function thousand_separator($number, $decimal_places=0)
    {
        return number_format($number, $decimal_places, ',', '.');
    }

    function generate_general_code($prefix, $number, $length = 4) {
        $paddedNumber = str_pad($number, $length, '0', STR_PAD_LEFT);
        $code = $prefix . '-' . $paddedNumber;
        return $code;
    }

    function db_date_format_from_datepicker($date_string){
        $date = \DateTime::createFromFormat('d M, Y', $date_string);

        if ($date !== false) {
            return $date->format('Y-m-d');
        } else {
            return false;
        }
    }

    function indoDate($date) {
        // Parse the input date string
        $timestamp = strtotime($date);
    
        // Format the date as dd-mm-yyyy
        $formattedDate = date('d-m-Y', $timestamp);
    
        return $formattedDate;
    }

    function dbDate($date) {
        // Parse the input date string
        $timestamp = strtotime($date);
    
        // Format the date as dd-mm-yyyy
        $formattedDate = date('Y-m-d', $timestamp);
    
        return $formattedDate;
    }

    function makePositive($number) {
        // Convert negative numbers to positive
        $positiveNumber = abs($number);
        
        return $positiveNumber;
    }
    
