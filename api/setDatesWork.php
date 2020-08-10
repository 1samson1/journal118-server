<?php 
    require_once './base.php';// Подключаем базовую сущность API    

    $db->get_user_token($request->token);
    $user = $db->get_row();
    if($user['group_id'] == 1){

        $utk = [
            array(
                'user_id' => 3,
                'exist' => true,
                'miss' => true,
                'miss_lessons' => 3
            ),
            array(
                'user_id' => 39,
                'exist' => false,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 43,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 44,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 45,
                'exist' => false,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 46,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 47,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 49,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 51,
                'exist' => false,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 52,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 53,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 55,
                'exist' => false,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 56,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 57,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
            array(
                'user_id' => 58,
                'exist' => true,
                'miss' => false,
                'miss_lessons' => 0,
            ),
        ];  

        $db->set_date(DateControl::get_current_timestamp_date());
        $db->get_date(DateControl::get_current_timestamp_date());
        if($date = $db->get_row()){
            $db->get_dates_work($date['id']);
            if($dates_work = $db->get_row()){
                foreach($utk as $date_work){
                    $db->update_dates_work(
                        $date['id'],
                        $date_work['user_id'],
                        $date_work['exist'],
                        $date_work['miss'],
                        $date_work['miss_lessons']
                    );
                    $db->confirm_queries();
                }
                //$response->set_error_if($db->error,$db->error,$db->error_num);                
            }              
            else{
                $db->set_dates_work($date['id'],$utk);
            }
        }
    }
    else $response->set_error('Недостаточно прав!',210);

    $response->print_json();
?>
