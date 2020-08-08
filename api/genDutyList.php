<?php 
    require_once './base.php';// Подключаем базовую сущность API   
    
    $db->get_date(DateControl::get_current_timestamp_date());

    $temp = 2;   
    $find_next = false; 

    if($date = $db->get_row()){
        $db->get_dates_work($date['id']);

        $count_duty = 0;  
        $Citer = new CycleIterator($db->get_array());

        $next = new BeginDutyList();    

        foreach($Citer as $user_work){
            if(!($count_duty < $temp)){
                break;
            }
            if($find_next || $user_work['user_id'] == $next->get_next()){
                if($user_work['exist']){
                    $users_duty[]= $user_work;
                    $count_duty++;
                }
                else{
                    $db->set_black_list($user_work['date_id'],$user_work['user_id']);
                }
                $find_next = true; 
            }
            /* else{
                echo "Пропуск до указателя!\n";
                //var_dump($next->get_next());
            } */ 
        }

        foreach($users_duty as $user){            
            $db->set_duty_list($user_work['date_id'],$user['user_id']);
        }

        
        $next_num = (int) array_pop($users_duty)['user_id'];
        $next->set($next_num,$next->get_next());
        $next->save();
        
    }    

    $response->print_json();
?>