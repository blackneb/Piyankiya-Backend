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

    $idf =isset($_GET['id'])? $_GET['id'] : die();

    $result = $post->read_single($idf);

    $num = $result->rowCount();

    if($num>0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'id'=> $row['C_ID'],
                'name'=>$row['NAME'],
                'gfor'=>$row['GFOR'],
                'afor'=>$row['AFOR'],
                'photos'=>$row['PHOTOS'],
                'price'=>$row['PRICE'],
                'types'=>$row['TYPES'],
                'description'=>$row['DESCRIPTION']
            );
            echo json_encode($post_item);
        }
    }else{
        echo json_encode(array('message'=>'no posts found'));
    }

?>