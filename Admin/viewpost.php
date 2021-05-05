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
    <title>Kiểm duyệt bài viết</title>
</head>
<body>
    <?php include_once "../Utils/menuadmin.php"?>
    <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column container-fuild" style="margin-left: 14rem">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container" style="margin-top: 30px;">
                    <?php 
                        $id = $_GET["post"];
                        $conn = mysqli_connect("localhost","root","","mytour");
                        $sqls = "SELECT *FROM post WHERE id = $id";
                        $results = mysqli_query($conn,$sqls);
                        foreach ($results as $key => $post)
                        {
                            $sql = "SELECT * FROM account WHERE id = $post[user]";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $key => $account)
                            {
                            }
                        }
                        $formatDate = date("H:i:s d/m/Y", strtotime($post["datepost"]));
                    ?>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">BẢN XEM TRƯỚC:</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bài viết:
                              <?php 
                                  if ($post["checkpost"]==0) {
                                    echo "<a href='../Model/check.php?post=$post[id]' class='btn btn-success' style='float:right;'>Duyệt</a>";
                                  } else {
                                    echo "<a href='../Model/check.php?post=$post[id]' class='btn btn-success disabled' style='float:right;'>Đã duyệt</a>";
                                  }
                                  
                              ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <h1><b><?php echo "$post[title]"; ?></b></h1>
                                <p style="color: gray"><span class="far fa-clock"></span> Đăng tải <?php echo "$formatDate"; ?> |<span class="fas fa-user" style="padding:0  10px 0 10px ;"></span><?php echo " Bởi: $account[name]"; ?></p>
                                <div style="text-align: center;"><img src="../<?php echo "$post[image]";?>" style="width: 80%;padding-bottom: 30px;"></div><hr>
                                <span><?php echo "$post[content]";?></span>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if ($post["checkpost"]==0) {
                            echo "<a href='../Model/check.php?post=$post[id]' class='btn btn-success' style='float:right;'>Duyệt</a>";
                        } else {
                            echo "<a href='../Model/check.php?post=$post[id]' class='btn btn-success disabled' style='float:right;'>Đã duyệt</a>";
                        }
                    ?>
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