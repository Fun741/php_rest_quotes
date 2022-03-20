<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

include_once '../../config/Database.php';
include_once '../../models/Categories.php';

//echo json_encode('did this run');

$database = new Database();
$db = $database->connect();

//instantite blog post obj
$post = new Categories($db);



if ($method == 'GET') {

    //if id exists
    if(isset($_GET['id'])) {
        require 'category_single.php';       

    } 
    else {
        //if id does not exist
        require 'category.php'; 
    }
    
}
else if ($method == 'POST') {

    require 'category_create.php';

}
else if ($method == 'PUT') {

    require 'category_update.php';

}
else if ($method == 'DELETE') {

    require 'category_delete.php';

}
else {
    echo json_encode('method: ' . $method . ' do not have');

}