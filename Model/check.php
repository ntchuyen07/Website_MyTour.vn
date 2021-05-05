<?php 
	$id = $_GET["post"];
	include_once "../Model/DAO.php";
	$dao = new DAO();
	$sql = "UPDATE post SET checkpost = 1 WHERE id = $id";
	$dao->insertToDB($sql);
	header("location:../Admin/checkpost.php");
?>