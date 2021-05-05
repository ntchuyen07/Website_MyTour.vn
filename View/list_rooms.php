<?php 
	if(!isset($_SESSION)) 
    { 
        session_start(); 

    } else $user = $_SESSION["user"]; 
    
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout']))
    {
        $_SESSION["user"] = "";
        $_SESSION["role"] = "-1";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="../Css/list_rooms.css">
	<title>MyTour.vn</title>
</head>
<body>
	<?php include "../Utils/menu.php"; ?>
	<div class="container-fuild"><!--Slide ảnh-->
            <div style="width: 100%;margin-top:60px;">
                <div class="container-fuild" style="width: 100%;left: 0;right: 0">
                  <?php 
                  $id = $_GET["id"];
                  $conn = mysqli_connect("localhost","root","","mytour");
                  $sql1 = "SELECT * FROM hotel WHERE id =$id";
                  $result = mysqli_query($conn,$sql1);
                  $value = mysqli_fetch_assoc($result);
                    echo "<img src='../$value[image]'style='width: 100%; height: 650px;'>";
                    echo "<div class='carousel-caption'><h1 style='font-size:60px;margin-top:-160px;padding:40px;background: rgba(0,174,239,0.6);'><b>$value[name]</b></h1></div>";
                  ?>
                </div>
            </div>
        </div>
	<div class="container-fuild ctnf">
		<div class="container ctn">
			<div class="row properties">
				<div class="col-md-3"><b>LOẠI PHÒNG</b></div>
				<div class="col-md-1"><b>TỐI ĐA</b></div>
				<div class="col-md-3"><b>ĐẶC ĐIỂM</b></div>
				<div class="col-md-2"><b>GIÁ MỘT ĐÊM</b></div>
				<div class="col-md-1"><b>SỐ LƯỢNG</b></div>
				<div class="col-md-2"><b>ĐẶT PHÒNG</b></div>
			</div>
			<?php 
				$sqli = "SELECT * FROM rooms WHERE hotel=$id";
				$resulti = mysqli_query($conn,$sqli);
				while ($rooms = mysqli_fetch_assoc($resulti)) 
				{
					echo "<div class='row card_room nameroom'><h5><b>$rooms[nameroom]</b></h5></div>";
					echo "<div class='row card_room'>";
					echo "		<div class='col-md-3 strip'>
									<img src='../$rooms[image]' class='image_room'><br>";
									$sql2 = "SELECT * FROM typeroom WHERE id = $rooms[type]";
									$result2 = mysqli_query($conn,$sql2);
									$type = mysqli_fetch_assoc($result2);
					echo "			<p style='margin-top:15px;'><i class='fas fa-tag'></i> Phòng: $type[name]</p>";				
					echo "		</div>
								<div class='col-md-1 strip'>
									<i class='fas fa-user-alt'></i> X $rooms[maximum]
								</div>
								<div class='col-md-3 strip' style='text-align:left;'>
								<p><i class='fas fa-expand-alt'></i> $rooms[area] m<sup>2</sup></p>
								<p><i class='far fa-eye'></i> $rooms[direction]</p>
								<p><i class='fas fa-bed'></i> $rooms[beds]</p>
								<p><i class='fas fa-concierge-bell'></i>";
								if ($rooms["breakfast"]==0) {
									echo "  Không bao gồm bữa sáng";
								} else {
									echo "  Bao gồm bữa sáng";
								}
								echo "</p>
								<p><i class='fas fa-times'></i>"; 
								if ($rooms["policy"]==0) {
									echo "  Không hoàn hủy";
								} else {
									echo "  Có hoàn hủy";
								}
								echo "</p>
								<a href=../View/detailroom.php?id=$rooms[id] class='btn-more'>Xem chi tiết</a>
								</div>
								<div class='col-md-2 strip'>
									<p><del>".$rooms['price']." đ</del></p>
									<h5 style='color:green;'><b>".$rooms['final_price']." đ</b></h5>
								</div>
								<div class='col-md-1 strip'>
									<input type='number' min='0' max='$rooms[status]' value='0'>
								</div>
								<div class='col-md-2' style='padding-top:20px;'>
									<a href='../View/set_room.php?id=$rooms[id]' class='btn btn-primary'>ĐẶT NGAY</a>
								</div>";
					echo "</div>";
				}
			?>
		</div>
	</div>
	<?php include_once "../Utils/footer.php"; ?>
</body>
</html>