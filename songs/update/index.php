<?php

include('../../response.php');
include('../../header.php');
$data = $_POST['data'];
  $myfile = fopen("../teslatrhsuncoekdmnicein283h4hi3b4b5in.txt", "w") or die("Unable to open file!");
fwrite($myfile, $data);
fclose($myfile);
$limit = 20;
$updateKey = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
$myfile = fopen("../updateKey.txt", "w") or die("Unable to open file!");
fwrite($myfile, $updateKey);
fclose($myfile);
$str = $_response;
echo json_encode($str);
 ?>
