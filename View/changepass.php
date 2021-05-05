<?php 
	session_start();
	$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
	<link rel="stylesheet" type="text/css" href="../Css/changepass.css">
	<title>MyTour.vn</title>
</head>
<body>
	<?php include_once '../Utils/menu.php'; ?>
	<div class="container-fuild ctnf_acc">
		<div class="container">
			<div class="row">
			<div class="col-md-7 col-xs-7 ctn_acc cont">
				<h1 class="text-center"><b>THAY ĐỔI MẬT KHẨU</b></h1>
				<h3>Hello <?php echo "$user,";?></h3>
				<?php
					$conn = mysqli_connect("localhost","root","","mytour");
					$sql = "SELECT * FROM account WHERE username = '".$user."'";
					$result = mysqli_query($conn,$sql);
					$acc = mysqli_fetch_assoc($result);
	                    $tb ="";
						
				?>
                <?php 
                    if ($_SERVER["REQUEST_METHOD"]== "POST") {
                        $pass= $_POST["password"];
                        $newpass = $_POST["newpass"];
                        $newpassag = $_POST["newpassag"];
                        if($pass!= $acc["passsave"]){
                            $tb="Xác thực mật khẩu cũ không đúng";
                        }
                        else{
                            if($newpass!= $newpassag){
                                $tb="Mật khẩu mới và mật khẩu xác thực lại không trùng khớp";
                            }
                            else{
                                $password =md5($newpass); 
                                $sql1 = "UPDATE account SET password='".$password."',passsave='".$newpass."'  WHERE username = '".$acc['username']."'";
                                $result = mysqli_query($conn,$sql1);
                                $tb = "Cập nhật thông tin thành công";
                            }
                        }
                    }
                ?>
	            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	            	<div class="form-group">
	                    <label for="username">Mật khẩu cũ:</label>
                        <input type="password" name="password" class="form-control" >
	                </div>
	                <div class="form-group">
	                    <label for="username">Mật khẩu mới:</label>
                        <input type="password" name="newpass" class="form-control">
	                </div>
	                <div class="form-group">
	                    <label for="password">Xác nhận mật khẩu mới:</label>
	                    <input type="password" name="newpassag" class="form-control">
                        <label for="username" class="text-danger"><?php echo $tb; ?></label>
	                </div>
	                    <button type="submit" class="btn btn-primary" style="float: right;">Cập nhật</button>
	            </form>
	        </div>
	        <div class="col-md-5 col-xs-5" style="text-align: center;margin-top: 100px;padding-left: 50px;">
	        	<img src="../image/avatar.png">
	        	<h5><b>MyTour.vn - Nâng tầm du lịch Đà Nẵng!</b></h5>
	        	
	        </div>
	    </div>
		</div>
	</div>
	<?php include_once '../Utils/footer.php';?>
</body>
</html>