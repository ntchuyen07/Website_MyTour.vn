<?php 
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	include_once "../Model/DAO.php";
	$dao = new DAO();
	$title = $_POST["title"];
	$content = $_POST["content"];
	$user = $_SESSION["iduser"];
	$date = date('Y-m-d H:i:s');
	$dir = "image/post/";
	$image = '';
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
            move_uploaded_file($_FILES["image"]["tmp_name"],'../'.$dir.$filename);
            $image = $dir.basename($filename);
        } else {
            echo 'Lỗi trong quá trình upload hình ảnh';
        }
    }
    if($image!='')
    {
    	$sql ="INSERT INTO post(title,content,image,user,datepost) VALUES ('$title','$content','$image','$user','$date')";
    	$dao->insertToDB($sql);
    	header("location:../View/post.php");
    }
    
?>