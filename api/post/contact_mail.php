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

    $mailto = "antenehcs@gmail.com";
    $phone = $data->phone;
    $subject = $data->subject;
    $name = $data->name;
    $message = $name . "<br/>" . $data->message;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: '.$data->email.'<'.$data->email.'>' . "\r\n".'Reply-To: '.$data->email."\r\n" . 'X-Mailer: PHP/' . phpversion();
    
    $retval = mail($mailto, $subject, $message, $headers);
    
    if($retval == true){
        echo json_encode(array('message' => 'success'));
    }
    else{
        echo json_encode(array('message' => 'error'));
    }
?>