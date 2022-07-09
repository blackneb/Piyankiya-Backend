<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Mehods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //instantiate DB and Connect
    $database = new Database();
    $db=$database->connect();

    //instantiate blog post object
    $post =new Post($db);

    $data = json_decode(file_get_contents("php://input"));

    if($post->create_booking($data->cid,$data->email,$data->name,$data->phone,$data->types)){
        echo json_encode(array('message' => 'post created'));
    }
    else{
        echo json_encode(array('message' => 'post not created'));
    }

?>