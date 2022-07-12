<?php 
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");

$response = array();
$DIR = 'photos/';
$urlServer = 'http://127.0.0.1';

if($_FILES['image'])
{
    $fileName = $_FILES["image"]["name"];
    $tempFileName = $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];

    if($error > 0){
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
    }else 
    {
        $FILE_NAME = $fileName;
        $UPLOAD_IMG_NAME = $DIR.strtolower($FILE_NAME);
        $UPLOAD_IMG_NAME = preg_replace('/\s+/', '-', $UPLOAD_IMG_NAME);
    
        if(move_uploaded_file($tempFileName , $UPLOAD_IMG_NAME)) {
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "Image has uploaded",
                "url" => $urlServer."/".$UPLOAD_IMG_NAME
              );
        }else
        {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error occured"
            );
        }
    }

}else{
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "File not found"
    );
}

echo json_encode($response);
?>