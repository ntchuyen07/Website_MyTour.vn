<?php
		session_start();
		$id = $_GET["id"];
		$message = $_POST["reply"];
		$conn = mysqli_connect("localhost","root","","mytour");
        $sqls = "SELECT *FROM contact WHERE id = $id";
        $results = mysqli_query($conn,$sqls);
        foreach ($results as $key => $contact)
        {
        }
        $sql = "UPDATE contact SET reply ='$message' WHERE id =$id";
        $results = mysqli_query($conn,$sql);
        $email = $contact["email"];
		/*$headers = array(
		    'From' => 'greenbook.vku@gmail.com',
		    'X-Mailer' => 'PHP/' . phpversion()
		);*/
		$headers .= 'From: greenbook.vku@gmail.com' . "\r\n";
		$headers .= 'X-Mailer: PHP/' .phpversion() . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$title = 'Thư phản hồi yêu cầu hỗ trợ từ MyTour.vn';
		mb_internal_encoding('UTF-8');
		$encoded_subject = mb_encode_mimeheader($title, 'UTF-8', 'B', "\r\n", strlen('Thư phản hồi yêu cầu hỗ trợ từ MyTour.vn'));
		$status = mail($email,$encoded_subject,$message, $headers); 
		header("location:../Admin/list_contact.php");
?>