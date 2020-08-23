<?php 
    require_once './base.php';// Подключаем базовую сущность API    
	
    $db->get_user_token($request->token);
    $user = $db->get_row();
    if($user['group_id'] == 1){

        $db->set_date(DateControl::get_current_timestamp_date());
        $db->get_date(DateControl::get_current_timestamp_date());
        if($date = $db->get_row()){
            $db->get_dates_work($date['id']);
            if($dates_work = $db->get_row()){
                foreach($request->datesWorkToday as $date_work){
                    $db->update_dates_work(
                        $date['id'],
                        $date_work->user_id,
                        $date_work->exist,
                        $date_work->miss,
                        $date_work->miss_lessons
                    );
                }
                $db->confirm_queries();
                $response->set_error_if($db->error,'Ошибка изменения!',$db->error_num);                
            }              
            else{
                $db->set_dates_work($date['id'],$request->datesWorkToday);
            }
        }
    }
    else $response->set_error('Недостаточно прав!',210);

    $response->print_json();
?>
