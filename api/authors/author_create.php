<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //instantite DB and connect
    $database = new Database();
    $db = $database->connect();

    //instantite blog post obj
    $post = new Author($db);

    //get raw posted data

    $data = json_decode(file_get_contents("php://input"));

    $post->id = $data->id;
    $post->author = $data->author;


    //create post
    if($post->create()) {
        echo json_encode(
            array('message' => 'Created author (id: ' . $data->id . ', Author: ' . $data->author . ')')
        );
    } else {
        echo json_encode(
            array('message' => 'Author Not Created')
        );
    }