<?php
# admin_header.php - CCMS administration header
#
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
# 

# CHANGES
# 90310-0709 - First Build
# 90508-0542 - Added IVR option, changed script to use long PHP tags
# 90514-0605 - Added audio prompt selection functions
# 90530-1206 - Changed List Mix to allow for 40 mixes and a default populate option
# 90531-2339 - Added Dynamic options for IVR
# 90612-0852 - Changed relative links
# 90635-0943 - Added javascript for dynamic menus in In-Groups
# 90627-0548 - Added no-agent-no-queue options
# 90628-1016 - Added Text-to-speech options
# 90830-2213 - Added Music On Hold options
# 90904-1534 - Added launch_moh_chooser
# 90916-2334 - Added Voicemail options
# 91223-1030 - Added VIDPROMPT options for in-group routing in Call Menus
#


######################### SMALL HTML HEADER BEGIN #######################################
$version = '3.0.3 (Build 02)';
if($short_header)
	{
echo "<link type='text/css' rel='stylesheet' href='./new_style/css/report.css' />";


	?>

<DIV id="kuang">
<?php if((substr($_SERVER['PHP_SELF'],10)!="AST_timeonVDADallAJAX.php") && (substr($_SERVER['PHP_SELF'],10)!="AST_timeonVDADallSUMMARY.php") ){
	?>
 <TABLE width="100%" CELLPADDING=0 CELLSPACING=0 BGCOLOR="#015B91" style="display:none">
    <TR>
      <TD width="78"><IMG SRC="images/vicidial_admin_web_logo_small.gif"></TD>
      <TD width="75"><A HREF="admin.php" ALT="Users"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Users</B></A> &nbsp; </TD>
      <TD width="104">&nbsp; <A HREF="admin.php?ADD=10" ALT="Campaigns"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Campaigns</B></A> &nbsp; </TD>
      <TD width="63">&nbsp; <A HREF="admin.php?ADD=100" ALT="Lists"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Lists</B></A> &nbsp; </TD>
      <TD width="76">&nbsp; <A HREF="admin.php?ADD=1000000" ALT="Scripts"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Scripts</B></A> &nbsp; </TD>
      <TD width="73">&nbsp; <A HREF="admin.php?ADD=10000000" ALT="Filters"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Filters</B></A> &nbsp; </TD>
      <TD width="98">&nbsp; <A HREF="admin.php?ADD=1000" ALT="In-Groups"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>In-Groups</B></A> &nbsp; </TD>
      <TD width="115">&nbsp; <A HREF="admin.php?ADD=100000" ALT="User Groups"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>User Groups</B></A> &nbsp; </TD>
      <TD width="103">&nbsp; <A HREF="admin.php?ADD=10000" ALT="Remote Agents"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Remote agents</B></A></TD>
      <TD width="73">&nbsp; <A HREF="admin.php?ADD=10000000000" ALT="Admin"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Admin</B></A> &nbsp; </TD>
      <TD width="90">&nbsp; <A HREF="admin.php?ADD=999999" ALT="Reports"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Reports</B></A> &nbsp; </TD>
    </TR>
  </TABLE>
	<?php
	}}
######################### SMALL HTML HEADER END #######################################


