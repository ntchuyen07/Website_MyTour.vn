<?php
	include_once "../Model/DAO.php";
	$dao = new DAO();
	$id = $_GET["id"];
	$sql = "DELETE FROM account WHERE id = '$id'";
    $dao->insertToDB($sql);   
    header('location: ../Admin/user.php');
?>