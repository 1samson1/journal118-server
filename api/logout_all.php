<?php       
    require_once './base.php';// Подключаем базовую сущность API     

    $db->get_user_token($request->token);
    if($user = $db->get_row()){
        $db->remove_token_all($user['id'],$request->token);
        $response->set_error_if($db->error,'Ошибка удаления токенов!',$db->error_num);
    }
    else $response->set_error('Недействительный токен',208);

    $response->print_json();
?>