######################### FULL HTML HEADER BEGIN #######################################
else
{
if ($hh=='users') 
	{$users_hh="bgcolor =\"$users_color\""; $users_fc="$users_font"; $users_bold="$header_selected_bold";}
	else {$users_hh=''; $users_fc='BLACK'; $users_bold="$header_nonselected_bold";}
if ($hh=='campaigns') 
	{$campaigns_hh="bgcolor=\"$campaigns_color\""; $campaigns_fc="$campaigns_font"; $campaigns_bold="$header_selected_bold";}
	else {$campaigns_hh=''; $campaigns_fc='BLACK'; $campaigns_bold="$header_nonselected_bold";}
if ($SSoutbound_autodial_active > 0)
	{
	if ($hh=='lists') 
		{$lists_hh="bgcolor=\"$lists_color\""; $lists_fc="$lists_font"; $lists_bold="$header_selected_bold";}
		else {$lists_hh=''; $lists_fc='BLACK'; $lists_bold="$header_nonselected_bold";}
	}
if ($hh=='ingroups') 
	{$ingroups_hh="bgcolor=\"$ingroups_color\""; $ingroups_fc="$ingroups_font"; $ingroups_bold="$header_selected_bold";}
	else {$ingroups_hh=''; $ingroups_fc='BLACK'; $ingroups_bold="$header_nonselected_bold";}
if ($hh=='remoteagent') 
	{$remoteagent_hh="bgcolor=\"$remoteagent_color\""; $remoteagent_fc="$remoteagent_font"; $remoteagent_bold="$header_selected_bold";}
	else {$remoteagent_hh=''; $remoteagent_fc='BLACK'; $remoteagent_bold="$header_nonselected_bold";}
if ($hh=='usergroups') 
	{$usergroups_hh="bgcolor=\"$usergroups_color\""; $usergroups_fc="$usergroups_font"; $usergroups_bold="$header_selected_bold";}
	else {$usergroups_hh=''; $usergroups_fc='BLACK'; $usergroups_bold="$header_nonselected_bold";}
if ($hh=='scripts') 
	{$scripts_hh="bgcolor=\"$scripts_color\""; $scripts_fc="$scripts_font"; $scripts_bold="$header_selected_bold";}
	else {$scripts_hh=''; $scripts_fc='BLACK'; $scripts_bold="$header_nonselected_bold";}
if ($SSoutbound_autodial_active > 0)
	{
	if ($hh=='filters') 
		{$filters_hh="bgcolor=\"$filters_color\""; $filters_fc="$filters_font"; $filters_bold="$header_selected_bold";}
		else {$filters_hh=''; $filters_fc='BLACK'; $filters_bold="$header_nonselected_bold";}
	}
if ($hh=='admin') 
	{$admin_hh="bgcolor=\"$admin_color\""; $admin_fc="$admin_font"; $admin_bold="$header_selected_bold";}
	else {$admin_hh=''; $admin_fc='BLACK'; $admin_bold="$header_nonselected_bold";}
if ($hh=='Monitor')
	{$monitor_hh="bgcolor=\"$admin_color\""; $monitor_fc="$admin_font"; $monitor_bold="$header_selected_bold";}
	else {$monitor_hh=''; $monitor_fc='BLACK'; $monitor_bold="$header_nonselected_bold";}
if ($hh=='reports') 
	{$reports_hh="bgcolor=\"$reports_color\""; $reports_fc="$reports_font"; $reports_bold="$header_selected_bold";}
	else {$reports_hh=''; $reports_fc='BLACK'; $reports_bold="$header_nonselected_bold";}

if ($hh=='notice') 
    {$notice_hh="bgcolor=\"$reports_color\""; $reports_fc="$reports_font"; $reports_bold="$header_selected_bold";}
    else {$notice_hh=''; $reports_fc='BLACK'; $reports_bold="$header_nonselected_bold";}

if ($hh=='client')
	{$client_hh="bgcolor=\"$reports_color\""; $client_fc="$reports_font"; $client_bold="$header_selected_bold";}
	else {$client_hh=''; $client_fc='BLACK'; $client_bold="$header_nonselected_bold";}

echo "</title>\n";
echo "<script language=\"Javascript\">\n";
echo "var field_name = '';\n";
echo "var user = '$PHP_AUTH_USER';\n";
echo "var pass = '$PHP_AUTH_PW';\n";
echo "var epoch = '" . date("U") . "';\n";

if ($TCedit_javascript > 0)
	{
	 ?> 
  
	function run_submit()
		{
		calculate_hours();
		var go_submit = document.getElementById("go_submit");
		if (go_submit.disabled == false)
			{
			document.edit_log.submit();
			}
		}

	// Calculate login time
	function calculate_hours() 
		{
		var now_epoch = '<?php echo $StarTtimE ?>';
		var i=0;
		var total_percent=0;
		var SPANlogin_time = document.getElementById("LOGINlogin_time");
		var LI_date = document.getElementById("LOGINbegin_date");
		var LO_date = document.getElementById("LOGOUTbegin_date");
		var LI_datetime = LI_date.value;
		var LO_datetime = LO_date.value;
		var LI_datetime_array=LI_datetime.split(" ");
		var LI_date_array=LI_datetime_array[0].split("-");
		var LI_time_array=LI_datetime_array[1].split(":");
		var LO_datetime_array=LO_datetime.split(" ");
		var LO_date_array=LO_datetime_array[0].split("-");
		var LO_time_array=LO_datetime_array[1].split(":");

		// Calculate milliseconds since 1970 for each date string and find diff
		var LI_sec = ( ( (LI_time_array[2] * 1) * 1000) );
		var LI_min = ( ( ( (LI_time_array[1] * 1) * 1000) * 60 ) );
		var LI_hour = ( ( ( (LI_time_array[0] * 1) * 1000) * 3600 ) );
		var LI_date_epoch = Date.parse(LI_date_array[0] + '/' + LI_date_array[1] + '/' + LI_date_array[2]);
		var LI_epoch = (LI_date_epoch + LI_sec + LI_min + LI_hour);
		var LO_sec = ( ( (LO_time_array[2] * 1) * 1000) );
		var LO_min = ( ( ( (LO_time_array[1] * 1) * 1000) * 60 ) );
		var LO_hour = ( ( ( (LO_time_array[0] * 1) * 1000) * 3600 ) );
		var LO_date_epoch = Date.parse(LO_date_array[0] + '/' + LO_date_array[1] + '/' + LO_date_array[2]);
		var LO_epoch = (LO_date_epoch + LO_sec + LO_min + LO_hour);
		var temp_LI_epoch = (LI_epoch / 1000 );
		var temp_LO_epoch = (LO_epoch / 1000 );
		var epoch_diff = ( (LO_epoch - LI_epoch) / 1000 );
		var temp_diff = epoch_diff;

		document.getElementById("login_time").innerHTML = "ERROR, Please check date fields";

		var go_submit = document.getElementById("go_submit");
		go_submit.disabled = true;
		// length is a positive number and no more than 24 hours, datetime is earlier than right now
		if ( (epoch_diff < 86401) && (epoch_diff > 0) && (temp_LI_epoch < now_epoch) && (temp_LO_epoch < now_epoch) )
			{
			go_submit.disabled = false;

			hours = Math.floor(temp_diff / (60 * 60)); 
			temp_diff -= hours * (60 * 60);

			mins = Math.floor(temp_diff / 60); 
			temp_diff -= mins * 60;

			secs = Math.floor(temp_diff); 
			temp_diff -= secs;

			document.getElementById("login_time").innerHTML = hours + ":" + mins;

			var form_LI_epoch = document.getElementById("LOGINepoch");
			var form_LO_epoch = document.getElementById("LOGOUTepoch");
			form_LI_epoch.value = (LI_epoch / 1000);
			form_LO_epoch.value = (LO_epoch / 1000);
			}
		}



	<?php
	}
######################
# ADD=31 or 34 and SUB=29 for list mixes
######################
if ( ( ($ADD==34) or ($ADD==31) or ($ADD==49) ) and ($SUB==29) and ($LOGmodify_campaigns==1) and ( (eregi("$campaign_id",$LOGallowed_campaigns)) or (eregi("ALL-CAMPAIGNS",$LOGallowed_campaigns)) ) ) 
	{

	?>
	// List Mix status add and remove
	function mod_mix_status(stage,vcl_id,entry) 
		{
		if (stage=="ALL")
			{
			var count=0;
			var ROnew_statuses = document.getElementById("ROstatus_X_" + vcl_id);

			while (count < entry)
				{
				var old_statuses = document.getElementById("status_" + count + "_" + vcl_id);
				var ROold_statuses = document.getElementById("ROstatus_" + count + "_" + vcl_id);

				old_statuses.value = ROnew_statuses.value;
				ROold_statuses.value = ROnew_statuses.value;
				count++;
				}
			}
		else
			{
			if (stage=="EMPTY")
				{
				var count=0;
				var ROnew_statuses = document.getElementById("ROstatus_X_" + vcl_id);

				while (count < entry)
					{
					var old_statuses = document.getElementById("status_" + count + "_" + vcl_id);
					var ROold_statuses = document.getElementById("ROstatus_" + count + "_" + vcl_id);
					
					if (ROold_statuses.value.length < 3)
						{
						old_statuses.value = ROnew_statuses.value;
						ROold_statuses.value = ROnew_statuses.value;
						}
					count++;
					}
				}

			else
				{
				var mod_status = document.getElementById("dial_status_" + entry + "_" + vcl_id);
				if (mod_status.value.length < 1)
					{
					alert("You must select a status first");
					}
				else
					{
					var old_statuses = document.getElementById("status_" + entry + "_" + vcl_id);
					var ROold_statuses = document.getElementById("ROstatus_" + entry + "_" + vcl_id);
					var MODstatus = new RegExp(" " + mod_status.value + " ","g");
					if (stage=="ADD")
						{
						if (old_statuses.value.match(MODstatus))
							{
							alert("The status " + mod_status.value + " is already present");
							}
						else
							{
							var new_statuses = " " + mod_status.value + "" + old_statuses.value;
							old_statuses.value = new_statuses;
							ROold_statuses.value = new_statuses;
							mod_status.value = "";
							}
						}
					if (stage=="REMOVE")
						{
						var MODstatus = new RegExp(" " + mod_status.value + " ","g");
						old_statuses.value = old_statuses.value.replace(MODstatus, " ");
						ROold_statuses.value = ROold_statuses.value.replace(MODstatus, " ");
						}
					}
				}
			}
		}

	// List Mix percent difference calculation and warning message
	function mod_mix_percent(vcl_id,entries) 
		{
		var i=0;
		var total_percent=0;
		var percent_diff='';
		while(i < entries)
			{
			var mod_percent_field = document.getElementById("percentage_" + i + "_" + vcl_id);
			temp_percent = mod_percent_field.value * 1;
			total_percent = (total_percent + temp_percent);
			i++;
			}

		var mod_diff_percent = document.getElementById("PCT_DIFF_" + vcl_id);
		percent_diff = (total_percent - 100);
		if (percent_diff > 0)
			{
			percent_diff = '+' + percent_diff;
			}
		var mix_list_submit = document.getElementById("submit_" + vcl_id);
		if ( (percent_diff > 0) || (percent_diff < 0) )
			{
			mix_list_submit.disabled = true;
			document.getElementById("ERROR_" + vcl_id).innerHTML = "<font color=red><B>The Difference % must be 0</B></font>";
			}
		else
			{
			mix_list_submit.disabled = false;
			document.getElementById("ERROR_" + vcl_id).innerHTML = "";
			}

		mod_diff_percent.value = percent_diff;
		}

	function submit_mix(vcl_id,entries) 
		{
		var h=1;
		var j=1;
		var list_mix_container='';
		var mod_list_mix_container_field = document.getElementById("list_mix_container_" + vcl_id);
		while(h < 41)
			{
			var i=0;
			while(i < entries)
				{
				var mod_list_id_field = document.getElementById("list_id_" + i + "_" + vcl_id);
				var mod_priority_field = document.getElementById("priority_" + i + "_" + vcl_id);
				var mod_percent_field = document.getElementById("percentage_" + i + "_" + vcl_id);
				var mod_statuses_field = document.getElementById("status_" + i + "_" + vcl_id);
				if (mod_priority_field.value==h)
					{
					list_mix_container = list_mix_container + mod_list_id_field.value + "|" + j + "|" + mod_percent_field.value + "|" + mod_statuses_field.value + "|:";
					j++;
					}
				i++;
				}
			h++;
			}
		mod_list_mix_container_field.value = list_mix_container;
		var form_to_submit = document.getElementById("" + vcl_id);
		form_to_submit.submit();
		}
	<?php
	}
	?>
	

if (document.addEventListener){
   document.addEventListener("DOMContentLoaded", setstyle, false)
}

 if (document.all && !window.opera){

  document.write('<script type="text/javascript" id="contentloadtag" defer="defer" src="javascript:void(0)"><\/script>');
  var contentloadtag=document.getElementById("contentloadtag");
  contentloadtag.onreadystatechange=function(){
  	    if (this.readyState=="complete")      {
            setstyle();
  	    }
  	    
   }
 }
	
	function setstyle(){
		
  	        var btnobjs = document.getElementsByTagName("input");

            for(var i=0;i<btnobjs.length;i++){
              if (btnobjs[i].type == "submit" || btnobjs[i].type == "button"  ){
              	  btnobjs[i].className = "inputsubmit";
              }	
              if (btnobjs[i].type == "text"){
              	  btnobjs[i].className = "inputtext";
              }          	
            }

  	        		
	}
	
   
	function openNewWindow(url) {
	  window.open (url,"",'width=620,height=300,scrollbars=yes,menubar=yes,address=yes');
	}
	function scriptInsertField() {
		openField = '--A--';
		closeField = '--B--';
		var textBox = document.scriptForm.script_text;
		var scriptIndex = document.getElementById("selectedField").selectedIndex;
		var insValue =  document.getElementById('selectedField').options[scriptIndex].value;
	  if (document.selection) {
		//IE
		textBox = document.scriptForm.script_text;
		insValue = document.scriptForm.selectedField.options[document.scriptForm.selectedField.selectedIndex].text;
		textBox.focus();
		sel = document.selection.createRange();
		sel.text = openField + insValue + closeField;
	  } else if (textBox.selectionStart || textBox.selectionStart == 0) {
		//Mozilla
		var startPos = textBox.selectionStart;
		var endPos = textBox.selectionEnd;
		textBox.value = textBox.value.substring(0, startPos)
		+ openField + insValue + closeField
		+ textBox.value.substring(endPos, textBox.value.length);
	  } else {
		textBox.value += openField + insValue + closeField;
	  }
	}

	<?php

#### Javascript for auto-generate of user ID Button
if ( ($ADD==1) or ($ADD=="1A") or ($ADD=="1C") or ($ADD=="2C"))
	{
	?>
	function user_auto()
		{
		var user_toggle = document.getElementById("user_toggle");
		var user_field = document.getElementById("user");
		if (user_toggle.value < 1)
			{
			user_field.value = 'AUTOGENERATEZZZ';
			user_field.disabled = true;
			user_toggle.value = 1;
			}
		else
			{
			user_field.value = '';
			user_field.disabled = false;
			user_toggle.value = 0;
			}
		}

	function user_submit()
		{
		var user_field = document.getElementById("user");
		user_field.disabled = false;
		document.userform.submit();
		}

function CheckUserNumber()
{
	var user_number				= document.getElementById("user").value;
	var user_number_length	= user_number.length;
//alert(user_number);
//输入字母和数字的组合，6位到15位：/([a-zA-Z0-9]{6,15})?/
//字符串仅包含数字、英文且不能为空 : /^[0-9a-zA-Z]*$/
	var result=user_number.match(/^[0-9a-zA-Z]*$/); 
	if(user_number != '' && user_number_length != null )
	{
		if(user_number_length > 8 || user_number_length < 2)
		{
			alert("The length of User Number must between 2 and 8!");
			document.getElementById('user').focus();
			return false;
		}
		if(result == null)
		{
			alert("User Number must be letters or numbers!");
			document.getElementById('user').focus();
			return false;
		}
	}
}

function CheckSuffixNumber()
{	
	var prefix_number				= document.getElementById("user_name_prefix").value;
	var prefix_number_length	= prefix_number.length;
//	var suffix_from_number_length	= suffix_from_number.length;
	var suffix_from_number				= document.getElementById("user_name_suffix_from").value;
	var suffix_from_number_length	= suffix_from_number.length;
	var suffix_to_number				= document.getElementById("user_name_suffix_to").value;
	var suffix_to_number_length	= suffix_to_number.length;
//	var user_name_length_from = parseInt(prefix_number_length)+parseInt(suffix_from_number_length);
//	var user_name_length_from = parseInt(prefix_number_length)+parseInt(suffix_from_number_length);
//alert(suffix_from_number);
//输入的用户名后缀必须是数字;
//字符串仅包含数字 : /^[0-9]*$/;
	var result_from=suffix_from_number.match(/^[0-9]*$/); 
	var result_to=suffix_to_number.match(/^[0-9]*$/); 
	if(suffix_from_number != '' || suffix_to_number != '')
	{
		if(result_from == null)
		{
			alert("'User Number Suffix From' must be Numbers!");
			document.getElementById('user_name_suffix_from').focus();
			return false;
		}
		else
		{
			if(result_to == null)
			{
				alert("'User Number Suffix To' must be Numbers!");
				document.getElementById('user_name_suffix_to').focus();
				return false;
			}
			else
			{
				if(result_from != null && result_to != null && suffix_from_number_length != suffix_to_number_length)
				{
						alert("The data you entered of 'User Number Suffix To' \n must have the same length of 'User Number Suffix From'");
						document.getElementById('user_name_suffix_to').focus();
						return false;
				}
			}
		}
	}
	else
	{
		if(suffix_from_number == '')
		{
			alert("'User Number Suffix From' must not null!");
			document.getElementById('user_name_suffix_from').focus();
			return false;
		}
		else
		{
			if(suffix_to_number == '')
			{
				alert("'User Number Suffix To' must not null!");
				document.getElementById('user_name_suffix_to').focus();
				return false;
			}
		}
	}

}

	<?php
	}

#### Javascript for auto-generate of user ID Button
else
	{
	?>
	function launch_chooser(fieldname,stage,vposition)
		{
		var audiolistURL = "./non_agent_api.php";
		var audiolistQuery = "source=admin&function=sounds_list&user=" + user + "&pass=" + pass + "&format=selectframe&stage=" + stage + "&comments=" + fieldname;
		var Iframe_content = '<IFRAME SRC="' + audiolistURL + '?' + audiolistQuery + '"  style="width:740;height:440;background-color:white;" scrolling="NO" frameborder="0" allowtransparency="true" id="audio_chooser_frame' + epoch + '" name="audio_chooser_frame" width="740" height="460" STYLE="z-index:2"> </iframe>';

		document.getElementById("audio_chooser_span").style.position = "absolute";
		document.getElementById("audio_chooser_span").style.left = "220px";
		document.getElementById("audio_chooser_span").style.top = vposition + "px";
		document.getElementById("audio_chooser_span").style.visibility = 'visible';
		document.getElementById("audio_chooser_span").innerHTML = Iframe_content;
		}

	function launch_moh_chooser(fieldname,stage,vposition)
		{
		var audiolistURL = "./non_agent_api.php";
		var audiolistQuery = "source=admin&function=moh_list&user=" + user + "&pass=" + pass + "&format=selectframe&stage=" + stage + "&comments=" + fieldname;
		var Iframe_content = '<IFRAME SRC="' + audiolistURL + '?' + audiolistQuery + '"  style="width:740;height:440;background-color:white;" scrolling="NO" frameborder="0" allowtransparency="true" id="audio_chooser_frame' + epoch + '" name="audio_chooser_frame" width="740" height="460" STYLE="z-index:2"> </iframe>';

		document.getElementById("audio_chooser_span").style.position = "absolute";
		document.getElementById("audio_chooser_span").style.left = "220px";
		document.getElementById("audio_chooser_span").style.top = vposition + "px";
		document.getElementById("audio_chooser_span").style.visibility = 'visible';
		document.getElementById("audio_chooser_span").innerHTML = Iframe_content;
		}

	function launch_vm_chooser(fieldname,stage,vposition)
		{
		var audiolistURL = "./non_agent_api.php";
		var audiolistQuery = "source=admin&function=vm_list&user=" + user + "&pass=" + pass + "&format=selectframe&stage=" + stage + "&comments=" + fieldname;
		var Iframe_content = '<IFRAME SRC="' + audiolistURL + '?' + audiolistQuery + '"  style="width:740;height:440;background-color:white;" scrolling="NO" frameborder="0" allowtransparency="true" id="audio_chooser_frame' + epoch + '" name="audio_chooser_frame" width="740" height="460" STYLE="z-index:2"> </iframe>';

		document.getElementById("audio_chooser_span").style.position = "absolute";
		document.getElementById("audio_chooser_span").style.left = "220px";
		document.getElementById("audio_chooser_span").style.top = vposition + "px";
		document.getElementById("audio_chooser_span").style.visibility = 'visible';
		document.getElementById("audio_chooser_span").innerHTML = Iframe_content;
		}

	function close_chooser()
		{
		document.getElementById("audio_chooser_span").style.visibility = 'hidden';
		document.getElementById("audio_chooser_span").innerHTML = '';
		}


	function user_submit()
		{
		var user_field = document.getElementById("user");
		user_field.disabled = false;
		document.userform.submit();
		}

	<?php
	}

### Javascript for shift end-time calculation and display
if ( ($ADD==131111111) or ($ADD==331111111) or ($ADD==431111111) )
	{
	?>
	function shift_time()
		{
		var start_time = document.getElementById("shift_start_time");
		var end_time = document.getElementById("shift_end_time");
		var length = document.getElementById("shift_length");

		var st_value = start_time.value;
		var et_value = end_time.value;
		while (st_value.length < 4) {st_value = "0" + st_value;}
		while (et_value.length < 4) {et_value = "0" + et_value;}
		var st_hour=st_value.substring(0,2);
		var st_min=st_value.substring(2,4);
		var et_hour=et_value.substring(0,2);
		var et_min=et_value.substring(2,4);
		if (st_hour > 23) {st_hour = 23;}
		if (et_hour > 23) {et_hour = 23;}
		if (st_min > 59) {st_min = 59;}
		if (et_min > 59) {et_min = 59;}
		start_time.value = st_hour + "" + st_min;
		end_time.value = et_hour + "" + et_min;

		var start_time_hour=start_time.value.substring(0,2);
		var start_time_min=start_time.value.substring(2,4);
		var end_time_hour=end_time.value.substring(0,2);
		var end_time_min=end_time.value.substring(2,4);
		start_time_hour=(start_time_hour * 1);
		start_time_min=(start_time_min * 1);
		end_time_hour=(end_time_hour * 1);
		end_time_min=(end_time_min * 1);

		if (start_time.value == end_time.value)
			{
			var shift_length = '24:00';
			}
		else
			{
			if ( (start_time_hour > end_time_hour) || ( (start_time_hour == end_time_hour) && (start_time_min > end_time_min) ) )
				{
				var shift_hour = ( (24 - start_time_hour) + end_time_hour);
				var shift_minute = ( (60 - start_time_min) + end_time_min);
				if (shift_minute >= 60) 
					{
					shift_minute = (shift_minute - 60);
					}
				else
					{
					shift_hour = (shift_hour - 1);
					}
				}
			else
				{
				var shift_hour = (end_time_hour - start_time_hour);
				var shift_minute = (end_time_min - start_time_min);
				}
			if (shift_minute < 0) 
				{
				shift_minute = (shift_minute + 60);
				shift_hour = (shift_hour - 1);
				}

			if (shift_hour < 10) {shift_hour = '0' + shift_hour}
			if (shift_minute < 10) {shift_minute = '0' + shift_minute}
			var shift_length = shift_hour + ':' + shift_minute;
			}
	//	alert(start_time_hour + '|' + start_time_min + '|' + end_time_hour + '|' + end_time_min + '|--|' + shift_hour + ':' + shift_minute + '|' + shift_length + '|');

		length.value = shift_length;
		}

	<?php
	}


### select list contents generation for dynamic route displays in IVR and in-group screens
if ( ($ADD==3511) or ($ADD==2511) or ($ADD==2611) or ($ADD==4511) or ($ADD==5511) or ($ADD==3111) or ($ADD==2111) or ($ADD==2011) or ($ADD==4111) or ($ADD==5111) or ($ADD==1500099) )
	{
	$stmt="select menu_id,menu_name from vicidial_call_menu order by menu_id;";
	$rslt=mysql_query($stmt, $link);
	$menus_to_print = mysql_num_rows($rslt);
	$call_menu_list='';
	$i=0;
	while ($i < $menus_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$call_menu_list .= "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
		$i++;
		}
		
	$stmt="select intelligent_route_id,intelligent_route_name from ccms_intelligent_route;";
	$rslt=mysql_query($stmt, $link);
	$menus_to_print = mysql_num_rows($rslt);
	$intelligent_menu_list='';
	$i=0;
	while ($i < $menus_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$intelligent_menu_list .= "<option value=\"$row[1]\">$row[0] - $row[1]</option>";
		$i++;
		}
		
		
	$stmt="select did_pattern,did_description,did_route from vicidial_inbound_dids where did_active='Y' order by did_pattern;";
	$rslt=mysql_query($stmt, $link);
	$dids_to_print = mysql_num_rows($rslt);
	$did_list='';
	$i=0;
	while ($i < $dids_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$did_list .= "<option value=\"$row[0]\">$row[0] - $row[1] - $row[2]</option>";
		$i++;
		}

	$stmt="select group_id,group_name from vicidial_inbound_groups where active='Y' and group_id NOT LIKE \"AGENTDIRECT%\" order by group_id;";
	$rslt=mysql_query($stmt, $link);
	$ingroups_to_print = mysql_num_rows($rslt);
	$ingroup_list='';
	$i=0;
	while ($i < $ingroups_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$ingroup_list .= "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
		$i++;
		}

	$stmt="select campaign_id,campaign_name from vicidial_campaigns where active='Y' order by campaign_id;";
	$rslt=mysql_query($stmt, $link);
	$IGcampaigns_to_print = mysql_num_rows($rslt);
	$IGcampaign_id_list='';
	$i=0;
	while ($i < $IGcampaigns_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$IGcampaign_id_list .= "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
		$i++;
		}

	$IGhandle_method_list = '<option>CID</option><option>CIDLOOKUP</option><option>CIDLOOKUPRL</option><option>CIDLOOKUPRC</option><option>ANI</option><option>ANILOOKUP</option><option>ANILOOKUPRL</option><option>VIDPROMPT</option><option>VIDPROMPTLOOKUP</option><option>VIDPROMPTLOOKUPRL</option><option>VIDPROMPTLOOKUPRC</option><option>CLOSER</option><option>3DIGITID</option><option>4DIGITID</option><option>5DIGITID</option><option>10DIGITID</option>';

	$IGsearch_method_list = '<option value="LB">LB - Load Balanced</option><option value="LO">LO - Load Balanced Overflow</option><option value="SO">SO - Server Only</option>';

	$stmt="select login,server_ip,extension,dialplan_number from phones where active='Y' order by login,server_ip;";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);
	$phone_list='';
	$i=0;
	while ($i < $phones_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$phone_list .= "<option value=\"$row[0]\">$row[0] - $row[1] - $row[2] - $row[3]</option>";
		$i++;
		}
	}

