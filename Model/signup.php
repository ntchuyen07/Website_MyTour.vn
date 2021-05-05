<?php
        session_start();
        $username = $pass = $email = $phone = $xnpass = $passsave = '';
        $userErr = $passErr = $emailErr = $phoneErr = $xnpassErr ='';
        $tb = '';
        $name=$_POST["username"];
                if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $name)) {
                    $_SESSION["tb"] = "Tên đăng nhập không hợp lệ. Tên chỉ được chứa kí tự a-Z và 0-9";
                } else {
                    $username = $_POST["username"];
                }
            $pass = md5($_POST["password"]);
            $xnpass = md5($_POST["repassword"]);
            $passsave = $_POST["repassword"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            if ($pass != $xnpass) {
               $_SESSION["tb"] ='Xác nhận sai mật khẩu';
            }
            else{
            if($username!='' && $pass!=''){
                 $conn = mysqli_connect("localhost","root","","mytour");
                 $sql1 = "SELECT id FROM account WHERE username ='$username'";
                 $ketqua1 = mysqli_query($conn,$sql1);
                 $soluong = mysqli_num_rows($ketqua1);
                 if($soluong==0){
                     $sql = "INSERT INTO account(username,name,password,passsave,email,phone,role) VALUES ('$username','$username','$pass','$passsave','$email','$phone','2')";
                     $ketqua = mysqli_query($conn,$sql);
                     $_SESSION["tb"]="Đăng ký thông tin thành công! Đăng nhập ngay";
                 }
                 else{
                    $_SESSION["tb"]="Tên đăng nhập đã tồn tại!";
                 }
            }
        }
        header('location:../View/login.php');
    ?>