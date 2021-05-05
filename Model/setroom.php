<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$date = date('Y-m-d H:i:s');
	session_start();
	$id = $_GET["id"];
	$user = $_SESSION["user"];
	$checkin = $_POST["checkin"];
	$checkout = $_POST["checkout"];
	$amount = $_POST["amount"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$address = $_POST["address"];
	$pay = $_POST["pay"];
	$sum = $_POST["sum"];
	$number = $_POST["numOfDates"];
	$conn = mysqli_connect("localhost","root","","mytour");
	$sql = "SELECT * FROM rooms WHERE id = $id";
	$res = mysqli_query($conn,$sql);
	$room = mysqli_fetch_assoc($res);
	$price = $room["final_price"];
	$hotel = $room["hotel"];
	$sql = "SELECT * FROM hotel WHERE id = $hotel";
	$res = mysqli_query($conn,$sql);
	$value = mysqli_fetch_assoc($res);

	$sql = "SELECT * FROM account WHERE username = '$user'";
	$res = mysqli_query($conn,$sql);
	$acc = mysqli_fetch_assoc($res);
	$user = $acc["id"];
	$formatDate = date("d/m/Y", strtotime($checkin));
	$formatDateOut = date("d/m/Y", strtotime($checkout));
	$sql = "INSERT INTO bills(user,name,email,phone,address,set_date,room,hotel, price,checkin_date,checkout_date,amount,sum_price,pay,status) 
			VALUES ('$user','$name','$email','$phone','$address','$date','$id','$hotel','$price','$checkin 14:00:00','$checkout 11:00:00','$amount','$sum','$pay','1')";
	$res = mysqli_query($conn,$sql);
	/*unset($_SESSION["cart"]);*/
		$headers .= 'From: greenbook.vku@gmail.com' . "\r\n";
		$headers .= 'X-Mailer: PHP/' .phpversion() . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$message = '
		<html>
			<body>
				<h2><b>Đơn đặt phòng</b></h2>
				<p>Xin chào <b>'.$acc["name"].'</b>,</p>
				<p>Đơn hàng của quý khách đã được ghi nhận. Chúng tôi sẽ xác nhận trong thời gian sớm nhất.</p>
				<h3><b>Thông tin đơn hàng:</b></h3>
				<ul>
					<li>Người nhận phòng: <b>'.$name.'</b></li>
					<li>Phòng đã đặt: <b>'.$room["nameroom"].'</b></li>
					<li>Thuộc khách sạn: <b>'.$value["name"].'('.$value["address"].')</b></li>
					<li>Số lượng: <b>'.$amount.'</b></li>
					<li>Ngày nhận phòng: <b>14:00:00 '.$formatDate.'</b></li>
					<li>Ngày trả phòng: <b>11:00:00 '.$formatDateOut.'</b></li>
					<li>Thanh toán:<b>'.$sum.' vnđ</b></li>
				</ul>
				<p>Sau khi xác nhận, quý khách vui lòng đến đúng thời gian (14:00:00 '.$formatDate.') như đã xác nhận trước đó.</p>
				<p>Trong trường hợp muốn hủy đơn, quý khách vui lòng tiến hàng trước thời gian nhận phòng 7 ngày. Sau thời gian trên, yêu cầu sẽ không được chấp nhận.</p>
				<i>Xin chân thành cảm ơn quý khách đã tin tưởng lựa chọn dịch vụ tại MyTour.vn!</i>
			</body>
		</html>
		';
		$title = 'Thông báo đơn đặt phòng tại MyTour.vn';
		mb_internal_encoding('UTF-8');
		$encoded_subject = mb_encode_mimeheader($title, 'UTF-8', 'B', "\r\n", strlen('Thông báo đơn đặt phòng tại MyTour.vn'));
		$status = mail($email,'Thông báo đơn đặt phòng tại MyTour.vn',$message, $headers); 
	header("location:../View/vieworder.php");
?>