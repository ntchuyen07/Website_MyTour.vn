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
    <link rel="stylesheet" href="../Css/main.css">
    <link rel="stylesheet" href="../Css/base.css">
    <link rel="stylesheet" href="../Css/detailhotel.css">
    <link rel="stylesheet" href="../Css/style.css">
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
                        <img src="../image/SheratonGrandDanangResort.jpg" class="homepage-carousel">
                      </div>
                    </div> 
                  </div>
                </div>
            </div>
        </div>
        <section class="zn_section eluid8814d5bb section-sidemargins section--no hide-on-mobile" id="eluid8814d5bb" style="background: #f5f5f5;">
        <div class="zn_section_size container zn-section-height--auto zn-section-content_algn--top " >
        <div class="row gutter-0">
        <div class="eluid04ffd9aa  col-md-12 col-sm-12   znColumnElement" id="eluid04ffd9aa">
        <div class="znColumnElement-innerWrapper-eluid04ffd9aa znColumnElement-innerWrapper znColumnElement-innerWrapper--valign-top znColumnElement-innerWrapper--halign-left ">
        <div class="znColumnElement-innerContent"> <div class="kl-iconbox eluid5bcabff1 bottomtip  kl-iconbox--type-icon   kl-iconbox--align-center text-center kl-iconbox--theme-light element-scheme--light" id="eluid5bcabff1" style="display: none;">
        <div class="kl-iconbox__inner clearfix">
        <div class="kl-iconbox__icon-wrapper kl-iconbox-AnimateFloat" >
        <span class="kl-iconbox__icon kl-iconbox__icon--" data-zniconfam="glyphicons_halflingsregular" data-zn_icon=""></span> </div>
        <div class="kl-iconbox__content-wrapper" >
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="eluid382c70d4 znBoxShadow-7           col-md-12 col-sm-12   znColumnElement" id="eluid382c70d4"  >
        <div class="znColumnElement-innerWrapper-eluid382c70d4 znColumnElement-innerWrapper znColumnElement-innerWrapper--valign-center znColumnElement-innerWrapper--halign-left " style="margin-top: -130px;">
        <div class="znColumnElement-innerContent">
            <div class="kl-title-block clearfix tbk--text- tbk--left text-left tbk-symbol--  tbk-icon-pos--after-title eluid29993755 "><h3 class="tbk__title" itemprop="headline"><b>TÌM KIẾM NHANH</b></h3>
            </div>
            <div class="zn_custom_html eluidb28493a0 search-form--inline">
                <div id="hotel-booking-search-5fe2a8777a805" class="hotel-booking-search">
                    <form name="hb-search-form" action="../View/quick_search.php" class="hb-search-form-5fe2a8777a803" method="post">
                        <ul class="hb-form-table">
                        <li class="hb-form-field">
                            <label>Ngày đến </label> 
                            <div class="hb-form-field-input">
                                <input type="date" name="checkin" id="check_in_date_5fe2a8777a803" 
                                class="hb_input_date_check hasDatepicker" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>">
                            </div>
                        </li>
                        <li class="hb-form-field">
                            <label>Ngày đi </label> 
                            <div class="hb-form-field-input">
                                <input type="date" name="checkout" id="check_out_date_5fe2a8777a803" 
                                class="hb_input_date_check hasDatepicker" value="<?php echo date('Y-m-d',strtotime('+1 day', strtotime(date('Y/m/d')))); ?>">
                            </div>
                        </li>
                        <li class="hb-form-field">
                            <label>Khu vực</label> 
                            <div class="hb-form-field-input">
                                <select name="address" style="width: auto;">
                                    <?php 
                                        $sql ="SELECT * FROM address";
                                        $res = $dao->getData($sql);
                                        foreach ($res as $key => $value) 
                                        {
                                            echo "<option value='$value[id]'>$value[name]</option>";
                                        }
                                    ?>
                                </select> 
                            </div>
                        </li>
                        <li class="hb-form-field">
                            <label>Số lượng </label> 
                            <div class="hb-form-field-input">
                                <input type="number" name="amount" min="1" placeholder="1 phòng">
                            </div>
                        </li>
                        </ul>
                        <input type="hidden" id="nonce" name="nonce" value="2168d3c692"><input type="hidden" name="_wp_http_referer" value="/greekhotel/"> <input type="hidden" name="hotel-booking" value="results">
                        <input type="hidden" name="widget-search" value="">
                        <input type="hidden" name="action" value="hotel_booking_parse_search_params">
                        <p class="hb-submit">
                        <button type="submit">Tìm kiếm</button>
                        </p>
                    </form>
                </div>
            </div> 
        </div>
        </div>
        </div>
        
    </section class="menu-hotel">
        <div class="container-fuild" style="background-color: #f5f5f5;padding-bottom:40px;padding-top: 40px;">
          <div class="container">
            <h1><b>KHÁCH SẠN ĐỐI TÁC</b></h1><hr>
            <?php 
                  $sql1 = "SELECT * FROM hotel";
                  $res = $dao->getData($sql1);
                  $i = 1;
                  foreach ($res as $key => $value1) {
                    if ($i<17) 
                    echo"<div class='col-md-3 col-xs-auto'>
                          <a href='../View/detailhotel.php?id=$value1[id]' class='hotel-link'>
                            <img src='../$value1[image]' class='imghotel'>
                            <div class='hotel-name'>$value1[name]</div>
                          </a>
                      </div>";
                      $i = $i +1;
                  }
            ?>
          </div>
          <div class="container" style="padding-top: 70px;">
            <h1><b>CÁC PHÒNG ĐƯỢC ĐẶT NHIỀU NHẤT</b></h1><hr>
            <div class="row">
                <?php 
                    $sqli = "SELECT * FROM rooms";
                    $res = $dao->getData($sqli);
                    $j = 1;
                    foreach ($res as $key => $value2)
                    {
                      if ($j < 7){
                ?>
                <div class="col-md-4 content3-item">
                    <a href="<?php echo "../View/detailroom.php?id=$value2[id]";?>" class="content3-item_link">
                        <img src="<?php echo "../$value2[image]"; ?>" alt="" class="content3-img">
                        <div class="content3-details">
                            <div class="content3-title"><?php echo "$value2[nameroom]"; ?></div>
                            <div class="content3-last-time">1 đêm</div>
                            <div class="content3-price"> <?php echo $value2['final_price']." vnđ"; ?></div>
                            <div class="content3-last-time">Tình trạng:
                                <?php 
                                    if($value2["status"]==0)
                                    {
                                        echo "Hết phòng";
                                    }
                                    else{
                                        echo "Còn $value2[status] phòng";
                                    }
                                ?>
                            </div>
                            <div class="content3-destination">
                              <?php echo "Tối đa: <i class='fas fa-user-alt'></i> X $value2[maximum] - ";
                                $conn = mysqli_connect("localhost","root","","mytour");
                                $sql3 = "SELECT * FROM typeroom WHERE id = $value2[type]";
                                $result3 = mysqli_query($conn,$sql3);
                                $type = mysqli_fetch_assoc($result3);
                                echo "<i class='fas fa-tag'></i> Phòng: $type[name]"; ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php 
                   $j = $j + 1;}
              } ?>
            </div>
          </div>
          <div class="container" style="background-color: white;padding:40px;">
            <h2 style="background-color: #CCFFFF;padding: 20px;"><b>Giới thiệu Đà Nẵng</b></h2>
            Đà Nẵng, một trong 20 thành phố sạch nhất thế giới, là điểm sáng không thể bỏ qua nếu bạn muốn khám phá vùng Nam Trung Bộ nước ta. Đà Nẵng, ở đó có sắc hoa tươi bốn mùa nở rộ, có sương mây lảng vảng bồng bềnh, có những cơn gió lạnh êm đềm tản mát từng làn hơi thở dịu êm. Tại nơi đó còn có những món ngon khó tả, ăn là ghiền, ngửi là nghiện, những món ăn đặc sản chắc chắn bạn không thể bỏ qua.<br><br>

            Các điểm tham quan du lịch nổi tiếng ở Đà Nẵng có khu du lịch Bà Nà, có bãi biển Mỹ Khê, còn có những thắng cảnh mê hồn như đèo Hải Vân, rừng nguyên sinh bán đảo Sơn Trà và Ngũ Hành Sơn. Đặc biệt, Đà Nẵng được bao quanh bởi 3 di sản văn hóa thế giới là Huế, Hội An và Mỹ Sơn. Và cũng đừng bỏ qua Lễ hội Pháo hoa hàng năm của thành phố đặc biệt này bạn nhé. Hãy đến nơi đây, trải nghiệm thành phố này bên trong những khu nghỉ dưỡng, khách sạn trên cả tuyệt vời.
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
        </div>
    <?php
    include_once "../Utils/menu.php";
    include_once "../Utils/footer.php";
    ?>

</body>
</html>
