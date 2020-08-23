<?php       
    require_once './base.php';// Подключаем базовую сущность API     

    $db->remove_token($request->token);    

    $response->print_json();
?>
