<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");

require_once "conn.php";

$username = trim($_POST["username_find"]);
$userdepartment = trim($_POST["userposition_find"]);

if(empty($username) && empty($userdepartment)){
	echo "<script>alert('请填写查询条件！');window.location.href = './index-2.php'</script>";
	exit;
}

if(empty($username)){
	$sql1="";
	if(empty($userdepartment)){
	$sql2="";
	}else{	
		$sql2="cdepartment='".$userdepartment."'";	
	}
}else{
	$sql1="cname='".$username."'";
	if(empty($userdepartment)){
	$sql2="";
	}else{
		$sql2="and cdepartment='".$userdepartment."'";
	}
}

$sWhere=$sql1.$sql2;

//$sql = "select cid, cname, cposition, cdepartment, ctel, clandline,cfax from contract where ".$sWhere." order by cid ;


//echo "<script>window.location.href = 'Search_view.php?sWhere='".$sWhere."'</script>";
echo '<Script>location.href="'.'Search_xfer_view.php?sWhere='.urlencode($sWhere).'";</Script>'; 




?>
