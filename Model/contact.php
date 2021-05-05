<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	session_start();
	$user = $_SESSION["iduser"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$content = $_POST["content"];
	$date = date('Y-m-d H:i:s');
	$conn = mysqli_connect("localhost","root","","mytour");
	$sql = "INSERT INTO contact(user,name,email,content,date_send) VALUES ($user,'$name','$email','$content','$date')";
	$res = mysqli_query($conn,$sql);
	$_SESSION["contact"]="Yêu cầu của bạn đã được ghi nhận";
	header("location:../View/contact.php");
?>