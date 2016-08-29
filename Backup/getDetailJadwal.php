<?php

 // Include confi.php
 include_once('connectToDB.php');
$service_dt = isset($_GET['service_dt']) ? mysql_real_escape_string($_GET['service_dt']) : "";
$service_type = isset($_GET['service_type']) ? mysql_real_escape_string($_GET['service_type']) : "";
 $qur = mysql_query("select * FROM tbl_service_schedule WHERE service_dt = '$service_dt' AND service_type = '$service_type'");
 $result =array();
 if(mysql_num_rows($qur) > 0){
	 while($r = mysql_fetch_array($qur)){
	 extract($r);
	 $result[] = array("total" => mysql_num_rows($qur), "service_dt" => $service_dt, "service_type" => $service_type, "id" => $id, 
									 "theme" => $theme, "preacher_nm" => $preacher_nm, "additional_svcr" => $additional_svcr, "stat" => 1);  
	 } 
	 $json = array("status" => 1, "infojadwal" => $result);
 }
 else{
 $json = array("status" => 0, "infojadwal" => "No Data Found");
}

 @mysql_close($conn);
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 ?>