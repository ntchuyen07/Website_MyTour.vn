<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include_once "../Model/DAO.php";
    $dao = new DAO();  
    session_start();      
    if(!isset($_SESSION["user"])) 
    { 
        $user = "";
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
	<title>MyTour.vn - Cẩm nang du lịch</title>
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
	
		<div class="container-fuild"><!--Chạy Slide ảnh-->
            <div style="width: 100%;">
                <div class="container-fuild" style="width: 100%;left: 0;right: 0">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">       
                    <div class="carousel-inner" role="listbox">
                      <div class="item active">
                        <img src="../image/anh-bien-beach-9.jpg" style="width: 100%; height: 650px;" class="contact-img">
                        <div class='carousel-caption contact-caption-edit' style="margin-bottom: -10px;">
                          <h1 style='font-size:60px;color: white;' class="contact-title"><b>CẨM NANG DU LỊCH</b></h1></div>
                      </div>
                    </div> 
                  </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-bottom: 100px;margin-top: 30px;">
        	<div class="row">
        		<div class="col-md-8 col-xs-12">
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
                                        <b>'.$acc["name"].'</b>
                                    <span><a href="../View/post.php" class="btn btn-success" style="float:right;">Đăng bài viết</a></span>
                                    <hr>';
		                 }
		                 
		            ?>
    		        <div>
                        <?php
                            $conn = mysqli_connect("localhost","root","","mytour");
                            $sql = "SELECT count(id) as total from post WHERE checkpost=1 and isShow=0 ORDER BY id DESC";
                            $ketqua = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($ketqua);
                            $total_record = $row['total'];
                            $current_page = isset($_GET['page'])?  $_GET['page'] : 1;
                            $limit =5;
                            $total_page = ceil($total_record/$limit);
                            if($current_page > $total_page)
                            {
                                $current_page = $total_page;
                            }
                            elseif($current_page < 1)
                            {
                                $current_page = 1;
                            }

                            $start = ($current_page -1) * $limit;

                            $sql1 = "SELECT * FROM post WHERE checkpost=1 and isShow=0 LIMIT $start,$limit";
                            $result = mysqli_query($conn, $sql1);
                        ?>
                        <?php 
                                $checkrow = 0;
                                  foreach ($arr = $dao->getData("SELECT * FROM post WHERE checkpost=1 and isShow=0 ORDER BY id DESC") as $key => $value)
                                    if($checkrow < 2 || $checkrow >= 1){
                                        $checkrow++; ?>
                                <?php while ($value = mysqli_fetch_assoc($result)) {
                                    $sql = "SELECT * FROM account WHERE id = $value[user]";
                                    $results = mysqli_query($conn,$sql);
                                    foreach ($results as $key => $account)
                                    {
                                    }
                                     $formatDate = date("H:i:s d/m/Y", strtotime($value["datepost"]));
                                    ?>
                                    <div class="row" style="padding-top: 30px;padding-bottom: 20px;">
                                        <div class="col-md-5">
                                            <?php 
                                                echo "<a href='../View/viewpost.php?post=$value[id]' style='text-decoration:none;'><img src='../$value[image]' style='width:100%;'></a>";
                                            ?>
                                        </div>
                                        <div class="col-md-7">
                                            <?php 
                                                echo "<h5><a href='../View/viewpost.php?post=$value[id]' style='text-decoration:none;'><b>$value[title]</b></a></h5>";
                                                echo '<p style="color: gray"><span class="far fa-clock"></span>'.$formatDate.' |<span class="fas fa-user" style="padding:0  10px 0 10px ;"></span>'.$account["name"].'</p><hr>';
                                                echo "<span class='intro-blog'>$value[content]</span>";

                                            ?>
                                        </div>
                                    </div>
                                <?php }
                                } ?>
                    </div>    
                    <div class="pagination" style="float: center;margin-left: 40%;">
                        <?php
                            if ($current_page >1 && $total_page >1) 
                            {
                                echo "<a class='btn btn-outline-primary' style='margin-right:5px;' href='blog.php?page=".($current_page-1)."'>Prev</a>";
                            }

                            for ($i=1; $i < $total_page; $i++) 
                            { 
                                if ($i == $current_page) 
                                {
                                    echo "<a style='text-decoration:none;margin-right:5px;color:white' class='btn btn-primary'> $i </a>";
                                }
                                else{
                                    echo "<a style='text-decoration:none;margin-right:5px;' class='btn btn-outline-primary' href='blog.php?page=".$i."'> $i </a>";
                                }
                            }

                            if ($current_page < $total_page && $total_page >1) 
                            {
                                echo "<a style='text-decoration:none;margin-right:5px;' class='btn btn-outline-primary' href='blog.php?page=".($current_page+1)."'>Next</a>";
                            }
                        ?>
                    </div>
        		</div>
        		<div class="col-md-4 col-xs-4">
        			<div style="padding-top: 30px; background: rgba(43, 124, 169, 0.3);border-radius: 5px;padding: 10px;">
                        <?php 
                            echo "<h4><b>PHỔ BIẾN</b></h4>";
                            $i = 1;
                            $sql ="SELECT * FROM post ORDER BY view DESC";
                            $res = $dao->getData($sql);
                            foreach ($res as $key => $post) 
                            {
                                $sql = "SELECT * FROM account WHERE id = $post[user]";
                                $results = mysqli_query($conn,$sql);
                                foreach ($results as $key => $account)
                                {
                                }
                                $formatDate = date("H:i:s d/m/Y", strtotime($post["datepost"]));
                                if ($i<5) 
                                {
                                    echo "
                                        <div class='row' style='padding-top:30px;'>
                                            <div class='col-md-4'>
                                                <a href='../View/viewpost.php?post=$post[id]' style='text-decoration:none;color:black'><img src='../$post[image]' style='width:122%;'></a>
                                            </div>
                                            <div class='col-md-8'>
                                                <a href='../View/viewpost.php?post=$post[id]' style='text-decoration:none;color:black'><h6 class='intro-title'><b>$post[title]</b></h6></a>
                                                <p style='color:gray;font-size:13px;'><span class='fas fa-user'></span> $account[name]</p>
                                            </div>
                                        </div>
                                    ";
                                    $i = $i+1;
                                }
                            }
                        ?>
                    </div>
                    <div style="padding-top: 30px; background: rgba(43, 124, 169, 0.3);border-radius: 5px;padding: 10px;margin-top: 60px; ">
                        <?php 
                            echo "<h4><b>GẦN ĐÂY</b></h4>";
                            $i = 1;
                            $sql ="SELECT * FROM post ORDER BY id DESC";
                            $res = $dao->getData($sql);
                            foreach ($res as $key => $post) 
                            {
                                $sql = "SELECT * FROM account WHERE id = $post[user]";
                                $results = mysqli_query($conn,$sql);
                                foreach ($results as $key => $account)
                                {
                                }
                                $formatDate = date("H:i:s d/m/Y", strtotime($post["datepost"]));
                                if ($i<5) 
                                {
                                    echo "
                                        <div class='row' style='padding-top:30px;'>
                                            <div class='col-md-4'>
                                                <a href='../View/viewpost.php?post=$post[id]' style='text-decoration:none;color:black'><img src='../$post[image]' style='width:122%;'></a>
                                            </div>
                                            <div class='col-md-8'>
                                                <a href='../View/viewpost.php?post=$post[id]' style='text-decoration:none;color:black'><h6 class='intro-title'><b>$post[title]</b></h6></a>
                                                <p style='color:gray;font-size:13px;'><span class='fas fa-user'></span> $account[name]</p>
                                            </div>
                                        </div>
                                    ";
                                    $i = $i+1;
                                }
                            }
                        ?>
                    </div>
        		</div>
        	</div>
        </div>
        <?php 
        include_once "../Utils/menu.php"; ?>
        <?php include_once "../Utils/footer.php"; ?>
<!-- <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-hotel').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script> -->
</body>
</html>