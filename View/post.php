<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include_once "../Model/DAO.php";
    $dao = new DAO();  
    session_start();      
    if(!isset($_SESSION["user"])) 
    { 
        header("location:../View/index.php");

    } else
    { 
    	$user = $_SESSION["user"];
    	$role = $_SESSION["role"];
	} 
	$conn = mysqli_connect("localhost","root","","mytour");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
    <link href="../vendor/datatables/DataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
     <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/contact.css">
    <script src="/JS/slide.js"></script>
	<title>MyTour.vn - Đăng bài chia sẻ</title>
</head>
<style>
      .intro-blog {
           overflow-y: hidden;
           display: -webkit-box;
         -webkit-box-orient: vertical;
         -webkit-line-clamp: 3;
         font-size: 13px;
       } 
       .intro-title {
           overflow-y: hidden;
           display: -webkit-box;
         -webkit-box-orient: vertical;
         -webkit-line-clamp: 2;
       }   
    </style>
<body>
	<?php 
		include_once "../Utils/menu.php";
	?>
		<div class="container-fuild"><!--Chạy Slide ảnh-->
            <div style="width: 100%;">
                <div class="container-fuild" style="width: 100%;left: 0;right: 0">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">       
                    <div class="carousel-inner" role="listbox">
                      <div class="item active">
                        <img src="../image/anh-bien-beach-9.jpg" style="width: 100%; height: 650px;">
                        <div class='carousel-caption' style="margin-bottom: -10px;">
                          <h1 style='font-size:60px;color: white;'><b>CẨM NANG DU LỊCH</b></h1></div>
                      </div>
                    </div> 
                  </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-bottom: 100px;margin-top: 70px;">
        	<div class="row">
        		<div class="col-md-8 col-xs-8">
        			<h2><b><i class='fas fa-edit'></i> Chia sẻ kinh nghiệm</b></h2><br>
        			<?php
		                 if ($user!="") 
		                 {
			                 $sql = "SELECT * FROM account WHERE username ='".$user."'";
			                 $result = mysqli_query($conn,$sql);
			                 $acc = mysqli_fetch_assoc($result);
			                 if ($acc['image']=='') {
                                $ava = "image/avat.jpg";
                             } else {
                                $ava = $acc['image'];
                             }
                             echo "<p>Bạn đang hoạt động với tư cách:</p>";
                             echo '<img style="width: 50px;height: 50px;border-radius: 50%;margin-right:7px;border:2px solid white;" src="../'.$ava.'">
                                        <b>'.$acc["name"].'</b><hr>';
		                 }
		                 
		            ?>
		            <form action="../Model/post.php" method="post" enctype="multipart/form-data">
		            	<div class="form-group">
	                        <label for="name"><b>Tiêu đề:</b> </label>
	                        <input type="text" name="title" id="" class="form-control" required>
	                    </div>
	                    <div class="form-group">
	                        <label for="image"><b>Hình ảnh:</b> </label>
	                        <input type="file" name="image" id="" onchange="readURL(this)" class="form-control"><br>
	                        <img class="image-hotel" src="../image/images.jpg" style="height: 350px;padding: 20px;">
	                    </div>
	                    <div class="form-group">
	                        <label for="decs"><b>Nội dung:</b></label>
	                        <textarea name="content"></textarea>
	                        <script>
	                            CKEDITOR.replace('content');
	                        </script>
	                    </div>
	                    <button type="submit" class="btn btn-success" style="float: right;">CHIA SẺ</button>
		            </form>
        		</div>
        		<div class="col-md-4 col-xs-4">
        			<h4><b>Bài viết của tôi</b></h4>
        			<div style="padding-top: 30px; background: rgba(43, 124, 169, 0.3);border-radius: 5px;padding: 10px;">
                        <?php 
                            $sql ="SELECT * FROM post WHERE user = $_SESSION[iduser] ORDER BY datepost DESC";
                            $res = $dao->getData($sql);
                            foreach ($res as $key => $post) 
                            {
                                $formatDate = date("H:i:s d/m/Y", strtotime($post["datepost"]));
                                    echo "
                                        <div class='row' style='padding-top:30px;'>
                                            <div class='col-md-4'>
                                                <a href='../View/viewpost.php?post=$post[id]' style='text-decoration:none;color:black'><img src='../$post[image]' style='width:120%;'></a>
                                            </div>
                                            <div class='col-md-8'>
                                                <a href='../View/viewpost.php?post=$post[id]' style='text-decoration:none;color:black'><h6 class='intro-title'><b>$post[title]</b></h6></a>
                                                <p style='color:gray;font-size:11px;'><span class='far fa-clock'></span>$formatDate</p>
                                            </div>
                                        </div>
                                    ";
                            }
                        ?>
                    </div>
        		</div>
        	</div>
        </div>
        <?php include_once "../Utils/footer.php"; ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-hotel').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>