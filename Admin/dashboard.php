<?php
    $user="";
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } else if(isset($_SESSION['user'])){
        $user = $_SESSION["user"]; 
    }
?>
<!DOCTYPE html>
<html lang=en>

<head>
    <!-- CSS only -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../style.css"> -->
</head>
<body>
    <?php include_once "../Utils/menuadmin.php";?>
     <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ ?>
    <div class="container-fuild" style="margin-left: 20%;">
    <h1>Trang điều khiển</h1>
    <?php 
        $conn = mysqli_connect("localhost","root","","mytour");
        $sql = "SELECT * FROM category ";
        $result = mysqli_query($conn,$sql);
        $soluong = mysqli_num_rows($result);

        $sql1 = "SELECT * FROM hotel ";
        $result1 = mysqli_query($conn,$sql1);
        $soluong1 = mysqli_num_rows($result1);

        $sql2 = "SELECT * FROM account ";
        $result2 = mysqli_query($conn,$sql2);
        $soluong2 = mysqli_num_rows($result2);

        $sql3 = "SELECT * FROM rooms";
        $result3 = mysqli_query($conn,$sql3);
        $soluong3 = mysqli_num_rows($result3);

        /*$sql4 ="SELECT month(ngaydat) as thang,sum(tongtien) as tong from bill where status='4' group by month(ngaydat) ";
        $result4 = mysqli_query($conn,$sql4);
        $months =[];
        $tong = [];
        while ($row = mysqli_fetch_assoc($result4)) {
            array_push($months, $row['thang']);
            array_push($tong, $row['tong']);
        }
        $monthLabels = json_encode($months);
        $tongdata = json_encode($tong);*/
    ?>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <div class="card">
                        <div class="card-body " style="background-color: #00c7d1;color: white;">
                            <?php echo "<h1>$soluong</h1>"; ?><br>Danh mục
                        </div>
                        <div class="card-footer text-center" style="color:white;background-color: #00bddb;">
                            <a href="category.php" style="color:white;">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="card">
                        <div class="card-body" style="background-color: #00a842;color: white;">
                            <?php echo "<h1>$soluong1</h1>"; ?><br>Khách sạn
                        </div>
                        <div class="card-footer text-center" style="color:white;background-color:#219621;">
                            <a href="hotels.php" style="color:white;">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="card">
                        <div class="card-body" style="background-color:#FFA500;color: white">
                             <?php echo "<h1>$soluong2</h1>"; ?><br>Tài khoản
                        </div>
                        <div class="card-footer text-center" style="color:white;background-color: #ffad29;">
                            <a href="user.php" style="color:white;">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="card">
                        <div class="card-body" style="background-color:#e30000;color: white;">
                             <?php echo "<h1>$soluong3</h1>"; ?><br>Phòng
                        </div>
                        <div class="card-footer text-center" style="color:white;background-color: #d90000;">
                            <a href="rooms.php" style="color:white;">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
      $conn = mysqli_connect("localhost","root","","mytour");
      $sql = 'SELECT set_date, count(id) as soluong FROM bills GROUP BY date(set_date) ORDER BY set_date desc LIMIT 7';
      $result = mysqli_query($conn, $sql);
      $date =[];
      $soluong = [];
      while ($row = mysqli_fetch_assoc($result)) {
          array_push($date, $row['set_date']);
          array_push($soluong, $row['soluong']);
      }
      $dateLabels = json_encode($date);
      $soluongData = json_encode($soluong);
    ?>
    <div class="container" style="margin-left: 20%;margin-top:40px;">
        <h1>Số đơn đặt hàng trong 7 ngày gần nhất</h1>
        <canvas id="myChart" style="width: 200px; height: 100px;"></canvas>
        <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo  $dateLabels; ?>,
                datasets: [{
                    label: '#Đơn hàng',
                    data: <?php echo  $soluongData; ?>,
                    backgroundColor: 
                        'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(0,185,242)',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>
    </div>
<?php } else{
    header('location:../View/index.php');
}?>
</body>
</html>