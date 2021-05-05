<?php 
	session_start();
	$idcmt = $_GET["id"];
	$conn = mysqli_connect("localhost","root","","mytour");
	$sql = "SELECT * FROM comment WHERE id=$idcmt";
	$res = mysqli_query($conn,$sql);
	$cmt = mysqli_fetch_assoc($res);
	$amount = $cmt["likecmt"];

	$sql = "SELECT * FROM likecomment WHERE user='$_SESSION[iduser]' and idcmt=$idcmt";
	$res = mysqli_query($conn,$sql);
	$num = mysqli_num_rows($res);
	if ($num==0) 
	{
		$amount = $amount+1;
		$sql = "INSERT INTO likecomment (user,idcmt,toggle) VALUES ('$_SESSION[iduser]','$idcmt','1')";
		$sqli = "UPDATE comment SET likecmt='$amount' WHERE id=$idcmt";
	} else {
		$like = mysqli_fetch_assoc($res);
		if ($like["toggle"]==0) 
		{
			$amount = $amount+1;
			$sql = "UPDATE likecomment SET toggle=1 WHERE user='$_SESSION[iduser]' and idcmt=$idcmt";
			$sqli = "UPDATE comment SET likecmt='$amount' WHERE id=$idcmt";
		} else {
			$amount = $amount-1;
			$sql = "UPDATE likecomment SET toggle=0 WHERE user='$_SESSION[iduser]' and idcmt=$idcmt";
			$sqli = "UPDATE comment SET likecmt='$amount' WHERE id=$idcmt";
		}
		
	}
	$res = mysqli_query($conn,$sql);
	$result = mysqli_query($conn,$sqli);
?>