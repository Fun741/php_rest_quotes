<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//echo json_encode('did this run');

$database = new Database();
$db = $database->connect();

//instantite blog post obj
$post = new Author($db);



if ($method == 'GET') {

    //if id exists
    if(isset($_GET['id'])) {
        require 'author_single.php';
    }      
    else {
        //if id does not exist
        require 'author.php'; 
    }
}
else if ($method == 'POST') {

    require 'author_create.php';

}
else if ($method == 'PUT') {

    require 'author_update.php';

}
else if ($method == 'DELETE') {

    require 'author_delete.php';

}
else {
    echo json_encode('method: ' . $method . ' do not have');

}