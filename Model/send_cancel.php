<?php
	$id = $_GET["id"];
	include_once "../Model/DAO.php";
	$dao = new DAO();
	$sql = "UPDATE bills SET status ='5' WHERE id ='$id'";
	$dao->insertToDB($sql);
	header("location:../View/vieworder.php");
?>