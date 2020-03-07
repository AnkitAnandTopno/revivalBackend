
<?php
include('../../../response.php');

include('../../../header.php');
$name = $_GET['name'];
$uname = $_GET['username'];
$pword = $_GET['password'];

//sql detail json read
	$myfile = fopen("../../../auth/credential/databaseInfo.json","r") or die("Unable to open file!");
	$sqldetails=fread($myfile,filesize("../../../auth/credential/databaseInfo.json"));
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
$sql="SELECT * FROM `premiumUsers` WHERE `username` LIKE '".$uname."'";
$str = $_response;
$result = $conn->query($sql);
if (!$result) {
    $str->error = 'Invalid query: ' . $conn->error;
    $str->success = false;
}
else{
    if ($result->num_rows <= 0) 
{$limit = 10;
$accessToken = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
$sql="INSERT INTO `premiumusers` (`name`,`username`, `password`, `accessToken`) VALUES ('".$name."','".$uname."', '".$pword."', '".$accessToken."');";
$str = $_response;
$result = $conn->query($sql);
if (!$result) {
    $str->error = 'Invalid query: ' . $conn->error;
    $str->success = false;
}
else{
            
         $str->data->name = $name;
                $str->data->username = $uname;
            $str->data->accessToken = $accessToken;
            $str->success=true;
            

    
}}
else{
    $str->error = "username already exists";
    $str->success = false;
}
}
    echo json_encode($str);
    ?>