<?php
    include_once "../Model/DAO.php";

    $dao = new DAO();    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } else $user = $_SESSION["user"]; 

    ob_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="../script/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <link rel="stylesheet" type="text/css" href="../Css/confirmorder.css">
    <title>Thống kê</title>
</head>
<body>
    <?php include_once "../Utils/menuadmin.php"?>
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
    <?php 
      $sql = 'SELECT datecmt, count(id) as soluong FROM comment GROUP BY date(datecmt) ORDER BY datecmt desc LIMIT 7';
      $result = mysqli_query($conn, $sql);
      $date =[];
      $soluong = [];
      while ($row = mysqli_fetch_assoc($result)) {
          array_push($date, $row['datecmt']);
          array_push($soluong, $row['soluong']);
      }
      $dateLabels = json_encode($date);
      $soluongData = json_encode($soluong);
    ?>
    <div class="container" style="margin-left: 20%;margin-top:40px;">
        <h1>Số lượt bình luận trong 7 ngày gần nhất</h1>
        <canvas id="myChart1" style="width: 200px; height: 100px;"></canvas>
        <script>
        var ctx = document.getElementById('myChart1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo  $dateLabels; ?>,
                datasets: [{
                    label: '#bình luận',
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
</body>
</html>

<?php
    ob_end_flush();
?>