# dynamic options for options in call_menu screen
if ( ($ADD==3511) or ($ADD==2511) or ($ADD==2611) or ($ADD==4511) or ($ADD==5511) or ($ADD==1500099))
	{

	?>
	function call_menu_option(option,route,value,value_context,chooser_height)
		{

		var call_menu_list = '<?php echo $call_menu_list ?>';
		var intelligent_menu_list = '<?php echo $intelligent_menu_list ?>';
		var ingroup_list = '<?php echo $ingroup_list ?>';
		var IGcampaign_id_list = '<?php echo $IGcampaign_id_list ?>';
		var IGhandle_method_list = '<?php echo $IGhandle_method_list ?>';
		var IGsearch_method_list = '<?php echo $IGsearch_method_list ?>';
		var did_list = '<?php echo $did_list ?>';
		var phone_list = '<?php echo $phone_list ?>';
		var selected_value = '';
		var selected_context = '';
		var new_content = '';

		var select_list = document.getElementById("option_route_" + option);
		var selected_route = select_list.value;
		var span_to_update = document.getElementById("option_value_value_context_" + option);

		if (selected_route=='CALLMENU')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value='';}
			new_content = '<span name=option_route_link_' + option + ' id=option_route_link_' + option + "><a href=\"./admin.php?ADD=3511&menu_id=" + value + "\">IVR: </a></span><select size=1 name=option_route_value_" + option + " id=option_route_value_" + option + " onChange=\"call_menu_link('" + option + "','CALLMENU');\">" + call_menu_list + "\n" + selected_value + '</select>';
			}
		if (selected_route=='INTELLIGENT ROUTE')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value='';}
			new_content = '<span name=option_route_link_' + option + ' id=option_route_link_' + option + "><a href=\"./admin.php?ADD=1500099&action=modify&route_name=" + value + "\">INTELLIGENT ROUTE: </a></span><select size=1 name=option_route_value_" + option + " id=option_route_value_" + option + " onChange=\"call_menu_link('" + option + "','INTELLIGENT');\">" + intelligent_menu_list + "\n" + selected_value + '</select>';
			}
		if (selected_route=='INGROUP')
			{
			if (value_context.length < 10)
				{value_context = 'CID,LB,998,TESTCAMP,1';}
			var value_context_split = value_context.split(",");
			var IGhandle_method =	value_context_split[0];
			var IGsearch_method =	value_context_split[1];
			var IGlist_id =			value_context_split[2];
			var IGcampaign_id =		value_context_split[3];
			var IGphone_code =		value_context_split[4];

			if (route == selected_route)
				{
				selected_value = '<option SELECTED>' + value + '</option>';
				}

			new_content = '<input type=hidden name=option_route_value_context_' + option + ' id=option_route_value_context_' + option + ' value="' + selected_value + '">';
			new_content = new_content + '<span name=option_route_link_' + option + 'id=option_route_link_' + option + '>';
			new_content = new_content + '<a href="admin.php?ADD=3111&group_id=' + value + '">In-Group:</a> </span>';
			new_content = new_content + '<select size=1 name=option_route_value_' + option + ' id=option_route_value_' + option + ' onChange="call_menu_link("' + option + '","INGROUP");">';
			new_content = new_content + '' + ingroup_list + "\n" + selected_value + '</select>';
			new_content = new_content + ' &nbsp; Handle Method: <select size=1 name=IGhandle_method_' + option + ' id=IGhandle_method_' + option + '>';
			new_content = new_content + '' + IGhandle_method_list + "\n" + '<option SELECTED>' + IGhandle_method + '</select>';
			new_content = new_content + '<BR>Search Method: <select size=1 name=IGsearch_method_' + option + ' id=IGsearch_method_' + option + '>';
			new_content = new_content + '' + IGsearch_method_list + "\n" + '<option SELECTED>' + IGsearch_method + '</select>';
			new_content = new_content + ' &nbsp; List ID: <input type=text size=5 maxlength=14 name=IGlist_id_' + option + ' id=IGlist_id_' + option + ' value="' + IGlist_id + '">';
			new_content = new_content + '<BR>Campaign ID: <select size=1 name=IGcampaign_id_' + option + ' id=IGcampaign_id_' + option + '>';
			new_content = new_content + '' + IGcampaign_id_list + "\n" + '<option SELECTED>' + IGcampaign_id + '</select>';
			new_content = new_content + ' &nbsp; Phone Code: <input type=text size=5 maxlength=14 name=IGphone_code_' + option + ' id=IGphone_code_' + option + ' value="' + IGphone_code + '">';
			}
		if (selected_route=='DID')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value='';}
			new_content = '<span name=option_route_link_' + option + ' id=option_route_link_' + option + '><a href="admin.php?ADD=3311&did_pattern=' + value + '">DID:</a> </span><select size=1 name=option_route_value_' + option + ' id=option_route_value_' + option + " onChange=\"call_menu_link('" + option + "','DID');\">" + did_list + "\n" + selected_value + '</select>';
			}
		if (selected_route=='HANGUP')
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value='vm-goodbye';}
			new_content = "Audio File: <input type=text name=option_route_value_" + option + " id=option_route_value_" + option + " size=40 maxlength=255 value=\"" + selected_value + "\"> <a href=\"javascript:launch_chooser('option_route_value_" + option + "','date'," + chooser_height + ");\">audio chooser</a>";
			}
		if (selected_route=='EXTENSION')
			{
			if (route == selected_route)
				{
				selected_value = value;
				selected_context = value_context;
				}
			else
				{value='8304';}
			new_content = "Extension: <input type=text name=option_route_value_" + option + " id=option_route_value_" + option + " size=20 maxlength=255 value=\"" + selected_value + "\"> &nbsp; Context: <input type=text name=option_route_value_context_" + option + " id=option_route_value_context_" + option + " size=20 maxlength=255 value=\"" + selected_context + "\"> ";
			}
		if (selected_route=='PHONE')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value='';}
			new_content = 'Phone: <select size=1 name=option_route_value_' + option + ' id=option_route_value_' + option + '>' + phone_list + "\n" + selected_value + '</select>';
			}
		if (selected_route=='VOICEMAIL')
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value='';}
			new_content = "Voicemail Box: <input type=text name=option_route_value_" + option + " id=option_route_value_" + option + " size=12 maxlength=10 value=\"" + selected_value + "\"> <a href=\"javascript:launch_vm_chooser('option_route_value_" + option + "','date'," + chooser_height + ");\">voicemail chooser</a>";
			}
		if (selected_route=='AGI')
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value='';}
			new_content = "AGI: <input type=text name=option_route_value_" + option + " id=option_route_value_" + option + " size=80 maxlength=255 value=\"" + selected_value + "\"> ";
			}

		if (new_content.length < 1)
			{new_content = selected_route}
		span_to_update.innerHTML = new_content;
		}

	function call_menu_link(option,route)
		{
		var selected_value = '';
		var new_content = '';

		var select_list = document.getElementById("option_route_value_" + option);
		var selected_value = select_list.value;
		var span_to_update = document.getElementById("option_route_link_" + option);

		if (route=='CALLMENU')
			{
			new_content = "<a href=\"admin.php?ADD=3511&menu_id=" + selected_value + "\">IVR:</a>";
			}
		if (route=='INTELLIGENT')
			{
			new_content = "<a href=\"admin.php?ADD=1500099&action=modify&route_name=" + selected_value + "\">INTELLIGENT ROUTE:</a>";
			}
		if (route=='INGROUP')
			{
			new_content = "<a href=\"admin.php?ADD=3111&group_id=" + selected_value + "\">In-Group:</a>";
			}
		if (route=='DID')
			{
			new_content = "<a href=\"admin.php?ADD=3311&did_pattern=" + selected_value + "\">DID:</a>";
			}

		if (new_content.length < 1)
			{new_content = selected_route}

		span_to_update.innerHTML = new_content;
		}

	<?php
	}

