<?php 
	session_start();
	include_once "../Model/DAO.php";
	$dao = new DAO();
	$username = $_POST["username"];
	$_SESSION["username"]=$username;
	$conn = mysqli_connect("localhost","root","","mytour");
	$sql = "SELECT * FROM account WHERE username = '$username'";
	$res = mysqli_query($conn,$sql);
	$soluong = mysqli_num_rows($res);
	if ($soluong==0)
	{
		$_SESSION["tb1"] = "Tên đăng nhập này không tồn tại";
		header("location:../View/forgotpass.php");
	} else {
		$value = mysqli_fetch_assoc($res);
			$_SESSION["email"] = $value["email"];
			$_SESSION["user"]=$value["username"];
		$code = rand(100000,999999);
		$headers .= 'From: greenbook.vku@gmail.com' . "\r\n";
		$headers .= 'X-Mailer: PHP/' .phpversion() . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$message = '
		<html>
			<body>
				<h4><b>Xác nhận mã lấy lại tài khoản MyTour</b></h4>
				<p>Xin chào bạn <b>'.$value["name"].'</b>,</p>
				<p>Mã xác nhận của bạn là: '.$code.'</p>
			</body>
		</html>
		';
		$sql = "UPDATE account SET code ='$code' WHERE username = '$username'";
		$res = mysqli_query($conn,$sql);
		$title = 'Mã xác nhận lấy lại tài khoản tại MyTour.vn';
		mb_internal_encoding('UTF-8');
		$encoded_subject = mb_encode_mimeheader($title, 'UTF-8', 'B', "\r\n", strlen('Mã xác nhận lấy lại tài khoản tại MyTour.vn '));
		$status = mail($_SESSION["email"],$encoded_subject,$message, $headers); 
		header("location:../View/codevalidation.php");
	}
?>