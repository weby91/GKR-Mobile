<?php
 
// Include confi.php
include_once('connectToDB.php');
 
if($_SERVER['REQUEST_METHOD'] == "POST"){
 // post data
 $service_dt = isset($_POST['service_dt']) ? mysql_real_escape_string($_POST['service_dt']) : "";
 $service_type = isset($_POST['service_type']) ? mysql_real_escape_string($_POST['service_type']) : "";  
 $theme = isset($_POST['theme']) ? mysql_real_escape_string($_POST['theme']) : "";
 $preacher_nm = isset($_POST['preacher_nm']) ? mysql_real_escape_string($_POST['preacher_nm']) : "";
 $additional_svcr = isset($_POST['additional_svcr']) ? mysql_real_escape_string($_POST['additional_svcr']) : "";
 $posted_by = isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) : "";
 $dd=date_create($service_dt);
 $datepic=date_format($dd,"Y-m-d");
 
 $qur = mysql_query("select * FROM tbl_service_schedule WHERE service_dt = '$datepic' AND service_type = '$service_type'");
 if(mysql_num_rows($qur) == 0){
	$sqlInsertIntoTblServiceSchedule = "INSERT INTO tbl_service_schedule 
		 VALUES 
		 (UUID(), '$datepic',  '$service_type', '$theme', '$preacher_nm', '$additional_svcr', NOW(), NULL, '$posted_by')";
	$qur1 = mysql_query($sqlInsertIntoTblServiceSchedule);
	if($qur1){
		$json = array("status" => 1, "msg" => "Success!");
	}else{
		$json = array("status" => 0, "msg" => "Failed!");
	}
 }else{
	$json = array("status" => 0, "msg" => "Service already exist!");
 }
}else{
 $json = array("status" => 0, "msg" => "Request method not accepted");
}
 
@mysql_close($conn);
 
/* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 
 