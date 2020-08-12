<?php
    require_once './base.php';// Подключаем базовую сущность API    
    
    $db->get_dates_work($request->date_id);

    if($dates_work = $db->get_array()){        
        $response->set_response($dates_work);
    }
    else $response->set_error('Работ на эту дату нет!',216);

    $response->print_json();
?>
