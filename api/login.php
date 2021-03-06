<?php       
    require_once './base.php';// Подключаем базовую сущность API      

    $response->set_error_if(!CheckField::login($request->login), 'Некорректный логин', 201);    

    $response->set_error_if(!CheckField::pass($request->pass), 'Вы не ввели пароль', 203);   
    
    if(!$response->errors){
        $db->check_user($request->login);
        
        if($user = $db->get_row()){              
            if (CheckField::confirm_hash($request->pass, $user['password'])){
                unset($user['password']);
                $token = $db->hash(time());
                $db->add_token($user['id'], $token, user_browser($_SERVER['HTTP_USER_AGENT']));
                
                if(!$db->error){                    
                    $res = array('user' => $user, 'token' => $token );
                    $response->set_response($res);
                }
                else $response->set_error('Не удалось выдать токен',207);
            }
            else $response->set_error('Неправильный пароль от учётной записи',205);
        }
        else $response->set_error('Пользователя с таким именем нет',206);

        $response->set_error_if($db->error, Error_info::reg_user($db->error_num), $db->error_num);        
    }

    $response->print_json();
?>
