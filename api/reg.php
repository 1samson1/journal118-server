<?         
    require_once './base.php';// Подключаем базовую сущность API

    $request = $catchJSON->get_array();

    if(!CheckField::login($request->login)){
        $response['error'] = True;
        $response['error_info'] = 'Некорректный логин';
        $response['error_num'] = 201;
    }
    if(!CheckField::email($request->email)){
        $response['error'] = True;
        $response['error_info'] = 'Некорректный email';
        $response['error_num'] = 202;
    }
    if(!CheckField::pass($request->pass)){
        $response['error'] = True;
        $response['error_info'] = 'Вы не ввели пароль';
        $response['error_num'] = 203;
    }
    if(!CheckField::confirm_pass($request->pass,$request->repass)){
        $response['error'] = True;
        $response['error_info'] = 'Пароль не совпадает с формой подтверждения';
        $response['error_num'] = 204;
    }
    if(!$response['error']){
        $db->reg_user($config['reg_user_group'],$request->name,$request->surname,$request->login,$request->email,$request->pass);
        var_dump($db->error);
        
        if($db->error){
            $response['error'] = True;
            $response['error_info'] = $db->get_info_error();
            $response['error_num'] = $db->error_num;
        }        
    }
    

    echo json_encode($response);
?>