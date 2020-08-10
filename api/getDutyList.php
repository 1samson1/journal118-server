<?php 
    require_once './base.php';// Подключаем базовую сущность API  

    $db->get_duty_list_all();
    if($duty_list = $db->get_array()){
        $response->set_response($duty_list);
    }

    $response->print_json();
?>
