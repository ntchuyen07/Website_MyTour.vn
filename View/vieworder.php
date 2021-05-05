<?php 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    session_start();
    if(!isset($_SESSION["user"])) 
    { 
        header("location:../View/index.php");
    } else if(isset($_SESSION['user'])){
        $user = $_SESSION["user"]; 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Css/cart.css">
    <title>Giỏ hàng</title>
    <style>
      .rate {
      float: left;
      height: 46px;
      padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
    </style>
</head>
<body>
 

  <div class="container-fuild" style="background-color: #f5f5f5;padding-bottom:40px;">
  <div class="container">
    <h1 style="padding-top: 200px;text-align: center;">Đơn hàng của tôi</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Phòng đã đặt</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tên phòng</th>
                      <th>Giá phòng (đ/đêm)</th>
                      <th>Số lượng</th>
                      <th>Tổng tiền</th>
                      <th>Phương thức thanh toán</th>
                      <th>Chưa thanh toán</th>
                      <th>Nhận phòng</th>
                      <th>Trả phòng</th>
                      <th>Trạng thái</th>  
                      <th>Hủy/Đánh giá</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $conn = mysqli_connect("localhost","root","","mytour");
                      $sqls = "SELECT *FROM account WHERE username ='$user'";
                      $results = mysqli_query($conn,$sqls);
                      foreach ($results as $key => $acc)
                      {
                          $iduser = $acc["id"];
                      }
                      $sql = "SELECT *FROM bills WHERE user='$iduser' ORDER BY set_date DESC";
                      $result = mysqli_query($conn,$sql);
                      foreach ($result as $key => $row) {
                        echo "<tr>";
                          $sql1 = "SELECT * FROM rooms WHERE id = $row[room]";
                          $res = mysqli_query($conn,$sql1);
                          foreach ($res as $key => $room)
                          {
                           
                          }
                          $sql2 = "SELECT * FROM hotel WHERE id = $room[hotel]";
                          $res = mysqli_query($conn,$sql2);
                          foreach ($res as $key => $hotel)
                          {
                           
                          }
                          echo "<td>$room[nameroom] (Thuộc $hotel[name])</td>";
                          echo "<td>$room[final_price] </td>";
                          echo "<td>$row[amount]</td>";
                          echo "<td>$row[sum_price]</td>";
                          echo "<td>$row[pay]</td>";
                          if ($row["status"]==1 || $row["status"]==2) 
                          {
                              $tt = $row["sum_price"] - $row["sum_price"]*30/100;
                              echo "<td>$tt </td>";
                          } else 
                          {
                            echo "<td>Đã thanh toán hết</td>";
                          }
                          $formatDatein =date("H:i:s d/m/Y", strtotime($row["checkin_date"]));
                          $formatDateout =date("H:i:s d/m/Y", strtotime($row["checkout_date"]));
                          echo "<td>$formatDatein</td>";
                          echo "<td>$formatDateout</td>";
                          $sql2 = "SELECT * FROM status WHERE id = $row[status]";
                          $res2 = mysqli_query($conn,$sql2);
                          foreach ($res2 as $key => $status)
                          {
                            echo "<td>$status[name]</td>";
                          }
                          $date = date('Y-m-d');
                          $start = strtotime($date);
                          $end = strtotime($row["checkin_date"]);

                          $days_between = ceil(($end - $start) / 86400);
                          if ($days_between>=7 && $row["status"]<5) 
                          {
                            echo "<td><a href='../Model/send_cancel.php?id=$row[id]'><button type='button' class='btn btn-danger'>Hủy đơn</button></a></td>";
                          } else if ($days_between<0 && $row["status"]==4 && $row["showname"]=="")
                          {
                            echo "<td><a><button type='button' class='btn btn-success rate-btn' data-toggle='modal' data-target='#exampleModal' 
                            data-id='$row[id]'>Đánh giá</button></a></td>";
                          }
                          else
                          {
                            echo "<td></td>";
                          }
                          
                          echo "</tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Đánh giá dịch vụ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" class="send-rate" method="POST">
                <div class="form-group">
                  <label for="username">Tên hiển thị: </label>
                  <input id="username" name="username" type="text" class="form-control" value="<?php echo "$_SESSION[user]"; ?>" required >
                </div>
                <div class="form-group">
                  <div class="rate" style="">
                    <input type="radio" id="star5" name="rate" value="5">
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4">
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3">
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2">
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1">
                    <label for="star1" title="text">1 star</label>
                  </div>
                </div>
                <div class="form-group">
                    <textarea name="content" cols="10" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group text-right">
                    <input type="submit" class="btn btn-success" value="Gửi đánh giá">
                </div>
                
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <?php include_once "../Utils/menu.php";
  ?>
    <script>
      $(document).ready(function () {
        $('.rate-btn').on('click', function() {
          var billID = $(this).attr('data-id');
          $('.send-rate').attr('action', `../Model/rate.php?id=${billID}`);
        })
      })
    </script>
     
    <?php include_once '../Utils/footer.php'; ?>
</body>
</html>