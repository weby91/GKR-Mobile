<?php

 // Include confi.php
 include_once('connectToDB.php');

 //$qur = mysql_query("select * FROM tbl_service_schedule ORDER BY service_dt, service_type");
 $qur = mysql_query("select * FROM tbl_service_schedule WHERE service_dt >= CURDATE() ORDER BY service_dt, service_type");
 $result =array();
 if(mysql_num_rows($qur) > 0){
	 while($r = mysql_fetch_array($qur)){
	 extract($r);
	 $result[] = array("total" => mysql_num_rows($qur), "service_dt" => $service_dt, "service_type" => $service_type, "id" => $id, 
									 "theme" => $theme, "preacher_nm" => $preacher_nm, "additional_svcr" => $additional_svcr, "stat" => 1);  
	 } 
	 $json = array("status" => 1, "count" => $result);
 }
 else{
 $json = array("status" => 0, "count" => "No Data Found");
}

 @mysql_close($conn);
 
 
 /* Output header */
 header('Content-type: application/json');
 $var = json_encode($json);
 echo json_encode($json);
 ?>