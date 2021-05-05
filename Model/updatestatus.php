<?php 
	include_once "../Model/DAO.php";
    $dao = new DAO();
	$id = $_GET["bill"];
	$status = $_POST["idstatus"];
	$sql2 = "UPDATE bills SET status= '$status' WHERE id = ".$id."";
	$dao->insertToDB($sql2);
    header('location:../Hotel/list_order.php');
?>