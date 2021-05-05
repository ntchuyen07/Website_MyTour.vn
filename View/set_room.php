<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	include_once "../Model/DAO.php";
	$dao = new DAO();
	session_start();
	if (!isset($_SESSION["user"])) 
	{
		$user = "";
		header('location: index.php');
	}
	else
	{
		$user = $_SESSION["user"];
	}
	$id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../Css/set_room.css">
	<title>Đặt phòng</title>
</head>
<body>
	<?php 
		$sql="SELECT * FROM rooms WHERE id =$id";
		$res = $dao->getData($sql);
		foreach ($res as $key => $value)
		{
			$sql1 = "SELECT * FROM hotel WHERE id = $value[hotel]";
			$res = $dao->getData($sql1);
			foreach ($res as $key => $value1)
			{
			}
		}
		$amount = 1;
	?>
	<div class="container-fuild" style="background-color: #f5f5f5;padding-top: 10px;">
		<div class="container" style="margin-top: 200px;">
			<form action="../Model/setroom.php?id=<?php echo $value["id"]; ?>" method="post">
				<div class="row">
					<div class="col-md-7 col-xs-7 card-set ">
						<?php 
							echo "<h4><b>$value1[name]</b></h4>";
							echo "<p><i class='fas fa-map-marker-alt' style='color:blue;'></i>$value1[address]</p><br>";
						?>
						<!-- <div class="row"> -->
							<div class="row form-group">
								<label class="col-md-3 col-xs-3">Nhận phòng: </label>
								14:00 <input type="date" name="checkin" id="checkin" class="col-md-5 col-xs-5" onchange = "differenceInDate()" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>">
							</div>
							<div class="row form-group">
								<label class="col-md-3 col-xs-3">Trả phòng: </label>
								11:00 <input type="date" name="checkout" id="checkout" class="col-md-5 col-xs-5" onchange = "differenceInDate()" value="<?php echo date('Y-m-d',strtotime('+1 day', strtotime(date('Y/m/d')))); ?>">
							</div>
							<div class="row form-group setroom-count-night">
								<label class="col-md-3 col-xs-3">Số đêm: </label>
								<label class="col-md-1 col-xs-1 amount"><?php echo "$amount"; ?></label><span>đêm</span>
							</div>
						<!-- </div> -->
						<div style="background-color: #e8e8ff;padding:5px;">
							<h5><b>Thông tin liên hệ</b></h5>
							<?php 
								$email = $phone = $name = $address = "";
								if ($user=="") 
								{
									echo "<a href='../View/login.php'>Đăng nhập</a>";
								} else 
								{
									$conn = mysqli_connect("localhost","root","","mytour");
									$sql2 = "SELECT * FROM account WHERE username = '$user'";
									$result = mysqli_query($conn,$sql2);
	                    			$acc = mysqli_fetch_assoc($result);
	                    				$email = $acc["email"];
	                    				$phone = $acc["phone"];
	                    				$name = $acc["name"];
	                    				$address = $acc["address"];
								}
							?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                	        <label> Email:<sup class="text-xs red-dark-3">*</sup> <br>
	                                            <small class="help-info">
	                                            <i class="fa fa-info-circle"></i>
	                                            Xác nhận đơn sẽ được gửi qua email này.
	                                            </small>
                                    	    </label>
                                    		<input type="text" name="email" class="col-md-12" value="<?php echo "$email" ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                	        <label> Số điện thoại:<sup class="text-xs red-dark-3">*</sup> <br>
	                                            <small class="help-info">
	                                            <i class="fa fa-info-circle"></i>
	                                            Xác nhận đơn phòng sẽ được gửi SMS.
	                                            </small>
                                    	    </label>
                                    		<input type="text" name="phone" class="col-md-12" value="<?php echo "$phone" ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                	        <label> Họ tên:<sup class="text-xs red-dark-3">*</sup>
                                    	    </label><br>
                                    		<input type="text" name="name" class="col-md-12" value="<?php echo "$name" ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                	        <label> Địa chỉ:<sup class="text-xs red-dark-3">*</sup>
                                    	    </label> <br>
                                    		<input type="text" name="address" class="col-md-12" value="<?php echo "$address" ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="ins-opt-in-checkbox-wrapper"><label class="ins-checkbox-container"> 
                                    <input type="checkbox" required> Tôi đồng ý nhận các thông tin khuyến mại được nêu chi tiết trong chính sách bảo mật như thông báo, bản tin, khuyến mại, các ưu đãi khác liên quan đến sản phẩm và dịch vụ của MyTour và các đối tác của MyTour.vn
                                    <span class="ins-checkmark"></span></label></div>
						</div>
						<div>
							<h5><b>Chọn phương thức thanh toán</b></h5>
							<small class="help-info">
                                <i class="fa fa-info-circle"></i>
                                Thanh toán trước 30%, còn lại sẽ thanh toán cho khách sạn khi khách hàng nhận phòng.
                            </small>
							<div class="row">
								<div class="col-md-3 chbox-pay">
								<input type="radio" name="pay" id="pay1" value="Thẻ tín dụng"><label><small>Thẻ tín dụng</small></label>
								</div>
								<div class="col-md-3 chbox-pay">
									<input type="radio" name="pay" id="pay2" value="Thẻ ATM nội địa"><label><small> Thẻ ATM nội địa</small></label>
								</div>
								<div class="col-md-3 chbox-pay">
									<input type="radio" name="pay" id="pay3" value="Chuyển khoản"><label><small> Chuyển khoản</small></label>
								</div>
								<div class="col-md-3 chbox-pay">
									<input type="radio" name="pay" id="pay4" value="Cửa hàng gần nhà"><label><small> Cửa hàng gần nhà</small></label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5 col-xs-5">
						<div class="card-room">
							<h5><b>Thông tin phòng</b></h5>
							<p><b><?php echo "$value[nameroom]"; ?></b></p>
							<div class="row">
								<div class="col-md-6">
									<img src="../<?php echo "$value[image]";?>" class="col-md-12" >
								</div>
								<div class="col-md-6">
									<p>1 phòng</p>
									<ul>
										<li>
											<?php 
												if ($value["breakfast"]==0) {
				                                    echo "  Không bao gồm bữa sáng";
				                                } else {
				                                    echo "  Bao gồm bữa sáng";
				                                }
		                                ?>
										</li>
										<li>
											<?php 
				                                if ($value["policy"]==0) {
				                                    echo "  Không hoàn hủy";
				                                } else {
				                                    echo "  Có hoàn hủy";
				                                }
											?>
										</li>
									</ul>
								</div>
							</div>
							<h5 class="text-price" id ="price"><b><?php echo $value["final_price"]; ?></b></h5><span style="float: right">đ/đêm</span><br>
							<hr>
							<p>Phí giao dịch tại MyTour: Miễn phí</p><hr>
							<h5><b>Đơn hàng của bạn</b></h5>
							<div class="row form-group">
								<label class="col-md-5 col-xs-5">Số lượng phòng: </label>
								<input type="number" name="amount" class="col-md-2 col-xs-2" id="numberRoom" value="1" min="1" max="<?php echo "$value[amount]";?>" onchange="differenceInDate()">
							</div>
							<div class="row form-group">
								<label class="col-md-5 col-xs-5">Số đêm:</label>
								<input type="text" class="col-md-2 col-xs-2 amount" name="numOfDates" value="<?php echo "$amount"; ?>" readonly>
							</div>
							<?php 
								$tt = $amount*$value["final_price"];
							?>
							<h6><b>Tổng tiền:   </b><input type="text" style="float: right;width: auto;" class="sumprice" name="sum" value="<?php echo $tt; ?>" readonly></h6><hr>
							<h4><b>THANH TOÁN</b></h4>
							<input type="submit" value="THANH TOÁN" class="btn btn-warning" style="right:0;">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include_once "../Utils/menu.php"; ?>
	<?php include_once"../Utils/footer.php"; ?>
<script type = "text/javascript" > 
	function differenceInDate() {
	  // lấy value ngày đến
	   var dateInput1 = $("#checkin").val();
	  // lấy value ngày trả
	   var dateInput2 = $("#checkout").val();
	   var date1 = new Date(dateInput1); 
	   var date2 = new Date(dateInput2); 

	   var Difference_In_Time = date2.getTime() - date1.getTime(); 
	   var numOfDates = Difference_In_Time / (1000 * 3600 * 24);
	   var numberOfRoom = $("#numberRoom").val();
	   var priceOfRoom = $("#price").text();
	   var sum = priceOfRoom * numOfDates * numberOfRoom;
	  // set numOfDates cho số đêm
	  $(".amount").val(numOfDates);
	  $(".amount").text(numOfDates);
	  $(".sumprice").val(sum);
	} 
</script> 
</body>
</html>