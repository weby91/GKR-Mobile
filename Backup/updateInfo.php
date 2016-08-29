<?php
 
// Include confi.php
include_once('connectToDB.php');
 
if($_SERVER['REQUEST_METHOD'] == "PUT"){
 $username = isset($_SERVER['HTTP_USERNAME']) ? mysql_real_escape_string($_SERVER['HTTP_USERNAME']) : "";
 $password = isset($_SERVER['HTTP_PASSWORD']) ? mysql_real_escape_string($_SERVER['HTTP_PASSWORD']) : "";

 // Add your validations
 if(!empty($username) && !empty($password)){
 $qur = mysql_query("UPDATE tbl_user
			  SET last_login_dt = NOW()
			  WHERE username = '$username' AND pw = '$password'");

 if($qur){
 $json = array("status" => 1, "msg" => "Status updated!!.");
 }else{
 $json = array("status" => 0, "msg" => "Error updating status");
 }
 }else{
 $json = array("status" => 0, "msg" => "User ID not define");
 }
}else{
 $json = array("status" => 0, "msg" => "User ID not define");
 }
 @mysql_close($conn);
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 
 ?>