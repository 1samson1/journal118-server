<?php
    require_once './base.php';// Подключаем базовую сущность API    

    $db->get_date(DateControl::get_current_timestamp_date());

    if($date = $db->get_row()){
        $db->get_dates_work($date['id']);
        $response->set_response($db->get_array());
    }
    else{
        $db->get_dates_work_empty();
        $response->set_response($db->get_array());
    }

    $response->print_json();
?>
