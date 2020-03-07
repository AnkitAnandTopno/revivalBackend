
<?php
include('../../../response.php');

include('../../../header.php');
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

$sql="SELECT * FROM `premiumUsers`";
$str = $_response;
$result = $conn->query($sql);
if (!$result) {
    $str->error = 'Invalid query: ' . $conn->error;
    $str->success = false;
}
else{
    if ($result->num_rows > 0) {
    // output data of each row
    $str->success = false;
    while($row = $result->fetch_assoc()) {
        if($row["username"]===$uname&&$row['password']===$pword){
            
            $limit = 10;
            $accessToken = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
            
            $sql2='UPDATE `premiumUsers` SET `accessToken`="'.$accessToken.'" WHERE `username` like "'.$row['username'].'"';
            $result1 = $conn->query($sql2);
            if(!$result1){

                $str->success=true;
            }
            else{
                $str->data->name = $row['name'];
                $str->data->username = $row['username'];
            $str->data->accessToken = $accessToken;
            $str->success=true;
            $str->message = "login successful";
            }
    
    break;
        }
    }
    if(!$str->success){
        $str->message = "login failed";
    }
}
    
    }
    echo json_encode($str);
    ?>