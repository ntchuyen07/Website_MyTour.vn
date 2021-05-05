     <?php
        session_start();
        ob_start();
        require_once '../Model/DAO.php';
        $dao = new  DAO();
        $username = $pass = '';
        $userErr = $passErr = '';
            $name = $_POST["username"];
                if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $name)) {
                    $userErr = "Chỉ chứa kí tự a-Z và 0-9";
                } else {
                    $username = $_POST["username"];
                }
            $pass = md5($_POST["password"]);
            if($username!='' && $pass!=''){
                $role = $dao->checkAccount($username, $pass);
                if($role != -1){
                    $_SESSION["user"] = $username;
                    $_SESSION["role"] = $role;
                    if($role==1){
                        header('location:../Admin/dashboard.php');
                    }
                    else 
                    {
                        $user = $_SESSION["user"]; 
                        $conn = mysqli_connect("localhost","root","","mytour");
                        $sql = "SELECT *  FROM account WHERE username = '$user'";
                        $result = mysqli_query($conn,$sql);
                        $account = mysqli_fetch_assoc($result);
                        if ($account["toggle"]==1) 
                        {
                           $_SESSION["tb"]="Tài khoản của bạn đã bị khóa";
                           header("location:../View/login.php");
                        }
                        else
                        {
                            if($role==3){
                            header('location:../Hotel/dashboard.php');
                            }
                            else
                            header('location:../View/index.php');
                        }
                    }
                }
                else{$_SESSION["tb"]='Đăng nhập không thành công!';
                    header('location:../View/login.php');}
            }
        ob_end_flush();
    ?>