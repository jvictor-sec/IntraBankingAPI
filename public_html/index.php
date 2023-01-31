<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

require_once "../vendor/autoload.php";

if($_SERVER["REQUEST_URI"]){
  $url =  explode("/", $_SERVER["REQUEST_URI"]);
  array_splice($url, 0, 4);

  if($url[0] === "api"){
    array_shift($url);

    $controller = 'App\Controllers\\'.ucfirst($url[0]).'Controller';

    array_shift($url);

    $method = strtolower($_SERVER['REQUEST_METHOD']);

    try{
        $response = call_user_func_array(array(new $controller, $method), $url);
        http_response_code(200);
        echo json_encode(array('status'=>'success', 'data'=>$response), JSON_UNESCAPED_UNICODE);
    }
    catch(\Exception $e){
        http_response_code(404);
        echo json_encode(array('status'=>'error', 'data'=>$e->getMessage()), JSON_UNESCAPED_UNICODE);
    }
  }
}
