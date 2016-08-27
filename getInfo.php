<?php

 // Include confi.php
 include_once('connectToDB.php');
 
 if($_SERVER['REQUEST_METHOD'] == "GET"){
 $username = isset($_GET['username']) ? mysql_real_escape_string($_GET['username']) :  "";
 $password = isset($_GET['password']) ? mysql_real_escape_string($_GET['password']) :  "";
 if(strlen($password) < 32)
 {
	$password = md5($password);
 }
 $result =array();
 if(!empty($username) && !empty($password)){
 $qur = mysql_query("select * from tbl_user tu LEFT JOIN
					tbl_user_profile tup ON tup.username = tu.username where tu.username='$username' AND tu.pw = '$password' AND is_confirmed = 1");
					
 if(mysql_num_rows($qur) > 0){
	 while($r = mysql_fetch_array($qur)){
	 extract($r);
	 $result[] = array("username" => $username, "password" => $pw, "role_cd" => $role_cd, "registration_dt" => $registration_dt, "nm_dpn" => $nm_dpn, "nm_blkg" => $nm_blkg,
						"dob" => $dob, "gender" => $gender, "komisi" => $komisi, "email" => $email, "mobile_no" => $mobile_no); 
	 $json = array("status" => 1, "info" => $result);
	 mysql_query("UPDATE tbl_user
				  SET last_login_dt = NOW()
				  WHERE username = '$username' AND pw = '$password'");
	 }
 }
 else{
   $result[] = array("error" => "|Username dan password anda salah atau ID anda belum terkonfirmasi, silahkan hubungi Admin.|");
	$json = array("status" => 0, "info" => $result);
 }
 }else{
 $json = array("status" => 0, "info" => "|Username dan password anda salah atau ID anda belum terkonfirmasi, silahkan hubungi Admin.|");
 }
 }else{
 $json = array("status" => 0, "info" => "Request method not accepted");
}

 @mysql_close($conn);
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 ?>