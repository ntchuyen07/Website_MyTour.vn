<?php 
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
                    <h1 class="h3 mb-2 text-gray-800">DANH SÁCH CÁC PHÒNG HIỆN CÓ:</h1>
                    <h3 class="mb-4"><a target="_blank"
                            href="<?php echo "../View/detailhotel.php?id=$hotel[id]";?>"><?php echo "$hotel[name]"; ?></a>.</h3>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách phòng</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>STT</th>
                                            <th>Tên phòng</th>
                                            <th>Hình ảnh</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                          $sql2 = "SELECT * FROM rooms WHERE hotel = $hotel[id]";
                                          $res2 = mysqli_query($conn,$sql2);
                                          $i = 1;
                                          while ($room = mysqli_fetch_assoc($res2)) 
                                          {
                                            echo 
                                            "<tr>
                                                  <td style='text-align: center;'>$i</td>
                                                  <td>$room[nameroom]</td>
                                                  <td style='text-align: center;'><img src='../$room[image]' width='150px' height='85px'></td>
                                                  <td style='text-align: center;'>$room[final_price]</td>
                                                  <td style='text-align: center;'>$room[amount]</td>
                                                  <td style='text-align: center;'><a class='btn btn-primary' href='modifyroom.php?id=$room[id]'><i class='fas fa-edit'></i></a></td>
                                                  <td style='text-align: center;'><a href='../Model/deleteroom.php?id=$room[id]' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a></td>
                                            </tr>";
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
                        <span>Copyright &copy; Your Website 2020</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../Model/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

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