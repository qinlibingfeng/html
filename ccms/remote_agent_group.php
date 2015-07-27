<?php
/**
require("dbconnect.php");
$ADD = $_REQUEST['ADD'];
$PHP_SELF = $_SERVER['PHP_SELF'];

$PHP_AUTH_USER = 'admin';

$stmt = "SELECT add_remoteagentgroups,modify_remoteagentgroups,delete_remoteagentgroups from vicidial_users where user='$PHP_AUTH_USER'";
$rs = mysql_query($stmt,$link);
while ($row = mysql_fetch_row($rs)){
	$LOGadd_remoteagentgroups = $row[0];
	$LOGmodify_remoteagentgroups = $row[1];
	$LOGdelete_remoteagentgroups = $row[2];
}
**/
if($ADD == 201315){ //show remote agent group list

?>
<table width="750" cellspacing="0" cellpadding="1">
<tbody>
	<tr class="tr_bg_color">
		<td height="20" ><font size="1" color="white"><b>Group Id</b></font></td>
		<td height="20" ><font size="1" color="white"><b>Group Name</b></font></td>
		<td height="20" ><font size="1" color="white"><b>Desciption</b></font></td>
		<td height="20" ><font size="1" color="white"><b>Modify</b></font></td>
	</tr>
	
<?php

$stmt = "select * from vicidial_remote_agent_groups";
$rs = mysql_query($stmt,$link);

$i = 1;
	
while($row = mysql_fetch_array($rs)){

	if($i%2 == 1) {
		echo "<tr bgcolor='#c2c2c2'><td align=\"left\">$row[0]</td><td align=\"left\">$row[1]</td><td align=\"left\">$row[2]</td><td align=\"left\"><a href=\"$PHP_SELF?ADD=201316&group_id=$row[0]\">Modify</a></td></tr>";
	}else {
		echo "<tr bgcolor='#ffffff'><td align=\"left\">$row[0]</td><td align=\"left\">$row[1]</td><td align=\"left\">$row[2]</td><td align=\"left\"><a href=\"$PHP_SELF?ADD=201316&group_id=$row[0]\">Modify</a></td></tr>";
	}
	$i++;
}


echo "</tbody></table>";

} 
?>




<?php
if($ADD == 201316){//modify remote agent group	

$group_id = $_REQUEST['group_id'];

?>
	<form method="POST" action="<?php echo $PHP_SELF;?>">
		<input type="hidden" value="2013161" name="ADD">
			<input type="hidden" value="<?php echo $group_id;?>" name="group_id">
			
		<table width="750" cellspacing="3">
			<tbody>
			
		
<?php	
	
	$stmt = "select * from vicidial_remote_agent_groups where group_id='$group_id'";
	$rs = mysql_query($stmt,$link);
	while ($row = mysql_fetch_row($rs)){
		echo "<tr bgcolor=\"#FFFFFF\"><td align=\"right\">Group Id:</td><td align=\"left\">$row[0]</td></tr>";
		echo "<tr bgcolor=\"#FFFFFF\"><td align=\"right\">Group Name:</td><td align=\"left\"><input type=\"text\" value=\"$row[1]\"        name=\"group_name\"></td></tr>";
		echo "<tr bgcolor=\"#FFFFFF\"><td align=\"right\">Desciption:</td><td align=\"left\"><input type=\"text\" value=\"$row[2]\"   name=\"desciption\"></td></tr>";
		echo "<tr bgcolor=\"#FFFFFF\"><td align=\"right\">Remark:</td><td align=\"left\"><input type=\"text\" value=\"$row[3]\"  name=\"remark\"></td></tr>";
		
		$group_name = $row[1];
	}
?>	
				<tr><td colspan="2" align="center"><input class="inputsubmit" type="submit" value="SUBMIT" name="SUBMIT"></td></tr>
				
			</tbody>
		</table>
			</form>
	<br>
	<a href="<?php echo $PHP_SELF;?>?ADD=2013171&group_id=<?php echo $group_id?>&group_name=<?php echo $group_name;?>">DELETE THIS REMOTE AGENT GROUP</a>
<?php


}

