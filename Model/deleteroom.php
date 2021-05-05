<?php
	$id = $_GET["id"];
	include "../Model/DAO.php";
	$dao = new DAO();
	$sql = "DELETE FROM rooms WHERE id = $id";
	$dao->insertToDB($sql);
	header("location:../Hotel/dashboard.php");
?>