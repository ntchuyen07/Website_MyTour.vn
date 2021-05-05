<?php
    include_once "../Model/DAO.php";
     session_start(); 
    $dao = new DAO();    
    if(!isset($_SESSION["user"])) 
    { 
      header("location:../View/index.php");
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
    <title>Danh sách liên hệ người dùng</title>
    <style>
      .intro-contact {
           overflow: hidden;
           display: -webkit-box;
         -webkit-box-orient: vertical;
         -webkit-line-clamp: 3;
       }  
    </style>
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
                    <h1 class="h3 mb-2 text-gray-800">DANH SÁCH YÊU CẦU TƯ VẤN:</h1>
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
                                          <th>Người dùng</th>
                                          <th>Tên</th>
                                          <!-- <th>Email</th> -->
                                          <th>Nội dung</th>
                                          <th>Thời gian gửi yêu cầu</th>
                                          <th>Trả lời</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $i = 1;
                                          $conn = mysqli_connect("localhost","root","","mytour");
                                          $sqls = "SELECT *FROM contact ORDER BY id DESC";
                                          $results = mysqli_query($conn,$sqls);
                                          foreach ($results as $key => $contact)
                                          {
                                            echo "<tr>";
                                              $sql = "SELECT *FROM account WHERE id='$contact[user]'";
                                              $result = mysqli_query($conn,$sql);
                                              foreach ($result as $key => $acc) {
                                              }
                                              $formatDate = date("H:i:s d/m/Y", strtotime($contact["date_send"]));
                                              echo "<td>$i</td>";
                                              echo "<td>$acc[username]</td>";
                                              echo "<td>$contact[name]</td>";
                                              /*echo "<td>$contact[email]</td>";*/
                                              echo "<td><span class='intro-contact'>$contact[content]</span></td>";
                                              echo "<td>$formatDate</td>";
                                              if ($contact["reply"]=="") 
                                              {
                                                  echo "<td><a class='btn btn-success' href='../Admin/contact.php?id=$contact[id]'>PHẢN HỒI</a></td>";
                                              }
                                              else
                                              {
                                                echo "<td>ĐÃ PHẢN HỒI<br>
                                                       <a href='../Admin/viewcontact.php?id=$contact[id]' style='text-decoration:none;'>Xem ngay</a> 
                                                      </td>";
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