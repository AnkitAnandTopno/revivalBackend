<?php

include('../../response.php');
include('../../header.php');
$dataString = (isset($_POST["data"]))?$_POST["data"]:'';
$data = json_decode($dataString);
$update_key = $data->updatekey;
$myfile = fopen("../updateKey.txt","r") or die("Unable to open file!");
$update_key_latest=fread($myfile,filesize("../updateKey.txt"));
$str=$_response;
fclose($myfile);
  if($update_key==''||$update_key_latest==$update_key){
    $str->success = false;
  }
  else {
    $myfile = fopen("../teslatrhsuncoekdmnicein283h4hi3b4b5in.txt","r") or die("Unable to open file!");
    $update=fread($myfile,filesize("../teslatrhsuncoekdmnicein283h4hi3b4b5in.txt"));
    fclose($myfile);
    $str->success=true;
    $str->data = json_decode($update);
    $str->updateKey = $update_key_latest;
  }
  echo json_encode($str);
 ?>
