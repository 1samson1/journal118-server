<?php       
    require_once './base.php';// Подключаем базовую сущность API     

    $db->get_user_token($request->token);
    if($user = $db->get_row()){
        $response->set_response($user);
    }
    else $response->set_error('Недействительный токен',208);

    $response->print_json();
?>
