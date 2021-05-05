<?php 
	include_once "../Model/DAO.php";

    $dao = new DAO();       
    if(!isset($_SESSION["uesr"])) 
    { 
        session_start(); 

    }else $user = $_SESSION["user"];
    if (!isset($_SESSION["mess"])) {
    	$tb ="";
    } else {
    	$tb = $_SESSION["mess"];
    	$_SESSION["mess"]="";
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Hotel</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/DataTables.bootstrap4.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
	<link rel="stylesheet" type="text/css" href="../Css/account.css">
	<title>MyTour.vn</title>
</head>
<body>
	<?php 
		include_once "../Utils/menuadmin.php";
		$conn = mysqli_connect("localhost","root","","mytour");
	?>
	<div class="container-fuild ctnf_acc" style="margin-top:0;">
		<div class="container ctn_acc cont" style="margin-left: 20%;">
			<h1><b>Hồ sơ cá nhân</b></h1>
			<?php 
				$sql = "SELECT * FROM account WHERE username = '".$user."'";
				$result = mysqli_query($conn,$sql);
				$acc = mysqli_fetch_assoc($result);
				$tb1 = $tb2  = '';
				if ($acc['address']=='') {
					$tb1 = 'Cập nhật Địa chỉ của bạn';
				} else {
					$tb1 = $acc['address'];
				}
				if ($acc['image']=='') {
					$ava = "image/avat.jpg";
				} else {
					$ava = $acc['image'];
				}	
				echo "<h3 style='padding-bottom:20px;'>Hello $acc[username],</h3>";
			?>
			<script>
				function readURL(input) {
			        if (input.files && input.files[0]) {
			            var reader = new FileReader();

			            reader.onload = function (e) {
			                $('.image-avatar').attr('src', e.target.result);
			            }

			            reader.readAsDataURL(input.files[0]);
			        }
			    }
			</script>
			<form action="../Model/account.php" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-5 col-xs-5">
							<img class="image-avatar" src="<?php echo "../$ava"; ?>" style="width: 300px;height: 300px;border-radius: 50%;" align="center"><br>
							<h5>Cập nhật Avatar</h5>
							<input type="file" name="image" id="image" onchange="readURL(this);" style="display: none;" accept="image/*">
							<label for="image"  style="margin-top: 4px; font-size: 40px; cursor: pointer;">
                                    <i class="fas fa-camera"></i>
                            </label>
					</div>
	            <div class="col-md-6 col-xs-6 " style="background-color: #f9f9f9;border-radius: 5px;padding: 20px;text-align: left;">
	                	<div class="form-group">
	                        <label for="username">Họ tên:</label>
	                        <input type="text" name="name" id="" class="form-control" value="<?php echo "$acc[name]"; ?>">
	                    </div>
	                    <div class="form-group">
	                        <label for="password">Mật khẩu:********</label><br>
	                        <a href="../View/changepass.php" style="text-decoration:none; ">Đổi mật khẩu <i class="fas fa-arrow-circle-right"></i></a>
	                    </div>
	                    <div class="form-group">
	                        <label for="email">Email:</label>
	                        <input type="email" name="email" class="form-control" value="<?php echo "$acc[email]"; ?>">
	                    </div>
	                    <div class="form-group">
	                        <label for="phone">Điện thoại:</label>
	                        <input type="text" name="phone" class="form-control" value="<?php echo "$acc[phone]"; ?>">
	                    </div>
	                    <div class="form-group">
	                        <label for="address">Địa chỉ:</label>
	                        <textarea cols="30" rows="4" class="form-control" name="address"><?php echo "$tb1"; ?></textarea>
	                    </div>
	                    <button type="submit" class="btn btn-primary" style="float: right;">Cập nhật</button>
	                    <!-- <?php 
	                    $dir = "image/";
							if ($_SERVER["REQUEST_METHOD"]== "POST") {
								$name = $pass = $passsave = $address = $email = $sdt = '';
								if($_POST["name"]==''||$_POST["name"]=='Cập nhật Tên người dùng'){
										$name =$acc['name'];
								}
								else{
									$name = $_POST["name"];
								}

								if ($_POST["email"]=='') {
									$email = $acc['email'];
								}
								else{
									$email = $_POST["email"];
								}
								if ($_POST["phone"]=='') {
									$phone = $acc['phone'];
								} else {
									$phone = $_POST['phone'];
								}
								

								if ($_POST["address"]==''||$_POST["address"]=='Cập nhật địa chỉ của bạn') {
									$address = $acc["address"];
								} else {
									$address = $_POST["address"];
								}
								$image = '';
								if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0)
								{
									{
							            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
							            $filename = $_FILES["image"]["name"];
							            $filetype = $_FILES["image"]["type"];
							            $filesize = $_FILES["image"]["size"];
							        }

							        //xác định loại file
							        if(in_array($filetype, $allowed)){
							                move_uploaded_file($_FILES["image"]["tmp_name"],'../'.$dir.$filename);
							                $image = $dir.basename($_FILES['image']['name']);
							        } else {
							            echo 'Lỗi trong quá trình upload hình ảnh';
							        }
							    }
						        if($image=='')
						        {
						        	$image =$acc["image"];
						        }
								$sql1 = "UPDATE account SET name = '$name', email = '$email',phone ='$phone', address = '$address',image ='$image' WHERE username = '".$acc['username']."'";
								/*echo "$sql1";*/
								$result = mysqli_query($conn,$sql1);
								/*$tb = "Cập nhật thông tin thành công";*/
								header("location:../Admin/account.php");
							}
						?> -->
	                   	<label for="username" class="text-danger"><?php echo $tb; ?></label>
	            	</div>
	            </div>
	        </form>
		</div>
	</div>
</body>
</html>