### Javascript for dynamic in-group option value entries
if ( ($ADD==3111) or ($ADD==2111) or ($ADD==2011) or ($ADD==4111) or ($ADD==5111) )
	{

	?>
	function dynamic_call_action(option,route,value,chooser_height)
		{
		var call_menu_list = '<?php echo $call_menu_list ?>';
		var ingroup_list = '<?php echo $ingroup_list ?>';
		var IGcampaign_id_list = '<?php echo $IGcampaign_id_list ?>';
		var IGhandle_method_list = '<?php echo $IGhandle_method_list ?>';
		var IGsearch_method_list = '<?php echo $IGsearch_method_list ?>';
		var did_list = '<?php echo $did_list ?>';
		var selected_value = '';
		var selected_context = '';
		var new_content = '';

		var select_list = document.getElementById(option + "");
		var selected_route = select_list.value;
		var span_to_update = document.getElementById(option + "_value_span");

		if (selected_route=='CALLMENU')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value = '';}
			new_content = '<span name=' + option + '_value_link id=' + option + '_value_link><a href="./admin.php?ADD=3511&menu_id=' + value + '">IVR: </a></span><select size=1 name=' + option + '_value id=' + option + "_value onChange=\"dynamic_call_action_link('" + option + "','CALLMENU');\">" + call_menu_list + "\n" + selected_value + '</select>';
			}
		if (selected_route=='INGROUP')
			{
			if ( (route != selected_route) || (value.length < 10) )
				{value = 'SALESLINE,CID,LB,998,TESTCAMP,1';}
			var value_split = value.split(",");
			var IGgroup_id =		value_split[0];
			var IGhandle_method =	value_split[1];
			var IGsearch_method =	value_split[2];
			var IGlist_id =			value_split[3];
			var IGcampaign_id =		value_split[4];
			var IGphone_code =		value_split[5];

			if (route == selected_route)
				{
				selected_value = '<option SELECTED>' + IGgroup_id + '</option>';
				}

			new_content = new_content + '<span name=' + option + '_value_link id=' + option + '_value_link><a href="admin.php?ADD=3111&group_id=' + IGgroup_id + '">In-Group:</a> </span> ';
			new_content = new_content + '<select size=1 name=IGgroup_id_' + option + ' id=IGgroup_id_' + option + " onChange=\"dynamic_call_action_link('IGgroup_id_" + option + "','INGROUP');\">";
			new_content = new_content + '' + ingroup_list + "\n" + selected_value + '</select>';
			new_content = new_content + ' &nbsp; Handle Method: <select size=1 name=IGhandle_method_' + option + ' id=IGhandle_method_' + option + '>';
			new_content = new_content + '' + IGhandle_method_list + "\n" + '<option SELECTED>' + IGhandle_method + '</select>';
			new_content = new_content + '<BR>Search Method: <select size=1 name=IGsearch_method_' + option + ' id=IGsearch_method_' + option + '>';
			new_content = new_content + '' + IGsearch_method_list + "\n" + '<option SELECTED>' + IGsearch_method + '</select>';
			new_content = new_content + ' &nbsp; List ID: <input type=text size=5 maxlength=14 name=IGlist_id_' + option + ' id=IGlist_id_' + option + ' value="' + IGlist_id + '">';
			new_content = new_content + '<BR>Campaign ID: <select size=1 name=IGcampaign_id_' + option + ' id=IGcampaign_id_' + option + '>';
			new_content = new_content + '' + IGcampaign_id_list + "\n" + '<option SELECTED>' + IGcampaign_id + '</select>';
			new_content = new_content + ' &nbsp; Phone Code: <input type=text size=5 maxlength=14 name=IGphone_code_' + option + ' id=IGphone_code_' + option + ' value="' + IGphone_code + '">';
			}
		if (selected_route=='DID')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value = '';}
			new_content = '<span name=' + option + '_value_link id=' + option + '_value_link><a href="admin.php?ADD=3311&did_pattern=' + value + '">DID:</a> </span><select size=1 name=' + option + '_value id=' + option + "_value onChange=\"dynamic_call_action_link('" + option + "','DID');\">" + did_list + "\n" + selected_value + '</select>';
			}
		if (selected_route=='MESSAGE')
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value = 'nbdy-avail-to-take-call|vm-goodbye';}
			new_content = "Audio File: <input type=text name=" + option + "_value id=" + option + "_value size=40 maxlength=255 value=\"" + value + "\"> <a href=\"javascript:launch_chooser('" + option + "_value','date'," + chooser_height + ");\">audio chooser</a>";
			}
		if (selected_route=='EXTENSION')
			{
			if ( (route != selected_route) || (value.length < 3) )
				{value = '8304,default';}
			var value_split = value.split(",");
			var EXextension =	value_split[0];
			var EXcontext =		value_split[1];

			new_content = "Extension: <input type=text name=EXextension_" + option + " id=EXextension_" + option + " size=20 maxlength=255 value=\"" + EXextension + "\"> &nbsp; Context: <input type=text name=EXcontext_" + option + " id=EXcontext_" + option + " size=20 maxlength=255 value=\"" + EXcontext + "\"> ";
			}
		if (selected_route=='VOICEMAIL')
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value = '101';}
			new_content = "Voicemail Box: <input type=text name=" + option + "_value id=" + option + "_value size=12 maxlength=10 value=\"" + value + "\"> <a href=\"javascript:launch_vm_chooser('" + option + "_value','date'," + chooser_height + ");\">voicemail chooser</a>";
			}

		if (new_content.length < 1)
			{new_content = selected_route}

		span_to_update.innerHTML = new_content;
		}

	function dynamic_call_action_link(field,route)
		{
		var selected_value = '';
		var new_content = '';

		if ( (route=='CALLMENU') || (route=='DID') )
			{var select_list = document.getElementById(field + "_value");}
		if (route=='INGROUP')
			{
			var select_list = document.getElementById(field + "");
			field = field.replace(/IGgroup_id_/, "");
			}
		var selected_value = select_list.value;
		var span_to_update = document.getElementById(field + "_value_link");

		if (route=='CALLMENU')
			{
			new_content = '<a href="admin.php?ADD=3511&menu_id=' + selected_value + '">IVR:</a>';
			}
		if (route=='INGROUP')
			{
			new_content = '<a href="admin.php?ADD=3111&group_id=' + selected_value + '">In-Group:</a>';
			}
		if (route=='DID')
			{
			new_content = '<a href="admin.php?ADD=3311&did_pattern=' + selected_value + '">DID:</a>';
			}

		if (new_content.length < 1)
			{new_content = selected_route}

		span_to_update.innerHTML = new_content;
		}

	<?php
	}
