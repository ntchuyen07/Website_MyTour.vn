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
    session_start();
    $user = $_SESSION["username"];
    if(!isset($_SESSION["tb3"]))
    {
        $tb = "Đổi mật khẩu";
    }
    else{
        $tb = $_SESSION["tb3"];
        $_SESSION["tb3"]="Đổi mật khẩu";
    }
    echo "<div><h1 style='text-align:center;padding-bottom:40px;'>$tb</h1></div>";
    ?>
    <div class="ctn">
        <div class="form sign-in" style="margin-top: -40px;"> 
            <?php echo "<h2>Nhập mật khẩu mới cho tài khoản $user ,</h2>"; ?>
            <form action="../Model/updatepass.php" method="POST">
                <label>
                    <span>Mật khẩu mới</span>
                    <input type="password" name="password" required="">
                </label>
                <label>
                    <span>Xác nhận mật khẩu mới</span>
                    <input type="password" name="confirm" required="">
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