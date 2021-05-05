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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="../Css/detailroom.css">
    <title>MyTour.vn</title>
</head>
<body>
       <div class="container-fuild"><!--Chạy Slide ảnh-->
            <div style="width: 100%;">
                <div class="container-fuild" style="width: 100%;left: 0;right: 0">
                  <?php 
                  $id = $_GET["id"];
                  $conn = mysqli_connect("localhost","root","","mytour");
                  $sql = "SELECT * FROM rooms WHERE id =$id";
                  $result = mysqli_query($conn,$sql);
                  $value = mysqli_fetch_assoc($result);
                    echo "<img src='../$value[image]'style='width: 100%; height: 650px;' class='contact-img'>";
                    echo "<div class='carousel-caption detailroom-caption-edit'><h1 class='titleroom'><b>$value[nameroom]</b></h1></div>";
                  ?>
                </div>
            </div>
        </div>
        <div class="container-fuild ctnf">
          <div class="container">
            <h1><b>GIỚI THIỆU</b></h1><hr>
            <?php 
                $sqli = "SELECT * FROM hotel WHERE id = $value[hotel]";
                $res = mysqli_query($conn,$sqli);
                $val = mysqli_fetch_assoc($res);
                echo "<h2 style='color:#0066FF;'><b><i class='fas fa-edit'></i> Được đăng tải bởi: $val[name]</b></h2>";
            ?>
            <h2 style="padding-top: 20px;padding-bottom: 20px;"><i class="fas fa-images"></i><b> HÌNH ẢNH</b></h2>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <?php 
                        $sql1 ="SELECT * FROM imagesrooms WHERE idroom = $id";
                        $result1 = mysqli_query($conn,$sql1);
                        $num = mysqli_num_rows($result1);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result1)) 
                        {
                            echo "
                                <div class='mySlides'>
                                    <div class='numbertext'>$i / $num </div>
                                    <img src='../$row[images]' style='width:100%;height:360px;' class='detailroom-main-img'>
                                </div>
                            ";
                            $i =$i + 1;
                        }
                    ?>
                        
                      <a class="prev" style="text-decoration: none;" onclick="plusSlides(-1)">❮</a>
                      <a class="next" style="text-decoration: none;" onclick="plusSlides(1)">❯</a>

                </div> 
                <div class="col-md-6 col-xs-6">
                    <div class="row detailroom-mini-img">
                        <?php
                            $result1 = mysqli_query($conn,$sql1);
                            $j = 1;
                            while ($row = mysqli_fetch_assoc($result1))  
                            {
                                echo "
                                    <div class='column'>
                                      <img class='demo cursor' src='../$row[images]' style='width:100%;height:120px;' onclick='currentSlide($j)' >
                                    </div>
                                ";
                                $j = $j + 1;
                            }    
                        ?>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 50px;">
               <div class="col-md-6 col-xs-6">
                   <h2><b>THÔNG TIN DỊCH VỤ</b></h2><hr>
                   <?php 
                   $result = mysqli_query($conn,$sql);
                   $room = mysqli_fetch_assoc($result);
                        $sql2 = "SELECT * FROM typeroom WHERE id = $room[type]";
                        $result2 = mysqli_query($conn,$sql2);
                        $type = mysqli_fetch_assoc($result2);
                        echo "<h3><i class='fas fa-tag'></i> Phòng: $type[name]</h3><br>";             
                        echo "<h3><i class='fas fa-user-alt'></i> X $room[maximum] người</h3><br>
                              <h3><i class='fas fa-expand-alt'></i> $room[area] m<sup>2</sup></h3><br>
                              <h3><i class='far fa-eye'></i> $room[direction]</h3><br>";
                              if ($room["status"]==0) 
                              {
                                    echo "<h3>Đã hết phòng. Quý khách vui lòng chọn loại phòng khác hoặc quay lại sau. Xin chân thành cảm ơn và cáo lỗi!</h3><br>";
                              } else 
                              {
                                    echo " <h3>Đảm bảo còn $room[status] phòng!</h3><br>";
                              }
                              
                   ?>
               </div>
               <div class="col-md-6 col-xs-6">
                   <h2><b>CHÍNH SÁCH ƯU ĐÃI</b></h2><hr>
                   <?php 
                        echo "<h3><i class='fas fa-concierge-bell'></i>";
                                if ($room["breakfast"]==0) {
                                    echo "  Không bao gồm bữa sáng";
                                } else {
                                    echo "  Bao gồm bữa sáng";
                                }
                                echo "</h3><br>
                                <h3><i class='fas fa-times'></i>"; 
                                if ($room["policy"]==0) {
                                    echo "  Không hoàn hủy";
                                } else {
                                    echo "  Có hoàn hủy";
                                }
                                echo "</h3><br>";
                        echo "<h3><i class='fas fa-gem'></i>";
                        if ($room["discount"]<=100) 
                        {
                          echo "Giảm $room[discount] %";
                        } else {
                          echo "Giảm $room[discount] VNĐ";
                        }
                        
                        echo " tiền phòng</h3><br>
                              <div class='button_set'><h3><del>".$room['price']." đ</del></h3>
                              <h1 style='color:green;'><b>".$room['final_price']." đ</b></h1>";
                        echo "<a href='../View/set_room.php?id=$room[id]' class='btn btn-primary px-4' style='font-size: 16px;'>ĐẶT NGAY</a>
                              </div>";
                   ?>
               </div>
            </div>
                <h2 style="padding-top: 20px;"><b>THÔNG TIN CHI TIẾT</b></h2><hr>
            <div class="row" style="padding-top: 20px;padding-left: 30px;">
                <?php 
                    echo "<h3>$room[decscription]</h3>";
                ?>
            </div>
          </div>
        </div>
    <?php
    include_once "../Utils/menu.php";
    include_once "../Utils/footer.php";
    ?>
    <script type="text/javascript" src="../JS/detailroom.js"></script>
</body>
</html>
