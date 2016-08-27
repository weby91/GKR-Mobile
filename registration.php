<?php
 
// Include confi.php
include_once('connectToDB.php');
 
if($_SERVER['REQUEST_METHOD'] == "POST"){
 // Get data
 $username = isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) : "";
 $password = isset($_POST['password']) ? mysql_real_escape_string($_POST['password']) : "";
 $nm_dpn = isset($_POST['nm_dpn']) ? mysql_real_escape_string($_POST['nm_dpn']) : "";
 $nm_blkg = isset($_POST['nm_blkg']) ? mysql_real_escape_string($_POST['nm_blkg']) : "";
 $dob = isset($_POST['dob']) ? mysql_real_escape_string($_POST['dob']) : "";
 $gender = isset($_POST['gender']) ? mysql_real_escape_string($_POST['gender']) : "";
 $komisi = isset($_POST['komisi']) ? mysql_real_escape_string($_POST['komisi']) : "";
 $email = isset($_POST['email']) ? mysql_real_escape_string($_POST['email']) : "";
 $mobile_no = isset($_POST['mobile_no']) ? mysql_real_escape_string($_POST['mobile_no']) : "";
 $dd=date_create($dob);
 $datepic=date_format($dd,"Y-m-d");
 // Insert data into data base
 $sqlInsertIntoTblUser = "INSERT INTO tbl_user 
		 VALUES 
		 (UUID(), '$username',  md5('$password'), 4, NOW(), NULL, 0, NULL, NULL)";
		 
 $sqlInsertIntoTblUserProfile = "INSERT INTO tbl_user_profile 
		 VALUES 
		 (UUID(), '$username', '$nm_dpn', '$nm_blkg', '$datepic', '$gender', '$komisi', '$email', '$mobile_no')";
		 
 $qur1 = mysql_query($sqlInsertIntoTblUser);
 $qur2 = mysql_query($sqlInsertIntoTblUserProfile);
 if($qur1 && $qur2){
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