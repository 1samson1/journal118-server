<?     
    define("ENGINE_DIR","../engine");
    require_once ENGINE_DIR.'/includes/init.php';
    require_once ENGINE_DIR.'/includes/catchJSON.php';

    header('Content-Type: application/json');

    $catchJSON = new catchJSON();
    $response['error']= False;     
?>