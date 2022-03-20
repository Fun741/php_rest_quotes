<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Categories.php';

    //instantite DB and connect
    $database = new Database();
    $db = $database->connect();

    //instantite blog post obj
    $post = new Categories($db);

    //blog post qu
    $result = $post->read();
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
                'category' => html_entity_decode($category)
            );

            //puch to "data"
            array_push($posts_arr['data'], $post_item);
        }
        

        //turn to json
        echo json_encode($posts_arr);

    } else {
        echo json_encode(
            array('message' => 'No Posts Fount')
        );
    }

