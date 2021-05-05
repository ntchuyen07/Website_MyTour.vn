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
    <link rel="stylesheet" type="text/css" href="../Css/confirmorder.css">
    <title>Danh sách đơn hàng</title>
</head>
<body>
    <?php include_once "../Utils/menuadmin.php"?>
    <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column container-fuild" style="margin-left: 14rem">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-top: 30px;">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">DANH SÁCH ĐƠN HÀNG:</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách:</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>STT</th>
                                          <th>Thông tin cá nhân</th>
                                          <th>Tên phòng</th>
                                          <th>Số lượng</th>
                                          <th>Tổng tiền</th>
                                          <th>Phương thức thanh toán</th>
                                          <th>Chưa thanh toán</th>
                                          <th>Nhận phòng</th>
                                          <th>Trả phòng</th>
                                          <th>Trạng thái</th>  
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $i = 1;
                                          $conn = mysqli_connect("localhost","root","","mytour");
                                          $sqls = "SELECT *FROM bills ORDER BY id DESC";
                                          $results = mysqli_query($conn,$sqls);
                                          foreach ($results as $key => $bill)
                                          {
                                            echo "<tr>";
                                              /*$sql = "SELECT *FROM account WHERE id='$bill[user]'";
                                              $result = mysqli_query($conn,$sql);
                                              foreach ($result as $key => $acc) {
                                                    echo "<td>$acc[username]</td>";
                                              }*/
                                              echo "<td>$i</td>";
                                              echo "<td>$bill[name]<br>
                                                        $bill[email]<br>
                                                        $bill[phone]<br>
                                                        $bill[address]
                                                    </td>";
                                              $sql1 = "SELECT * FROM rooms WHERE id = $bill[room]";
                                              $res = mysqli_query($conn,$sql1);
                                              foreach ($res as $key => $room)
                                              {
                                               
                                              }
                                              echo "<td>$room[nameroom]</td>";
                                              echo "<td>$bill[amount]</td>";
                                              echo "<td>$bill[sum_price]</td>";
                                              echo "<td>$bill[pay]</td>";
                                              if ($bill["status"]==1 || $bill["status"]==2 || $bill["status"]==5) 
                                              {
                                                  $tt = $bill["sum_price"] - $bill["sum_price"]*30/100;
                                                  echo "<td>$tt </td>";
                                              } else{
                                                  if($bill["status"]==6)
                                                  {
                                                    echo "<td>Đã hủy đơn</td>";
                                                  } 
                                                  else
                                                  {
                                                    echo "<td>Đã thanh toán hết</td>";
                                                  }
                                              }
                                              $formatDatein = date("H:i:s d/m/Y", strtotime($bill["checkin_date"]));
                                              $formatDateout = date("H:i:s d/m/Y", strtotime($bill["checkout_date"]));
                                              echo "<td>$formatDatein</td>";
                                              echo "<td>$formatDateout</td>";
                                              $sql2 = "SELECT * FROM status WHERE id = $bill[status]";
                                              $res2 = mysqli_query($conn,$sql2);
                                              foreach ($res2 as $key => $status)
                                              {
                                                echo "<td>$status[name]</td>";
                                              }
                                              echo "</tr>";
                                              $i = $i +1;
                                      }
                                        ?>
                                      </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MyTour.vn 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
 -->
    <!-- Custom scripts for all pages-->
    <!-- <script src="../javascript/sb-admin-2.min.js"></script> -->

    <!-- Page level plugins -->
    <!-- <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="../js/demo/datatables-demo.js"></script> -->

 <?php } ?>
</body>
</html>

<?php
    ob_end_flush();
?>