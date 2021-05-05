<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include_once "../Model/DAO.php";
    $dao = new DAO();  
    session_start();      
    if(!isset($_SESSION["user"])) 
    { 

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

       .btn-heart.fas {
        color: red !important;
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
        		<div class="col-md-8 col-xs-12" style="font-family:Nunito">
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
                            $id = $_GET["post"];
                            $conn = mysqli_connect("localhost","root","","mytour");
                            $sqls = "SELECT *FROM post WHERE id = $id";
                            $results = mysqli_query($conn,$sqls);
                            foreach ($results as $key => $post)
                            {
                                $sql = "SELECT * FROM account WHERE id = $post[user]";
                                $result = mysqli_query($conn,$sql);
                                foreach ($result as $key => $account)
                                {
                                }
                            }
                            $formatDate = date("H:i:s d/m/Y", strtotime($post["datepost"]));
                            $view = $post['view']+1;
                            $sql = "UPDATE post SET view='$view' WHERE id=$id";
                            $result = mysqli_query($conn,$sql);

                        ?>
                        <h2><b><?php echo "$post[title]"; ?></b></h2>
                        <p style="color: gray"><span class="far fa-clock"></span> Đăng tải <?php echo "$formatDate"; ?> |<span class="fas fa-user" style="padding:0  10px 0 10px ;"></span><?php echo " Bởi: $account[name]"; ?><span style='float:right;'><i class='far fa-eye'></i><?php echo "  $post[view]";?> lượt xem</span></p>
                        <div style="text-align: center;"><img src="../<?php echo "$post[image]";?>" style="width: 80%;padding-bottom: 30px;"></div><hr>
                        <span><?php echo "$post[content]";?></span><hr>
                    </div>
                    <div>
                        <?php
                            if($user!="")
                            {
                        ?>
                        <div class="row">
                            <div class="col-md-2">
                                <img style="width: 100%;border-radius: 50%;margin-right:7px;border:2px solid white;" src="../<?php echo $ava;?>">    
                            </div>
                            <div class="col-md-10">
                                <textarea name="content" id="content" placeholder="Thêm bình luận của bạn..." style="width: 100%;padding:2px 8px;" rows="4" ></textarea>
                                <input type="submit" name="send" id="send" value="Gửi bình luận" style="background-color: #8E7037; float: right;border:none" class="btn btn-primary">
                            </div>
                        </div> 
                        <?php 
                            }
                            else
                            {
                                echo "<div style='font-size:20px;'><b>Bạn cần đăng nhập để bình luận!</b></div>";
                            }
                        ?>
                    </div>
                    <div>
                        <?php
                            $date = date('H:i:s d-m-Y');
                            $sql = "SELECT * FROM comment WHERE idpost =$id ORDER BY datecmt DESC";
                            $result1 = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result1);
                            echo "<div class='col-md-12' style='font-size:19px;padding:10px 0;'><b>Bình luận ($num)</b>
                                  </div>";
                            ?>
                            <div id='dsbinhluan'>
                            <?php
                            while ($dong = mysqli_fetch_assoc($result1)) 
                            {
                                if ($dong['parent_id'] == 0) 
                                {
                                    $sql4 = "SELECT * FROM account WHERE id=$dong[user]";
                                    $result4 = mysqli_query($conn,$sql4);
                                    $acc1 =mysqli_fetch_assoc($result4);
                                    if ($acc1['image']=='') 
                                    {
                                        $ava1 = "image/avat.jpg";
                                    } 
                                    else 
                                    {
                                        $ava1 = $acc1['image'];
                                    }

                                    if ($dong["isShow"]==0)
                                    {
                                    ?>
                                    <div class='row'>
                                        <div class='col-md-2'>
                                            <img style='width: 90%;border-radius: 50%;border:2px solid white;' src='../<?php echo "$ava1";?>'>
                                        </div>
                                        <div class='col-md-10'>
                                            <h5><b style='color:#0c92bb;'><?php echo $acc1['name'];?></b>
                                            <span style='color:gray;font-size:14px;float:right;'><i><?php
                                            $formatDates =date("H:i:s d/m/Y", strtotime($dong["datecmt"]));
                                             echo $formatDates;?></i></span></h5>
                                            <p><?php echo $dong['content'];?></p>
                                            <p>
                                            <?php
                                                if($user!=""){
                                                $sqls = "SELECT * FROM likecomment WHERE user='$acc[id]' and idcmt=$dong[id]";
                                                $results = mysqli_query($conn,$sqls);
                                                $sl = mysqli_num_rows($results);
                                                if($sl==0)
                                                {
                                            ?>
                                                <span style='color:black;padding-right: 10px;'> 
                                                    <i class='btn-heart far fa-heart <?php echo"$dong[id]";?>' style='color:black;text-decoration:none; margin-right: 4px; cursor: pointer;' data-id='<?php echo"$dong[id]";?>'>
                                                    </i>
                                                    <span><?php echo $dong["likecmt"];?></span>
                                                </span>
                                            <?php
                                                }
                                                else 
                                                {
                                                    $like = mysqli_fetch_assoc($results);
                                                    if ($like["toggle"]==0) 
                                                    {
                                                ?>
                                                        <span style='color:black;padding-right: 10px;'> 
                                                            <i class='btn-heart far fa-heart <?php echo"$dong[id]";?>' style='color:black;text-decoration:none; margin-right: 4px; cursor: pointer;'  data-id='<?php echo"$dong[id]";?>'>
                                                            </i>
                                                            <span><?php echo $dong["likecmt"];?></span>
                                                        </span>
                                                <?php
                                                    } 
                                                    else 
                                                    {
                                                ?>    
                                                        <span style='color:black;padding-right: 10px;'> 
                                                            <i class='btn-heart fas far fa-heart <?php echo"$dong[id]";?> ' style='text-decoration:none; margin-right: 4px; cursor: pointer;' data-id='<?php echo"$dong[id]";?>'>
                                                            </i>
                                                            <span><?php echo  $dong["likecmt"];?></span>
                                                        </span>
                                                <?php
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                echo "<span style='color:black;padding-right: 10px;'> <i class='btn-heart far fa-heart' style='color:black;text-decoration:none; margin-right: 4px;'></i>$dong[likecmt]";
                                            }
                                    ?>
                                        <span style=' cursor: pointer;color:#2447ff;' data-parentId='<?php echo "$dong[id]";?>' class='traloi-btn'><i class='fas fa-reply'></i><b> Trả lời</b></span>
                                            </p><hr>
                                            <?php 
                                            if($user!="")
                                            {
                                            ?>
                                            <div class='row rep-cmt <?php echo "$dong[id]";?>' style='padding-bottom:20px;'>
                                                <div class='col-md-2'>
                                                    <img style='width: 90%;border-radius: 50%;border:2px solid white;' src='../<?php echo $ava;?>'>
                                                </div>
                                                <div class='col-md-10'>
                                                    <textarea type='text' placeholder='Thêm bình luận của bạn...' class='repcontent <?php echo "$dong[id]";?>' name='repcontent' style='width: 100%;' rows='2'></textarea>
                                                    <input type='submit' value='Gửi bình luận' class='repcmt btn btn-primary' name='repcmt'  data-parentId='<?php echo "$dong[id]";?>' style='background-color: #8E7037;color:white;float:right;border:none'>
                                                </div>
                                            </div>
                                            <?php 
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php 
                                    }
                                }
                                ?>
                                <div class='rep-wrap <?php echo "$dong[id]";?>'>
                                <?php
                                $result2 = mysqli_query($conn,$sql);
                                    // $dong co id
                                while ($dong1 = mysqli_fetch_assoc($result2)) 
                                { 
                                    if($dong1['parent_id'] == $dong['id']) 
                                    {
                                        $sql5 = "SELECT * FROM account WHERE id=$dong1[user]";
                                        $result5 = mysqli_query($conn,$sql5);
                                        $acc2 =mysqli_fetch_assoc($result5);
                                        if ($acc2['image']=='') 
                                        {
                                            $ava2 = "image/avat.jpg";
                                        } 
                                        else 
                                        {
                                            $ava2 = $acc2['image'];
                                        }
                                        if($dong1["isShow"]==0)
                                        {
                                        ?>
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class='col-md-2'>
                                                        <img style='width:90%;border-radius: 50%;border:2px solid white;' src='../<?php echo $ava2;?>'>
                                                    </div>
                                                    <div class='col-md-10'>
                                                        <h5 class='textcmt'><b style='color:#0c92bb;'><?php echo $acc2["name"];?></b><span style='color:gray;font-size:14px;float:right;'><i><?php
                                                            $formatDate1 =date("H:i:s d/m/Y", strtotime($dong1["datecmt"]));
                                                         echo $formatDate1;?>
                                                        </i></span></h5>
                                                        <p  class='textcmt'><?php echo $dong1['content'];?>
                                                        </p><br>
                                                        <?php
                                                if($user!=""){
                                                $sql1 = "SELECT * FROM likecomment WHERE user='$acc[id]' and idcmt=$dong1[id]";
                                                $results1 = mysqli_query($conn,$sql1);
                                                $sl1 = mysqli_num_rows($results1);
                                                if($sl1==0)
                                                {
                                            ?>
                                                <span style='color:black;padding-right: 10px;'> 
                                                    <i class='btn-heart far fa-heart <?php echo"$dong1[id]";?>' style='color:black;text-decoration:none; margin-right: 4px; cursor: pointer;' data-id='<?php echo"$dong1[id]";?>'>
                                                    </i>
                                                    <span><?php echo $dong1["likecmt"];?></span>
                                                </span>
                                            <?php
                                                }
                                                else 
                                                {
                                                    $like1 = mysqli_fetch_assoc($results1);
                                                    if ($like1["toggle"]==0) 
                                                    {
                                                ?>
                                                        <span style='color:black;padding-right: 10px;'> 
                                                            <i class='btn-heart far fa-heart <?php echo"$dong1[id]";?>' style='color:black;text-decoration:none; margin-right: 4px; cursor: pointer;'  data-id='<?php echo"$dong1[id]";?>'>
                                                            </i>
                                                            <span><?php echo $dong1["likecmt"];?></span>
                                                        </span>
                                                <?php
                                                    } 
                                                    else 
                                                    {
                                                ?>    
                                                        <span style='color:black;padding-right: 10px;'> 
                                                            <i class='btn-heart fas far fa-heart <?php echo"$dong1[id]";?> ' style='text-decoration:none; margin-right: 4px; cursor: pointer;' data-id='<?php echo"$dong1[id]";?>'>
                                                            </i>
                                                            <span><?php echo  $dong1["likecmt"];?></span>
                                                        </span>
                                                <?php
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                echo "<span style='color:black;padding-right: 10px;'> <i class='btn-heart far fa-heart' style='color:black;text-decoration:none; margin-right: 4px;'></i>$dong1[likecmt]";
                                            }
                                    ?>
                                        <span style=' cursor: pointer;color:#2447ff;' data-parentId='<?php echo "$dong[id]";?>' class='traloi-btn'><i class='fas fa-reply'></i><b> Trả lời</b></span>
                                                </p>
                                                    </div>
                                                </div><hr>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    }
                                }  
                                ?>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                            </div>
                        </div>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $(document).ready(function(){
                                    $(".rep-cmt").hide();
                                    $(".traloi-btn").on("click", function() {
                                        var parent_id = $(this).attr('data-parentId');
                                        $(`.rep-cmt.${parent_id}`).toggle();
                                    })

                                    $("#send").click(function(){
                                        var url_string = window.location.href;
                                        var url = new URL(url_string);
                                        var idpost = url.searchParams.get("post");
                                        var parent_id = 0;
                                        var txt = $("#content").val();
                                        $.post("xulybinhluan.php",{noidung:txt, idpost:idpost, parent_id: parent_id}, function(result){
                                            $("#dsbinhluan").prepend(`
                                                <div class='row'>
                                                    <div class='col-md-2'>
                                                        <img style='width: 90%;border-radius: 50%;border:2px solid white;' src='<?php echo "../$ava";?>'>
                                                    </div>
                                                    <div class='col-md-10'>
                                                        <h5><b style='color:#0c92bb;'><?php echo $acc['name'];?></b>
                                                        <span style='color:gray;font-size:14px;float:right;'><i><?php echo $date;?></i></span></h5>
                                                        <p>`+txt+`</p>
                                                        <p>
                                                        <a class='btn far fa-heart' style='color:black;text-decoration:none'>   0</a>
                                                        <span style=' cursor: pointer;color:#2447ff;' data-parentId='<?php echo "$dong[id]";?>' class='traloi-btn'><i class='fas fa-reply'></i><b> Trả lời</b></span></p><hr>
                                                    </div>
                                                </div>`);
                                            $("#content").val("");
                                        });
                                    });

                                    $(".repcmt").click(function(){
                                        var url_string = window.location.href;
                                        var url = new URL(url_string);
                                        var idpost = url.searchParams.get("post");
                                        var parent_id = $(this).attr('data-parentId');

                                        var txt = $(`.repcontent.${parent_id}`).val();
                                        $.post("xulybinhluan.php",{noidung:txt, idpost:idpost, parent_id: parent_id}, function(result){
                                            $(`.rep-wrap.${parent_id}`).prepend(`
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class='col-md-2'>
                                                                <img style='width:90%;border-radius: 50%;border:2px solid white;' src='../<?php echo $ava;?>'>
                                                            </div>
                                                            <div class='col-md-10'>
                                                                <h5 class='textcmt'><b style='color:#0c92bb;'><?php echo $acc["name"];?></b><span style='color:gray;font-size:14px;float:right;'><i><?php echo $date;?>
                                                                </i></span></h5>
                                                                <p  class='textcmt'>`+txt+`
                                                                </p><br>
                                                            </div>
                                                        </div><hr>
                                                    </div>
                                                </div>`);
                                            $(`.repcontent.${parent_id}`).val('');
                                        });

                                    });

                                    $('.btn-heart').on('click', function() {
                                        var commentID = $(this).attr('data-id');
                                        $.get("../Model/likecmt.php",{id: commentID}, function(result){
                                            var heartElement = $(`.btn-heart.${commentID}`);
                                            heartElement.toggleClass('fas');
                                            var likes = parseInt($(`.btn-heart.${commentID} ~ span`).html());
                                            if(heartElement.hasClass('fas')) {
                                                $(`.btn-heart.${commentID} ~ span`).html(likes + 1);
                                            } else {
                                                $(`.btn-heart.${commentID} ~ span`).html(likes - 1);
                                            }
                                        });
                                    })
                                });
                        </script>
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
                                                <p style='color:gray;font-size:13px;'><span class='fas fa-user'></span> $account[name]
                                                </p>
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
        <?php include_once "../Utils/footer.php"; ?>
</body>
</html>