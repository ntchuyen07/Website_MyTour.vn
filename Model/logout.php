<?php 
    include_once "../Object/DAO.php";

    $dao = new DAO();
    session_start();
    unset($_SESSION["user"]);
    unset($_SESSION["role"]);
    header('location:../View/index.php');

?>