echo "</script>\n";
### Add by fnatic new style css ###
echo "<link type='text/css' rel='stylesheet' href='./new_style/css/style.css' />";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<!-- INTERNATIONALIZATION-LINKS-PLACEHOLDER-CCMS -->\n";

$stmt="SELECT admin_home_url,enable_tts_integration from system_settings;";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$admin_home_url_LU =	$row[0];
$SSenable_tts_integration = $row[1];
?>
<center>
<div id="listbd">
	<table border=0 cellspacing=0 cellpadding=0>
	  <tr><td valign=top>
		<div><img src="./new_style/images/logo.gif" /></div>
		<div><img src="./new_style/images/left_1.gif" /></div>
		<div class="left_center">     
	 <div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=0" class="white">Users</a></div>

	<?php if (strlen($users_hh) > 1) { 
		?>
	 <div id="left_line"><a href="<?php echo $ADMIN ?>">Show Users</a></div>
	 <div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1">Add A New User</a></div>
	 <div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1A">Copy User</a></div>
	 <div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1C">Batch Copy User</a></div>
	 <div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=550">Search For A User</a></div>
	 <div id="left_line" style="display:none"><a href="./user_stats.php?user=<?php echo $user ?>">User Stats</a></div>
	 <div id="left_line"><a href="./user_status.php?user=<?php echo $user ?>">User Status</a></div>
	 <div id="left_line" style="display:none"><a href="./AST_agent_time_sheet.php?agent=<?php echo $user ?>">Time Sheet</a></div>
	 <?php
	if ( ($SSuser_territories_active > 0) or ($user_territories_active > 0) )
		{ ?>

	 <div id="left_line"><a href="./user_territories.php?agent=<?php echo $user ?>">User Territories</a></div>

	<?php } 
	  } 
	?>
    <div><img src="./new_style/images/empty.gif" /></div>
    
	<!-- CAMPAIGNS NAVIGATION -->

	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=10" class="white">Campaigns</a></div>
	<?php
	if (strlen($campaigns_hh) > 1) 
		{ 
		if ($sh=='basic') {$sh='list';}
		if ($sh=='detail') {$sh='list';}
		if ($sh=='dialstat') {$sh='list';}

		if ($sh=='list') {$list_sh="bgcolor=\"$subcamp_color\""; $list_fc="$subcamp_font";}
			else {$list_sh=''; $list_fc='BLACK';}
		if ($sh=='status') {$status_sh="bgcolor=\"$subcamp_color\""; $status_fc="$subcamp_font";}
			else {$status_sh=''; $status_fc='BLACK';}
		if ($sh=='hotkey') {$hotkey_sh="bgcolor=\"$subcamp_color\""; $hotkey_fc="$subcamp_font";}
			else {$hotkey_sh=''; $hotkey_fc='BLACK';}
		if ($sh=='recycle') {$recycle_sh="bgcolor=\"$subcamp_color\""; $recycle_fc="$subcamp_font";}
			else {$recycle_sh=''; $recycle_fc='BLACK';}
		if ($sh=='autoalt') {$autoalt_sh="bgcolor=\"$subcamp_color\""; $autoalt_fc="$subcamp_font";}
			else {$autoalt_sh=''; $autoalt_fc='BLACK';}
		if ($sh=='pause') {$pause_sh="bgcolor=\"$subcamp_color\""; $pause_fc="$subcamp_font";}
			else {$pause_sh=''; $pause_fc='BLACK';}
		if ($sh=='listmix') {$listmix_sh="bgcolor=\"$subcamp_color\""; $listmix_fc="$subcamp_font";}
			else {$listmix_sh=''; $listmix_fc='BLACK';}

		?>
         <div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=10">Campaigns Main</a></div>
		 <div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=32">Call Result</a></div>
		 <div id="left_line" style="display:none"><a href="<?php echo $ADMIN ?>?ADD=33">HotKeys</a></div>
		<?php
		if ($SSoutbound_autodial_active > 0)
			{
			?>
			<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=35">Lead Recycle</a></div>
	        <div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=36">Auto-Alt Dial</a></div>
<!--		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=39">List Mix</a></div>   -->
			<?php
			}
		?>
		    <div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=37">Pause Codes</a></div>
	<?php } 
	?>
    
    <div><img src="./new_style/images/empty.gif" /></div>
	<!-- LISTS NAVIGATION -->
	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=100" class="white">Lists</a></div>
		<?php
		if (strlen($lists_hh) > 1) { 
			if ($LOGdelete_from_dnc > 0) {$DNClink = 'Add-Delete Number From DNC';}
			else {$DNClink = 'Add Number To DNC';}
			?>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=100">Show Lists</a></div>
		 
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=111">Add A New List</a></div>
		
		<div id="left_line" style="display:none"><a href="admin_search_lead.php">Search For A Lead</a></div>
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=121">Add-Delete Number From Outbound DNC</a></div>
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=121121">Add-Delete Number From Inbound DNC</a></div>
		
		<!--<div id="left_line"><a href="./new_listloader_superL.php">Load New Leads</a></div> -->
		<!--<div id="left_line"><a  target='_blank' href="../vtigercrm/index.php?module=Leads&action=Import&step=1&return_module=Leads&return_action=index&parenttab=My Home Page
">Load New Leads</a></div> -->
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=377">Load New Leads</a></div>
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=377111">Import Leads From CSV</a></div>
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=377333">Assign Leads</a></div>
		<?php } 
		}
	?>
    
    <div><img src="./new_style/images/empty.gif" /></div>
	<!-- SCRIPTS NAVIGATION -->

	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=1000000" class="white" >Scripts</a></div>

	<?php
	if (strlen($scripts_hh) > 1) 
		{ 
		?>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1000000">Show Scripts</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1111111">Add A New Script</a></div>

		<?php } 
	?>
    
    <div><img src="./new_style/images/empty.gif" /></div>
	<!-- FILTERS NAVIGATION -->
	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=10000000" class="white">Filters</a></div>
		<?php
		if (strlen($filters_hh) > 1) 
			{ 
			?>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=10000000">Show Filters</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=11111111">Add A New Filter</a></div>

		<?php } 
		}
	?>
    
    <div><img src="./new_style/images/empty.gif" /></div>
	<!-- INGROUPS NAVIGATION -->
	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=1000" class="white">In-Groups</a></div>
	<?php
	if (strlen($ingroups_hh) > 1) 
		{ 
		?>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1000">Show In-Groups</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1111">Add A New In-Group</a></div>
	
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1211">Copy In-Group </a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1300">Show DIDs</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1311">Add A New DID</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1411">Copy DID</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1500">Show IVRs</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1511">Add A New IVR</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1611">Copy IVR </a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1500099">Show Intelligent Routes</a></div>
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1500099&action=modify">Add A New Intelligent Route</a></div>
		<?php } 
		?>
        
    <div><img src="./new_style/images/empty.gif" /></div>
	<!-- USERGROUPS NAVIGATION -->
	
	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=100000" class="white">User Groups</a></div>

	<?php
	if (strlen($usergroups_hh) > 1)
		{ 
		?>
 
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=100000">Show User Groups</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=111111">Add A New User Group</a></div>
		
		<!--<div id="left_line"><a href="group_hourly_stats.php">Group Hourly Report</a></div>-->
		 
		<div id="left_line"><a href="user_group_bulk_change.php">Bulk Group Change</a></div>

		<?php } 
	?>
    
    <div><img src="./new_style/images/empty.gif" /></div>
	<!-- REMOTEAGENTS NAVIGATION -->
	
	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=10000" class="white">Remote Agents</a></div>

	<?php
	if (strlen($remoteagent_hh) > 1) 
		{ 
		?>
        
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=10000">Show Remote Agents</a></div>
	
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=11111">Add New Remote Agents</a></div>

	<?php } 
	?>
    
    <div><img src="./new_style/images/empty.gif" /></div>
	<!-- ADMIN NAVIGATION -->
	
	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=10000000000" class="white">Admin</a></div>

	<?php
	if (strlen($admin_hh) > 1) 
		{ 
		if ($sh=='times') {$times_sh="bgcolor=\"$times_color\""; $times_fc="$times_font";}
			else {$times_sh=''; $times_fc='BLACK';}
		if ($sh=='shifts') {$shifts_sh="bgcolor=\"$shifts_color\""; $shifts_fc="$shifts_font";}
			else {$shifts_sh=''; $shifts_fc='BLACK';}
		if ($sh=='templates') {$templates_sh="bgcolor=\"$templates_color\""; $templates_fc="$templates_font";}
			else {$templates_sh=''; $templates_fc='BLACK';}
		if ($sh=='carriers') {$carriers_sh="bgcolor=\"$carriers_color\""; $carriers_fc="$carriers_font";}
			else {$carriers_sh=''; $carriers_fc='BLACK';}
		if ($sh=='phones') {$phones_sh="bgcolor=\"$server_color\""; $phones_fc="$phones_font";}
			else {$phones_sh=''; $phones_fc='BLACK';}
		if ($sh=='server') {$server_sh="bgcolor=\"$server_color\""; $server_fc="$server_font";}
			else {$server_sh=''; $server_fc='BLACK';}
		if ($sh=='conference') {$conference_sh="bgcolor=\"$server_color\""; $conference_fc="$server_font";}
			else {$conference_sh=''; $conference_fc='BLACK';}
		if ($sh=='settings') {$settings_sh="bgcolor=\"$settings_color\""; $settings_fc="$settings_font";}
			else {$settings_sh=''; $settings_fc='BLACK';}
		if ($sh=='status') {$status_sh="bgcolor=\"$status_color\""; $status_fc="$status_font";}
			else {$status_sh=''; $status_fc='BLACK';}
		if ($sh=='audio') {$audio_sh="bgcolor=\"$audio_color\""; $audio_fc="$audio_font";}
			else {$audio_sh=''; $audio_fc='BLACK';}
		if ($sh=='moh') {$moh_sh="bgcolor=\"$moh_color\""; $moh_fc="$moh_font";}
			else {$moh_sh=''; $moh_fc='BLACK';}
		if ($sh=='vm') {$vm_sh="bgcolor=\"$vm_color\""; $vm_fc="$vm_font";}
			else {$vm_sh=''; $vm_fc='BLACK';}
		if ($sh=='tts') {$tts_sh="bgcolor=\"$tts_color\""; $tts_fc="$tts_font";}
			else {$tts_sh=''; $tts_fc='BLACK';}

		?>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=100000000">Call Times</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=130000000">Shifts</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=10000000000">Phones</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=130000000000">Templates</a></div>
        
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=140000000000">Carriers</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=100000000000">Servers</a></div>
        
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=1000000000000">Conferences</a></div>
	
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=311111111111111">System Settings</a></div>
        
        	<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=331111111111111222">System Call Result Type</a></div>
		
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=321111111111111">System Call Result</a></div>
        
		<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=170000000000">Voicemail</a></div>

		<?php if ( ($sounds_central_control_active > 0) or ($SSsounds_central_control_active > 0) )
			{ ?>
			<div id="left_line"><a href="audio_store.php">Audio Store</a></div>

			<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=160000000000">Music On Hold</a></div>


		<?php }
		if ($SSenable_tts_integration > 0)
			{ ?>
			 
			<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=150000000000">Text To Speech</a></div>

		<?php }
			
	?>

			<div id="left_line"><a href="<?php echo $ADMIN ?>?ccms_admin_modules=performance_report">Server Performance Report</a></div>
			<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=700000000000000">Administration Change Log</a></div>
			<?php
			/*
				if(!empty($LOGuser_level) && !empty($LOGuser_name_id)){
					$stmt = getCampaignSql($LOGuser_level,$LOGuser_name_id);
					echo $stmt;exit;
					$rslt=mysql_query($stmt, $link);
					$campaigns_count_menu = mysql_num_rows($rslt);
					$menu_str_temp = "";
					if($campaigns_count_menu > 1 || $campaigns_count_menu < 1){
						$menu_str_temp = $ADMIN . '?ADD=3777';
					}else{
						$menu_str_temp = $ADMIN . '?ccms_admin_modules=vtigercrm';
					}
				}else{
					$menu_str_temp = $ADMIN . '?ADD=3777';
				}
			*/
				$menu_str_temp = $ADMIN . '?ADD=3777';
			?>
			<div id="left_line"><a href="<?php echo $menu_str_temp ?>">Modules</a></div>
			<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=99998888">CSAT</a></div>

	  <?php
		}
	  ?>

	<div><img src="./new_style/images/empty.gif" /></div>

	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=999999" class="white">Reports</a></div>
	<?php
	if (strlen($reports_hh) > 1) { 
	?>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=201211131143">Report Manager</a></div>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=9999999999">Real-Time Reports</a></div>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=999999">Historical Reports</a></div>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=9999991">历史报表</a></div>
	<?php } ?>
	<div><img src="./new_style/images/empty.gif" /></div>
	
