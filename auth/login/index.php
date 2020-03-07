
<?php
include('../../response.php');

include('../../header.php');
$data = $_POST['data'];

$uname=json_decode($data)->username;
$pword=json_decode($data)->password;
//sql detail json read
	$myfile = fopen("../credential/databaseInfo.json","r") or die("Unable to open file!");
	$sqldetails=fread($myfile,filesize("../credential/databaseInfo.json"));
    fclose($myfile);
    
//updateKey read   
$myfile = fopen("../../songs/updateKey.txt","r") or die("Unable to open file!");
$update_key_latest=fread($myfile,filesize("../../songs/updateKey.txt"));

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

$sql="SELECT * FROM `users` WHERE `username` LIKE '".$uname."'";
$str = $_response;
$result = $conn->query($sql);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["password"]==$pword)
        {
            
$limit = 10;
$accessToken = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
$str->data->username = $row['username'];
$str->data->accessToken = $accessToken;
$myfile = fopen("../../songs/teslatrhsuncoekdmnicein283h4hi3b4b5in.txt","r") or die("Unable to open file!");
    $update=fread($myfile,filesize("../../songs/teslatrhsuncoekdmnicein283h4hi3b4b5in.txt"));
    fclose($myfile);
    $str->success=true;
    $str->data->songList = json_decode($update);
    $str->data->updateKey = $update_key_latest;
                $sql2='UPDATE `users` SET `accessToken`="'.$accessToken.'" WHERE `username` like "'.$row['username'].'"';
                $conn->query($sql2);
        }
        else
        {
            $str->success=false;
        }
    }
}
else{
    $str->success=false;
}

echo json_encode($str); 
?>