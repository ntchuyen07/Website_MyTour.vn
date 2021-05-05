<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include_once "../Model/DAO.php";
    session_start(); 
    $dao = new DAO();       
    if(!isset($_SESSION["user"])) 
    { 
        header("location:../View/index.php");

    } else $user = $_SESSION["user"]; 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
    <link href="../vendor/datatables/DataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
     <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/contact.css">
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
                          <h1 style='font-size:60px;color: white;' class="contact-title"><b>LIÊN HỆ VỚI CHÚNG TÔI</b></h1></div>
                      </div>
                    </div> 
                  </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-bottom: 100px;margin-top: 70px;">
          <div class="row">
          <div class="col-md-6 col-xs-6">
            <?php
                 $conn = mysqli_connect("localhost","root","","mytour");
                 $sql = "SELECT * FROM account WHERE username ='".$user."'";
                 $result = mysqli_query($conn,$sql);
                 $acc = mysqli_fetch_assoc($result);
                 if (!isset($_SESSION["contact"])) {
                   $tb = "";
                 } else {
                    $tb = $_SESSION["contact"];
                    unset($_SESSION["contact"]);
                 }
                 
            ?>
            <h3><b>Xin chào <?php echo "$acc[name]"; ?>,</b></h3>
            <h2><b>Chúng tôi giúp được gì cho bạn?</b></h2>
            <p>Đội ngũ chúng tôi luôn quan tâm đến cảm nhận cũng như những thắc mắc của người dùng.</p>
            <p>Nếu có bất cứ thắc mắc nào, đừng ngại ngùng, hãy chia sẻ với chúng tôi. Chúng tôi sẵn sàng chia sẻ và giúp đỡ bạn trong thời gian sớm nhất.</p>
            <h4><b>Phương thức liên hệ:</b></h4>
            <p><i class="fas fa-map-marker-alt" style="color:  #8E7037;"></i>  470 Trần Đại Nghĩa, Hòa Hải, Ngũ Hành Sơn, TP Đà Nẵng</p>
            <p><i class="fas fa-phone-alt" style="color:  #8E7037;"></i> 0911234567</p>
            <p><i class="fas fa-envelope" style="color:  #8E7037;"></i>   ntchuyen@vku.udn.vn</p>
            <p>Hoặc gửi tin nhắn nhờ hỗ trợ tư vấn đến quản trị viên  <i class="fas fa-arrow-circle-right" style="color:  #8E7037;"></i></p>
          </div>
          <div class="col-md-6 col-xs-6">
            <form action="../Model/contact.php" method="post">
              <div class="row">
                <div class="form-group col-md-6 col-xs-6" style="width: 100%;">
                    <label for="username"><b>Họ tên:</b></label>
                    <input type="text" name="name" id="" class="form-control" value="<?php echo "$acc[name]"; ?>">
                </div>
                <div class="form-group col-md-6 col-xs-6">
                    <label for="username"><b>Email:</b></label>
                    <input type="email" name="email" id="" class="form-control" value="<?php echo "$acc[email]"; ?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12 col-xs-12">
                    <label for="content"><b>Nội dung:</b></label>
                    <textarea name="content"></textarea>
                    <script>
                         CKEDITOR.replace('content');
                    </script>
                </div>
              </div>
              <label for="username" class="text-danger"><?php echo $tb; ?></label>
              <button type="submit" class="btn btn-contact" style="padding-right: 3rem; padding-left: 3rem;"><b>GỬI</b></button>
            </form>
          </div>
        </div>
        </div>
    <?php
    include_once "../Utils/menu.php";
    include_once "../Utils/footer.php";
    ?>

</body>
</html>