<div id="left_menu"><a href="<?php echo $ADMIN ?>?ADD=423&page=1" class="white">Notices</a></div>	
	<?php
	if (strlen($notice_hh) > 1 && $PHP_AUTH_USER =='admin') { 
	?>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=423&page=1">Show Notices</a></div>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ADD=424">Add A New Notice</a></div>
	
	<?php } ?>
	<div><img src="./new_style/images/empty.gif" /></div>
	
	<div><img src="./new_style/images/empty.gif" /></div>

	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ccms_admin_modules=forecast_outbound_handle" class="white">Predictive Dial</a></div>
	<?php
	if (strlen($client_hh) > 1) { 
	?>
	<div id="left_line"><a onclick=small_menu_openwindow("./forecast_outbound_handle.php") href="#">Config</a></div>
	<?php } ?>

	<div><img src="./new_style/images/empty.gif" /></div>
	<div id="left_menu"><a href="<?php echo $ADMIN ?>?ccms_admin_modules=search_call_log" class="white">Monitor</a></div>
	<script>
	function small_menu_openwindow(url)
			{
			var wd_url=url;
			var wd_width=screen.availWidth;
			var wd_height=screen.availHeight;
			var wd_top=15;
			var wd_left=15;
			var wd_toolbar=0;
			var wd_menubar="no";
			var wd_scrollbars="YES";
			var wd_resizable="YES";
			var wd_location="no";
			var wd_status="no"; 
			window.open (wd_url, '', 'height='+wd_height+', width='+wd_width+', top='+wd_top+', left='+wd_left+', toolbar='+wd_toolbar+', menubar='+wd_menubar+', scrollbars='+wd_scrollbars+', resizable='+wd_resizable+',location='+wd_location+', status='+wd_status);
			}
	</script>
			<?php
	if (strlen($monitor_hh) > 1) 
		{ 
		?>
	<?php
		if ($LOGlive_monitor==1){
	?>

	<div id="left_line"><a onClick="small_menu_openwindow('AST_timeonVDADallAJAX.php?report_name=monitor');" href="#">Live Monitor</a></div>
	<?php
		}else{
	?>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ccms_admin_modules=live_monitor">Live Monitor</a></div>
	<?php
	}
	?>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ccms_admin_modules=search_call_log">Search Call Log</a></div>
	<div id="left_line"><a href="<?php echo $ADMIN ?>?ccms_admin_modules=search_voice_mail">Search Voice Mail</a></div>
	<?php
		}
	?>
	 </div>
     <div><img src="./new_style/images/left_3.gif" /></div>
     <div class="left_bottom"><!--VERSION:2.2.1-27 BUILD:100510-2015--></div>
