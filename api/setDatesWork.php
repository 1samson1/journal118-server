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
    ];
    

    $db->set_date(DateControl::get_current_timestamp_date());
    $db->get_date(DateControl::get_current_timestamp_date());
    if($row = $db->get_row()){        
        $db->set_dates_work($row['id'],$utk);
    }
    
    $response->print_json();
?>