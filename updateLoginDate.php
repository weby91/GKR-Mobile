<?php
 // Include confi.php
 include_once('connectToDB.php');
 
 if($_SERVER['REQUEST_METHOD'] == "GET"){
 $username = isset($_GET['username']) ? mysql_real_escape_string($_GET['username']) :  "";
 $password = isset($_GET['password']) ? mysql_real_escape_string($_GET['password']) :  "";
 if(!empty($username) && !empty($password)){
 mysql_query("UPDATE tbl_user
			  SET last_login_dt = NOW()
			  WHERE username = '$username' AND pw = '$password'");
 @mysql_close($conn);
 
 /* Output header */
 header('Content-type: application/json');
 ?>