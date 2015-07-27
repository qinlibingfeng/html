<style>
td{font-size:13px}
</style>
<div>
<input id="vicidial_id" name="vicidial_id" value="" type="hidden" size="120" />
<table width="202" height="22" border="1" cellpadding="1" cellspacing="0">
	<tr>
    	<td height="20" bgcolor="#CCCCCC"><strong>Name</strong></td>
        <td bgcolor="#CCCCCC"><strong>Value</strong></td>
    </tr>
<?php
$i=0;

foreach($_GET as $Tag_Name=>$Tag_Value){
	$i++;
	if($i%2==0){
		$color="#F9FBFC";
	}else{
		$color="";	
	}
	echo "<tr bgcolor='$color' ><td>".$Tag_Name."</td><td>".$Tag_Value."&nbsp;</td><tr>";
}
?>
</table>
</div>