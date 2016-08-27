<?php

 // Include confi.php
 include_once('connectToDB.php');
 if($_SERVER['REQUEST_METHOD'] == "GET"){
 $id = isset($_GET['id']) ? mysql_real_escape_string($_GET['id']) : "";
 $username = isset($_GET['username']) ? mysql_real_escape_string($_GET['username']) : "";
	$qur = mysql_query("select * from tbl_user WHERE id = '$id'");
	$result =array();
	if(mysql_num_rows($qur) > 0){
	 mysql_query("UPDATE tbl_user SET 
				is_confirmed = 1, confirmed_by = '$username', confirmed_dt = NOW() WHERE id = '$id'"); 
	 $json = array("status" => 1, "info" => "Successfully updated!");
	}
	else{
	$json = array("status" => 0, "msg" => "$id");
	}
}else{
 $json = array("status" => 0, "msg" => "Request method not accepted");
}
 @mysql_close($conn);
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 ?>