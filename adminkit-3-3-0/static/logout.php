<?
ob_start();
session_start();
?>
<?		
		include("connectdb.php");
		$strSQL1 = "INSERT INTO log_web ";
		$strSQL1 .=" (log_id,log_user,log_time,log_type,log_detail) ";
		$strSQL1 .=" VALUES (NULL,'".$_SESSION["member_user"]."','".date("Y-m-d H:i:s")."','LOGOUT','SUCCESS') ";
		$objQuery1 = mysqli_query($conn,$strSQL1);
	session_start();
	session_destroy();
	header("location:index.php");
?>
