<?php
    require_once './base.php';// Подключаем базовую сущность API    

    $db->get_dates();
    if($dates = $db->get_array()){
        $response->set_response($dates);
    }
    else $response->set_error('Работ на эту дату нет!',217);

    $response->print_json();
?>
