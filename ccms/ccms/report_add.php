<?php
$stmt = getCampaignSql($LOGuser_level,$LOGuser_name_id,'Y');
$rslt=mysql_query($stmt, $link);
$campaigns_to_print = mysql_num_rows($rslt);
$o=0;

while ($campaigns_to_print > $o) 
	{
	$row=mysql_fetch_row($rslt);
	$campaign_str .= "<option value=\"$row[0]\">$row[1]</option>";
	$o++;
	}
?>
<form name="form1" action=<?php echo $PHP_SELF;?> method="post" enctype="multipart/form-data">
<table width="750" border="0" cellspacing="3" > 
<tbody> 
<tr class="tr_bg_color">	
	<td width='20%' align="right"><b>Type</b></td><td>Value</td>
</tr>
<tr bgcolor="#C2C2C2">		
	<td align="right"><b>Category:</b></td><td><input type="text" name="category" size="40" value=""><br>(Like:Inbound Reports)</td>
</tr>
<tr bgcolor="#C2C2C2">	
	<td align="right"><b>Campaign_id:</b></td><td><select name="campaign_id">
<?php echo $campaign_str; ?>
</select></td>
</tr>
<tr bgcolor="#C2C2C2">
	<td align="right"><b>Title:</b></td><td><input type="text" name="title" id="title" size="40" value=""></td>
</tr>
<tr bgcolor="#C2C2C2">
	<td align="right"><b>Link:</b></td><td><input type="text" name="url" id="url" size="40" value=""><br>(Like:Inbound/AIA Inbound Performance Summary Report.prpt)</td>
</tr>

<tr bgcolor="#C2C2C2">
	<td align="right"><b>Is_open:</b></td><td><select name="is_open">
	<option value="Y">Y</option>
	<option value="N">N</option>
</select></td>
</tr> 
<tr bgcolor="#C2C2C2">
	<td align="right"><b>CN Or EN:</b></td><td><select name="cn_en">
	<option value="en">EN</option>
	<option value="cn">CN</option>
</select></td>
</tr> 
<tr bgcolor="#C2C2C2">
	<td align="right"><b>Attachments:</b></td><td><input type="hidden" name="max_file_size" value="2000000">
		<input name="file" type="file" size="40"><br><span class="small">(Maximum:2,000k)</span>
</td>
</tr> 
<tr>
	<td class="form-title" colspan="2" align="center"><input type=hidden name=ADD value="201211200945"><button onclick="document.forms.form1.submit();">Submit</button></td>
</tr>
</tbody>
</table>
</form> 
