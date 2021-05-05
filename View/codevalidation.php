<?php 
    session_start();
    if(!isset($_SESSION["email"]))
    {
        header("location:../View/index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" crossorigin="anonymous" />
    <title>Lấy lại mật khẩu</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
    <link rel="stylesheet" href="../Css/forgotpass.css">
</head>
<body>
    <div class="container-fuild">
    <?php 
    if(!isset($_SESSION["tb2"]))
    {
        $tb = "Lấy lại mật khẩu";
    }
    else{
        $tb = $_SESSION["tb2"];
        $_SESSION["tb2"]="Lấy lại mật khẩu";
    }
    echo "<div><h1 style='text-align:center;padding-bottom:40px;'>$tb</h1></div>";
    ?>
    <div class="ctn">
        <div class="form sign-in"> 
            <?php echo "<h2>Nhập mã được gửi đến gmail $_SESSION[email],</h2>"; ?>
            <p></p>
            <form action="../Model/codevalidation.php" method="POST">
                <label>
                    <span>Mã xác nhận</span>
                    <input type="text" name="code" required="">
                </label>
                <input type="submit" value="Xác nhận" required="" class="submit" style="width: 170px;padding: 6px;margin-left: 200px; border-radius: 50px;color:white;">
            </form>

             <b><a href="../View/index.php" style="font-size:16px;text-decoration: none;">
                << Trở về Trang chủ</a></b>
        </div>
    </div>
</div>
<script type="text/javascript" src="../JS/login.js"></script>
</body>
</html>