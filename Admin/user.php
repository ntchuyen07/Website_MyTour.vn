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
    <title>Danh sách tài khoản</title>
</head>
<body>
    <?php include_once "../Utils/menuadmin.php"?>
    <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ ?>
    <div class="container" style="margin-left:20%;">
        <div class="row"  style="margin-top: 20px;">
        <h1 class="text-center">Quản lý người dùng</h1><br>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                
                    <table class="table table-striped">
                        <thead>
                            <tr style="background:black;color:white; text-align: center;">
                                <td><b>ID</b></td>
                                <td><b>Tên đăng nhập</b></td>
                                <td><b>Tên người dùng</b></td>
                                <td><b>Email</b></td>
                                <td><b>Quyền</b></td>
                                <td><b>Hoạt động</b></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql =  "SELECT * FROM account";
                                $result = $dao->getData($sql);
                                foreach ($result as $key => $value): ?>
                                <form action="<?php echo "../Model/toggleuser.php?id=$value[id]"; ?>" method="post">
                                    <tr>
                                        <td><input type="hidden" name="id" value="<?php echo $value["id"]?>"><?php echo $value["id"]?></td>
                                        <td><?php echo $value["username"]?></td>
                                        <td><?php echo $value["name"]?></td>
                                        <td><?php echo $value["email"]?></td>
                                        <td><?php 
                                            if($value["role"]==1) {
                                                    echo "ADMIN";
                                            }else if ($value["role"]==3)
                                            {
                                                     echo "ADMIN HOTEL";
                                            } else echo 'USER';
                                            ?></td>
                                        <?php 
                                            if ($value["toggle"]==0) 
                                            {
                                            ?>
                                                <td>
                                                    <label class="switch">
                                                      <input type="checkbox" checked name="show"  onchange=this.form.submit()>
                                                      <span class="slider round"></span>
                                                    </label>
                                                </td>
                                            <?php
                                            } else 
                                            {
                                            ?>
                                                <td>
                                                    <label class="switch">
                                                      <input type="checkbox" name="show"  onchange=this.form.submit()>
                                                      <span class="slider round"></span>
                                                    </label>
                                                </td>
                                            <?php
                                            }
                                            
                                        ?>
                                        <td><a name="delete" class="btn btn-danger" href="<?php echo "../Model/deluser.php?id=$value[id]";?>" ><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                </form>
                                <?php endforeach ?>
                        </tbody>
                    </table>
                    
                
            </div>
        </div>
    </div>
    <?php } ?>
</body>
</html>

<?php
    ob_end_flush();
?>