<?php

 // Include confi.php
 include_once('connectToDB.php');

 $qur = mysql_query("select tu.id, tup.nm_dpn, tup.nm_blkg from tbl_user tu LEFT JOIN
					tbl_user_profile tup ON tup.username = tu.username WHERE is_confirmed = 0 AND role_cd = 4");
 $result =array();
 if(mysql_num_rows($qur) > 0){
	 while($r = mysql_fetch_array($qur)){
	 extract($r);
	 $result[] = array("total" => mysql_num_rows($qur), "nm_dpn" => $nm_dpn, "nm_blkg" => $nm_blkg, "id" => $id, "stat" => 1);  
	 } 
	 $json = array("status" => 1, "count" => $result);
 }
 else{
 $json = array("status" => 0, "msg" => "Request method not accepted");
}

 @mysql_close($conn);
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 ?>