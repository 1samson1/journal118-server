<?         
    require_once './base.php';   

    //$db->reg_user($config['reg_user_group'],'fgjdkf',"fdhjfdjkf",'fhdjfj','efhdjf@fhdj.tu','1234');
    $request = $catchJSON->get_array();

    var_dump($request);

    if(!CheckFeild::login($request->login)){
        
    }


    echo json_encode($response);
?>