<?php 
	session_start();
	$conn = mysqli_connect("localhost","root","","mytour");
	$user = $_SESSION["user"];
	$sql = "SELECT * FROM account WHERE username = '".$user."'";
	$result = mysqli_query($conn,$sql);
	$acc = mysqli_fetch_assoc($result);
	$dir = "image/";
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
		$sql1 = "UPDATE account SET name = '$name', email = '$email',phone ='$phone', address = '$address',image ='$image' WHERE username = '".$_SESSION["user"]."'";
		$result = mysqli_query($conn,$sql1);
		$_SESSION["mess"] = "Cập nhật thông tin thành công";
		header("location:../Admin/account.php");
?>