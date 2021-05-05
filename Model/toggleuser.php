<?php 
	include_once "../Model/DAO.php";
    $dao = new DAO();
	$id = $_GET["id"];
	$sql = "SELECT * FROM account WHERE id =$id";
	$res = $dao->getData($sql);
	foreach ($res as $key => $value) {
		
	}
	if ($value["role"]!=1) {
			if ($value["toggle"]==0) 
		{
			$isShow = 1;
		} else {
			$isShow = 0;
		}
		$sql2 = "UPDATE account SET toggle = '$isShow' WHERE id = ".$id."";
		$dao->insertToDB($sql2);
	}
    header('location:../Admin/user.php');
?>