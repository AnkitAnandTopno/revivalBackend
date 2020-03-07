<?php
include("../../response.php");
include('../../header.php');
$data = $_POST['data'];

$uname=json_decode($data)->username;
$accessToken=json_decode($data)->accessToken;
//sql detail json read
	$myfile = fopen("../credential/databaseInfo.json","r") or die("Unable to open file!");
	$sqldetails=fread($myfile,filesize("../credential/databaseInfo.json"));
	fclose($myfile);

	$dbinfo= json_decode($sqldetails);
	$servername = $dbinfo->serverName;
    $username = $dbinfo->username;
    $password = $dbinfo->password;
    $dbname = $dbinfo->dbname;
//sql detail json read end

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$str=$_response;
$sql='UPDATE `users` SET `accessToken`="" WHERE `username` like "'.$uname.'"';;

$result = $conn->query($sql);
if (!$result) {
    $str->success=false;
}
else{
    
    $str->success=true;
}

echo json_encode($str); 
?>