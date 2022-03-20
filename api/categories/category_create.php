<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Categories.php';

    //instantite DB and connect
    $database = new Database();
    $db = $database->connect();

    //instantite blog post obj
    $post = new Categories($db);

    //get raw posted data

    $data = json_decode(file_get_contents("php://input"));

    $post->id = $data->id;
    $post->category = $data->category;

    //create post
    if($post->create()) {
        echo json_encode(
            array('message' => 'Category Created (id: ' . $data->id . ', Category: ' . $data->category . ')')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Created')
        );
    }