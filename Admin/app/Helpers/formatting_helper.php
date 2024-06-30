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
    
    function thousand_separator($number)
    {
        return number_format($number, 0, ',', '.');
    }
