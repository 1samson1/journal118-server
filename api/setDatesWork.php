<?php 
    require_once './base.php';// Подключаем базовую сущность API    

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
            'exist' => false,
            'miss' => false,
            'miss_lessons' => 0,
        ),
    ];
    

    $db->set_date(DateControl::get_current_timestamp_date());
    $db->get_date(DateControl::get_current_timestamp_date());
    if($row = $db->get_row()){        
        $db->set_dates_work($row['id'],$utk);
    }
    $response->set_error_if($db->error,$db->error,$db->error_num);
    $response->print_json();
?>