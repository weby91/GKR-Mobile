<?php
 
// Include confi.php
include_once('connectToDB.php');
 
if($_SERVER['REQUEST_METHOD'] == "POST"){
 // Get data
 $username = isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) : "";
 $pw = isset($_POST['password']) ? mysql_real_escape_string($_POST['password']) : "";

 
 // Insert data into data base
 $sql = "INSERT INTO tbl_user 
		 VALUES 
		 (UUID(), '$username', '$pw', 1 , NOW(), NOW(), 1, 'ASD', 'ASD')";
		 
 $qur = mysql_query($sql);
 if($qur){
 $json = array("status" => 1, "msg" => "Done User added!");
 }else{
 $json = array("status" => 0, "msg" => "Error adding user!");
 }
}else{
 $json = array("status" => 0, "msg" => "Request method not accepted");
}
 
@mysql_close($conn);
 
/* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 
 ?>