<?php
	  require_once("dbconnect.php");
	  function getuser($usergroup,$user){
	  	   $sql = " SELECT a.user,a.full_name ";
	  	   $sql = $sql . " FROM vicidial_users a,vicidial_user_groups b ";
	  	   $sql = $sql . " WHERE a.user_group = b.user_group ";
	  	   $sql = $sql . " AND   a.user_group='$usergroup' ";
	  	   $sql = $sql . " AND ( select count(*) from vicidial_users where user_level >5 and user = '$user' ) >0";
	  	   $sql = $sql . " union SELECT user,full_name FROM vicidial_users ";
	  	   $sql = $sql . "       WHERE (user='$user' and user_level=5  ) ";
	  }
	  
	  $usegroup = $_GET["usergroup"];
	  $user     = $_GET["user"];
	  
	  $sql      = getuser($usegroup,$user);
	  file_put_contents("tmp.txt",$sql);
	  $res      = mysql_query($sql, $link);
	  
	  $ret      = array();
	  
	  if ($result){
	  	  $result     = array();
		    while ($row = mysql_fetch_assoc($res)) {
		    	     $result[] = $row;
		    }
	  	  $ret["success"] = "1";
	  	  $ret["result"]  = $result;
	  }else{
	  	  $ret["success"] = "0";		
		}
	  
	  echo json_encode($ret);
    exit;
?>