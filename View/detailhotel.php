<?php       
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    } else $user = $_SESSION["user"]; 
    
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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" type="text/css" href="../Css/detailhotel.css">
    <link rel="stylesheet" href="../Css/list_rooms.css">
    <title>MyTour.vn</title>
</head>
<body>
       <div  class="container-fuild" style="width: 100%;left: 0;right: 0;top:0">
                  <?php 
                  $id = $_GET["id"];
                  $conn = mysqli_connect("localhost","root","","mytour");
                  $sql = "SELECT * FROM hotel WHERE id =$id";
                  $result = mysqli_query($conn,$sql);
                  $value = mysqli_fetch_assoc($result);
                    echo "<img src='../$value[image]'style='width: 100%; height: 650px;' class='detailroom-main-img'>";
                    echo "<div class='carousel-caption detailroom-caption-edit'><h1 style='font-size:60px;margin-bottom:150px;padding:40px;background: rgba(0,174,239,0.6);' class='titleroom'><b>$value[name]</b></h1></div>";
                  ?>
        </div>
        <div class="container-fuild" style="background-color: #f5f5f5;padding-bottom:40px;padding-top: 10px;">
            <div class="container">
                <h2 style="padding-top: 20px;padding-bottom: 20px;"><i class="fas fa-images"></i><b> HÌNH ẢNH</b></h2>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <?php 
                            $sql1 ="SELECT * FROM imageshotel WHERE idhotel = $id";
                            $result1 = mysqli_query($conn,$sql1);
                            $num = mysqli_num_rows($result1);
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result1)) 
                            {
                                echo "
                                    <div class='mySlides'>
                                        <div class='numbertext'>$i / $num </div>
                                        <img src='../$row[image]' style='width:100%;height:360px;' class='detailroom-main-img'>
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
                                          <img class='demo cursor' src='../$row[image]' style='width:100%;height:120px;' onclick='currentSlide($j)' >
                                        </div>
                                    ";
                                    $j = $j + 1;
                                }    
                            ?>
                        </div>
                    </div>
                </div>
            </div>
          <div class="container">
            <h2 style="padding-top: 20px;padding-bottom: 20px;"><b>GIỚI THIỆU</b></h2><hr>
            <?php 
                echo "<p style='color:blue;'><b><i class='fas fa-map-marker-alt'></i>$value[address]</b></p>";
                $sql1 ="SELECT * FROM category WHERE id=$value[cate]";
                $result1 = mysqli_query($conn,$sql1);
                $value1 = mysqli_fetch_assoc($result1);
                $sql2 ="SELECT * FROM category WHERE id=$value1[parent_id]";
                $result2 = mysqli_query($conn,$sql2);
                $value2 = mysqli_fetch_assoc($result2);
                echo "<p><b><i class='fas fa-tags'></i>";
                if ($value1["parent_id"]!=0) {
                    echo "$value2[namecate], ";
                }
                echo "$value1[namecate]</b></p>";
                echo "<span class='intro-hotel'>$value[decscription]</span>";
                echo "<p style='float:right;'><a href=''>Xem thêm</a></p>";
            ?>
          </div>
          <div class="container" style="padding-top: 70px;">
            <h2><b>PHÒNG ĐƯỢC QUAN TÂM NHIỀU NHẤT</b></h2><hr>
            <div class="row">
                <?php 
                    $sqli = "SELECT * FROM rooms WHERE hotel=$id";
                    $resulti = mysqli_query($conn,$sqli);
                    while ($rooms = mysqli_fetch_assoc($resulti))
                    {
                ?>
                <div class="col-md-4 content3-item">
                    <a href="<?php echo "../View/detailroom.php?id=$rooms[id]";?>" class="content3-item_link">
                        <img src="<?php echo "../$rooms[image]"; ?>" alt="" class="content3-img">
                        <div class="content3-details">
                            <div class="content3-title"><?php echo "$rooms[nameroom]"; ?></div>
                            <div class="content3-last-time">1 đêm</div>
                            <div class="content3-price"> <?php echo $rooms['final_price']." vnđ"; ?></div>
                            <div class="content3-last-time">Tình trạng:
                                <?php 
                                    if($rooms["status"]==0)
                                    {
                                        echo "Hết phòng";
                                    }
                                    else{
                                        echo "Còn $rooms[status] phòng";
                                    }
                                ?>
                            </div>
                            <div class="content3-destination"><?php echo "Tối đa: <i class='fas fa-user-alt'></i> X $rooms[maximum] - ";
                                $sql3 = "SELECT * FROM typeroom WHERE id = $rooms[type]";
                                $result3 = mysqli_query($conn,$sql3);
                                $type = mysqli_fetch_assoc($result3);
                                echo "<i class='fas fa-tag'></i> Phòng: $type[name]"; ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
          </div>
          <div class="container">
            <h2><b>DANH SÁCH PHÒNG CỦA KHÁCH SẠN</b></h2><hr>
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
                    echo "      <div class='col-md-3 strip'>
                                    <img src='../$rooms[image]' class='image_room'><br>";
                                    $sql2 = "SELECT * FROM typeroom WHERE id = $rooms[type]";
                                    $result2 = mysqli_query($conn,$sql2);
                                    $type = mysqli_fetch_assoc($result2);
                    echo "          <p style='margin-top:15px;'><i class='fas fa-tag'></i> Phòng: $type[name]</p>";             
                    echo "      </div>
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
          <div class="container" style="padding: 30px;background-color: white; margin-top: 20px;">
              <h2><b>ĐÁNH GIÁ DỊCH VỤ KHÁCH SẠN CỦA NGƯỜI DÙNG</b></h2><hr>
              <?php
                $rate = "SELECT * FROM bills WHERE hotel=$id and rating > 0";
                $load = mysqli_query($conn,$rate);
                if ($load==true) 
                {
                    $num = mysqli_num_rows($load);
                    $star1 = $star2 = $star3 = $star4 = $star5 = 0;
                   foreach ($load as $key => $rating) {
                    ?>
                    <div class="row" style="padding: 30px;">
                      <div class="col-md-2">
                          <?php
                                $sql = "SELECT *FROM account WHERE id='$rating[user]'";
                                $result = mysqli_query($conn,$sql);
                                foreach ($result as $key => $acc) {
                                    if ($acc['image']=='') 
                                        {
                                            $avat = "image/avat.jpg";
                                        } 
                                        else 
                                        {
                                            $avat = $acc['image'];
                                        }
                                    echo "<img src='../$avat' style='width:70%;border-radius:50%;'>";
                                }
                          ?>
                      </div>
                      <div class="col-md-9">
                        <?php
                            echo "<h4><b>$rating[showname]</b></h4>";
                           switch ($rating["rating"]) {
                               case '1':
                                   echo "<i class='fas fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                        ";
                                        $star1 = $star1 + 1;
                                   break;
                               case '2':
                                   echo "<i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                        ";
                                        $star2 = $star2 + 1;
                                   break;
                               case '3':
                                   echo "<i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                        ";
                                        $star3 = $star3 + 1;
                                   break;
                               case '4':
                                   echo "<i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='far fa-star' style='color:orange;'></i>
                                        ";
                                        $star4 = $star4 + 1;
                                   break;
                               case '5':
                                   echo "<i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                         <i class='fas fa-star' style='color:orange;'></i>
                                        ";
                                        $star5 = $star5 + 1;
                                   break;
                               
                               default:
                                   break;
                           }
                           echo "<p>$rating[comment]</p>";
                        ?>
                        </div>
                    </div><hr>
                    <?php
                   }
                }
                if ($num!=0) {
                  $star = ($star1*1 + $star2*2 + $star3*3 + $star4*4 + $star5*5)/$num;
                } else {
                  $star = 0;
                }
              ?>
                <div class="row">
                    <div class="col-md-4" style="border: 4px solid #CCCCFF;border-radius: 10px;
                        padding: 10px;align-items: center;justify-content: center;display: flex;height: 190px">
                        <div style="text-align: center;">
                            <i class='fas fa-star' style='color:orange;font-size: 72px;'></i><br>
                            <?php echo "<h1>$star/5</h1>"; ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class='row'>
                        <div class="col-md-3" style="border: 4px solid #CCCCFF;height: 90px;border-radius: 10px;
                        padding: 10px;align-items: center;justify-content: center;display: flex;margin: 3px;">
                            <div style="text-align: center; ">
                                <i class='fas fa-star' style='color:orange;'></i><br>
                                <?php echo "<h3>$star1</h3>"; ?>
                            </div>
                        </div>
                        <div class="col-md-3" style="border: 4px solid #CCCCFF;height: 90px;border-radius: 10px;
                        padding: 10px;align-items: center;justify-content: center;display: flex;margin: 3px;">
                            <div style="text-align: center;">
                                <i class='fas fa-star' style='color:orange;'></i>
                                <i class='fas fa-star' style='color:orange;'></i><br>
                                <?php echo "<h3>$star2</h3>"; ?>
                            </div>
                        </div>
                        <div class="col-md-3" style="border: 4px solid #CCCCFF;height: 90px;border-radius: 10px;
                        padding: 10px;align-items: center;justify-content: center;display: flex;margin: 3px;">
                            <div style="text-align: center;">
                                <i class='fas fa-star' style='color:orange;'></i><br>
                                <i class='fas fa-star' style='color:orange;'></i>
                                <i class='fas fa-star' style='color:orange;'></i><br>
                                <?php echo "<h3>$star3</h3>"; ?>
                            </div>
                        </div>
                        <div class="col-md-3" style="border: 4px solid #CCCCFF;height: 90px;border-radius: 10px;
                        padding: 10px;align-items: center;justify-content: center;display: flex;margin: 3px;">
                            <div style="text-align: center;">
                                <i class='fas fa-star' style='color:orange;'></i>
                                <i class='fas fa-star' style='color:orange;'></i>
                                <i class='fas fa-star' style='color:orange;'></i>
                                <i class='fas fa-star' style='color:orange;'></i><br>
                                <?php echo "<h3>$star4</h3>"; ?>
                            </div>
                        </div>
                        <div class="col-md-3" style="border: 4px solid #CCCCFF;height: 90px;border-radius: 10px;
                        padding: 10px;align-items: center; justify-content: center;display: flex;margin: 3px;">
                            <div style="text-align: center;">
                                <i class='fas fa-star' style='color:orange;'></i>
                                <i class='fas fa-star' style='color:orange;'></i><br>
                                <i class='fas fa-star' style='color:orange;'></i>
                                <i class='fas fa-star' style='color:orange;'></i>
                                <i class='fas fa-star' style='color:orange;'></i>
                                <?php echo "<h3>$star5</h3>"; ?>
                            </div>
                        </div>
                    </div>
                </div>
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
