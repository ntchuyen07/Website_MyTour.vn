<?php 
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

    <title>Admin - Hotel</title>

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
<style>
    
.tb {
  position: absolute;
    top: 10px;
    right: 51px;
    width: 20px;
    height: 20px;
    text-align: center;
    padding-right: 2px;
    color: white;
    background: red;
    border-radius: 50%;
    font-size: 10px;
}


</style>
<body id="page-top">
<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top" id="accordionSidebar" style="width: 100vw; /* viewport width */
            height: 100vh; /* viewport height */
            overflow-y: scroll;
            overflow-x: hidden;">>

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Hello</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="../<?php echo "$acc[image]"; ?>">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "<b style='color:white'>$acc[name]</b>"; ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../View/account.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Hồ sơ
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang chủ</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Chúng tôi
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-hotel"></i>
                    <span>Khách sạn</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Chi tiết:</h6>
                        <a class="collapse-item" href="<?php echo "../Hotel/modifyhotel.php?id=$hotel[id]"; ?>">Giới thiệu</a>
                        <a class="collapse-item" href="#">Hình ảnh</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-file-alt"></i>
                    <span>Dịch vụ phòng</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Quản lý:</h6>
                        <a class="collapse-item" href="list_rooms.php">Xem danh sách</a>
                        <a class="collapse-item" href="addroom.php">Thêm phòng mới</a>
                        <a class="collapse-item" href="#">Cập nhật hình ảnh</a>
                        <a class="collapse-item" href="#">Khác</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Chăm sóc Khách hàng
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý đơn hàng</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Chung:</h6>
                        <a class="collapse-item" href="../Hotel/list_order.php">Danh sách đơn hàng</a>
                        <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Theo trạng thái:</h6>
                        <a class="collapse-item" href="../Hotel/orderstatus.php?status=2">Đặt thành công</a>
                        <a class="collapse-item" href="../Hotel/orderstatus.php?status=3">Đã nhận phòng</a>
                        <a class="collapse-item" href="../Hotel/orderstatus.php?status=4">Đã trả phòng</a>
                        <a class="collapse-item" href="../Hotel/cancelorder.php">Đơn đã hủy</a>
                    </div>
                </div>
            </li>
            <?php 
                $conn = mysqli_connect("localhost","root","","mytour");
                $sqls = "SELECT *FROM bills WHERE  hotel = $hotel[id] and (status=1 or status=5) ORDER BY id DESC";
                $results = mysqli_query($conn,$sqls);
                $num = mysqli_num_rows($results);
            ?>
            <li class="nav-item">
                <a class="nav-link" href="../Hotel/confirmorder.php" style="position: relative;">
                    <i class="fas fa-check-circle"></i>
                    <span>Xác nhận đơn hàng</span>
                    <?php 
                        if ($num!=0)
                        {
                            echo "<span class='tb' >$num</span>";
                        }
                        
                    ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagess"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Cập nhật đơn hàng</span>
                </a>
                <div id="collapsePagess" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Chung:</h6>
                        <a class="collapse-item" href="../Hotel/updatestatus.php?status=1">Tất cả đơn</a>
                        <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Theo trạng thái:</h6>
                        <a class="collapse-item" href="../Hotel/updatestatus.php?status=2">Đã xác nhận</a>
                        <a class="collapse-item" href="../Hotel/updatestatus.php?status=3">Đã nhận phòng</a>
                        <a class="collapse-item" href="../Hotel/updatestatus.php?status=4">Đã trả phòng</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../View/contact.php" target="_blank">
                    <i class="fas fa-headset"></i>
                    <span>Tư vấn</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Nav Item - Charts -->
          
            <div class="sidebar-heading">
                Khác
            </div>
            <li class="nav-item">
                <a class="nav-link" href="../View/post.php" target="_blank">
                    <i class="fas fa-file-signature"></i>
                    <span>Đăng bài viết</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Hotel/charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Thống kê</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có thật sự muốn?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" để thoát khỏi tài khoản</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" href="../Model/logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
        <!-- End of Sidebar -->
</body>
</html>
