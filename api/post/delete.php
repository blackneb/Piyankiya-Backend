<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Mehods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //instantiate DB and Connect
    $database = new Database();
    $db=$database->connect();

    //instantiate blog post object
    $post =new Post($db);

    $idf = isset($_GET['id'])? $_GET['id'] : die();

    if($post->delete($idf)){
        echo json_encode(array('message' => 'post deleted'));
    }
    else{
        echo json_encode(array('message' => 'post not deleted'));
    }

?>