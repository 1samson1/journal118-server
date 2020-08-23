<?php
    require_once './base.php';// Подключаем базовую сущность API    

    $db->get_users_admin();
    if($users = $db->get_array()){
        $response->set_response($users);
    }    

    $response->print_json();
?>