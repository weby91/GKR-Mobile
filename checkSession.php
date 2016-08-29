<?php
session_start(); // ready to go!

if(isset($_SESSION['isWebsite'])){
	if (!isset($_SESSION['username'])){
		echo "<script>alert('Maaf, Session anda telah habis. Silahkan login kembali'); location.href='index.php';</script>";
	}
	
	$now = time();
	if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
		// this session has worn out its welcome; kill it and start a brand new one
		session_unset();
		session_destroy();
		session_start();
		echo "<script>alert('Maaf, Session anda telah habis. Silahkan login kembali'); location.href='index.php';</script>";
	}

	// either new or old, it should live at most for another hour
	$_SESSION['discard_after'] = $now + 3600;
}else{
	echo "<script>alert('Maaf, Session anda telah habis. Silahkan login kembali'); location.href='index.php';</script>";	
}
?>