<?php 
	include_once "../Model/DAO.php";
	$dao = new DAO();
	session_start();
	$user = $_SESSION["username"]; 
	$code = $_POST["code"];
	$conn = mysqli_connect("localhost","root","","mytour");
	$sql = "SELECT * FROM account WHERE username = '$user'";
	$res = mysqli_query($conn,$sql);
	$acc = mysqli_fetch_assoc($res);
	echo "$code";
	echo "$acc[code]";
	if ($code ==$acc["code"]) 
	{
		$sql = "UPDATE account SET code ='' WHERE username = '$user'";
		$res = mysqli_query($conn,$sql);
		header("location:../View/updatepass.php");
	} else {
		$_SESSION["tb2"] ="Mã xác nhận không đúng";
		header("location:../View/codevalidation.php");
	}
	
?>