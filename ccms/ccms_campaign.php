<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CCMS</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 14px;
}
-->
</style></head>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<script language="Javascript">
	function openNewWindow(url) {
	  window.open (url,"",'width=620,height=300,scrollbars=yes,menubar=yes,address=yes');
	}
	function checkData(){
		
		var obj1 = document.getElementById("Auto_Submit_Dispo");
		var obj2 = document.getElementById("default_call_result");
		var obj3 = document.getElementById("ccms_form");

		if(obj1.selectedIndex == 0 && obj2.selectedIndex==0){
			alert("'Default Call Result' can't be 'NONE'");
			return false;
		}
		return true;
	}
</script>
<?php
	require("dbconnect.php");
	mysql_query("set names utf8",$link);
	if (isset($_GET["modify"]))			{$modify=$_GET["modify"];}
	elseif (isset($_POST["modify"]))	{$modify=$_POST["modify"];}
	
	if (isset($_GET["campaign"]))			{$campaign=$_GET["campaign"];}
	elseif (isset($_POST["campaign"]))	{$campaign=$_POST["campaign"];}
	$success = "";
	if($modify=="yes"){
		if (isset($_GET["Manual_Ring_Launch"]))			{$Manual_Ring_Launch=$_GET["Manual_Ring_Launch"];}
			elseif (isset($_POST["Manual_Ring_Launch"]))	{$Manual_Ring_Launch=$_POST["Manual_Ring_Launch"];}
		if (isset($_GET["Custom_Dispo"]))			{$Custom_Dispo=$_GET["Custom_Dispo"];}
			elseif (isset($_POST["Custom_Dispo"]))	{$Custom_Dispo=$_POST["Custom_Dispo"];}
		if (isset($_GET["Custom_Dispo_Script"]))			{$Custom_Dispo_Script=$_GET["Custom_Dispo_Script"];}
			elseif (isset($_POST["Custom_Dispo_Script"]))	{$Custom_Dispo_Script=$_POST["Custom_Dispo_Script"];}
		if (isset($_GET["WebForm_Button_Display"]))			{$WebForm_Button_Display=$_GET["WebForm_Button_Display"];}
			elseif (isset($_POST["WebForm_Button_Display"]))	{$WebForm_Button_Display=$_POST["WebForm_Button_Display"];}
		if (isset($_GET["Default_Pause_Code_Enable"]))			{$Default_Pause_Code_Enable=$_GET["Default_Pause_Code_Enable"];}
			elseif (isset($_POST["Default_Pause_Code_Enable"]))	{$Default_Pause_Code_Enable=$_POST["Default_Pause_Code_Enable"];}
		if (isset($_GET["Agent_First_Login_Time"]))			{$Agent_First_Login_Time=$_GET["Agent_First_Login_Time"];}
			elseif (isset($_POST["Agent_First_Login_Time"]))	{$Agent_First_Login_Time=$_POST["Agent_First_Login_Time"];}
		if (isset($_GET["Conference_Channel_Display"]))			{$Conference_Channel_Display=$_GET["Conference_Channel_Display"];}
			elseif (isset($_POST["Conference_Channel_Display"]))	{$Conference_Channel_Display=$_POST["Conference_Channel_Display"];}
		if (isset($_GET["Xfer_Blind_Display"]))			{$Xfer_Blind_Display=$_GET["Xfer_Blind_Display"];}
			elseif (isset($_POST["Xfer_Blind_Display"]))	{$Xfer_Blind_Display=$_POST["Xfer_Blind_Display"];}
		if (isset($_GET["Xfer_Local_Closer_Display"]))			{$Xfer_Local_Closer_Display=$_GET["Xfer_Local_Closer_Display"];}
			elseif (isset($_POST["Xfer_Local_Closer_Display"]))	{$Xfer_Local_Closer_Display=$_POST["Xfer_Local_Closer_Display"];}
		if (isset($_GET["Xfer_Dial_With_Customer_Display"]))			{$Xfer_Dial_With_Customer_Display=$_GET["Xfer_Dial_With_Customer_Display"];}
			elseif (isset($_POST["Xfer_Dial_With_Customer_Display"]))	{$Xfer_Dial_With_Customer_Display=$_POST["Xfer_Dial_With_Customer_Display"];}
		if (isset($_GET["Parked_Channel_Value"]))			{$Parked_Channel_Value=$_GET["Parked_Channel_Value"];}
			elseif (isset($_POST["Parked_Channel_Value"]))	{$Parked_Channel_Value=$_POST["Parked_Channel_Value"];}
		if (isset($_GET["IM_Enable"]))			{$IM_Enable=$_GET["IM_Enable"];}
			elseif (isset($_POST["IM_Enable"]))	{$IM_Enable=$_POST["IM_Enable"];}
			
		if (isset($_GET["phone_place_enable"]))			{$phone_place_enable=$_GET["phone_place_enable"];}
			elseif (isset($_POST["phone_place_enable"]))	{$phone_place_enable=$_POST["phone_place_enable"];}
		if (isset($_GET["Phone_Place_DB_Server_IP"]))			{$Phone_Place_DB_Server_IP=$_GET["Phone_Place_DB_Server_IP"];}
			elseif (isset($_POST["Phone_Place_DB_Server_IP"]))	{$Phone_Place_DB_Server_IP=$_POST["Phone_Place_DB_Server_IP"];}
		if (isset($_GET["Phone_Place_DB_Name"]))			{$Phone_Place_DB_Name=$_GET["Phone_Place_DB_Name"];}
			elseif (isset($_POST["Phone_Place_DB_Name"]))	{$Phone_Place_DB_Name=$_POST["Phone_Place_DB_Name"];}
		if (isset($_GET["Phone_Place_DB_Login"]))			{$Phone_Place_DB_Login=$_GET["Phone_Place_DB_Login"];}
			elseif (isset($_POST["Phone_Place_DB_Login"]))	{$Phone_Place_DB_Login=$_POST["Phone_Place_DB_Login"];}
		if (isset($_GET["Phone_Place_DB_Password"]))			{$Phone_Place_DB_Password=$_GET["Phone_Place_DB_Password"];}
			elseif (isset($_POST["Phone_Place_DB_Password"]))	{$Phone_Place_DB_Password=$_POST["Phone_Place_DB_Password"];}
		if (isset($_GET["Phone_Place_Defaul"]))			{$Phone_Place_Defaul=$_GET["Phone_Place_Defaul"];}
			elseif (isset($_POST["Phone_Place_Defaul"]))	{$Phone_Place_Defaul=$_POST["Phone_Place_Defaul"];}			
			
		if (isset($_GET["IM_Talk_Level"]))			{$IM_Talk_Level=$_GET["IM_Talk_Level"];}
			elseif (isset($_POST["IM_Talk_Level"]))	{$IM_Talk_Level=$_POST["IM_Talk_Level"];}
		if (isset($_GET["IM_Admin_Level"]))			{$IM_Admin_Level=$_GET["IM_Admin_Level"];}
			elseif (isset($_POST["IM_Admin_Level"]))	{$IM_Admin_Level=$_POST["IM_Admin_Level"];}
		if (isset($_GET["Lead_Preview_Display"]))			{$Lead_Preview_Display=$_GET["Lead_Preview_Display"];}
			elseif (isset($_POST["Lead_Preview_Display"]))	{$Lead_Preview_Display=$_POST["Lead_Preview_Display"];}
		if (isset($_GET["Dial_Next_Display"]))			{$Dial_Next_Display=$_GET["Dial_Next_Display"];}
			elseif (isset($_POST["Dial_Next_Display"]))	{$Dial_Next_Display=$_POST["Dial_Next_Display"];}
		if (isset($_GET["Xfer_Answer_Machine_Message_Display"]))			{$Xfer_Answer_Machine_Message_Display=$_GET["Xfer_Answer_Machine_Message_Display"];}
			elseif (isset($_POST["Xfer_Answer_Machine_Message_Display"]))	{$Xfer_Answer_Machine_Message_Display=$_POST["Xfer_Answer_Machine_Message_Display"];}
		if (isset($_GET["Fast_Hangup_Xferline_And_Grab_Custline"]))			{$Fast_Hangup_Xferline_And_Grab_Custline=$_GET["Fast_Hangup_Xferline_And_Grab_Custline"];}
			elseif (isset($_POST["Fast_Hangup_Xferline_And_Grab_Custline"]))	{$Fast_Hangup_Xferline_And_Grab_Custline=$_POST["Fast_Hangup_Xferline_And_Grab_Custline"];}
		if (isset($_GET["Xfer_Target_Unavailable_Remind_Enable"]))			{$Xfer_Target_Unavailable_Remind_Enable=$_GET["Xfer_Target_Unavailable_Remind_Enable"];}
			elseif (isset($_POST["Xfer_Target_Unavailable_Remind_Enable"]))	{$Xfer_Target_Unavailable_Remind_Enable=$_POST["Xfer_Target_Unavailable_Remind_Enable"];}
		if (isset($_GET["Ingroup_Change_Enable"]))			{$Ingroup_Change_Enable=$_GET["Ingroup_Change_Enable"];}
			elseif (isset($_POST["Ingroup_Change_Enable"]))	{$Ingroup_Change_Enable=$_POST["Ingroup_Change_Enable"];}
		if (isset($_GET["Skip_Choose_Ingroup_Enable"]))			{$Skip_Choose_Ingroup_Enable=$_GET["Skip_Choose_Ingroup_Enable"];}
			elseif (isset($_POST["Skip_Choose_Ingroup_Enable"]))	{$Skip_Choose_Ingroup_Enable=$_POST["Skip_Choose_Ingroup_Enable"];}
		if (isset($_GET["Incoming_Web_Play_Music_Enable"]))			{$Incoming_Web_Play_Music_Enable=$_GET["Incoming_Web_Play_Music_Enable"];}
			elseif (isset($_POST["Incoming_Web_Play_Music_Enable"]))	{$Incoming_Web_Play_Music_Enable=$_POST["Incoming_Web_Play_Music_Enable"];}
		if (isset($_GET["Incoming_Web_Play_Music_Filename"]))			{$Incoming_Web_Play_Music_Filename=$_GET["Incoming_Web_Play_Music_Filename"];}
			elseif (isset($_POST["Incoming_Web_Play_Music_Filename"]))	{$Incoming_Web_Play_Music_Filename=$_POST["Incoming_Web_Play_Music_Filename"];}
		if (isset($_GET["Xfer_Waiting_Web_Play_Music_Enable"]))			{$Xfer_Waiting_Web_Play_Music_Enable=$_GET["Xfer_Waiting_Web_Play_Music_Enable"];}
			elseif (isset($_POST["Xfer_Waiting_Web_Play_Music_Enable"]))	{$Xfer_Waiting_Web_Play_Music_Enable=$_POST["Xfer_Waiting_Web_Play_Music_Enable"];}
		if (isset($_GET["Xfer_Waiting_Web_Play_Music_Filename"]))			{$Xfer_Waiting_Web_Play_Music_Filename=$_GET["Xfer_Waiting_Web_Play_Music_Filename"];}
			elseif (isset($_POST["Xfer_Waiting_Web_Play_Music_Filename"]))	{$Xfer_Waiting_Web_Play_Music_Filename=$_POST["Xfer_Waiting_Web_Play_Music_Filename"];}
		if (isset($_GET["Customer_Hangup_Goto_Dispo_Enable"]))			{$Customer_Hangup_Goto_Dispo_Enable=$_GET["Customer_Hangup_Goto_Dispo_Enable"];}
			elseif (isset($_POST["Customer_Hangup_Goto_Dispo_Enable"]))	{$Customer_Hangup_Goto_Dispo_Enable=$_POST["Customer_Hangup_Goto_Dispo_Enable"];}
					if (isset($_GET["Auto_Submit_Dispo"]))			{$Auto_Submit_Dispo=$_GET["Auto_Submit_Dispo"];}
			elseif (isset($_POST["Auto_Submit_Dispo"]))	{$Auto_Submit_Dispo=$_POST["Auto_Submit_Dispo"];}
		if (isset($_GET["dtmf_enable"]))			{$dtmf_enable=$_GET["dtmf_enable"];}
			elseif (isset($_POST["dtmf_enable"]))	{$dtmf_enable=addslashes($_POST["dtmf_enable"]);}
		if (isset($_GET["Pause_Code_Selected_Link_Display"]))			{$Pause_Code_Selected_Link_Display=$_GET["Pause_Code_Selected_Link_Display"];}
			elseif (isset($_POST["Pause_Code_Selected_Link_Display"]))	{$Pause_Code_Selected_Link_Display=$_POST["Pause_Code_Selected_Link_Display"];}
		if (isset($_GET["Default_Pause_Code"]))			{$Default_Pause_Code=$_GET["Default_Pause_Code"];}
			elseif (isset($_POST["Default_Pause_Code"]))	{$Default_Pause_Code=$_POST["Default_Pause_Code"];}
		if (isset($_GET["inbound_did_arr"]))			{$inbound_did_arr=$_GET["inbound_did_arr"];}
			elseif (isset($_POST["inbound_did_arr"]))	{$inbound_did_arr=$_POST["inbound_did_arr"];}
		if (isset($_GET["inbound_ivr"]))			{$inbound_ivr=$_GET["inbound_ivr"];}
			elseif (isset($_POST["inbound_ivr"]))	{$inbound_ivr=$_POST["inbound_ivr"];}
		if (isset($_GET["ccms_project"]))			{$ccms_project=$_GET["ccms_project"];}
			elseif (isset($_POST["ccms_project"]))	{$ccms_project=$_POST["ccms_project"];}
		if (isset($_GET["default_call_result"]))			{$default_call_result=$_GET["default_call_result"];}
			elseif (isset($_POST["default_call_result"]))	{$default_call_result=$_POST["default_call_result"];}
		if (isset($_GET["extension_info_sql"]))			{$extension_info_sql=$_GET["extension_info_sql"];}
			elseif (isset($_POST["extension_info_sql"]))	{$extension_info_sql=addslashes($_POST["extension_info_sql"]);}

		if (isset($_GET["auto_dispo_time"]))			{$auto_dispo_time=$_GET["auto_dispo_time"];}
			elseif (isset($_POST["auto_dispo_time"]))	{$auto_dispo_time=addslashes($_POST["auto_dispo_time"]);}
		
		if (isset($_GET["CCMS_Agent_Window_Align"]))			{$CCMS_Agent_Window_Align=$_GET["CCMS_Agent_Window_Align"];}
			elseif (isset($_POST["CCMS_Agent_Window_Align"]))	{$CCMS_Agent_Window_Align=$_POST["CCMS_Agent_Window_Align"];}
		if (isset($_GET["CCMS_Agent_Window_Width"]))			{$CCMS_Agent_Window_Width=$_GET["CCMS_Agent_Window_Width"];}
			elseif (isset($_POST["CCMS_Agent_Window_Width"]))	{$CCMS_Agent_Window_Width=addslashes($_POST["CCMS_Agent_Window_Width"]);}
			
			
		if (isset($_GET["Extension_Info_Integration_Enable"]))			{$Extension_Info_Integration_Enable=$_GET["Extension_Info_Integration_Enable"];}
			elseif (isset($_POST["Extension_Info_Integration_Enable"]))	{$Extension_Info_Integration_Enable=addslashes($_POST["Extension_Info_Integration_Enable"]);}
		if (isset($_GET["Extension_Info_Db_Server_Ip"]))			{$Extension_Info_Db_Server_Ip=$_GET["Extension_Info_Db_Server_Ip"];}
			elseif (isset($_POST["Extension_Info_Db_Server_Ip"]))	{$Extension_Info_Db_Server_Ip=addslashes($_POST["Extension_Info_Db_Server_Ip"]);}
		if (isset($_GET["Extension_Info_Db_Name"]))			{$Extension_Info_Db_Name=$_GET["Extension_Info_Db_Name"];}
			elseif (isset($_POST["Extension_Info_Db_Name"]))	{$Extension_Info_Db_Name=addslashes($_POST["Extension_Info_Db_Name"]);}
		if (isset($_GET["Extension_Info_Db_Login"]))			{$Extension_Info_Db_Login=$_GET["Extension_Info_Db_Login"];}
			elseif (isset($_POST["Extension_Info_Db_Login"]))	{$Extension_Info_Db_Login=addslashes($_POST["Extension_Info_Db_Login"]);}
		if (isset($_GET["Extension_Info_Db_Password"]))			{$Extension_Info_Db_Password=$_GET["Extension_Info_Db_Password"];}
			elseif (isset($_POST["Extension_Info_Db_Password"]))	{$Extension_Info_Db_Password=addslashes($_POST["Extension_Info_Db_Password"]);}
		if (isset($_GET["agent_available_reset_codde"]))			{$agent_available_reset_codde=$_GET["agent_available_reset_codde"];}
			elseif (isset($_POST["agent_available_reset_codde"]))	{$agent_available_reset_codde=addslashes($_POST["agent_available_reset_codde"]);}
		if (isset($_GET["agent_available_reset"]))			{$agent_available_reset=$_GET["agent_available_reset"];}
			elseif (isset($_POST["agent_available_reset"]))	{$agent_available_reset=addslashes($_POST["agent_available_reset"]);}	
			
		if (isset($_GET["Max_Pauses"]))			{$Max_Pauses=$_GET["Max_Pauses"];}
			elseif (isset($_POST["Max_Pauses"]))	{$Max_Pauses=addslashes($_POST["Max_Pauses"]);}
		
		$inbound_dids = implode(" ",$inbound_did_arr);
		
		$stmt = "update ccms_campaigns set manual_Ring_Launch='$Manual_Ring_Launch',custom_Dispo='$Custom_Dispo',custom_Dispo_Script='$Custom_Dispo_Script',webForm_Button_Display='$WebForm_Button_Display',Default_Pause_Code_Enable='$Default_Pause_Code_Enable',agent_First_Login_Time='$Agent_First_Login_Time',Conference_Channel_Display='$Conference_Channel_Display',Xfer_Blind_Display='$Xfer_Blind_Display',Xfer_Local_Closer_Display='$Xfer_Local_Closer_Display',Xfer_Dial_With_Customer_Display='$Xfer_Dial_With_Customer_Display',parked_Channel_Value='$Parked_Channel_Value',im_Enable='$IM_Enable',phone_place_enable='$phone_place_enable',im_Talk_Level='$IM_Talk_Level',im_Admin_Level='$IM_Admin_Level',Lead_Preview_Display='$Lead_Preview_Display',Dial_Next_Display='$Dial_Next_Display',Xfer_Answer_Machine_Message_Display='$Xfer_Answer_Machine_Message_Display',fast_Hangup_Xferline_And_Grab_Custline='$Fast_Hangup_Xferline_And_Grab_Custline',Xfer_Target_Unavailable_Remind_Enable='$Xfer_Target_Unavailable_Remind_Enable',ingroup_Change_Enable='$Ingroup_Change_Enable',Skip_Choose_Ingroup_Enable='$Skip_Choose_Ingroup_Enable',Incoming_Web_Play_Music_Enable='$Incoming_Web_Play_Music_Enable',Incoming_Web_Play_Music_Filename='$Incoming_Web_Play_Music_Filename',Xfer_Waiting_Web_Play_Music_Enable='$Xfer_Waiting_Web_Play_Music_Enable',Xfer_Waiting_Web_Play_Music_Filename='$Xfer_Waiting_Web_Play_Music_Filename',Customer_Hangup_Goto_Dispo_Enable='$Customer_Hangup_Goto_Dispo_Enable',Pause_Code_Selected_Link_Display='$Pause_Code_Selected_Link_Display',max_pauses='$Max_Pauses',Default_Pause_Code='$Default_Pause_Code',inbound_ivr='$inbound_ivr',inbound_dids='$inbound_dids',ccms_project='$ccms_project',extension_info_sql='$extension_info_sql',default_call_result='$default_call_result',extension_info_integration_enable='$Extension_Info_Integration_Enable',extension_info_db_server_ip='$Extension_Info_Db_Server_Ip',extension_info_db_name='$Extension_Info_Db_Name',extension_info_db_login='$Extension_Info_Db_Login',extension_info_db_password='$Extension_Info_Db_Password',phone_place_db_server_ip='$Phone_Place_DB_Server_IP',phone_place_db_name='$Phone_Place_DB_Name',phone_place_db_login='$Phone_Place_DB_Login',phone_place_db_password='$Phone_Place_DB_Password',phone_place_default='$Phone_Place_Defaul',ccms_agent_window_align='$CCMS_Agent_Window_Align',ccms_agent_window_width='$CCMS_Agent_Window_Width',auto_submit_dispo='$Auto_Submit_Dispo',auto_dispo_time='$auto_dispo_time',dtmf_enable='$dtmf_enable',agent_available_reset_codde='$agent_available_reset_codde',agent_available_reset='$agent_available_reset' where campaign_id = '$campaign'";
		//echo $stmt;exit;
		$rslt=mysql_query($stmt, $link);
		$success="yes";
	}
	
	$stmt = "SELECT manual_Ring_Launch,custom_Dispo,custom_Dispo_Script,webForm_Button_Display,Default_Pause_Code_Enable,agent_First_Login_Time,Conference_Channel_Display,Xfer_Blind_Display,Xfer_Local_Closer_Display,Xfer_Dial_With_Customer_Display,parked_Channel_Value,im_Enable,phone_place_enable,im_Talk_Level,im_Admin_Level,Lead_Preview_Display,Dial_Next_Display,Xfer_Answer_Machine_Message_Display,fast_Hangup_Xferline_And_Grab_Custline,Xfer_Target_Unavailable_Remind_Enable,ingroup_Change_Enable,Skip_Choose_Ingroup_Enable,Incoming_Web_Play_Music_Enable,Incoming_Web_Play_Music_Filename,Xfer_Waiting_Web_Play_Music_Enable,Xfer_Waiting_Web_Play_Music_Filename,Customer_Hangup_Goto_Dispo_Enable,Pause_Code_Selected_Link_Display,Default_Pause_Code,inbound_dids,inbound_ivr,ccms_project,extension_info_sql,default_call_result,extension_info_integration_enable,extension_info_db_server_ip,extension_info_db_name,extension_info_db_login,extension_info_db_password,phone_place_db_server_ip,phone_place_db_name,phone_place_db_login,phone_place_db_password,phone_place_default,ccms_agent_window_align,ccms_agent_window_width,auto_submit_dispo,auto_dispo_time,dtmf_enable,agent_available_reset_codde,agent_available_reset,max_pauses from ccms_campaigns where campaign_id = '$campaign'";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	
	$Manual_Ring_Launch=$row[0];
	$Custom_Dispo=$row[1];
	$Custom_Dispo_Script=$row[2]; 
	$WebForm_Button_Display=$row[3];
	$Default_Pause_Code_Enable=$row[4];
	$Agent_First_Login_Time=$row[5];
	$Conference_Channel_Display= $row[6];
	$Xfer_Blind_Display=$row[7];
	$Xfer_Local_Closer_Display=$row[8];
	$Xfer_Dial_With_Customer_Display=$row[9];
	$Parked_Channel_Value=$row[10];
	$IM_Enable=$row[11];
	$phone_place_enable = $row[12];
	$IM_Talk_Level=$row[13];
	$IM_Admin_Level=$row[14];
	$Lead_Preview_Display=$row[15];
	$Dial_Next_Display=$row[16];
	$Xfer_Answer_Machine_Message_Display=$row[17];
	$Fast_Hangup_Xferline_And_Grab_Custline=$row[18];
	$Xfer_Target_Unavailable_Remind_Enable=$row[19];
	$Ingroup_Change_Enable=$row[20];
	$Skip_Choose_Ingroup_Enable = $row[21];
	$Incoming_Web_Play_Music_Enable = $row[22];
	$Incoming_Web_Play_Music_Filename = $row[23];
	$Xfer_Waiting_Web_Play_Music_Enable = $row[24];
	$Xfer_Waiting_Web_Play_Music_Filename = $row[25];
	$Customer_Hangup_Goto_Dispo_Enable = $row[26];
	$Pause_Code_Selected_Link_Display = $row[27];
	$Default_Pause_Code = $row[28];
	$inbound_dids = $row[29];
	$inbound_ivr = $row[30];
	$ccms_project = $row[31];
	$extension_info_sql = htmlspecialchars($row[32]);
	$default_call_result = $row[33];
	
	$Extension_Info_Integration_Enable = $row[34];
	$Extension_Info_Db_Server_Ip = $row[35];
	$Extension_Info_Db_Name = $row[36];
	$Extension_Info_Db_Login = $row[37];
	$Extension_Info_Db_Password = $row[38];
	
	$Phone_Place_DB_Server_IP = $row[39];
	$Phone_Place_DB_Name = $row[40];
	$Phone_Place_DB_Login = $row[41];
	$Phone_Place_DB_Password = $row[42];
	$Phone_Place_Defaul = $row[43];
	$CCMS_Agent_Window_Align = $row[44];
	$CCMS_Agent_Window_Width = $row[45];
	$Auto_Submit_Dispo = $row[46];
	$auto_dispo_time = $row[47];
	$dtmf_enable = $row[48];
	$agent_available_reset_codde = $row[49];
	$agent_available_reset = $row[50];
	$Max_Pauses = $row[51];
