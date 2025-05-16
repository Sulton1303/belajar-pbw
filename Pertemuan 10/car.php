<?php 
require_once "method.php"; 

$obj_car = new Car(); 
$request_method = $_SERVER["REQUEST_METHOD"]; 

switch ($request_method) { 
    case 'GET': 
        if (!empty($_GET["id"])) { 
            $id = intval($_GET["id"]); 
            $obj_car->get_car($id); 
        } else { 
            $obj_car->get_cars(); 
        } 
        break; 

    case 'POST': 
        if (!empty($_GET["id"])) { 
            $id = intval($_GET["id"]); 
            $obj_car->update_car($id); 
        } else { 
            $obj_car->insert_car(); 
        } 
        break; 

    case 'DELETE': 
        $id = intval($_GET["id"]); 
        $obj_car->delete_car($id); 
        break; 

    default: 
        header("HTTP/1.0 405 Method Not Allowed"); 
        break; 
}