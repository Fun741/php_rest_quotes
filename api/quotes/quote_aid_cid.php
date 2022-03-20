<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //instantite DB and connect
    $database = new Database();
    $db = $database->connect();

    //instantite blog post obj
    $post = new Quote($db);

    //set binded params
    $post->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die();
    $post->categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : die();


    //blog post qu
    $result = $post->read_aid_cid();
    //get row count
    $num = $result->rowCount();

    //check for posts 
    if($num > 0) {
        //post arr
        $posts_arr = array();
        $posts_arr['data'] = array();

        
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $post_item = array(
                'id' => $id,
                'quote' => html_entity_decode($quote),
                'author' => $author,
                'category' => $category
            );
            

            //puch to "data"
            array_push($posts_arr['data'], $post_item);
        }
        

        //turn to json
        echo json_encode($posts_arr);

    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }

