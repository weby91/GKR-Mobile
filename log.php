<?php session_start(); ?>
<?php include_once 'ConnectToDB.php'; ?>
<?php
try
{ 
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$dbhandle;		
		
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
	$query = mysqli_query($dbhandle, "SELECT * FROM tbl_user WHERE username = '$username' AND pw = MD5('$password')");
	
	if(mysqli_num_rows($query) == 1)	
	{
		while($row = mysqli_fetch_array($query)){ 
			$role_cd = $row['role_cd'];		
		}
		
		if($role_cd == 1)
		{
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['isWebsite'] = 'YES';
			mysqli_close($dbhandle);	
			echo "<script>location.href='dashboard.php';</script>";	
		}else{
			mysqli_close($dbhandle);	
			echo "<script>alert('Maaf, Hanya admin yang dapat login'); location.href='index.php';</script>";
		}
		
	}else{
		
		echo "<script>alert('Maaf, Username dan password anda salah. Silahkan mencoba kembali.'); location.href='index.php';</script>";
	}

}

?>