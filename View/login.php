<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" crossorigin="anonymous" />
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
    <link rel="stylesheet" href="../Css/login.css">
</head>
<body>
    <div class="container-fuild">
    <?php 
    session_start();
    if(!isset($_SESSION["tb"]))
    {
        $tb = "Chào mừng bạn đến với MyTour.vn!";
    }
    else{
        $tb = $_SESSION["tb"];
        $_SESSION["tb"]="Chào mừng bạn đến với MyTour.vn!";
    }
    echo "<div><h1 style='text-align:center;padding-bottom:40px;'>$tb</h1></div>";
    ?>
    <div class="cont">
        <div class="form sign-in"> 
            <h2>Mừng bạn quay trở lại,</h2>
            <form action="../Model/login.php" method="POST">
                <label>
                    <span>Tên đăng nhập</span>
                    <input type="text" name="username" required="">
                </label>
                <label>
                    <span>Mật khẩu</span>
                    <input type="password" name="password" required="">
                </label>  
                <input type="submit" value="Đăng nhập" required="" class="submit" style="width: 170px;padding: 6px;margin-left: 200px; border-radius: 50px;color:white;">
                <p class="forgot-pass"><a href="../View/forgotpass.php" style="text-decoration: none;">Quên mật khẩu?</a></p>
            </form>
            <div class="social-media">
                <ul>
                    <a href="https://www.facebook.com/"><li><img src="../image/facebook.jpg"></li></a>
                    <a href="https://twitter.com/?lang=vi"><li><img src="../image/twitter.png"></li></a>
                    <a href="https://www.instagram.com/?hl=vi"><li><img src="../image/instagram.png"></li></a>
                </ul>
            </div>
             <a href="../View/index.php" style="font-size:20px;text-decoration: none;">
                <i class="fas fa-arrow-circle-left"></i>Trở về trang chủ</a>
        </div>
        <div class="sub-cont">
            <div class="img">
                <div class="img-text m-up">
                    <h2>Xin Chào Bạn!!</h2>
                    <p>Đăng ký và khám phá nhiều cơ hội mới!</p>
                </div>
                <div class="img-text m-in">
                    <h2>Một trong số chúng tôi?</h2>
                    <p>Nếu bạn đã có tài khoản, chỉ cần đăng nhập. Chúng tôi rất nhớ bạn!</p>
                </div>
                <div class="img-btn">
                    <span class="m-up">Đăng ký</span>
                    <span class="m-in">Đăng nhập</span>
                </div>
            </div>
            <div class="form sign-up">
                <h2 style="margin-top: -30px;">Tôi là thành viên mới,</h2>
                <form action="../Model/signup.php" method="POST">
                    <label>
                        <span>Tên đăng nhập</span>
                        <input type="text" name="username" required="">
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required="">
                    </label>
                    <label>
                        <span>Mật khẩu</span>
                        <input type="password" name="password" required="">
                    </label>
                    <label>
                        <span>Xác nhận mật khẩu</span>
                        <input type="password" name="repassword" required="">
                    </label>
                    <label>
                        <span>Số điện thoạir</span>
                        <input type="text" name="phone">
                    </label>
                    <input type="submit" value="Đăng ký" name="submit" class="submit" style="width: 170px;padding: 6px;margin-left: 200px; border-radius: 50px;margin-top: 10px;color: white;">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../JS/login.js"></script>
</body>
</html>