</div>
  <div>CCMS 版本：<?php echo $version ;?></div>
  </td>
<!-- END SIDEBAR NAVIGATION -->

<span style="position:absolute;left:300px;top:30px;z-index:1;visibility:hidden;" id="audio_chooser_span">

</span>

<td valign=top align=left>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="44%"><a href="<?php echo $ADMIN ?>?ADD=120329&user=<?php echo $PHP_AUTH_USER ?>">Change Password</a> | <a href="<?php echo $admin_home_url_LU ?>">Home</a> <span style="display:none" id = "time_clock"> | <a href="../agc/timeclock.php?referrer=admin">Timeclock</a> </span>| <a href="<?php echo $ADMIN ?>?force_logout=1">Loqout</a></td>
          <td width="56%" class="right_topfont"><?php echo date("l F j, Y G:i:s A") ?></td>
        </tr>
      </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="right_centerbg">
           <div id="xsnazzy">
            <b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
             <div class="xboxcontent">

 	<?php
	if ($ADD==10) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=10">Show Campaigns</a> | <a href="<?php echo $ADMIN ?>?ADD=11">Add A New Campaign</a> | <a href="<?php echo $ADMIN ?>?ADD=12">Copy Campaign</a> 
		<?php } ?>
 	<?php
	if ($ADD==11 && $LOGadd_new_campaigns==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=10">Show Campaigns</a> | <a href="<?php echo $ADMIN ?>?ADD=11">Add A New Campaign</a> | <a href="<?php echo $ADMIN ?>?ADD=12">Copy Campaign</a> 
		<?php } ?>
 	<?php
	if ($ADD==12) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=10">Show Campaigns</a> | <a href="<?php echo $ADMIN ?>?ADD=11">Add A New Campaign</a> | <a href="<?php echo $ADMIN ?>?ADD=12">Copy Campaign</a> 
		<?php } ?>
 	<?php
	if ($ADD==99998888 || $ADD==999988888) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=99998888">Show CSAT</a> | <a href="<?php echo $ADMIN ?>?ADD=99998888&csat_action=add">Add A New CSAT</a>
	| <a href="<?php echo $ADMIN ?>?ADD=999988888">Show CSAT Item</a> | <a href="<?php echo $ADMIN ?>?ADD=999988888&csat_action=add">Add A New CSAT Item</a>
		<?php } ?>
	<?php
	if ($ADD==331111111111111222 || $ADD==331111111111111222) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=331111111111111222">Show System Call Result Type</a> | <a href="<?php echo $ADMIN ?>?ADD=331111111111111222">Add A New System Call Result Type</a>
		<?php } ?>
		<?php
	if (strlen($times_sh) > 1 && $LOGast_admin_access==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=100000000">Show Call Times</a> | <a href="<?php echo $ADMIN ?>?ADD=111111111"> Add A New Call Time</a> | <a href="<?php echo $ADMIN ?>?ADD=1000000000">Show State Call Times</a> | <a href="<?php echo $ADMIN ?>?ADD=1111111111">Add A New State Call Time</a>
		<?php } 
	if (strlen($shifts_sh) > 1 && $LOGast_admin_access==1) { 
		?>
	 <a href="<?php echo $ADMIN ?>?ADD=130000000">Show Shifts</a> | <a href="<?php echo $ADMIN ?>?ADD=131111111">Add A New Shift</a>
		<?php } 
	if (strlen($phones_sh) > 1 && $LOGast_admin_access==1) { 
		?>
	 <a href="<?php echo $ADMIN ?>?ADD=10000000000">Show Phones</a> | <a href="<?php echo $ADMIN ?>?ADD=11111111111">Add A New Phone</a> | <a href="<?php echo $ADMIN ?>?ADD=12000000000">Phone Alias List</a> | <a href="<?php echo $ADMIN ?>?ADD=12111111111">Add A New Phone Alias</a> | <a href="<?php echo $ADMIN ?>?ADD=13000000000">Group Alias List</a> | <a href="<?php echo $ADMIN ?>?ADD=13111111111">Add A New Group Alias</a> | <p align="left"><a href="<?php echo $ADMIN ?>?ADD=17111111111">Batch Add Phones</a></p>
		<?php }
	if (strlen($conference_sh) > 1 && $LOGast_admin_access==1) { 
		?>
     <a href="<?php echo $ADMIN ?>?ADD=1000000000000">Show Conferences</a> | <a href="<?php echo $ADMIN ?>?ADD=1111111111111">Add A New Conference</a> | <a href="<?php echo $ADMIN ?>?ADD=10000000000000">Show CCMS Conferences</a> | <a href="<?php echo $ADMIN ?>?ADD=11111111111111">Add A New CCMS Conference</a>
		<?php }
	if ( (strlen($server_sh) > 1) and (strlen($admin_hh) > 1) && $LOGast_admin_access==1) { 
		?>
	 <a href="<?php echo $ADMIN ?>?ADD=100000000000">Show Servers</a> | <a href="<?php echo $ADMIN ?>?ADD=111111111111">Add A New Server</a>
	<?php }
	if ( (strlen($templates_sh) > 1) and (strlen($admin_hh) > 1)  && $LOGast_admin_access==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=130000000000">Show Templates</a> | <a href="<?php echo $ADMIN ?>?ADD=131111111111">Add A New Template</a>
	<?php }
	if ( (strlen($carriers_sh) > 1) and (strlen($admin_hh) > 1) && $LOGast_admin_access==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=140000000000">Show Carriers</a> | <a href="<?php echo $ADMIN ?>?ADD=141111111111">Add A New Carrier</a>
	<?php }
	if ( (strlen($tts_sh) > 1) and (strlen($admin_hh) > 1)  && $LOGast_admin_access==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=150000000000">Show TTS Entries</a> | <a href="<?php echo $ADMIN ?>?ADD=151111111111">Add A New TTS Entry</a>
	<?php }
	if ( (strlen($moh_sh) > 1) and (strlen($admin_hh) > 1) && $LOGast_admin_access==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=160000000000">Show MOH Entries</a> | <a href="<?php echo $ADMIN ?>?ADD=161111111111">Add A New MOH Entry</a>
	<?php }
	if ( (strlen($vm_sh) > 1) and (strlen($admin_hh) > 1) && $LOGast_admin_access==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=170000000000">Show Voicemail Entries</a> | <a href="<?php echo $ADMIN ?>?ADD=171111111111">Add A New Voicemail Entry</a>
	<?php }
	if (strlen($settings_sh) > 1 && $LOGast_admin_access==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=311111111111111">System Settings</a>
	<?php }
	if ( (strlen($status_sh) > 1) and (!eregi('campaign',$hh) ) && $LOGast_admin_access==1) { 
		?>
	<a href="<?php echo $ADMIN ?>?ADD=321111111111111">System Call Result</a> | <a href="<?php echo $ADMIN ?>?ADD=331111111111111">Status Categories</a> | <a href="<?php echo $ADMIN ?>?ADD=341111111111111">QC Status Codes</a>
	<?php }

	if ( $ADD=='3' && $LOGmodify_users == 1) { 
		?>
	<span id="user_stats" style="display:none"><a href="./user_stats.php?user=<?php echo $user ?>">User Stats</a> | </span><a href="./user_status.php?user=<?php echo $user ?>">User Status</a> | <span id="time_sheet" style="display:none"><a href="./AST_agent_time_sheet.php?agent=<?php echo $user ?>">Time Sheet</a> | </span><a href="./AST_agent_days_detail.php?user=<?php echo $user ?>">Days Status</a>
	<?php }

	
if (strlen($reports_hh) > 1) { 
	?>

<?php } }?>
