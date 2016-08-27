<?php session_start(); ?>
<?php include 'ConnectToDB.php'; ?>
<?php
try
{ 
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$dbhandle;
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		
		ValidateUser($username, $password, $dbhandle);
	}else{
		echo "<script>alert('Maaf, Username atau password anda tidak boleh kosong'); location.href='index.php';</script>";
	}
}
catch (Exception $ex) 
{
    echo 'Caught exception: ',  $ex->getMessage(), "\n";
}

function ValidateUser($username, $password, $dbhandle)
{
	$query = mysql_query("SELECT * FROM tbl_user WHERE username = '$username' AND pw = md5('$password')");
	
	if(mysql_num_rows($query) == 1)	
	{
		while($row = mysql_fetch_array($query)){ 
			$role_cd = $row['role_cd'];		
		}
		
		if($role_cd == 1)
		{
			mysql_close($dbhandle);	
			echo "<script>location.href='Home.php';</script>";	
		}else{
			mysql_close($dbhandle);	
			echo "<script>alert('Maaf, Hanya admin yang dapat login'); location.href='index.php';</script>";
		}
		
	}

}

?>