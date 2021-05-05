<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$date = date('Y-m-d H:i:s');
	session_start();
	$conn = mysqli_connect("localhost","root","","mytour");

	$content = $_POST["noidung"];
	$id = $_POST["idpost"];
	$parent_id = $_POST["parent_id"];
	$user = $_SESSION["iduser"];
	$sql = "INSERT INTO comment (idpost,content,user,datecmt,parent_id) VALUES ('$id','$content','$user','$date','$parent_id')";
	$ketqua = mysqli_query($conn,$sql);

?>