if($ADD == 2013161){ // update remote agent group

	if($LOGmodify_remoteagentgroups == 1){

		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		$desciption = $_REQUEST['desciption'];
		$remark = $_REQUEST['remark'];
		
		$stmt = "SELECT * FROM vicidial_remote_agent_groups WHERE group_name='$group_name' AND group_id<>'$group_id'";
		$rs=mysql_query($stmt);
		$rs_num = mysql_num_rows($rs);
		if($rs_num > 0 ) {echo "Duplicate Remote Agent Group Name: $group_name!";exit; }
		
		$query = "update vicidial_remote_agent_groups set group_name='$group_name',desciption='$desciption',remark='$remark' where group_id='$group_id'";
		$rslt=mysql_query($query);
		$num = mysql_affected_rows();
		
		if($num >0 ){
			echo "Update Success!!!";
		}
	}else{
		echo "You do not have permission to view this page\n";
		exit;
	}
}

if($ADD == 2013171){

	if($LOGdelete_remoteagentgroups == 1){
		$group_id = $_REQUEST['group_id'];
		$group_name = $_REQUEST['group_name'];
		echo "<a href=\"$PHP_SELF?ADD=201318&group_id=$group_id&CoNfIrM=YES\">Click here to delete  remote agent group: $group_name!</a>";
	}else{
		echo "You do not have permission to view this page\n";
		exit;
	}	
}

if($ADD == 201318){ // delete remote agent group
	$group_id = $_REQUEST['group_id'];
	$query = "delete from vicidial_remote_agent_groups where group_id='$group_id'";
	$rslt=mysql_query($query);
	$num = mysql_affected_rows();
	
	if($num >0 ){
		echo "Delete Success!!!";
	}
}
?>


<?php
if($ADD == 201319){//add remote agent group	
	if($LOGadd_remoteagentgroups == 1){

?>

ADD NEW REMOTE AGENT GROUP<br>

	<form method="POST" action="<?php echo $PHP_SELF;?>">
		<input type="hidden" value="2013191" name="ADD">	
		<table width="750" cellspacing="3">
			<tbody>			
			<tr bgcolor="#FFFFFF"><td align="right">Group Name:</td><td align="left"><input type="text" value="" name="group_name"></td></tr>
			<tr bgcolor="#FFFFFF"><td align="right">Desciption:</td><td align="left"><input type="text" value="" name="desciption"></td></tr>
			<tr bgcolor="#FFFFFF"><td align="right">Remark:</td><td align="left"><input type="text" value="" name="remark"></td></tr>
			
			<tr><td colspan="2" align="center"><input class="inputsubmit" type="submit" value="SUBMIT" name="SUBMIT"></td></tr>
				
			</tbody>
		</table>
		</form>
<?php
	}else{
		echo "You do not have permission to view this page\n";
		exit;
	}
}
?>


		
<?php	
if($ADD == 2013191){ // add remote agent group
	$group_name = $_REQUEST['group_name'];
	$desciption = $_REQUEST['desciption'];
	$remark = $_REQUEST['remark'];
	
	$stmt = "SELECT * FROM vicidial_remote_agent_groups WHERE group_name='$group_name'";
	$rs=mysql_query($stmt);
	$rs_num = mysql_num_rows($rs);
	if($rs_num > 0 ) {echo "Duplicate Remote Agent Group Name: $group_name!";exit; }
	
	
	$query = "INSERT INTO vicidial_remote_agent_groups (group_name,desciption,remark) VALUES('$group_name','$desciption','$remark')";
	$rslt=mysql_query($query);
	$num = mysql_affected_rows();
	
	if($num >0 ){
		echo "Add Success!!!";
	}
	
}
?>	

				

