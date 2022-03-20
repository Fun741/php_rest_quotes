<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';
include_once '../../models/Categories.php';

//echo json_encode('did this run');

$database = new Database();
$db = $database->connect();

//instantite blog post obj
$post = new Quote($db);


if ($method === 'GET') {

    //if id exists
    if(isset($_GET['id'])) {
        require 'quote_single.php';       
    }
    else if (isset($_GET['authorId']) && !(isset($_GET['categoryId']))) {
        require 'quote_authorid.php';
    } 
    else if (isset($_GET['categoryId']) && !(isset($_GET['authorId']))) {
        require 'quote_categoryid.php';
    } 
    else if (isset($_GET['authorId']) && isset($_GET['categoryId'])) {
        require 'quote_aid_cid.php';
    }
    else {
        //if id does not exist
        require 'quote.php'; 
    }
    
}
else if ($method == 'POST') {

    require 'quote_create.php';

}
else if ($method == 'PUT') {

    require 'quote_update.php';

}
else if ($method == 'DELETE') {

    require 'quote_delete.php';

}
else {
    echo "FHSU";
}