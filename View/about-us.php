<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include_once "../Model/DAO.php";

    $dao = new DAO();       
    if(!isset($_SESSION["user"])) 
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
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/about-us.css">
    <link rel="stylesheet" href="../Css/base.css">
    <link rel="stylesheet" href="../Css/detailhotel.css">
    <link rel="stylesheet" href="../Css/style.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="jquery.counterup.min.js"></script>
    <script src="/JS/slide.js"></script>
    <title>MyTour.vn</title>
</head>
<body>
       <div class="container-fuild"><!--Chạy Slide ảnh-->
            <div style="width: 100%;">
                <div class="container-fuild" style="width: 100%;left: 0;right: 0">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">       
                    <div class="carousel-inner" role="listbox">
                      <div class="item active">
                        <img src="../image/anh-bien-beach-9.jpg" style="width: 100%; height: 650px;" class="contact-img">
                        <div class='carousel-caption contact-caption-edit' style="margin-bottom: 10px;">
                          <h1 style='font-size:60px;color: white;' class="contact-title"><b>VỀ CHÚNG TÔI</b></h1></div>
                      </div>
                    </div> 
                  </div>
                </div>
            </div>
        </div>
        <div class="container" style="padding-top: 70px;padding-bottom: 50px;">
          <div class="row">
            <div class="col-md-6">
              <img src="../image/da-nang-co-them-truong-dai-hoc-chuyen-dao-tao-cntt-truyen-thong.jpg" style="width: 100%">
            </div>
            <div class="col-md-6 text-center about-us-title">
             <h1 style="font-size: 25px;"><b>CHÚNG TÔI</b></h1><br>
             <p>Ra đời từ trong những ước mơ, hoài bão ươm mầm ở ngôi trường Đại học VKU: Từ những người không thân thiết quen biết, chúng tôi gặp gỡ và cùng nhau bắt tay xây dựng nên một website với mong muốn đẩy mạnh ngành dịch vụ khách sạn và tạo sự yên tâm, tin tưởng của khách hàng khi lựa chọn phòng lưu trú.</p><br>
             <p><b>MyTour.vn</b> là một dự án nhỏ cho một kỳ bảo vệ đồ án cơ sở. Tuy nhiên, chúng tôi luôn ước mơ và nỗ lực để nó hoàn toàn có thể là một sản phẩm chỉnh chu và uy tín cho mọi người.</p><br>
             <p><i><b>Cảm ơn tất cả những người trong đội ngũ thiết kế đã góp phần tạo nên thành công của MyTour.vn</b></i></p>
            </div>
          </div>
          
        </div>
            <div class="container homepage-about-us">
              <h1 style="text-align: center;padding: 50px;"><b>Tại sao nên đặt phòng tại MyTour.vn?</b></h1>
              <div class="row about-features" style="padding-bottom: 60px;">
                  <div class="col-md-4 text-center">
                      <img src="../image/1494407528373-a0e2c450b5cfac244d687d6fa8f5dd98.png">
                  </div>
                  <div class="col-md-8">
                      <h3><b>Giá rẻ mỗi ngày với ưu đãi đặc biệt dành riêng cho khách hàng thân thiết</b></h3>
                      <p>Đặt phòng qua ứng dụng để nhận giá tốt nhất với các khuyến mãi tuyệt vời!</p>
                  </div>
              </div>
              <div class="row about-features" style="padding-bottom: 60px;">
                  <div class="col-md-8">
                      <h3><b>Phương thức thanh toán an toàn và linh hoạt</b></h3>
                      <p>Giao dịch trực tuyến an toàn với nhiều lựa chọn như thanh toán tại cửa hàng tiện lợi, chuyển khoản ngân hàng, thẻ tín dụng đến Internet Banking. Không tính phí giao dịch.</p>
                  </div>
                  <div class="col-md-4 text-center">
                      <img src="../image/1494407536280-ddcb70cab4907fa78468540ba722d25b.png">
                  </div>
              </div>
              <div class="row about-features" style="padding-bottom: 60px;">
                  <div class="col-md-4 text-center">
                      <img src="../image/1494407541562-61b4438f5439c253d872e70dd7633791.png">
                  </div>
                  <div class="col-md-8">
                      <h3><b>Hỗ trợ khách hàng 24/7</b></h3>
                      <p>Đội ngũ nhân viên hỗ trợ khách hàng luôn sẵn sàng giúp đỡ bạn trong từng bước của quá trình đặt vé</p>
                  </div>
              </div>
              <div class="row about-features" style="padding-bottom: 60px;">
                  <div class="col-md-8">
                      <h3><b>Khách thực, đánh giá thực</b></h3>
                      <p>Hơn 10.000.000 đánh giá, bình chọn đã được xác thực từ du khách sẽ giúp bạn đưa ra lựa chọn đúng đắn.</p>
                  </div>
                  <div class="col-md-4 text-center">
                      <img src="../image/1494407562736-ea624be44aec195feffac615d37ab492.png">
                  </div>
            </div>
		    </div>
        <?php 
            $conn = mysqli_connect("localhost","root","","mytour");
            $sql = "SELECT * FROM bills ";
            $result = mysqli_query($conn,$sql);
            $soluong = mysqli_num_rows($result);

            $sql1 = "SELECT * FROM hotel";
            $result1 = mysqli_query($conn,$sql1);
            $soluong1 = mysqli_num_rows($result1);

            $sql2 = "SELECT * FROM account";
            $result2 = mysqli_query($conn,$sql2);
            $soluong2 = mysqli_num_rows($result2);

            $sql3 = "SELECT * FROM post";
            $result3 = mysqli_query($conn,$sql3);
            $soluong3 = mysqli_num_rows($result3);
        ?>
        <div class="container-fluid parallax">
            <div class="us" style="background: rgba(0,0,0,0.8);color: white;display: flex; align-items: center;justify-content: center;text-align: center;">
              <div class="container counter_wrap">
                <h1 style="padding-bottom: 50px;"><b>THÀNH TỰU THU ĐƯỢC</b></h1>
                  <div class="row">
                      <div class="col-lg-3 col-md-3" style="border-right: 2px solid white">
                            <div class="single_counter text-center">
                                <h2 class="counter" style="font-size: 72px;"><?php echo "$soluong1"; ?></h2>
                                <p>Khách sạn đối tác</p>
                            </div>
                      </div>
                      <div class="col-lg-3 col-md-3" style="border-right: 2px solid white">
                           <div class="single_counter text-center">
                                <h2 class="counter" style="font-size: 72px;"><?php echo "$soluong2"; ?></h2>
                                <p>Khách hàng</p>
                           </div>
                      </div>
                      <div class="col-lg-3 col-md-3" style="border-right: 2px solid white">
                           <div class="single_counter text-center">
                                 <h2 class="counter" style="font-size: 72px;"><?php echo "$soluong3"; ?></h2>
                                 <p>Bài viết</p>
                           </div>
                      </div>
                      <div class="col-lg-3 col-md-3">
                           <div class="single_counter text-center">
                                 <h2 class="counter" style="font-size: 72px;"><?php echo "$soluong"; ?></h2>
                                 <p>Đơn đặt phòng</p>
                           </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" style="padding:100px;">
            <h2 style="text-align: center;font-family: 'Anton';font-size: 45px;">THÀNH VIÊN SÁNG LẬP</h2>
            <h4 style="text-align: center;color:#dfdfdf;">KHÔNG CÓ VIỆC GÌ KHÓ NẾU TA LÀM CÙNG NHAU</h4>
            <div class="line"></div><br>
            <div class="row text-center slideanim">
              <div class="col-sm-3">
                <div class="thumbnail">
                  <img src="../image/12a2dh1-543.jpg" class="avat"><br>
                  <h3><b>CẨM HUYỀN</b></h3>
                  <h5><b>Trưởng nhóm</b></h5><br>
                  <p style="padding-top: 10px;">Quản trị viên website</p>
                  <p>Thực hiện 100% dự án</p><br>
                  <p style="padding-top: 10px;">Email:<br> <a><b>ntchuyen@vku.udn.vn</b></a></p>
                  <div style="padding-top: 10px;"><span class="lk"><i class="fab fa-twitter"><a href=""></a></i></span>
                  <span class="lk"><i class="fab fa-facebook"><a href="#"></a></i></span>
                  <span class="lk"><i class="fab fa-instagram"><a href=""></a></i></span>
                  <span class="lk"><i class=" fab fa-dribbble"><a href=""></a></i></span></div>
                  <br>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="thumbnail">
                  <img src="../image/128078826_402437887567604_8472730812473317076_n.jpg" class="avat"><br>
                  <h3><b>THANH PHONG</b></h3>
                  <h5><b>Cố vấn - Hỗ trợ</b></h5><br>
                  <p style="padding-top: 10px;">Tư vấn, test thử nghiệm</p>
                  <p>Hỗ trợ thiết kế website</p><br>
                  <p style="padding-top: 10px;">Email:<br> <a><b>htphong@vku.udn.vn</b></a></p>
                  <div style="padding-top: 10px;"><span class="lk"><i class="fab fa-twitter"><a href=""></a></i></span>
                  <span class="lk"><i class="fab fa-facebook"><a href="#"></a></i></span>
                  <span class="lk"><i class="fab fa-instagram"><a href=""></a></i></span>
                  <span class="lk"><i class=" fab fa-dribbble"><a href=""></a></i></span></div>
                  <br>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="thumbnail">
                  <img src="../image/unnamed.png" class="avat"><br>
                  <h3><b>TS. HOÀNG HỮU ĐỨC</b></h3>
                  <h5><b> Giảng viên hướng dẫn</b></h5><br>
                  <p style="padding-top: 10px;">Góp ý, phê duyệt dự án</p>
                  <p>Theo dõi quá trình thực hiện</p><br>
                  <p style="padding-top: 10px;">Email:<br> <a><b>hhduc@vku.udn.vn</b></a></p>
                  <div style="padding-top: 10px;"><span class="lk"><i class="fab fa-twitter"><a href=""></a></i></span>
                  <span class="lk"><i class="fab fa-facebook"><a href="#"></a></i></span>
                  <span class="lk"><i class="fab fa-instagram"><a href=""></a></i></span>
                  <span class="lk"><i class=" fab fa-dribbble"><a href=""></a></i></span></div>
                  <br>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="thumbnail">
                  <img src="../image/36223128_616973088677928_7151059408980541440_n.jpg" class="avat"><br>
                  <h3><b>QUỐC ANH</b></h3>
                  <h5><b> Thành viên nhóm đồ án</b></h5><br>
                  <p style="padding-top: 10px;">Không có trách nhiệm việc được giao</p>
                  <p>Mức độ hoàn thiện chưa cao</p><br>
                  <p style="padding-top: 10px;">Email:<br> <a><b>vtqanh.19it1@vku.udn.vn</b></a></p>
                  <div style="padding-top: 10px;"><span class="lk"><i class="fab fa-twitter"><a href=""></a></i></span>
                  <span class="lk"><i class="fab fa-facebook"><a href="#"></a></i></span>
                  <span class="lk"><i class="fab fa-instagram"><a href=""></a></i></span>
                  <span class="lk"><i class=" fab fa-dribbble"><a href=""></a></i></span></div>
                  <br>
                </div>
              </div>
            </div>
        </div>
    <?php
    include_once "../Utils/menu.php";
    include_once "../Utils/footer.php";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(document).ready(function () {
        $('.counter').counterUp({
          delay: 10,
          time: 10000
        });
      })
    </script>
</body>
</html>
