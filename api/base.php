<?     
    define("ENGINE_DIR","../engine");

    require_once ENGINE_DIR.'/includes/init.php';

    require_once ENGINE_DIR.'/includes/catchJSON.php';

    require_once ENGINE_DIR.'/includes/response.php';

    require_once ENGINE_DIR.'/includes/errors.php';

    header('Content-Type: application/json');  

	header('Access-Control-Allow-Headers: *');

	header('Access-Control-Allow-Methods: POST');

	header('Access-Control-Allow-Origin: *');	
	

    $catchJSON = new catchJSON();

    $response = new Response();
?>