<?php 
    require_once './base.php';// Подключаем базовую сущность API    
	
    $db->get_user_token($request->token);
    $user = $db->get_row();
    if($user['group_id'] == 1){
        foreach($request->users as $user_edit){
            $db->update_users_admin(
                $user_edit->user_id,
                $date_work->miss_user
            );
        }
        $db->confirm_queries();
        $response->set_error_if($db->error,'Ошибка изменения!',$db->error_num);
    }
    else $response->set_error('Недостаточно прав!',210);

    $response->print_json();
?>
