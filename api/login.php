<?         
    require_once './base.php';// Подключаем базовую сущность API

    $request = $catchJSON->get_array();

    $response = new Response();

    $response->set_error_if(!CheckField::login($request->login), 'Некорректный логин', 201);    

    $response->set_error_if(!CheckField::pass($request->pass), 'Вы не ввели пароль', 203);   
    
    if(!$response->errors){
        $db->check_user($request->login);
        
        if($row = $db->get_row()){              
            if (password_verify(htmlspecialchars($request->pass), $row['password'])){
                $_SESSION['logined'] = $row;
                unset($row['password']);
                $response->set_response($row);
            }

            else $response->set_error('Неправильный пароль от учётной записи',205);
        }
        else $response->set_error('Пользователя с таким именем нет!',206);

        $response->set_error_if($db->error, Error_info::reg_user($db->error_num), $db->error_num);        
    }

    $response->print_json();
?>