?>
<form name="ccms_form" id="ccms_form" action="ccms_campaign.php" method="POST"  onsubmit="return checkData();">
<table width="100%" border="0" cellpadding="5">
	  <tr>
	    <td colspan="2" align="center">
        	<span style="font-weight:bold;">Modify More Campaign Info(<?PHP echo $campaign; ?>)</span><?php if($success=="yes"){ ?><span style="color:#F00;">&nbsp;&nbsp;&nbsp;Modify Success!</span><?php } ?>
        </td>
    </tr>
	  <tr bgcolor="#f5f5f5">
	    <td width="53%" align="right">Manual Ring Launch</td>
	    <td width="47%">
			<select name="Manual_Ring_Launch" size="1"><option <?php if($Manual_Ring_Launch=="SCRIPT") echo "selected"; ?>>SCRIPT</option><option <?php if($Manual_Ring_Launch=="NONE") echo "selected"; ?>>NONE</option></select><a href="javascript:openNewWindow('admin.php?ADD=99999#more_manual_ring_launch')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Custom Dispo</td>
	    <td><select name="Custom_Dispo" size="1"><option <?php if($Custom_Dispo=="Y") echo "selected"; ?>>Y</option><option <?php if($Custom_Dispo=="N") echo "selected"; ?>>N</option></select><a href="javascript:openNewWindow('admin.php?ADD=99999#more_custom_dispo')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a></td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Custom Dispo Script </td>
	    <td><input type="text" value="<?php echo $Custom_Dispo_Script; ?>" maxlength="50" size="18" name="Custom_Dispo_Script">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_custom_dispo_script')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Customer Hangup Goto Dispo Enable</td>
	    <td><select name="Customer_Hangup_Goto_Dispo_Enable" size="1"><option <?php if($Customer_Hangup_Goto_Dispo_Enable=="Y") echo "selected"; ?>>Y</option><option <?php if($Customer_Hangup_Goto_Dispo_Enable=="N") echo "selected"; ?>>N</option></select>
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_customer_hangup_goto_dispo_enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  <tr bgcolor="#f5f5a0">
	    <td align="right">Auto Submit Dispo</td>
	    <td><select name="Auto_Submit_Dispo" id="Auto_Submit_Dispo" size="1"><option <?php if($Auto_Submit_Dispo=="Y") echo "selected"; ?>>Y</option><option <?php if($Auto_Submit_Dispo=="N") echo "selected"; ?>>N</option></select>
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Auto_Submit_Dispo')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>  <tr bgcolor="#f5f5a0">
	    <td align="right">Auto Dispo Time</td>
	    <td><input type="text" value="<?php echo $auto_dispo_time; ?>" maxlength="50" size="18" name="auto_dispo_time">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_auto_dispo_time')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  <?php
	//select
	
	function get_default_call_result_select($default_call_result,$campaign){
		global $link;
		mysql_query("SET NAMES 'UTF8'");
		$inbound_ivr_select = "<select name=\"default_call_result\" id=\"default_call_result\" style=\"width:200px;\"><option value=\"\">NONE</option>";
		//system
		$stmt="SELECT status,status_name FROM vicidial_statuses WHERE selectable='Y' and status != 'NEW' order by status limit 50";
		$rslt=mysql_query($stmt, $link);
		$menus_to_print = mysql_num_rows($rslt);
		$o=0;
		while ($menus_to_print > $o) 
		{
			$row=mysql_fetch_row($rslt);
			if($default_call_result==$row[0]){
				$inbound_ivr_select = $inbound_ivr_select . "<option value=\"$row[0]\" selected>System-$row[1]</option>";
			}else{
				$inbound_ivr_select = $inbound_ivr_select . "<option value=\"$row[0]\">System-$row[1]</option>";
			}
			$o++;
		}
		//campaign
		$stmt="SELECT status,status_name FROM vicidial_campaign_statuses WHERE selectable='Y' and status != 'NEW' and campaign_id='$campaign' order by status limit 80";
		//echo $stmt;exit;
		$rslt=mysql_query($stmt, $link);
		$menus_to_print = mysql_num_rows($rslt);
		$o=0;
		while ($menus_to_print > $o) 
		{
			$row=mysql_fetch_row($rslt);
			if($default_call_result==$row[0]){
				$inbound_ivr_select = $inbound_ivr_select . "<option value=\"$row[0]\" selected>$campaign-$row[1]</option>";
			}else{
				$inbound_ivr_select = $inbound_ivr_select . "<option value=\"$row[0]\">$campaign-$row[1]</option>";
			}
			$o++;
		}
		$inbound_ivr_select = $inbound_ivr_select . "</select>";
		return $inbound_ivr_select;
	}
  ?>
  	  <tr bgcolor="#f5f5a0">
	    <td align="right">Default Call Result </td>
	    <td><?php echo get_default_call_result_select($default_call_result,$campaign); ?>
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_default_call_result')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">WebForm Button Display</td>
	    <td>
			<select name="WebForm_Button_Display" size="1"><option <?php if($WebForm_Button_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($WebForm_Button_Display=="NONE") echo "selected"; ?>>NONE</option></select>
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_webForm_button_display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>

	  <tr bgcolor="#f5f5f5">
	    <td align="right">Conference Channel Display</td>
	    <td><select name="Conference_Channel_Display" size="1"><option <?php if($Conference_Channel_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($Conference_Channel_Display=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_conference_channel_display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">Xfer Blind Display</td>
	    <td><select name="Xfer_Blind_Display" size="1"><option <?php if($Xfer_Blind_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($Xfer_Blind_Display=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_xfer_blind_display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">Xfer Local Closer Display</td>
	    <td><select name="Xfer_Local_Closer_Display" size="1"><option <?php if($Xfer_Local_Closer_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($Xfer_Local_Closer_Display=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_xfer_local_closer_display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">Xfer Dial With Customer Display</td>
	    <td><select name="Xfer_Dial_With_Customer_Display" size="1"><option <?php if($Xfer_Dial_With_Customer_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($Xfer_Dial_With_Customer_Display=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_xfer_dial_with_customer_display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">Xfer Answer Machine Message Display</td>
	    <td><select name="Xfer_Answer_Machine_Message_Display" size="1"><option <?php if($Xfer_Answer_Machine_Message_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($Xfer_Answer_Machine_Message_Display=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_xfer_answer_machine_message_display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">Fast Hangup Xferline And Grab Custline</td>
	    <td><select name="Fast_Hangup_Xferline_And_Grab_Custline" size="1"><option <?php if($Fast_Hangup_Xferline_And_Grab_Custline=="Y") echo "selected"; ?>>Y</option><option <?php if($Fast_Hangup_Xferline_And_Grab_Custline=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Fast_Hangup_Xferline_And_Grab_Custline')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">Xfer Target Unavailable Remind Enable</td>
	    <td><select name="Xfer_Target_Unavailable_Remind_Enable" size="1"><option <?php if($Xfer_Target_Unavailable_Remind_Enable=="Y") echo "selected"; ?>>Y</option><option <?php if($Xfer_Target_Unavailable_Remind_Enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Xfer_Target_Unavailable_Remind_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">Xfer Waiting Web Play Music Enable</td>
	    <td><select name="Xfer_Waiting_Web_Play_Music_Enable" size="1"><option <?php if($Xfer_Waiting_Web_Play_Music_Enable=="Y") echo "selected"; ?>>Y</option><option <?php if($Xfer_Waiting_Web_Play_Music_Enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Xfer_Waiting_Web_Play_Music_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">Xfer Waiting Web Play Music Filename</td>
	    <td><input type="text" value="<?php echo $Xfer_Waiting_Web_Play_Music_Filename; ?>" maxlength="50" size="18" name="Xfer_Waiting_Web_Play_Music_Filename">
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Xfer_Waiting_Web_Play_Music_Filename')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Phone Place Enable</td>
	    <td><select name="phone_place_enable" size="1"><option <?php if($phone_place_enable=="Y") echo "selected"; ?>>Y</option><option <?php if($phone_place_enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_phone_place_enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  	  <tr bgcolor="#f5f5f5">
	    <td align="right">DTMF Enable</td>
	    <td><select name="dtmf_enable" size="1"><option <?php if($dtmf_enable=="Y") echo "selected"; ?>>Y</option><option <?php if($dtmf_enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Incoming_Web_Play_Music_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Phone Place DB Server IP </td>
	    <td><input type="text" value="<?php echo $Phone_Place_DB_Server_IP; ?>" maxlength="50" size="18" name="Phone_Place_DB_Server_IP">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Phone_Place_DB_Server_IP')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  	  <tr bgcolor="#f5f5a0">
	    <td align="right">Phone Place DB Name </td>
	    <td><input type="text" value="<?php echo $Phone_Place_DB_Name; ?>" maxlength="50" size="18" name="Phone_Place_DB_Name">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Phone_Place_DB_Name')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  	  <tr bgcolor="#f5f5a0">
	    <td align="right">Phone Place DB Login </td>
	    <td><input type="text" value="<?php echo $Phone_Place_DB_Login; ?>" maxlength="50" size="18" name="Phone_Place_DB_Login">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Phone_Place_DB_Login')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  	  <tr bgcolor="#f5f5a0">
	    <td align="right">Phone Place DB Password </td>
	    <td><input type="text" value="<?php echo $Phone_Place_DB_Password; ?>" maxlength="50" size="18" name="Phone_Place_DB_Password">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Phone_Place_DB_Password')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  	  <tr bgcolor="#f5f5a0">
	    <td align="right">Phone Place Defaul </td>
	    <td><input type="text" value="<?php echo $Phone_Place_Defaul; ?>" maxlength="50" size="18" name="Phone_Place_Defaul">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Phone_Place_Defaul')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Lead Preview Display</td>
	    <td><select name="Lead_Preview_Display" size="1"><option <?php if($Lead_Preview_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($Lead_Preview_Display=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Lead_Preview_Display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Dial Next Display</td>
	    <td><select name="Dial_Next_Display" size="1"><option <?php if($Dial_Next_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($Dial_Next_Display=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Dial_Next_Display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>

	  <tr bgcolor="#f5f5f5">
	    <td align="right">Ingroup Change Enable</td>
	    <td><select name="Ingroup_Change_Enable" size="1"><option <?php if($Ingroup_Change_Enable=="Y") echo "selected"; ?>>Y</option><option <?php if($Ingroup_Change_Enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Ingroup_Change_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Skip Choose Ingroup Enable</td>
	    <td><select name="Skip_Choose_Ingroup_Enable" size="1"><option <?php if($Skip_Choose_Ingroup_Enable=="Y") echo "selected"; ?>>Y</option><option <?php if($Skip_Choose_Ingroup_Enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Skip_Choose_Ingroup_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  <tr bgcolor="#f5f5a0">
	    <td align="right">Agent Available Reset</td>
	    <td><select name="agent_available_reset" id="agent_available_reset" size="1"><option <?php if($agent_available_reset=="Y") echo "selected"; ?>>Y</option><option <?php if($agent_available_reset=="N") echo "selected"; ?>>N</option></select>
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Auto_Submit_Dispo')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  <?php

	function get_pause_code_list2($agent_available_reset_codde,$VD_campaign){
		global $link;
		$stmt="SELECT pause_code,pause_code_name FROM vicidial_pause_codes WHERE campaign_id='$VD_campaign' order by pause_code limit 50;";
		$rslt=mysql_query($stmt, $link);
		$menus_to_print = mysql_num_rows($rslt);
		$o=0;
		$Default_Pause_Code_select = "<select name=\"agent_available_reset_codde\" id=\"agent_available_reset_codde\" style=\"width:200px;\">";
		while ($menus_to_print > $o) 
		{
			$row=mysql_fetch_row($rslt);
			if($agent_available_reset_codde==$row[0]){
				$Default_Pause_Code_select = $Default_Pause_Code_select . "<option value=\"$row[0]\" selected>$row[1]</option>";
			}else{
				$Default_Pause_Code_select = $Default_Pause_Code_select . "<option value=\"$row[0]\">$row[1]</option>";
			}
			$o++;
		}
		$Default_Pause_Code_select = $Default_Pause_Code_select . "</select>";
		return $Default_Pause_Code_select;
	}
  ?>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Agent Available Reset Codde</td>
	    <td><?php echo get_pause_code_list2($agent_available_reset_codde,$campaign); ?>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Default_Pause_Code')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Incoming Web Play Music Enable</td>
	    <td><select name="Incoming_Web_Play_Music_Enable" size="1"><option <?php if($Incoming_Web_Play_Music_Enable=="Y") echo "selected"; ?>>Y</option><option <?php if($Incoming_Web_Play_Music_Enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Incoming_Web_Play_Music_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Incoming Web Play Music Filename</td>
	    <td><input type="text" value="<?php echo $Incoming_Web_Play_Music_Filename; ?>" maxlength="50" size="18" name="Incoming_Web_Play_Music_Filename">
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Incoming_Web_Play_Music_Filename')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Default Pause Code Enable</td>
	    <td><select name="Default_Pause_Code_Enable" size="1"><option <?php if($Default_Pause_Code_Enable=="Y") echo "selected"; ?>>Y</option><option <?php if($Default_Pause_Code_Enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Default_Pause_Code_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Pause Code Select Link Enable</td>
	    <td><select name="Pause_Code_Selected_Link_Display" size="1"><option <?php if($Pause_Code_Selected_Link_Display=="Y") echo "selected"; ?>>Y</option><option <?php if($Pause_Code_Selected_Link_Display=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Pause_Code_Selected_Link_Display')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  <?php

	function get_pause_code_list($Default_Pause_Code,$VD_campaign){
		global $link;
		$stmt="SELECT pause_code,pause_code_name FROM vicidial_pause_codes WHERE campaign_id='$VD_campaign' order by pause_code limit 50;";
		$rslt=mysql_query($stmt, $link);
		$menus_to_print = mysql_num_rows($rslt);
		$o=0;
		$Default_Pause_Code_select = "<select name=\"Default_Pause_Code\" id=\"Default_Pause_Code\" style=\"width:200px;\">";
		while ($menus_to_print > $o) 
		{
			$row=mysql_fetch_row($rslt);
			if($Default_Pause_Code==$row[0]){
				$Default_Pause_Code_select = $Default_Pause_Code_select . "<option value=\"$row[0]\" selected>$row[1]</option>";
			}else{
				$Default_Pause_Code_select = $Default_Pause_Code_select . "<option value=\"$row[0]\">$row[1]</option>";
			}
			$o++;
		}
		$Default_Pause_Code_select = $Default_Pause_Code_select . "</select>";
		return $Default_Pause_Code_select;
	}
  ?>
  </tr>
  <tr bgcolor="#f5f5f5">
	    <td align="right">Max Pauses</td>
	    <td><input type="text" value="<?php echo $Max_Pauses; ?>" maxlength="50" size="18" name="Max_Pauses"  id="Max_Pauses">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Max_Pauses')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Default Pause Code</td>
	    <td><?php echo get_pause_code_list($Default_Pause_Code,$campaign); ?>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Default_Pause_Code')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  <?php
	//DID
	function get_select_did($inbound_did){
		global $link;
		$stmt="SELECT did_id,did_pattern,did_description,did_active,did_route from vicidial_inbound_dids order by did_pattern";
		$rslt=mysql_query($stmt, $link);
		$menus_to_print = mysql_num_rows($rslt);
		$o=0;
		$inbound_did_select = "";
		$inbound_did_arr = explode(" ",$inbound_did);
		while ($menus_to_print > $o) 
		{
			$row=mysql_fetch_row($rslt);
			$check_yn = false;
			foreach($inbound_did_arr as $did_temp){
				if($did_temp == $row[0]){
					$check_yn = true;
				}
			}
			
			
			
			if($check_yn){
				$inbound_did_select = $inbound_did_select . "<input type=\"checkbox\" name=\"inbound_did_arr[]\" value=\"$row[0]\" checked>$row[2]<br>";
			}else{
				$inbound_did_select = $inbound_did_select . "<input type=\"checkbox\" name=\"inbound_did_arr[]\" value=\"$row[0]\">$row[2]<br>";
			}
			$o++;
		}
		$inbound_did_select = $inbound_did_select . "";
		return $inbound_did_select;
	}
  ?>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Inbound DIDs<BR><a href="javascript:openNewWindow('admin.php?ADD=99999#more_inbound_dids')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a></td>
	    <td><?php echo get_select_did($inbound_dids); ?></td>
  </tr>
  <?php
	//select
	function get_select_ivr($inbound_ivr){
		global $link;
		$stmt="SELECT menu_id,menu_name,menu_prompt,menu_timeout from vicidial_call_menu order by menu_id";
		$rslt=mysql_query($stmt, $link);
		$menus_to_print = mysql_num_rows($rslt);
		$o=0;
		$inbound_ivr_select = "<select name=\"inbound_ivr\" id=\"inbound_ivr\" style=\"width:200px;\">";
		while ($menus_to_print > $o) 
		{
			$row=mysql_fetch_row($rslt);
			if($inbound_ivr==$row[0]){
				$inbound_ivr_select = $inbound_ivr_select . "<option value=\"$row[0]\" selected>$row[1]</option>";
			}else{
				$inbound_ivr_select = $inbound_ivr_select . "<option value=\"$row[0]\">$row[1]</option>";
			}
			$o++;
		}
		$inbound_ivr_select = $inbound_ivr_select . "</select>";
		return $inbound_ivr_select;
	}
  ?>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">Inbound IVR</td>
	    <td><?php echo get_select_ivr($inbound_ivr); ?>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_inbound_ivr')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>

	  <tr bgcolor="#f5f5a0">
	    <td align="right">Enable Extension Info Integration</td>
	    <td><select name="Extension_Info_Integration_Enable" size="1"><option value="1" <?php if($Extension_Info_Integration_Enable==1) echo "selected"; ?>>Y</option><option value="0" <?php if($Extension_Info_Integration_Enable==0) echo "selected"; ?>>N</option></select>
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Extension_Info_Integration_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Extension Info DB Server IP</td>
	    <td><input type="text" value="<?php echo $Extension_Info_Db_Server_Ip; ?>" maxlength="50" size="18" name="Extension_Info_Db_Server_Ip">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Extension_Info_Db_Server_Ip')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Extension Info DB Name</td>
	    <td><input type="text" value="<?php echo $Extension_Info_Db_Name; ?>" maxlength="50" size="18" name="Extension_Info_Db_Name">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Extension_Info_Db_Name')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Extension Info DB Login</td>
	    <td><input type="text" value="<?php echo $Extension_Info_Db_Login; ?>" maxlength="50" size="18" name="Extension_Info_Db_Login">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Extension_Info_Db_Login')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5a0">
	    <td align="right">Extension Info DB Password</td>
	    <td><input type="text" value="<?php echo $Extension_Info_Db_Password; ?>" maxlength="50" size="18" name="Extension_Info_Db_Password">
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_Extension_Info_Db_Password')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>

  	  <tr bgcolor="#f5f5a0">
	    <td align="right">Extension Info SQL</td>
	    <td><textarea name="extension_info_sql" cols="40" rows="8"><?php echo $extension_info_sql; ?></textarea>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_extension_info_sql')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
  	  <tr bgcolor="#f5f5f5">
	    <td align="right">CCMS Agent Window Align</td>
	    <td><select name="CCMS_Agent_Window_Align" size="1"><option <?php if($CCMS_Agent_Window_Align=="Center") echo "selected"; ?>>Center</option><option <?php if($CCMS_Agent_Window_Align=="Right") echo "selected"; ?>>Right</option><option <?php if($CCMS_Agent_Window_Align=="Left") echo "selected"; ?>>Left</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_CCMS_Agent_Window_Align')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">CCMS Agent Window Width</td>
	    <td><input type="text" value="<?php echo $CCMS_Agent_Window_Width; ?>" maxlength="50" size="18" name="CCMS_Agent_Window_Width">
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_CCMS_Agent_Window_Width')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">IM Enable </td>
	    <td><select name="IM_Enable" size="1"><option <?php if($IM_Enable=="Y") echo "selected"; ?>>Y</option><option <?php if($IM_Enable=="N") echo "selected"; ?>>N</option></select>
		<a href="javascript:openNewWindow('admin.php?ADD=99999#more_IM_Enable')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
    <tr bgcolor="#eeeeee">
	    <td align="right">IM Send Message Level</td>
	    <td>
			<select name="IM_Talk_Level" size="1">
				<option value="5" <?php if($IM_Talk_Level=="5") echo "selected"; ?>>Agent</option>
				<option value="6" <?php if($IM_Talk_Level=="6") echo "selected"; ?>>QA</option>
				<option value="7" <?php if($IM_Talk_Level=="7") echo "selected"; ?>>Supervisor</option>
				<option value="8" <?php if($IM_Talk_Level=="8") echo "selected"; ?>>Manager</option>
				<option value="9" <?php if($IM_Talk_Level=="9") echo "selected"; ?>>Admin</option>
			</select>
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_IM_Talk_Level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#eeeeee">
	    <td align="right">IM Admin Level</td>
	    <td>
			<select name="IM_Admin_Level" size="1">
				<option value="5" <?php if($IM_Admin_Level=="5") echo "selected"; ?>>Agent</option>
				<option value="6" <?php if($IM_Admin_Level=="6") echo "selected"; ?>>QA</option>
				<option value="7" <?php if($IM_Admin_Level=="7") echo "selected"; ?>>Supervisor</option>
				<option value="8" <?php if($IM_Admin_Level=="8") echo "selected"; ?>>Manager</option>
				<option value="9" <?php if($IM_Admin_Level=="9") echo "selected"; ?>>Admin</option>
			</select>
			<a href="javascript:openNewWindow('admin.php?ADD=99999#more_IM_Admin_Level')"><img height="20" border="0" align="TOP" width="20" alt="HELP" src="help.gif"></a>
		</td>
  </tr>
	  <tr bgcolor="#f5f5f5">
	    <td align="right">&nbsp;</td>
	    <td align="left">
        	<input type="hidden" name="modify" value="yes">
			<input type="hidden" name="campaign" value="<?PHP echo $campaign; ?>">
            <input type="submit" name="submit" id="submit" value="Submit">
        </td>
    </tr>
</table>
</form>
</BODY>
</html>
