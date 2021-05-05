<?php
    include_once "../Object/DAO.php";

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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Quản lí danh mục</title>
</head>
<body>
    <?php include_once "../Utils/menuadmin.php"?>
    <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ ?>
    <div class="container" style="margin-left:20%;">
        <div class="row"  style="margin-top: 20px;">
            <h1 class="text-center">Danh mục</h1><br>
        </div>
        
        <div class="row">
            <?php
                $conn = mysqli_connect("localhost","root","","mytour");
                $sql = "SELECT count(id) as total from category";
                $ketqua = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($ketqua);
                $total_record = $row['total'];
                $current_page = isset($_GET['page'])?  $_GET['page'] : 1;
                $limit =10;
                $total_page = ceil($total_record/$limit);
                if($current_page > $total_page)
                {
                    $current_page = $total_page;
                }
                elseif($current_page < 1)
                {
                    $current_page = 1;
                }

                $start = ($current_page -1) * $limit;

                $sql1 = "SELECT * FROM category LIMIT $start,$limit";
                $result = mysqli_query($conn, $sql1);
            ?>
            <div class="col-md-12 col-lg-12">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Tên</td>
                                <td>Thuộc danh mục</td>
                                <td>Mô tả</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $checkrow = 0;
                                  foreach ($arr = $dao->getData("SELECT * FROM category") as $key => $value)
                                    if($checkrow < 2 || $checkrow >= 1){
                                        $checkrow++; ?>
                                <?php while ($value = mysqli_fetch_assoc($result)) {?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <tr>
                                        <td><input type="hidden" name="id" value="<?php echo $value["id"]?>"><?php echo $value["id"]?></td>
                                        <td><?php echo $value["namecate"]?></td>
                                        <?php 
                                            if ($value["parent_id"]==0) {
                                                echo "<td>--- --- ---</td>";
                                            } else {
                                                $query = "SELECT * FROM category WHERE id =$value[parent_id]";
                                                $result2 = mysqli_query($conn,$query);
                                                $value1 = mysqli_fetch_assoc($result2);
                                                echo "<td>$value1[namecate]</td>";
                                            }
                                        ?>
                                        <td><?php echo $value["decscription"]?></td>
                                        <td><a href=modifycate.php?id=<?php echo $value["id"]?> name="modify" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                                        <td><button type="submit" name="delete" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                </form>
                                <?php }
                                } ?>
                        </tbody>
                    </table>
                <div class="pagination" style="float: center;margin-left: 40%;">
                    <?php
                        if ($current_page >1 && $total_page >1) 
                        {
                            echo "<a class='bttn' href='category.php?page=".($current_page-1)."'>Prev</a>";
                        }

                        for ($i=1; $i < $total_page; $i++) 
                        { 
                            if ($i == $current_page) 
                            {
                                echo "<a style='text-decoration:none;' class='bttn actives'> $i </a>";
                            }
                            else{
                                echo "<a style='text-decoration:none;' class='bttn' href='category.php?page=".$i."'> $i </a>";
                            }
                        }

                        if ($current_page < $total_page && $total_page >1) 
                        {
                            echo "<a style='text-decoration:none;' class='bttn' href='category.php?page=".($current_page+1)."'>Next</a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["delete"])){

        $id = $_POST["id"];

        $sql = "DELETE FROM category WHERE id = '$id'";
        $dao->insertToDB($sql);   
        header('location: category.php');
        }   
    }
?>

<?php
    ob_end_flush();
?>