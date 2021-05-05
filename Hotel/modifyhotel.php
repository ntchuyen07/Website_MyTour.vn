<?php
    include_once "../Model/DAO.php";

    $dao = new DAO();    
?>
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
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $conn = mysqli_connect("localhost","root","","mytour");
          $sql = "SELECT * FROM account WHERE username = '$user'";
          $res = mysqli_query($conn,$sql);
          $acc = mysqli_fetch_assoc($res);

          $sql1 = "SELECT * FROM hotel WHERE admin_hotel = $acc[id]";
          $res1 = mysqli_query($conn,$sql1);
          $hotel = mysqli_fetch_assoc($res1);
        if ($id!=$hotel["id"]) {
            header("location:../Hotel/dashboard.php");
        }
    }
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="../script/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <title>MyTour.vn - <?php echo "$hotel[name]"; ?></title>
</head>
<body>
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
                    <h1 class="h3 mb-2 text-gray-800">Chỉnh sửa thông tin khách sạn:</h1>
                    <h3 class="mb-4"><a target="_blank"
                            href="<?php echo "../View/detailhotel.php?id=$hotel[id]";?>"><?php echo "$hotel[name]"; ?></a>.</h3>
                    <hr class="sidebar-divider d-none d-md-block">
                    <div class="row">
                        <?php 

                            $conn = mysqli_connect("localhost","root","","mytour");
                            $sql1 = "SELECT * FROM hotel WHERE id = $id";
                            $result1 = mysqli_query($conn, $sql1);
                            $row = mysqli_fetch_assoc($result1);

                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-lg-10">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=" .$id; ?>" 
                                method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Tên doanh nghiệp: </label>
                                    <input type="text" name="name" id="" class="form-control" value="<?php echo "$row[name]"; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Hình ảnh: </label>
                                    <input type="file" name="image" id="" onchange="readURL(this)" class="form-control"><br>
                                    <img class="image-hotel" src="../<?php echo "$row[image]"; ?>" style="height: 300px;padding: 20px;">
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ:</label>
                                    <input type="text" name="address" id="" class="form-control" value="<?php echo "$row[address]"; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Khu vực:</label>
                                    <select name="idaddress" id="" class="form-control">
                                        <?php
                                        $sql = "SELECT * FROM address";
                                        $result = $dao->getData($sql);
                                        foreach ($result as $key => $value) {
                                            if ($row["id_address"]==$value["id"]) {
                                                echo '<option value="'.$value["id"].'" selected>'.$value["name"].'</option>';
                                            } else {
                                                echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="decs">Mô tả</label>
                                    <textarea name="decs"><?php echo "$row[decscription]"; ?></textarea>
                                    <script>
                                        CKEDITOR.replace('decs');
                                    </script>
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit" value ="Sửa">
                            </form>
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-hotel').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>

<?php
    $dir = "image/";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit"])){

        $name = $_POST["name"];
        $address =$_POST["address"];
        $id_address = $_POST["idaddress"];
        $decs = $_POST["decs"];
        $image="";
        //Kiểm tra file tải lên mà không có lỗi
        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $row["id"] .$_FILES["image"]["name"] ;
            $filetype = $_FILES["image"]["type"];
            $filesize = $_FILES["image"]["size"];
        }

        //xác định loại file
        if(in_array($filetype, $allowed)){
            move_uploaded_file($_FILES["image"]["tmp_name"],'../'.$dir.$filename);
            $image = $dir.basename($filename);
        } else {
            echo 'Lỗi trong quá trình upload hình ảnh';
        }
        if($image=='')
        {
            $image =$row["image"];
        }
            $sql = "UPDATE hotel SET name='$name',address ='$address', id_address = '$id_address', image ='$image', decscription ='$decs' WHERE id =$row[id]";
            $dao->insertToDB($sql);
            header('location:../Hotel/dashboard.php');
        }
    }
?>

<?php
    ob_end_flush();
?>