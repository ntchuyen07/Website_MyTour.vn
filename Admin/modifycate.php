<?php
    include_once "../Model//DAO.php";
    $dao = new DAO();    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } else $user = $_SESSION["user"]; 
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM category WHERE id=$id";
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
    <title>Sửa danh mục</title>
</head>
<body>
    <?php
    include_once "../Utils/menuadmin.php"; ?>
     <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ ?>
    <div class="container" style="margin-left: 20%;">
        <div class="row"  style="margin-top: 50px;">
            <h1 class="text-center">Sửa danh mục</h1>
            <?php 
                $conn = mysqli_connect("localhost","root","","mytour");
                $sql1 = "SELECT * FROM category WHERE id = $id";
                $result1 = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_assoc($result1);

            ?>
        </div>
        <div class="row">
            <div class="col-md-8 col-lg-6">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id; ?>" method="post">
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input type="text" name="name" id="" class="form-control" required value='<?php echo "$row[namecate]"; ?>'>
                    </div>
                    <div class="form-group">
                        <label for="idcategory">Thuộc danh mục</label>
                        <select name="cate" id="" class="form-control">
                            <?php
                            if ($row["parent_id"]==0) {
                               echo '<option value="0" selected>--- --- ---</option>';
                            }
                            else{
                                echo '<option value="0">--- --- ---</option>';
                            }
                            $sql = "SELECT * FROM category";
                            $res = $dao->getData($sql);
                            foreach ($res as $key => $value) {
                                if($row["parent_id"] == $value['id']){
                                    echo '<option value="'.$value["id"].'" selected>'.$value["namecate"].'</option>';
                                }
                                else echo '<option value="'.$value["id"].'">'.$value["namecate"].'</option>';
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
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit"])){

        $name = $_POST["name"];
        $decs = $_POST["decs"];
        $parent_id = $_POST["cate"];
        $sql3 = "UPDATE category SET namecate = '$name', parent_id =$parent_id, decscription = '$decs' WHERE id = $id";
        $result3 = mysqli_query($conn, $sql3);
        $dao->insertToDB($sql3);
        header('location:../Admin/category.php');  
        }   
    }
?>

<?php
ob_end_flush();
?>