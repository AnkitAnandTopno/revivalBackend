<?php
include("../../../response.php");
include("../../../header.php");
$target_dir = "";
$file_name = "tmp_name";

$uploadOk = 0;

$str = $_response;
$str->received= json_encode($_FILES);
if(isset($_FILES["file"])) {
    $str->data->test = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["file"])) {
    $check = getimagesize($_FILES["file"][$file_name]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $str->data->notFile = true;
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    if (!unlink($target_file))
        {
            $str->data->fileExists = true;
            $uploadOk = 0;}
        
}
// Check file size
if ($_FILES["file"]["size"] > 12000000) {
    $str->data->fileExceedsSize = true;
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "mp3" ) {
    $uploadOk = 0;
    $str->data->fileTypeError = true;
}
}
else{
    $str->data->error = json_encode($_FILES);
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $str->success = false;
    echo json_encode($str);
// if everything is ok, try to upload file
} else {
    $targetFile = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8).".".$imageFileType;
    if (move_uploaded_file($_FILES["file"][$file_name], $targetFile)) {
        $str->success = true;
        $str->data->file = basename($targetFile);
        echo json_encode($str);
    } else {
        $str->success = false;
        echo json_encode($str);
    }
}
?>