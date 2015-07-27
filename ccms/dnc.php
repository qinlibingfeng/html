<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CCMS</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
-->
</style></head>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<center>
<div id="xsnazzy">
<?php
	require("dbconnect.php");
	mysql_query("SET NAMES utf8;");
	if (isset($_GET["action"]))			{$action=$_GET["action"];}
	elseif (isset($_POST["action"]))	{$action=$_POST["action"];}
	if (isset($_GET["list"]))			{$list=$_GET["list"];}
	elseif (isset($_POST["list"]))		{$list=$_POST["list"];}
	if (isset($_GET["direction"]))		{$direction=$_GET["direction"];}
	elseif (isset($_POST["direction"]))	{$direction=$_POST["direction"];}
	
	if($direction=="inbound"){
		$type_sql = "_inbound";
	}else{
		$type_sql = "";
	}
	if(empty($list)){
		$list = "SYSTEM_INTERNAL";
	}
	if($action=="dnc"){
?>
	DNC Phone Number
	<table width="100%">
	  <tr style="font-weight:bold; background-color:#ffcc00; color: #FFF;">
	    <td>EVENT DATE</td>
		<td>LIST</td>
	    <td>USER</td>
	    <td>RECORD ID</td>
        <td>NOTES</td>
      </tr>
      <?php
		if($list == "SYSTEM_INTERNAL"){
			$stmt = "SELECT phone_number,max(event_date),user,event_notes,max(admin_log_id) from vicidial_dnc$type_sql a,vicidial_admin_log b where a.phone_number=b.record_id and b.event_sql like 'INSERT INTO vicidial_dnc$type_sql (phone_number) values%' group by phone_number";
		}else{
			$stmt = "SELECT phone_number,max(event_date),user,event_notes,max(admin_log_id) from vicidial_campaign_dnc$type_sql a,vicidial_admin_log b where a.phone_number=b.record_id and a.campaign_id = '".$list."' and b.event_sql like \"INSERT INTO vicidial_campaign_dnc$type_sql%'$list'%\" group by phone_number"; 
		}
	  	//echo $stmt;
		$rslt=mysql_query($stmt, $link);
		$count_temp = mysql_num_rows($rslt);
		$i = 0;
		if($DB) {echo "$stmt\n";}
		
		$dnc_array = array();
		$dncid_array = array();
		while($i< $count_temp){
			$row=mysql_fetch_row($rslt);
			
			$dnc_array[$row[0]]['EVENT_DATE'] = $row[1];
			$dnc_array[$row[0]]['USER'] = $row[2];
			$dncid_array[] = $row[4];
			$i++;
		}
		$dncid_str =implode(",",$dncid_array);
		
		$stmt = "select record_id,event_notes from vicidial_admin_log where admin_log_id in ($dncid_str) order by event_date desc";
		$rslt=mysql_query($stmt, $link);
		$count_temp = mysql_num_rows($rslt);
		$i = 0;
		if($DB) {echo "$stmt\n";}
		//echo "==>".$stmt;
		
		while($i< $count_temp){
			$row=mysql_fetch_row($rslt);
	  ?>
	  <tr <?php if($i%2==0){echo "bgcolor='#c2c2c2'";} ?>>
	    <td><?php echo $dnc_array[$row[0]]['EVENT_DATE']; ?></td>
		<td>
		<?php
			if($list == "SYSTEM_INTERNAL"){
				echo "SYSTEM";
			}else{
				echo $list;
			}
		?>
		</td>
	    <td><?php echo $dnc_array[$row[0]]['USER']; ?></td>
	    <td><?php echo $row[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
      </tr>
      <?php
			$i++;
		}
	  ?>
    </table>
<?php
	}else{
?>
	DNC Phone Number Log
	<table width="100%">
	  <tr style="font-weight:bold; background-color:#ffcc00; color: #FFF;">
	    <td>EVENT DATE</td>
		<td>LIST</td>
	    <td>USER</td>
	    <td>RECORD ID</td>
        <td>IP ADDRESS</td>
        <td>EVENT TYPE</td>
		<td>EVENT NOTES</td>
      </tr>
      <?php
		if($list == "SYSTEM_INTERNAL"){
			 $stmt = "SELECT event_date,user,record_id,ip_address,event_type,event_notes from vicidial_admin_log where (event_sql like '%vicidial_dnc$type_sql (phone_number) values%' or event_code='ADMIN DELETE NUMBER FROM DNC LIST') order by event_date desc LIMIT 0 , 10000";
		}else{
			$stmt = "SELECT event_date,user,record_id,ip_address,event_type,event_notes from vicidial_admin_log where (event_sql like \"INSERT INTO vicidial_campaign_dnc$type_sql%'$list'%\" or event_code=\"ADMIN DELETE NUMBER FROM CAMPAIGN DNC LIST $list\") order by event_date desc LIMIT 0 , 10000";
		}

//		echo $stmt."<hr>";
		$rslt=mysql_query($stmt, $link);
		$count_temp = mysql_num_rows($rslt);
		$i = 0;
		if($DB) {echo "$stmt\n";}
		while($i< $count_temp){
			$row=mysql_fetch_row($rslt);
	  ?>
	  <tr <?php if($i%2==0){echo "bgcolor='#c2c2c2'";} ?>>
	    <td><?php echo $row[0]; ?></td>
		<td>
		<?php
			if($list == "SYSTEM_INTERNAL"){
				echo "SYSTEM";
			}else{
				echo $list;
			}
		?>
		</td>
	    <td><?php echo $row[1]; ?></td>
	    <td><?php echo $row[2]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row[4]; ?></td>
		<td><?php echo $row[5]; ?></td>
      </tr>
      <?php
			$i++;
		}
	  ?>
    </table>
<?php
	}
?>
</div>
</center>
</BODY>
</html>