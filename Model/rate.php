<?php 
	$username = $_POST["username"];
	$rate = $_POST["rate"];
	$id = $_GET["id"];
	$content = $_POST["content"];
	include_once "../Model/DAO.php";
	$dao = new DAO();
	$sql = "UPDATE bills SET rating='$rate',comment='$content',showname='$username' WHERE id='$id'";
	$dao->insertToDB($sql);
	header("location:../View/vieworder.php");

?>