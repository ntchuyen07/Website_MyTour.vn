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
	<link rel="stylesheet" href="../Css/category.css">
	<title>MyTour.vn</title>
</head>
<style>
    .product-image-detail{
        max-width: 350px;
        height: 200px;
        float: left;
        padding-right: 50px;
    }
    .test-sm{
        font-weight: 400;
        color: #79d6f9;
    }
    .product{
        padding-top: 50px;
        /*padding-left: 200px;*/
        margin-right: 70px;
    }
    .data-hotel{
        padding: 10px;
        border: 1px solid #eee;
    }
    /*i{
        color: green;
        padding-right: 10px;
    }*/
    .nav-list-gray{
        padding-top: 20px;
    }
    .li-detail{
        line-height: 35px;
    }
</style>
<body>
	<?php include "../Utils/menu.php"; ?>
	<div class="container-fuild" style="background-color: #f5f5f5;padding-top: 120px;">
		<div class="row" style="margin-top: 60px;">
			<div class="col-md-4"  style="margin-bottom: 100px;padding-left: 130px;  padding-top: 50px;">
				<img src="https://dulichannam.com/wp-content/uploads/2020/06/COMBO-GOLDEN-BAY-DA-NANG.png" alt="" style="width: 100%;">
				<img src="https://media.laodong.vn/Storage/NewsPortal/2020/11/29/858140/Z2193624188157_1190E.jpg" alt="" style="width: 100%; padding-top: 50px;">
			</div>
			<div class="col-md-8" style="margin-bottom: 100px;padding-right: 50px;">
			<?php 
				$id = $_GET["id"];
				$conn = mysqli_connect("localhost","root","","mytour");
				if ($id==0) {
					$sql = "SELECT * FROM hotel";
				}
				else
				{
					$sqli = "SELECT * FROM category WHERE parent_id = $id";
					$resulti = mysqli_query($conn,$sqli);
					while ($hoteli = mysqli_fetch_assoc($resulti)) 
					{
						$sqls = "SELECT * FROM hotel WHERE cate = $hoteli[id]";
						$results = mysqli_query($conn,$sqls);
						while ($hotels = mysqli_fetch_assoc($results)) 
						{
							?>
							<div class="product">
                                        <div class="data-hotel" style="border: 4px solid #CCCCFF;padding: 20px;border-radius: 10px;">
                                            <div class="product-item row">
                                                <div class="product-infor col-sm-12">
                                                        <div class="product-image">
                                                            <a href="../View/detailhotel.php?id=<?php echo "$hotels[id]";?>"
                                                            	style="text-decoration: none;" ><img class="product-image-detail" src="<?php echo "../$hotels[image]"; ?>" alt=""></a>
                                                        </div>
                                                        <div class="product-name" style="padding-left:150px;">
                                                            <a href="../View/detailhotel.php?id=<?php echo "$hotels[id]";?>"
                                                            	style="text-decoration: none;">
                                                            	<h5 style="font-weight: 700;"><?php echo "$hotels[name]";?></h5></a>
                                                            <ul style="list-style: none;" class=" nav-list-gray pull-left">
                                                            <li class="li-detail" style="">
                                                            <a mytour-ext="ajax-modal" modal-name="modal-sure-back-money">
                                                                <p style='color:blue;'><b><i class='fas fa-map-marker-alt'></i><?php echo "<span style='font-size:12px;'>$hotels[address]</span>";?></b></p>
                                                            </a>
                                                            </li>
                                                            <li class="li-detail"><a mytour-ext="ajax-modal" modal-name="modal-sure-good-price"><i class="fas fa-tags" style="color: green;padding-right: 10px;"></i>
                                                            <?php 
                                                            	$sql1 = "SELECT * FROM category WHERE id=$hotels[cate]";
												                $result1 = mysqli_query($conn,$sql1);
												                $value1 = mysqli_fetch_assoc($result1);
												                $sql2 = "SELECT * FROM category WHERE id=$value1[parent_id]";
												                $result2 = mysqli_query($conn,$sql2);
												                $value2 = mysqli_fetch_assoc($result2);
												                if ($value1["parent_id"]!=0) 
						               							{
						    										echo "$value2[namecate], ";
						          								}
						   										 	echo "$value1[namecate]";
                                                            ?>
                                                            </a></li>
                                                            <li class="li-detail"><a mytour-ext="ajax-modal" modal-name="modal-sure-good-price"><i class="fa fa-check-circle green text-sm" style="color: green;padding-right: 10px;"></i>  Đảm bảo giá tốt nhất!</a></li>
                                                            
                                                        </ul>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-12">
                                                        <a style ="float: right;padding: 10px 30px 10px 30px;top:50%;background-color: #79d6f9;color:white" href="../View/list_rooms.php?id=<?php echo "$hotels[id]";?>" style='color:white;'>Xem phòng</a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
							<?php
						}
					}
					$sql = "SELECT * FROM hotel WHERE cate= $id";
				}
				$result = mysqli_query($conn, $sql);
				while ($hotel = mysqli_fetch_assoc($result)) 
				{
					?>
						<div class="product">
                                        <div class="data-hotel" style="border: 4px solid #CCCCFF;padding: 20px;border-radius: 10px;">
                                            <div class="product-item row">
                                                <div class="product-infor col-sm-12">
                                                        <div class="product-image">
                                                            <a href="../View/detailhotel.php?id=<?php echo "$hotel[id]";?>"
                                                            	style="text-decoration: none;"><img class="product-image-detail" src="<?php echo "../$hotel[image]"; ?>" alt=""></a>
                                                        </div>
                                                        <div class="product-name" style="padding-left:150px;">
                                                            <a href="../View/detailhotel.php?id=<?php echo "$hotel[id]";?>" style="text-decoration: none;">
                                                            	<h5 style="font-weight: 700;"><?php echo "$hotel[name]";?></h5></a>
                                                            <ul style="list-style: none;" class=" nav-list-gray pull-left">
                                                            <li class="li-detail" style="">
                                                            <a mytour-ext="ajax-modal" modal-name="modal-sure-back-money">
                                                                <p style='color:blue;'><b><i class='fas fa-map-marker-alt'></i><?php echo "$hotel[address]";?></b></p>
                                                            </a>
                                                            </li>
                                                            <li class="li-detail"><a mytour-ext="ajax-modal" modal-name="modal-sure-good-price"><i class="fas fa-tags" style="color: green;padding-right: 10px;"></i>
                                                            <?php 
                                                            	$sql1 = "SELECT * FROM category WHERE id=$hotel[cate]";
												                $result1 = mysqli_query($conn,$sql1);
												                $value1 = mysqli_fetch_assoc($result1);
												                $sql2 = "SELECT * FROM category WHERE id=$value1[parent_id]";
												                $result2 = mysqli_query($conn,$sql2);
												                $value2 = mysqli_fetch_assoc($result2);
												                if ($value1["parent_id"]!=0) 
						               							{
						    										echo "$value2[namecate], ";
						          								}
						   										 	echo "$value1[namecate]";
                                                            ?>
                                                            </a></li>
                                                            <li class="li-detail"><a mytour-ext="ajax-modal" modal-name="modal-sure-good-price"><i class="fa fa-check-circle green text-sm" style="color: green;padding-right: 10px;"></i>  Đảm bảo giá tốt nhất!</a></li>
                                                            
                                                        </ul>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-12">
                                                        <a style ="float: right;padding: 10px 30px 10px 30px;top:50%;background-color: #79d6f9;color: white" href="../View/list_rooms.php?id=<?php echo "$hotel[id]";?>" style='color:white;'>Xem phòng</a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
					<?php
				}
			?>
		</div>
		</div>
	</div>
	<?php include_once "../Utils/footer.php"; ?>
</body>
</html>