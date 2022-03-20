<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //instantite DB and connect
    $database = new Database();
    $db = $database->connect();

    //instantite blog post obj
    $post = new Quote($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //set id for update
    $post->id = $data->id;


    //create post
    if($post->delete()) {
        echo json_encode(
            array('message' => 'Quote ' . $post->id . ' Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }