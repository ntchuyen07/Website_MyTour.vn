<?php
    include_once "../Model/DAO.php";

    $dao = new DAO();    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } else $user = $_SESSION["user"]; 
    ob_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="../script/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <title>Thêm Người dùng</title>
</head>
<body>
    <?php include_once "../Utils/menuadmin.php"?>
    <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ 
        $tb ="";
        ?>
    <div class="container" style="margin-left: 20%;">
        <div class="row">
            <h3>Thêm người dùng</h3>
        </div>
        <div class="row">
            <div class="col-md-8 col-lg-6">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                 method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Username:</label>
                        <input type="text" name="username" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Password:</label>
                        <input type="password" name="password" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Xác thực Password:</label>
                        <input type="password" name="repassword" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ Tên:</label>
                        <input type="text" name="name" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input type="email" name="email" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Số điện thoại:</label>
                        <input type="text" name="phone" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="idcategory">Quyền truy cập:</label>
                        <select name="role" id="" class="form-control">
                            <option value="2" selected>USER</option>
                            <option value="3">ADMIN HOTEL</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit">
                    <label for="username" class="text-danger"><?php echo $tb; ?></label>
                </form>
            </div>
        </div>
    </div>
    <?php }?>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit"])){
            $username = $pass = $email = $phone = $xnpass = $passsave = $name = '';
        $userErr = $passErr = $emailErr = $phoneErr = $xnpassErr ='';
        $tb = '';
        $name1=$_POST["username"];
                if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $name1)) {
                    $tb = "Tên đăng nhập không hợp lệ. Tên chỉ được chứa kí tự a-Z và 0-9";
                } else {
                    $username = $_POST["username"];
                }
            $pass = md5($_POST["password"]);
            $xnpass = md5($_POST["repassword"]);
            $passsave = $_POST["repassword"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $name = $_POST["name"];
            $role = $_POST["role"];
            if ($pass != $xnpass) {
               $tb ='Xác nhận sai mật khẩu';
            }
            else{
            if($username!='' && $pass!=''){
                 $conn = mysqli_connect("localhost","root","","mytour");
                 $sql1 = "SELECT id FROM account WHERE username ='$username'";
                 $ketqua1 = mysqli_query($conn,$sql1);
                 $soluong = mysqli_num_rows($ketqua1);
                 if ($name=='') 
                 {
                    $name = $username;
                 }
                 if($soluong==0){
                     $sql = "INSERT INTO account(username,name,password,passsave,email,phone,role) VALUES ('$username','$name','$pass','$passsave','$email','$phone','$role')";
                     $ketqua = mysqli_query($conn,$sql);
                     header("location:../Admin/user.php");
                 }
                 else{
                    $tb ="Tên đăng nhập đã tồn tại!";
                 }
            }
        }
         
        }   
    }
?>

<?php
ob_end_flush();
?>