<?php       
    require_once './base.php';// Подключаем базовую сущность API     

    $db->get_user_token_all($request->token);
    if($user = $db->get_row()){

        $response->set_error_if(!CheckField::login($request->login), 'Некорректный логин', 201);

		$response->set_error_if(!CheckField::email($request->email), 'Некорректный email', 202);
        
        if(isset($request->newpass[0])){
            $response->set_error_if(!CheckField::confirm_hash($request->pass,$user['password']), 'Пароль не совпадает с предыдущим', 256);
    
            $response->set_error_if(!CheckField::confirm_pass($request->newpass,$request->repass), 'Пароль не совпадает с формой подтверждения', 204);
        }

        if(!$response->errors){
			$db->update_user_data($user['id'], $request->name, $request->surname, $request->login, $request->email, $request->newpass);
			
			$response->set_error_if($db->error, Error_info::reg_user($db->error_num), $db->error_num);        
        }
        
        if(!$response->errors){
            $response->set_response(array(
                'id' => $user['id'],
                'group_id' => $user['group_id'],
                `name` => $request->name, 
                `surname` => $request->surname, 
                `login` => $request->login, 
                `email` => $request->email, 
                `miss_user` => $user['miss_user'],
            ));
        }
    }
    else $response->set_error('Недействительный токен',208);

    $response->print_json();
?>
