<?php 
    require_once './base.php';// Подключаем базовую сущность API   
    
    
    
    $db->get_date(DateControl::get_current_timestamp_date());

    $temp = 2;   
    

    if($date = $db->get_row()){
        $count_duty = 0;    
        $find_next = false; 

        $next = new BeginDutyList();    
        /*Check exist duty list from current date */

        $db->get_duty_list($date['id']);
        if($duty_user = $db->get_row()){
            $db->remove_duty_list($date['id']);
            $db->remove_black_list_date($date['id']);
            $db->get_black_list_backup($date['id']);
            if($backups = $db->get_array()){
                foreach ($backups as $backup) {
                    $db->set_black_list($backup['date_id'],$backup['user_id'],$backup['reason']);
                }
            }
            $db->remove_black_list_backup($backup['date_id']);
            $next->set_next($next->get_previus());
        }

        /*Get duty user from black_list */

        $db->get_black_list_exist($date['id']);

        $black_list = $db->get_array();
        if(isset($black_list[0])){
            foreach($black_list as $user_black){
                echo 'Зашло по чёрному списку: '.$count_duty."\n";
                if(!($count_duty < $temp)){
                    break;
                }
                $user_black['reason'] = 'За отсутствие на '.DateControl::to_date($user_black['date']);
                $users_duty[]= $user_black;
                $db->set_black_list_backup($user_black['previus_date_id'],$user_black['user_id'],$user_black['date_id'],$user_black['reason']);
                $db->remove_black_list($user_black['previus_date_id'],$user_black['user_id']);
                $count_duty++;
            }
        }

        /*Get duty user from dates_work */

        if($count_duty < $temp){      
           
            $db->get_dates_work($date['id']);
            
            $Citer = new CycleIterator($db->get_array());

            foreach($Citer as $user_work){
                if(!($count_duty < $temp)){
                    break;
                }
                if($find_next || $user_work['user_id'] == $next->get_next()){
                    echo 'Зашло по списку: '.$count_duty."\n";
                    if($user_work['exist']){
                        $user_work['reason'] = 'По списку';
                        $users_duty[]= $user_work;
                        $count_duty++;
                    }
                    else{
                        $db->set_black_list(
                            $user_work['date_id'],
                            $user_work['user_id'],
                            'Отсутствие на '.DateControl::get_current_date()
                        );
                    }
                    $find_next = true; 
                }
            }
        }

        /* Set duty list */
        foreach($users_duty as $user){            
            $db->set_duty_list($user['date_id'], $user['user_id'], $user['reason']);
        }

        $response->set_response($users_duty);

        /* Set cache BeginDutyList */
        if($find_next){
            $next_num = (int) array_pop($users_duty)['user_id'];
            $next->set($next_num,$next->get_next());
        }
        $next->save();
        
    }    

    $response->print_json();
?>