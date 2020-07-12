<?     
    define("ENGINE_DIR","../engine");

    require_once ENGINE_DIR.'/includes/init.php';

    require_once ENGINE_DIR.'/includes/catchJSON.php';

    require_once ENGINE_DIR.'/includes/response.php';

    require_once ENGINE_DIR.'/includes/errors.php';

    header('Content-Type: application/json');

    $catchJSON = new catchJSON();

?>