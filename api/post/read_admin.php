<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Mehods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //instantiate DB and Connect
    $database = new Database();
    $db=$database->connect();


    //instantiate blog post object
    $post =new Post($db);
    $result = $post->read_admin();

    $data = json_decode(file_get_contents("php://input"));

    $num = $result->rowCount();

    if($num>0){
        $posts_arr = array();
        $posts_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            if(password_verify($data->username, $row['USERNAME']) && password_verify($data->password, $row['PASSWORD'])){
                echo json_encode(array('message'=>'success'));
            }
            else{
                echo json_encode(array('message'=>'error'));
            }
    }
}
    else{
        echo json_encode(array('message'=>'error'));
    }


?>