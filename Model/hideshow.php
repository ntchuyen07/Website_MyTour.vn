<?php 
	include_once "../Model/DAO.php";
    $dao = new DAO();
	$id = $_GET["id"];
	$sql = "SELECT * FROM comment WHERE id =$id";
	$res = $dao->getData($sql);
	foreach ($res as $key => $value) {
		if ($value["isShow"]==0) 
		{
			$isShow = 1;
		} else {
			$isShow = 0;
		}
		
	}
	$sql2 = "UPDATE comment SET isShow = '$isShow' WHERE id = ".$id."";
	$dao->insertToDB($sql2);
    header('location:../Admin/comment.php');
?>