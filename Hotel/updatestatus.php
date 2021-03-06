<?php 
  include_once "../Model/DAO.php";
  $dao = new DAO();
  session_start();
  if(isset($_SESSION['role'])){
        if($_SESSION['role'] != 3){
            header("location:../View/index.php");
        }else if($_SESSION['role'] == 3){
            $role = 3;
            $user =$_SESSION["user"];
        }
    }
  $conn = mysqli_connect("localhost","root","","mytour");
  $sql = "SELECT * FROM account WHERE username = '$user'";
  $res = mysqli_query($conn,$sql);
  $acc = mysqli_fetch_assoc($res);

  $sql1 = "SELECT * FROM hotel WHERE admin_hotel = $acc[id]";
  $res1 = mysqli_query($conn,$sql1);
  $hotel = mysqli_fetch_assoc($res1);
  $_SESSION["hotel"]=$hotel["id"];

  $sql1 = "SELECT * FROM rooms WHERE hotel = $hotel[id]";
  $res1 = mysqli_query($conn,$sql1);
  $status = $_GET["status"];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MyTour.vn - <?php echo "$hotel[name]"; ?></title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/DataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once "../Utils/menuhotel.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column container-fuild" style="margin-left: 14rem">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-top: 30px;">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">DANH S??CH ????N H??NG:</h1>
                    <h3 class="mb-4"><a target="_blank"
                            href="<?php echo "../View/detailhotel.php?id=$hotel[id]";?>"><?php echo "$hotel[name]"; ?></a>.</h3>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh s??ch:</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>STT</th>
                                          <th>Th??ng tin c?? nh??n</th>
                                          <th>T??n ph??ng</th>
                                          <th>S??? l?????ng</th>
                                          <th>T???ng ti???n</th>
                                          <th>Ph????ng th???c thanh to??n</th>
                                          <th>Ch??a thanh to??n</th>
                                          <th>Nh???n ph??ng</th>
                                          <th>Tr??? ph??ng</th>
                                          <th>Tr???ng th??i</th>  
                                          <?php 
                                              if ($status!=4) 
                                              {
                                                  echo "<th>C???p nh???t</th>";
                                              }
                                          ?>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $i = 1;
                                          $conn = mysqli_connect("localhost","root","","mytour");
                                          if ($status==1) 
                                          {
                                             $sqls = "SELECT *FROM bills WHERE  hotel = $hotel[id] and (status>1 and status<5) ORDER BY id DESC";
                                          } else {
                                             $sqls = "SELECT *FROM bills WHERE  hotel = $hotel[id] and status=$status ORDER BY id DESC";
                                          }
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
                                                    echo "<td>???? h???y ????n</td>";
                                                  } 
                                                  else
                                                  {
                                                    echo "<td>???? thanh to??n h???t</td>";
                                                  }
                                              }
                                              $formatDatein =date("H:i:s d/m/Y", strtotime($bill["checkin_date"]));
                                              $formatDateout =date("H:i:s d/m/Y", strtotime($bill["checkout_date"]));
                                              echo "<td>$formatDatein</td>";
                                              echo "<td>$formatDateout</td>";
                                              $sql2 = "SELECT * FROM status WHERE id = $bill[status]";
                                              $res2 = mysqli_query($conn,$sql2);
                                              foreach ($res2 as $key => $statuss)
                                              {
                                                echo "<td>$statuss[name]</td>";
                                              }
                                              ?>
                                              <?php 
                                                  if ($status!=4) 
                                                  {
                                              ?>
                                              <td style="width: 250px;">
                                                <form action="<?php echo"../Model/updatestatus.php?bill=$bill[id]"; ?>" method="post">
                                                 <select name="idstatus" id="" class="form-control" onchange=this.form.submit()>
                                                          <?php
                                                          $sql4 = "SELECT * FROM status WHERE (id>'$statuss[id]' or id='$statuss[id]') and id<5";
                                                          $res4 =mysqli_query($conn,$sql4);
                                                          foreach ($res4 as $key => $value4) 
                                                          {
                                                              if($value4['id']==$statuss["id"]){
                                                                  echo '<option value="'.$value4["id"].'" selected>'.$value4["name"].'</option>';
                                                              } else echo '<option value="'.$value4["id"].'">'.$value4["name"].'</option>';
                                                          }
                                                          ?>
                                                  </select>
                                                </form>
                                              </td>
                                              <?php
                                                  }
                                              ?>  
                                              <?php
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

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../javascript/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>