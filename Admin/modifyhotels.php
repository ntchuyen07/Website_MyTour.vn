<?php
    include_once "../Model/DAO.php";

    $dao = new DAO();    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } else $user = $_SESSION["user"]; 
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM hotel WHERE id=$id";
        $result = $dao->getData($sql);
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
    <title>Cập nhật thông tin doanh nghiệp liên kết</title>
</head>
<body>
    <?php include_once "../Utils/menuadmin.php"?>
    <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ ?>
    <div class="container" style="margin-left: 20%;padding-bottom: 100px;padding-top: 20px;">
        <div class="row">
            <h3>Cập nhật thông tin doanh nghiệp</h3>
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
                        <img class="image-hotel" src="../<?php echo "$row[image]"; ?>" style="height: 200px;padding: 20px;">
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
                        <label for="idcategory">Thuộc danh mục:</label>
                        <select name="cate" id="" class="form-control">
                            <?php
                            $sql = "SELECT * FROM category";
                            $result = $dao->getData($sql);
                            foreach ($result as $key => $value) {
                                if ($row["cate"]==$value["id"]) {
                                    echo '<option value="'.$value["id"].'" selected>'.$value["namecate"].'</option>';
                                } else {
                                    echo '<option value="'.$value["id"].'">'.$value["namecate"].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Admin quản lý:</label>
                        <select name="admin" id="" class="form-control">
                            <?php
                            if ($row["admin_hotel"]==0) {
                                echo "<option value='0' selected>--- --- ---</option>";
                            } else {
                                echo "<option value='0'>--- --- ---</option>";
                            }
                            
                            $sql = "SELECT * FROM account";
                            $result = $dao->getData($sql);
                            foreach ($result as $key => $value) {
                                if ($row["admin_hotel"]==$value["id"]) 
                                {
                                    echo '<option value="'.$value["id"].'" selected>'.$value["username"].'</option>';
                                } else {
                                    echo '<option value="'.$value["id"].'">'.$value["username"].'</option>';
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
    <?php } ?>
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
        $cate = $_POST["cate"];
        $admin = $_POST["admin"];
        $decs = $_POST["decs"];
        $image="";
        //Kiểm tra file tải lên mà không có lỗi
        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0)
        {
            {
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["image"]["name"];
                $filetype = $_FILES["image"]["type"];
                $filesize = $_FILES["image"]["size"];
            }

            //xác định loại file
            if(in_array($filetype, $allowed)){
                //Kiểm tra file trước đó có tồn tại hay không
                if(file_exists('../'.$dir.$filename)){
                    echo $filename.' already exist';
                } else {
                    move_uploaded_file($_FILES["image"]["tmp_name"],'../'.$dir.$filename);
                    $image = $dir.basename($_FILES['image']['name']);
                    // $image = substr($image, 1);
                }
            } else {
                echo 'Lỗi trong quá trình upload hình ảnh';
            }
        }
        if($image=='')
        {
            $image =$row["image"];
        }
            $sql = "UPDATE hotel SET name='$name',address ='$address', id_address = '$id_address', cate = '$cate',admin_hotel='$admin', image ='$image', decscription ='$decs' WHERE id =$row[id]";
            if($row["admin_hotel"]!=0 && $row["admin_hotel"]!=$admin)
            {
                $sql1 = "UPDATE account SET role ='2' WHERE id ='$row[admin_hotel]'";
                $dao->insertToDB($sql1);
            }
            if ($admin!=0) 
            {
                $sql2 = "UPDATE account SET role ='3' WHERE id ='$admin'";
                $dao->insertToDB($sql2);
            }
            $dao->insertToDB($sql);
            header('location:../Admin/hotels.php');
        }
    }
?>

<?php
    ob_end_flush();
?>