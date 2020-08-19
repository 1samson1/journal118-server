<?php
    require_once './base.php';// Подключаем базовую сущность API    

    $db->get_dates();
    if($dates = $db->get_array()){
        $response->set_response($dates);
    }    

    $response->print_json();
?>
