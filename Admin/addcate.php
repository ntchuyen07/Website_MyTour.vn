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
    <title>Thêm danh mục</title>
</head>
<body>
    <?php include_once "../Utils/menuadmin.php"?>
    <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ ?>
    <div class="container" style="margin-left: 20%;">
        <div class="row">
            <h3>Thêm danh mục mới</h3>
        </div>
        <div class="row">
            <div class="col-md-8 col-lg-6">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                 method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input type="text" name="name" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="idcategory">Thuộc danh mục</label>
                        <select name="cate" id="" class="form-control">
                            <option value="0">-----</option>
                            <?php
                            $sql = "SELECT * FROM category";
                            $result = $dao->getData($sql);
                            foreach ($result as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["namecate"].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="decs">Mô tả</label>
                        <textarea name="decs"></textarea>
                        <script>
                            CKEDITOR.replace('decs');
                        </script>
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit">
                </form>
            </div>
        </div>
    </div>
    <?php }?>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit"])){

        $name = $_POST["name"];
        $decs = $_POST["decs"];
        $parent_id = $_POST["cate"];
        $connect = mysqli_connect("localhost", "root", "", "mytour") or die ("Can't connect");
        $sql = "INSERT INTO category (namecate,parent_id, decscription) VALUES('$name',$parent_id, '$decs')";
        $result = mysqli_query($connect,$sql);
        header('location:../Admin/category.php');  
        }   
    }
?>

<?php
ob_end_flush();
?>