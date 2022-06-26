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

    $result = $post->read();

    $num = $result->rowCount();

    if($num>0){
        $posts_arr = array();
        $posts_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'id'=> $row['C_ID'],
                'name'=>$row['NAME'],
                'gfor'=>$row['GFOR'],
                'afor'=>$row['AFOR'],
                'photos'=>$row['PHOTOS'],
                'price'=>$row['PRICE']
            );
            array_push($posts_arr['data'],$post_item);
        }
        echo json_encode($posts_arr);
    }else{
        echo json_encode(array('message'=>'no posts found'));
    }
?>