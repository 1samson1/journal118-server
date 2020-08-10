<?php 
    require_once './base.php';// Подключаем базовую сущность API  

    $db->get_black_list_all();
    if($black_list = $db->get_array()){
        $response->set_response($black_list);
    }

    $response->print_json();
?>
