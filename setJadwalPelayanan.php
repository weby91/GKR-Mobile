<?php include 'checkSession.php'; ?><?php
 
// Include confi.php
include_once('connectToDB.php');
 
if($_SERVER['REQUEST_METHOD'] == "POST"){ $additional_svcr = "";
 // post data  if(isset($_SESSION['isWebsite'])){	if(isset($_POST['penterjemah'])) $additional_svcr = 'Penterjemah : ' . $_POST['penterjemah'] . "<br>" . PHP_EOL;	if(isset($_POST['worshipleader'])) $additional_svcr .= 'Worship Leader : ' . $_POST['worshipleader'] . "<br>" . PHP_EOL;	if(isset($_POST['singers'])) $additional_svcr .= 'Singers : ' . $_POST['singers'] . "<br>" . PHP_EOL;	if(isset($_POST['pemusik'])) $additional_svcr .= 'Pemusik : ' . $_POST['pemusik'] . "<br>" . PHP_EOL;	if(isset($_POST['kolektan'])) $additional_svcr .= 'Kolektan : ' . $_POST['kolektan'] . "<br>" . PHP_EOL;	if(isset($_POST['usher'])) $additional_svcr .= 'Usher : ' . $_POST['usher'] . "<br>" . PHP_EOL;	if(isset($_POST['lcd'])) $additional_svcr .= 'Operator LCD : ' . $_POST['lcd'] . "<br>" . PHP_EOL;	if(isset($_POST['soundsystem'])) $additional_svcr .= 'Operator Sound System : ' . $_POST['soundsystem'] . "<br>" . PHP_EOL; 		 }
 $service_dt = isset($_POST['service_dt']) ? mysql_real_escape_string($_POST['service_dt']) : "";
 $service_type = isset($_POST['service_type']) ? mysql_real_escape_string($_POST['service_type']) : "";  
 $theme = isset($_POST['theme']) ? mysql_real_escape_string($_POST['theme']) : "";
 $preacher_nm = isset($_POST['preacher_nm']) ? mysql_real_escape_string($_POST['preacher_nm']) : ""; if(!isset($_SESSION['isWebsite'])){
 $additional_svcr = isset($_POST['additional_svcr']) ? mysql_real_escape_string($_POST['additional_svcr']) : ""; }  $additional_svcr = strip_tags($additional_svcr); 
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
 
/* Output header */ if(!isset($_SESSION['isWebsite'])) {
	 header('Content-type: application/json');
	 echo json_encode($json); }else{	if($json['status'] == 0 && $json['msg'] == "Service already exist!"){		echo "<script>alert('Save gagal, Jadwal Pelayanan ini sudah pernah diinput'); location.href='formTambahJadwal.php';</script>";	}else if($json['status'] == 0 && $json['msg'] != "Service already exist!"){		echo "<script>alert('Save gagal, Silahkan mencoba kembali'); location.href='formTambahJadwal.php';</script>";	}else if($json['status'] == 1){		echo "<script>alert('Jadwal pelayanan berhasil ditambahkan'); location.href='formTambahJadwal.php';</script>";	} }
 
 