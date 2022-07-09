<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Mehods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //instantiate DB and Connect
    $database = new Database();
    $db=$database->connect();

    //instantiate blog post object
    $post =new Post($db);
    $idf =isset($_GET['gender'])? $_GET['gender'] : die();
    $result = $post->read_byg($idf);

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
                'price'=>$row['PRICE'],
                'types'=>$row['TYPES'],
                'description'=>$row['DESCRIPTION']
            );
            array_push($posts_arr['data'],$post_item);
        }
        echo json_encode($posts_arr);
    }else{
        echo json_encode(array('message'=>'no posts found'));
    }

?>