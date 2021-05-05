<?php 
	session_start();
	$user = $_SESSION["username"];
	$pass = $_POST["password"];
	$confirm = $_POST["confirm"];
	if ($pass!=$confirm) 
	{
		$_SESSION["tb3"] ="Mật khẩu không trùng khớp";
		header("location:../View/updatepass.php");
	} else {
		$password = md5($pass);
		$conn = mysqli_connect("localhost","root","","mytour");
		$sql = "UPDATE account SET password='$password',passsave = '$pass' WHERE username='$user'";
		$res = mysqli_query($conn,$sql);
		$_SESSION["user"]=$user;
		$sql = "SELECT * FROM account WHERE username ='$user'";
		$res = mysqli_query($conn,$sql);
		$acc = mysqli_fetch_assoc($res);
		$_SESSION["role"]=$acc["role"];
		if($acc["role"]==3){
            header('location:../Hotel/dashboard.php');
        }
        else
        {
        	header('location:../View/index.php');	
        }
	}
	
?>