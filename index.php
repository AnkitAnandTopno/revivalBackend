<?php
include("response.php");
$_response->data->difficulty = $_GET['difficulty'];
$_response->data->type = $_GET['type'];


echo json_encode($_response); 
?>