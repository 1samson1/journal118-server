<?php 
    require_once './base.php';// Подключаем базовую сущность API   
    
    $db->get_date(DateControl::get_current_timestamp_date());

    $temp = 2;    

    if($date = $db->get_row()){
        $db->get_dates_work($date['id']);

        $count_duty = 0;  
        $Citer = new CycleIterator($db->get_array());        
        foreach($Citer as $user_work){
            if(!($count_duty < $temp)){
                break;
            }
            if($user_work['exist']){
                $users_duty[]= $user_work;
                $count_duty++;
            }
            else{
                $db->set_black_list($user_work['date_id'],$user_work['user_id']);
            }
        }

        foreach($users_duty as $user){            
            $db->set_duty_list($user_work['date_id'],$user['user_id']);
        }
        
    }    

    $response->print_json();
?>