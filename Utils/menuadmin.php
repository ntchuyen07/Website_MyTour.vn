<?php
    $user="";
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } else if(isset($_SESSION['user'])){
        $user = $_SESSION["user"]; 
    }
    if ($_SESSION["role"]!=1) {
       header("location:../View/index.php");
    }
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
<body id="page-top">
<!-- Sidebar -->
      <?php 
         $conn = mysqli_connect("localhost","root","","mytour");
         $sql = "SELECT * FROM account WHERE username ='".$user."'";
         $result = mysqli_query($conn,$sql);
         $acc = mysqli_fetch_assoc($result);
         $_SESSION['iduser']=$acc['id'];
         if ($acc['image']=='') {
             $ava = "image\avat.jpg";
         } else {
             $ava = $acc['image'];
         }
        ?>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top"
         id="accordionSidebar" style="width: 100vw; /* viewport width */
            height: 100vh; /* viewport height */
            overflow-y: scroll;
            overflow-x: hidden;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../View/index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Hello</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <span><?php echo '<img style="width: 35px;height: 35px;border-radius: 50%;margin-right:7px;border:2px solid white;"
                    src="../'.$ava.'">'. $acc["name"]; ?></span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Th??ng tin:</h6>
                        <a class="collapse-item" href="../Admin/account.php">H??? s??</a>
                        <a class="collapse-item" href="../Admin/changepass.php">?????i m???t kh???u</a>
                        <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Tho??t:</h6>
                        <a class="collapse-item" href="../Model/logout.php">????ng xu???t</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../Admin/dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang ch???</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Qu???n l??
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Danh m???c</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Qu???n l??:</h6>
                        <a class="collapse-item" href="../Admin/category.php">Danh s??ch</a>
                        <a class="collapse-item" href="../Admin/addcate.php">Th??m m???i</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-hotel"></i>
                    <span>Kh??ch s???n</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Qu???n l??:</h6>
                        <a class="collapse-item" href="../Admin/hotels.php"; ?>Danh s??ch</a>
                        <a class="collapse-item" href="../Admin/addhotels.php">Th??m m???i</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-user"></i>
                    <span>Ng?????i d??ng</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Qu???n l??:</h6>
                        <a class="collapse-item" href="../Admin/user.php">Danh s??ch</a>
                        <a class="collapse-item" href="../Admin/adduser.php">Th??m m???i</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-file-alt"></i>
                    <span>Ph??ng</span>
                </a>
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Qu???n l??:</h6>
                        <a class="collapse-item" href="../Admin/rooms.php">Danh s??ch</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>????n h??ng</span>
                </a>
                <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../Admin/list_order.php">Danh s??ch ????n h??ng</a>
                        <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Theo tr???ng th??i:</h6>
                        <a class="collapse-item" href="../Admin/orderstatus.php?status=1">Ch??? x??c nh???n</a>
                        <a class="collapse-item" href="../Admin/orderstatus.php?status=2">?????t th??nh c??ng</a>
                        <a class="collapse-item" href="../Admin/orderstatus.php?status=3">???? nh???n ph??ng</a>
                        <a class="collapse-item" href="../Admin/orderstatus.php?status=4">???? tr??? ph??ng</a>
                        <a class="collapse-item" href="../Admin/orderstatus.php?status=5">Y??u c???u h???y ????n</a>
                        <a class="collapse-item" href="../Admin/cancelorder.php">????n ???? h???y</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Ch??m s??c Kh??ch h??ng
            </div>

            <li class="nav-item">
                <a class="nav-link" href="../Admin/list_contact.php">
                    <i class="fas fa-headset"></i>
                    <span>T?? v???n</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Admin/comment.php">
                    <i class="fas fa-comment-alt"></i>
                    <span>B??nh lu???n</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Nav Item - Charts -->
          
            <div class="sidebar-heading">
                Kh??c
            </div>
            <li class="nav-item">
                <a class="nav-link" href="../View/post.php" target="_blank">
                    <i class="fas fa-file-signature"></i>
                    <span>????ng b??i vi???t</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Admin/checkpost.php">
                    <i class="fas fa-edit"></i>
                    <span>Ki???m duy???t b??i vi???t</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Admin/charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Th???ng k??</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
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
