<?php      
    require_once './base.php';// Подключаем базовую сущность API    

    $response->set_error_if(!CheckField::login($request->login), 'Некорректный логин', 201);

    $response->set_error_if(!CheckField::email($request->email), 'Некорректный email', 202);

    $response->set_error_if(!CheckField::pass($request->pass), 'Вы не ввели пароль', 203);

    $response->set_error_if(!CheckField::confirm_pass($request->pass,$request->repass), 'Пароль не совпадает с формой подтверждения', 204);
    
    
    if(!$response->errors){
        $db->reg_user($config['reg_user_group'],$request->name,$request->surname,$request->login,$request->email,$request->pass);
        
        $response->set_error_if($db->error, Error_info::reg_user($db->error_num), $db->error_num);        
    }  

    $response->print_json();
?>
