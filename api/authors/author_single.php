<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //instantite DB and connect
    $database = new Database();
    $db = $database->connect();

    //instantite blog post obj
    $post = new Author($db);

    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    //get post

    //echo $post->id;

    $post->read_single();

    //create array
    $post_arr = array(
        'id' => $post->id,
        'author' => $post->author
    );

    // make json

    print_r(json_encode($post_arr));