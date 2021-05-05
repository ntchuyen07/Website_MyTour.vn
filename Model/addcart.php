<?php
    session_start();
    $id = $_GET['item'];
    if(isset($_SESSION['cart'][$id])){
        $soluong = $_SESSION['cart'][$id] + 1;
    } else $soluong = 1;

    $_SESSION['cart'][$id] = $soluong;

    header("location:../View/index.php");
    exit();
?>