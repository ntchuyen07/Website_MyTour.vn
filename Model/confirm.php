<?php
	include_once "../Model/DAO.php";
    $dao = new DAO();
	$id = $_GET["id"];
	$sql = "SELECT * FROM bills WHERE id =$id";
	$res = $dao->getData($sql);
	foreach ($res as $key => $value) {
		if ($value["status"]==1) 
		{
			$status = 2;
		} else {
			$status = 6;
		}
		
	}
	$sql2 = "UPDATE bills SET status = '$status' WHERE id = ".$id."";
	$dao->insertToDB($sql2);
    header('location:../Hotel/confirmorder.php');
?>