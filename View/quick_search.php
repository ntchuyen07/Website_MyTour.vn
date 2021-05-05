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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <title>Document</title>
</head>
<style>
    .product-image-detail{
        width: 300px;
        height: 200px;
        float: left;
    }
    .test-sm{
        font-weight: 400;
        color: #79d6f9;
    }
    .product{
        padding-top: 50px;
        /*padding-left: 200px;*/
        margin-right: 100px;
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
        line-height: 50px;
    }
    .product-price {
        padding-top: 81px;
    }

    .product-old-price {
        text-decoration: line-through;
        color: gray;
    }

    .product-final-price {
        font-size: 20px;
        color: red;
        font-weight: bold;
    }
</style>
<body>
    
<?php
    include_once "../Utils/menu.php"; 
    ?>
    <div class="container-fuild" style=" padding-top: 160px;padding-bottom: 70px;">
        <div class="row" >
            <div class="col-md-4" style="margin-bottom: 100px;padding-left: 130px;  padding-top: 50px;">
                <img src="https://cafebiz.cafebizcdn.vn/162123310254002176/2020/10/13/photo-1-16025591019651375947372.jpg" alt="" style="width: 100%;">
                <img src="https://image.winudf.com/v2/image1/dm4ubXl0b3VyLmFwcHMuYW5kcm9pZF9zY3JlZW5fNF8xNTk3MTQ5NzAxXzAwMA/screen-4.jpg?fakeurl=1&type=.jpg" alt="" style="width: 100%; padding-top: 50px;">
            </div>
            <div class="col-md-8">
    <?php  
    /*if(isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['find-submit'])){*/
        $today = date("Y-m-d");
        $daycome = $_POST['checkin'];
        $dayleave = $_POST['checkout'];
        $area = $_POST['address'];
        $amount = $_POST["amount"];
        $nameroom= $add= $image="";
        $id;
      //  $find_day = abs(strtotime($dayleave) - strtotime($daycome));

        if(strtotime($daycome) > strtotime($dayleave) || strtotime($daycome) < strtotime($today))
        {
            $alert = "Bạn đã nhập sai dữ liệu";
        }else
        {
            $conn = mysqli_connect("localhost","root","","mytour");
            $hotel = "SELECT *FROM hotel WHERE id_address=$area";
            $result1 = mysqli_query($conn,$hotel);
            if($result1 == true)
            {
                foreach ($result1 as $key => $value1) 
                {
                    $find = "SELECT *FROM rooms WHERE status > 0 AND hotel= $value1[id]";
                    $result = mysqli_query($conn,$find);
                    if($result == true)
                    {
                        foreach ($result as $key => $value) 
                        {
                            $sql = "SELECT sum(amount) as tong from bills WHERE room =$value[id] and checkin_date BETWEEN '$daycome 14:00:00' AND '$dayleave 11:00:00' or checkout_date BETWEEN '$daycome 14:00:00' AND '$dayleave 11:00:00' and status<4";
                            $result = mysqli_query($conn,$sql);
                            if($result == true)
                            {
                                foreach ($result as $key => $sum) 
                                {
                                }
                            $kq = $value["amount"] - $sum["tong"];
                            if ($kq>0 && $kq>=$amount) 
                            {
                                ?>
                                    <div class="product">
                                        <div class="data-hotel" style="border: 4px solid #CCCCFF;padding: 20px;border-radius: 10px;">
                                            <div class="product-item row">
                                                <div class="col-sm-12">
                                                    <?php $sql = "SELECT *FROM hotel WHERE id=$value[hotel]"; 
                                                        $result2 = mysqli_query($conn,$sql);
                                                        foreach ($result2 as $key => $hotelinfor) {   
                                                    ?>
                                                    <h3 style="font-weight: 900;color: #79d6f9;"><?php echo $hotelinfor['name']; ?></h3>
                                                    <p style="font-size: 12px;color: #b4b0af;"><?php echo $hotelinfor['address'];?></p>
                                                    <?php 
                                                        }
                                                    ?>
                                                </div>
                                                <div class="product-infor col-sm-12 d-flex">
                                                        <div class="product-image" style="width: 30%;">
                                                            <a href="../View/detailroom.php?id=<?php echo "$value[id]";?>" class='btn-more'><img class="product-image-detail" src="<?php echo "../$value[image]"; ?>" alt=""></a>
                                                        </div>
                                                        <div class="product-name" style="padding-left:80px; width: 50%;">
                                                            <a href="../View/detailroom.php?id=<?php echo "$value[id]";?>" class='btn-more'><h4 style="font-weight: 700;"><?php echo $value["nameroom"];?></h4></a>
                                                            <ul style="list-style: none;" class=" nav-list-gray pull-left">
                                                                <li class="li-detail" style="">
                                                                <a mytour-ext="ajax-modal" modal-name="modal-sure-back-money">
                                                                    <i class="fa fa-check-circle green text-sm" style="color: green;padding-right: 10px;"></i>  <?php 
                                                                        if ($value["breakfast"]==0) {
                                                                            echo "  Không bao gồm bữa sáng";
                                                                        } else {
                                                                            echo "  Bao gồm bữa sáng";
                                                                        }
                                                                    ?></a>
                                                                </li>
                                                                <li class="li-detail"><a mytour-ext="ajax-modal" modal-name="modal-sure-good-price"><i class="fa fa-check-circle green text-sm" style="color: green;padding-right: 10px;"></i>  Đảm bảo giá tốt nhất!</a></li>
                                                                <li class="li-detail"><a mytour-ext="ajax-modal" modal-name="modal-sure-good-price"><i class="fa fa-check-circle green text-sm" style="color: green;padding-right: 10px;"></i>  <?php echo $value['beds'];?></a></li>
                                                            
                                                            </ul>
                                                        </div>
                                                        <div class="product-price" style="width: 20%">
                                                            <div class="product-old-price">
                                                                <?php echo "$value[price]"; ?> VNĐ
                                                            </div>
                                                            <div class="product-final-price">
                                                                <?php echo "$value[final_price]"; ?> VNĐ
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-12">
                                                        <a style ="float: right;padding: 10px 30px 10px 30px;top:50%;background-color: #79d6f9;text-decoration: none;" href="set_room.php?id=<?php echo"$value[id]"; ?>">Đặt ngay</a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    }
                }
            }
        }
    }
    ?>
        </div>
    </div>
</div>
<?php
    require_once "../Utils/footer.php"; 
    ?>
</body>
</html>