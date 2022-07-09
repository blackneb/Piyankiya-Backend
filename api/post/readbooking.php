<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //instantiate DB and Connect
    $database = new Database();
    $db=$database->connect();

    //instantiate blog post object
    $post =new Post($db);

    $result = $post->read_booking();

    $num = $result->rowCount();

    if($num>0){
        $posts_arr = array();
        $posts_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'bid'=> $row['B_ID'],
                'cid'=> $row['C_ID'],
                'email'=> $row['EMAIL'],
                'name'=> $row['CLIENT_NAME'],
                'phone'=> $row['CLIENT_PHONE']
            );
            array_push($posts_arr['data'],$post_item);
        }
        echo json_encode($posts_arr);
    }else{
        echo json_encode(array('message'=>'no posts found'));
    }
?>