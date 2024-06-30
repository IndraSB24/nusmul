<?php

    function activeId(){
        return session('activeId');
    }
    
    function activeServiceId(){
        return session('id_service');
    }
    
    function activeService(){
        $service_id = session('id_service');
        
        switch($service_id){
            case '1':
                return 'nusmul';
            break;
            case '2':
                return 'travel';
            break;
            case '3':
                return 'cargo';
            break;
            case '4':
                return 'bus';
            break;
        }
    }
    
    function getServiceId($service){
        switch($service){
            case 'nusmul':
                return 1;
            break;
            case 'travel':
                return 2;
            break;
            case 'cargo':
                return 3;
            break;
            case 'bus':
                return 4;
            break;
        }
    }

