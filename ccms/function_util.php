<?php
/*
@module     模块  users usergroups campaigns lists ....
@user_level 用户级别
@return     base 基本视图  full 全部视图
*/
function  getview($module,$user_level){
	if ($user_level == 9){
		  return "full";
	}else{
	    return "base";	
	} 
}

/*add by heibo
@inparam $user_group  当前用户组
@inparam $user_level  用户级别 8 7 6
@return  html:用户页面中修改 manager supervisor qa时返回视图
*/
function getUserManagerHtml($user_group,$user_level){
    global $link;
    
    $elementname = "";
    
    if ( $user_level == 8 ){
    	   $stmt = "select manager from vicidial_user_groups where user_group='$user_group';";
    	   $elementname = "manager_select[]";
    }
    if ( $user_level == 7 ){
    	   $stmt = "select supervisor from vicidial_user_groups where user_group='$user_group';";
    	   $elementname = "supervisor_select[]";
    }    
    if ( $user_level == 6 ){
    	   $stmt = "select qa from vicidial_user_groups where user_group='$user_group';";
    	   $elementname = "qa_select[]";
    }
     //echo      $stmt;
		$rslt = mysql_query($stmt, $link);
		$row  = mysql_fetch_row($rslt);
		$manager = $row[0];
		if (isset($manager)){
		    $Amanager = explode(",",$manager);
		}else{
		    $Amanager = array();
		}    

		$str = "";
		if ( $user_level == 7 ){
		    $stmt= "select user,user_id from vicidial_users where user_level=$user_level and active=1 and user_group='$user_group';";
		}else{
			  $stmt= "select user,user_id from vicidial_users where user_level=$user_level and active=1";
		}    
		
		$rslt=mysql_query($stmt, $link);
		$camps_to_print = mysql_num_rows($rslt);
		$o=0;
		if ($camps_to_print ==0) $str = $str . "<input type=checkbox name=$elementname value='' >NONE<br>";
		while ($camps_to_print > $o) 
		{
			$row=mysql_fetch_row($rslt);
			if( in_array($row[0],$Amanager) ){
				$str .= "<input type=checkbox name=$elementname value=\"" . $row[0] . "\" checked >" . $row[0] . "<br>";
			}else{
				$str .= "<input type=checkbox name=$elementname value=\"" . $row[0] . "\" >" . $row[0] . "<br>";
			}
			$o++;
		}

		return $str;
}

/*
@inparam  $user_level 用户级别
@inparam  $user_name  用户名
@inparam  $SQLstatus  active='Y'
@inparam  $SQLorder   order by
@返回sql语句 User List 管理的用户范围
*/
function getUsersList($user_level=0,$user_name="",$SQLstatus="",$SQLorder=""){
	   $stmt = "";
	   if ($user_level == 9){
	   	   $stmt = "SELECT user,full_name,user_level,user_group,active from vicidial_users where 1 $SQLstatus $SQLorder;";
	   }else{
	   	   $stmt = "SELECT user,full_name,user_level,user_group,active from vicidial_users where user_level<=$user_level ";
	   	   $stmt = $stmt . " and user_group in ( ";
	   	   $stmt = $stmt . "  select distinct(user_group) from vicidial_user_groups ";
	   	   $stmt = $stmt . "     where fun_instr(manager,'$user_name') = 1 ";
	   	   $stmt = $stmt . "     or fun_instr(supervisor,'$user_name') = 1 ";
	   	   $stmt = $stmt . "     or fun_instr(qa,'$user_name') = 1 ";	   	   
	   	   $stmt = $stmt . " ) ";
	   	   $stmt = $stmt . $SQLstatus . " ". $SQLorder;
	 	 }
	   return $stmt;
}

/*
@inparam  $user_level 用户级别
@inparam  $user_name  用户名
@inparam  $SQLstatus  active='Y'
@inparam  $SQLorder   order by
@返回sql语句 User List 管理的用户范围
*/
function getUsersList_Access($user_level=0,$user_name="",$SQLstatus="",$SQLorder="order by full_name asc"){
	   $stmt = "";
	   if ($user_level == 9){
	   	   $stmt = "SELECT user,full_name,user_level,user_group,active from vicidial_users where 1 $SQLstatus $SQLorder;";
	   }elseif ( $user_level == 8 || $user_level == 7 ||  $user_level == 6 ){
	   	   $stmt = "SELECT user,full_name,user_level,user_group,active from vicidial_users where user_level<=$user_level ";
	   	   $stmt = $stmt . " and user_group in ( ";
	   	   $stmt = $stmt . "  select distinct(user_group) from vicidial_user_groups ";
	   	   $stmt = $stmt . "     where fun_instr(manager,'$user_name') = 1 ";
	   	   $stmt = $stmt . "     or fun_instr(supervisor,'$user_name') = 1 ";
	   	   $stmt = $stmt . "     or fun_instr(qa,'$user_name') = 1 ";	   	   
	   	   $stmt = $stmt . " ) ";
	   	   $stmt = $stmt . $SQLstatus . " ". $SQLorder;
	 	 }else{
	 	 	   $stmt = "SELECT user,full_name,user_level,user_group,active from vicidial_users where user='$user_name' $SQLorder;";
	 	 }
	   return $stmt;
}

/*
@inparam  $user_level 用户级别
@inparam  $user_name  用户名
@inparam  $SQL  查询条件
@返回sql语句 User List查询 管理的用户范围
*/
function getSearchUsersList($user_level=0,$user_name="",$SQL=""){
	   $stmt = "";
	   $field = "";   
	   
	   if ($user_level == 9){
	   	   $stmt = "SELECT user_id,user,pass,full_name,user_level,user_group,phone_login,phone_pass,delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,shift_override_flag,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts from vicidial_users  where 1 $SQL;";
	   	   $stmt = $stmt . "order by full_name desc;";
	   }else{
	   	   $stmt = "SELECT user_id,user,pass,full_name,user_level,user_group,phone_login,phone_pass,delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,shift_override_flag,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts from vicidial_users  where user_level<=$user_level ";
	   	   $stmt = $stmt . " and user_group in ( ";
	   	   $stmt = $stmt . "  select distinct(user_group) from vicidial_user_groups ";
	   	   $stmt = $stmt . "     where fun_instr(manager,'$user_name') = 1 ";
	   	   $stmt = $stmt . "     or fun_instr(supervisor,'$user_name') = 1 ";
	   	   $stmt = $stmt . "     or fun_instr(qa,'$user_name') = 1 ";	   	   
	   	   $stmt = $stmt . " ) ";
	   	   $stmt = $stmt . $SQL . " order by full_name desc; ";
	 	 }
	   return $stmt;
}


/*
@inparam  $user_level 用户级别
@inparam  $user_name  用户名
@sql_field  查询返回字符串类别
@返回sql语句 User Group List  管理的用户组
@example: getUserGroupsList($LOGuser_level,$LOGuser_name_id,1); 
*/
function getUserGroupsList($user_level=0,$user_name="",$sql_field = 1){
	
	$stmt  = "";
  $field = "";
  if ( $sql_field == 1 ){
  	   $field = " a.user_group,a.group_name ";
  }
  if ( $sql_field == 2){
  	   $field = " a.user_group,a.group_name,a.forced_timeclock_login ";
  }
  
	if ( $user_level == 9 ) {
		  $stmt = "SELECT $field from vicidial_user_groups a order by a.user_group";
  }elseif ( $user_level == 8 || $user_level == 7 ||  $user_level == 6 ) {
	    $stmt = "SELECT $field from vicidial_user_groups a where fun_instr(a.supervisor,'$user_name') = 1 ";
	    $stmt = $stmt . " or fun_instr(a.manager,'$user_name') = 1 ";
	    $stmt = $stmt . " or fun_instr(a.qa,'$user_name') = 1 ";
	    $stmt = $stmt . "  order by a.user_group";
	}

	return $stmt;
	   
}

/*
@inparam  $user_level 用户级别
@inparam  $user_name  用户名
@sql_field  查询返回字符串类别
@返回sql语句 User Group List  访问的用户组
@example: getUserGroupsList_acc($LOGuser_level,$LOGuser_name_id,1); 
*/
function getUserGroupsList_Access($user_level=0,$user_name="",$sql_field = 1){
	
	$stmt  = "";
  $field = "";
  if ( $sql_field == 1 ){
  	   $field = " a.user_group,a.group_name ";
  }
  if ( $sql_field == 2){
  	   $field = " a.user_group,a.group_name,a.forced_timeclock_login ";
  }
  
	if ( $user_level == 9 ) {
		  $stmt = "SELECT $field from vicidial_user_groups a order by a.user_group";
  }elseif ( $user_level == 8 || $user_level == 7 ||  $user_level == 6 ) {
	    $stmt = "SELECT $field from vicidial_user_groups a where fun_instr(a.supervisor,'$user_name') = 1 ";
	    $stmt = $stmt . " or fun_instr(a.manager,'$user_name') = 1 ";
	    $stmt = $stmt . " or fun_instr(a.qa,'$user_name') = 1 ";
	    $stmt = $stmt . "  order by a.user_group";
	}else{
		  $stmt = "SELECT $field from vicidial_user_groups a,vicidial_users b where a.user_group = b.user_group and b.user = '$user_name';";
	}

	return $stmt;
	   
}

/*
管理的campaign
*/
function getCampaignSql($LOGuser_level,$LOGuser_id,$active='Y'){
	global $link;
	$sql_active= "";
	if($active != 'Y'){
		$sql_active= "where active='Y'";
	}
	$stmt="SELECT campaign_id,campaign_name,active,dial_method,auto_dial_level,lead_order,dial_statuses,vtiger_url,enable_vtiger_integration,inbound_mode,voicemail_ext from vicidial_campaigns $sql_active order by campaign_id";
	if($LOGuser_level <= 8){
	  $stmt2 = "select allowed_campaigns from vicidial_user_groups ";
	  $stmt2 = $stmt2 . " where fun_instr(manager,'$LOGuser_id') = 1 ";
	  $stmt2 = $stmt2 . " or fun_instr(supervisor,'$LOGuser_id') = 1 ";
	  $stmt2 = $stmt2 . " or fun_instr(qa,'$LOGuser_id') = 1 ";	  

	  $rslt=mysql_query($stmt2, $link);
	  $count_temp = mysql_num_rows($rslt);
	  $i = 0;
	  if($DB) {echo "$stmt\n";}
	  $allowed_campaigns_total = "";
	  while($i< $count_temp){
		  $row=mysql_fetch_row($rslt);
		  $allowed_campaigns=$row[0];
		  $allowed_campaigns=substr(trim($allowed_campaigns),0,strlen($allowed_campaigns)-3);
		  $allowed_campaigns_total = $allowed_campaigns_total . $allowed_campaigns . ' ';
		  $i++;
	  }
	  $allowed_campaigns_array = array_unique(explode(" ",$allowed_campaigns_total));
	  foreach($allowed_campaigns_array as $k=>$v){
		if(!$v){
			unset($allowed_campaigns_array[$k]);
		}else{
			$allowed_campaigns_array[$k] = "'" . $allowed_campaigns_array[$k] . "'";
		}
	  }
	  
	  if(!stripos(implode(",",$allowed_campaigns_array),"-ALL-CAMPAIGNS-")){
		$stmt="SELECT campaign_id,campaign_name,active,dial_method,auto_dial_level,lead_order,dial_statuses,vtiger_url,enable_vtiger_integration,inbound_mode,voicemail_ext from vicidial_campaigns where active='Y' and campaign_id in (". implode(",",$allowed_campaigns_array) . ") order by campaign_id";
	  }
	  
	}
	return $stmt;
}

function getclosercampaigns($closer_campaigns){
 		$closer_campaigns = preg_replace("/^ | -$/","",$closer_campaigns);
		$closer_campaigns = preg_replace("/ /","','",$closer_campaigns);
	  return "'" . $closer_campaigns . "'";
}

/*
@inparam  $user_level 用户级别
@inparam  $user_name  用户名
@返回sql语句 管理的campaigns
*/
function getOwnCampaigns($user_level,$user_name){
	
  if ($user_level == 9){
      $stmt = "SELECT campaign_id,campaign_name,active,dial_method,auto_dial_level,lead_order,dial_statuses,vtiger_url,enable_vtiger_integration,inbound_mode,voicemail_ext FROM  vicidial_campaigns order by campaign_id ";
  }else{
			$stmt = "SELECT campaign_id,campaign_name,active,dial_method,auto_dial_level,lead_order,dial_statuses,vtiger_url,enable_vtiger_integration,inbound_mode,voicemail_ext FROM  vicidial_campaigns a ";
			$stmt =  $stmt . " where active='Y'";
			$stmt =  $stmt . " and exists ( SELECT 1  FROM vicidial_user_groups c " ;
			$stmt =  $stmt . "                where (fun_instr(c.supervisor,'$user_name') = 1 or fun_instr(c.manager,'$user_name') = 1 or fun_instr(c.qa,'$user_name')=1 ) and   ";
			$stmt =  $stmt . "                ( c.allowed_campaigns regexp concat(' ',a.campaign_id,' ') = 1 or ";
		  $stmt =  $stmt . " 	                INSTR(c.allowed_campaigns,'ALL-CAMPAIGNS') >0 ";
		  $stmt =  $stmt . "                 ) ";
		  $stmt =  $stmt . " ) order by campaign_id ";  	
	} 
	return $stmt;	
	
}
/*
function getOwnCampaigns($user_level,$user_name){
	
  if ($user_level == 9){
      $stmt = "SELECT campaign_id,campaign_name,active,dial_method,auto_dial_level,lead_order,dial_statuses,vtiger_url,enable_vtiger_integration,inbound_mode,voicemail_ext FROM  vicidial_campaigns order by campaign_id ";
  }else{
			$stmt = "SELECT campaign_id,campaign_name,active,dial_method,auto_dial_level,lead_order,dial_statuses,vtiger_url,enable_vtiger_integration,inbound_mode,voicemail_ext FROM  vicidial_campaigns a ";
			$stmt =  $stmt . " where active='Y'";
			$stmt =  $stmt . " and exists ( SELECT 1  FROM vicidial_users b,vicidial_user_groups c " ;
			$stmt =  $stmt . "                where b.user_group = c.user_group and b.user = '$user_name' and   ";
			$stmt =  $stmt . "                ( c.allowed_campaigns regexp concat(' ',a.campaign_id,' ') = 1 or ";
		  $stmt =  $stmt . " 	                INSTR(c.allowed_campaigns,'ALL-CAMPAIGNS') >0 ";
		  $stmt =  $stmt . "                 ) ";
		  $stmt =  $stmt . " ) order by campaign_id ";  	
	} 
	return $stmt;	
	
}
*/

/*
@inparam  $user_level 用户级别
@inparam  $user_name  用户名
@返回sql语句 可以访问的campaigns 的邮箱路径
*/
function getOwnVoicemails($user_level,$user_name){
	if ($user_level == 9){
		$stmt = "SELECT voicemail_ext,campaign_name FROM  vicidial_campaigns a  order by campaign_id ";
  }else{	
		$stmt = "";
		$stmt = "SELECT voicemail_ext,campaign_name FROM  vicidial_campaigns a ";
		$stmt =  $stmt . " where active='Y'";
		$stmt =  $stmt . " and exists ( SELECT 1  FROM vicidial_user_groups c " ;
		$stmt =  $stmt . "                where (fun_instr(c.supervisor,'$user_name') = 1 or fun_instr(c.manager,'$user_name') = 1 or fun_instr(c.qa,'$user_name')=1 ) and   ";
		$stmt =  $stmt . "                ( c.allowed_campaigns regexp concat(' ',a.campaign_id,' ') = 1 or ";
	  $stmt =  $stmt . " 	                INSTR(c.allowed_campaigns,'ALL-CAMPAIGNS') >0 ";
	  $stmt =  $stmt . "                 ) ";
	  $stmt =  $stmt . " ) order by campaign_id "; 
  }
	return $stmt;	

	
}

/*
可以管理的lists
*/
function getListCampaign_limit($user_level,$user_name){
	
    global $link;
    $campaign_limit = "";
    
    if( $user_level <= 8 ){
    	
			  $stmt2 = "select allowed_campaigns from vicidial_user_groups ";
			  $stmt2 = $stmt2 . "  where fun_instr(supervisor,'$user_name') = 1 ";
			  $stmt2 = $stmt2 . "     or fun_instr(manager,'$user_name') = 1 ";
			  $stmt2 = $stmt2 . "     or fun_instr(qa,'$user_name') = 1 ";
			  
			  $rslt=mysql_query($stmt2, $link);
			  $count_temp = mysql_num_rows($rslt);
			  $i = 0;
			  if($DB) {echo "$stmt\n";}
			  $allowed_campaigns_total = "";
			  while($i< $count_temp){
				  $row=mysql_fetch_row($rslt);
				  $allowed_campaigns=$row[0];
				  $allowed_campaigns=substr(trim($allowed_campaigns),0,strlen($allowed_campaigns)-3);
				  $allowed_campaigns_total = $allowed_campaigns_total . $allowed_campaigns . ' ';
				  $i++;
			  }
			  $allowed_campaigns_array = array_unique(explode(" ",$allowed_campaigns_total));
			  foreach($allowed_campaigns_array as $k=>$v){
				if(!$v){
					unset($allowed_campaigns_array[$k]);
				}else{
					$allowed_campaigns_array[$k] = "'" . $allowed_campaigns_array[$k] . "'";
				}
			  }
			  if(!stripos(implode(",",$allowed_campaigns_array),"-ALL-CAMPAIGNS-")){
				   $campaign_limit = "vls.campaign_id in(" . implode(",",$allowed_campaigns_array) . ") and ";
			  }
	  }
	  return $campaign_limit;
	
	
}

/*
当前用户能访问的技能组范围
@example $LOGuser_level,$LOGuser_name_id
*/
function getIngroupList($user_name){
	 $stmt = "";
   
	 $stmt = " select group_id,group_name,inbound_mode from vicidial_inbound_groups a ";
	 $stmt = $stmt . "  where exists ( ";	
	 $stmt = $stmt . "          select 1 from vicidial_campaigns b  ";
	 $stmt = $stmt . "          where   exists ( SELECT 1  FROM vicidial_users c,vicidial_user_groups d ";
	 $stmt = $stmt . "                         where c.user_group = d.user_group and c.user = '$user_name' and ";
	 $stmt = $stmt . "                          ( d.allowed_campaigns regexp concat(' ',b.campaign_id,' ') = 1 or INSTR(d.allowed_campaigns,'ALL-CAMPAIGNS') >0   ) ";
	 $stmt = $stmt . "                       ) ";
	 $stmt = $stmt . "          and concat(' ',b.closer_campaigns,' ') regexp binary concat(' ',ltrim(rtrim(a.group_id)),' ') = 1 ";	 
	 $stmt = $stmt . "  ) order by inbound_mode,group_id ";		 

	 return $stmt;
}


/*
当前用户能管理的技能组范围
@example $LOGuser_level,$LOGuser_name_id
*/
function getIngroupList_Access($user_level = 0,$user_name){
	 $stmt = "";
   if ( $user_level ==9 ){
     $stmt = " select group_id,group_name,inbound_mode from vicidial_inbound_groups a ";
     $stmt = $stmt . "  order by inbound_mode,group_id ";	
   }else{
		 $stmt = " select group_id,group_name,inbound_mode from vicidial_inbound_groups a ";
		 $stmt = $stmt . "  where exists ( ";	
		 $stmt = $stmt . "          select 1 from vicidial_campaigns b  ";
		 $stmt = $stmt . "          where   exists ( SELECT 1  FROM vicidial_user_groups d ";
		 $stmt = $stmt . "                         where (fun_instr(d.supervisor,'$user_name') = 1 or fun_instr(d.manager,'$user_name') = 1 or fun_instr(d.qa,'$user_name')=1 ) and ";
		 $stmt = $stmt . "                          ( d.allowed_campaigns regexp concat(' ',b.campaign_id,' ') = 1 or INSTR(d.allowed_campaigns,'ALL-CAMPAIGNS') >0   ) ";
		 $stmt = $stmt . "                       ) ";
		 $stmt = $stmt . "          and concat(' ',b.closer_campaigns,' ') regexp binary concat(' ',ltrim(rtrim(a.group_id)),' ') = 1 ";	 
		 $stmt = $stmt . "  ) order by inbound_mode,group_id ";	 	
 	 }
	 

	 return $stmt;
}

/*
当前用户能访问的技能组范围
@example $LOGuser_level,$LOGuser_name_id
*/
function getIngroupListByGroup($user_group){
	 $stmt = "";

	 $stmt = " select group_id,group_name,inbound_mode from vicidial_inbound_groups a ";
	 $stmt = $stmt . "  where exists ( ";	
	 $stmt = $stmt . "          select 1 from vicidial_campaigns b  ";
	 $stmt = $stmt . "          where   exists ( SELECT 1  FROM vicidial_user_groups d ";
	 $stmt = $stmt . "                         where d.user_group = '$user_group' and ";
	 $stmt = $stmt . "                          ( d.allowed_campaigns regexp concat(' ',b.campaign_id,' ') = 1 or INSTR(d.allowed_campaigns,'ALL-CAMPAIGNS') >0   ) ";
	 $stmt = $stmt . "                       ) ";
	 $stmt = $stmt . "          and concat(' ',b.closer_campaigns,' ') regexp binary concat(' ',ltrim(rtrim(a.group_id)),' ') = 1 ";	 
	 $stmt = $stmt . "  ) order by inbound_mode,group_id ";		 

	 return $stmt;
}

/*修改用户能访问的技能组*/
function getIngroupHtml($user){
	
	global $link;
	
	$stmt="SELECT closer_campaigns from vicidial_users where user='$user';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$closer_campaigns =	$row[0];
	$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
	$groups = explode(" ", $closer_campaigns);
			
	$stmt=getIngroupList($user);
	
	$rslt=mysql_query($stmt, $link);
	$groups_to_print = mysql_num_rows($rslt);
	$groups_list='';
	$groups_value='';
	$XFERgroups_list='';
	$RANKgroups_list="<tr><td>INBOUND GROUP</td><td stylexxx=\"display:none\"> &nbsp; &nbsp; RANK</td><td style=\"display:none\"> &nbsp; &nbsp; CALLS</td><td ALIGN=CENTER style=\"display:none\">WEB VARS</td></tr>\n";
	
	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$group_id_values[$o] = $rowx[0];
		$group_name_values[$o] = $rowx[1];
		$inbound_modes[$o] = $rowx[2];
		$o++;
		}
	$o=0;
	while ($groups_to_print > $o)
		{
		$group_web_vars='';
		$group_web='';
		$stmt="SELECT group_rank,calls_today,group_web_vars from vicidial_inbound_group_agents where user='$user' and group_id='$group_id_values[$o]'";
		$rslt=mysql_query($stmt, $link);
		$ranks_to_print = mysql_num_rows($rslt);
		if ($ranks_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$SELECT_group_rank =	$row[0];
			$calls_today =			$row[1];
			$group_web_vars =		$row[2];
			}
		else
			{$calls_today=0;   $SELECT_group_rank=0;}

     $group_rank = $SELECT_group_rank;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#FFFFFF"';} 
		else
			{$bgcolor='bgcolor="#C2C2C2"';}


		$RANKgroups_list .= "<tr $bgcolor><td><input type=\"checkbox\" name=\"groups[]\" value=\"$group_id_values[$o]\"";
		
		$p=0;
		$group_ct = count($groups);
		while ($p < $group_ct)
			{
			if ($group_id_values[$o] == $groups[$p]) 
				{
				$RANKgroups_list .= " CHECKED";
				}
			$p++;
			}
		$p=0;
		
		$RANKgroups_list .= "> <a href=\"$PHP_SELF?ADD=3111&group_id=$group_id_values[$o]\">$group_id_values[$o]</a> - $group_name_values[$o] </td>";
		$RANKgroups_list .= "<td stylexxx=\"display:none\"> &nbsp; &nbsp; <select size=1 name=RANK_$group_id_values[$o]>\n";
		$h="9";
		while ($h>=-9)
			{
			$RANKgroups_list .= "<option value=\"$h\"";
			if ($h==$group_rank)
				{$RANKgroups_list .= " SELECTED";}
			$RANKgroups_list .= ">$h</option>";
			$h--;
			}
		if ( (strlen($group_web) < 1) and (strlen($group_web_vars) > 0) )
			{$group_web=$group_web_vars;}
		$RANKgroups_list .= "</select></td>\n";
		$RANKgroups_list .= "<td align=right style=\"display:none\"> &nbsp; &nbsp; $calls_today</td>\n";
		$RANKgroups_list .= "<td style=\"display:none\"> &nbsp; &nbsp; <input type=text size=25 maxlength=255 name=WEB_$group_id_values[$o] value=\"$group_web\"></td></tr>\n";
		$o++;
		}
		
		return 	$RANKgroups_list;
}
function getAllStatus(){
	$array_temp = array();
	global $link;
	mysql_query("set names utf8");
	$stmt="select status,status_name from vicidial_statuses";
	$rslt=mysql_query($stmt, $link);
	$ranks_to_print = mysql_num_rows($rslt);
	while ($ranks_to_print > 0){
		$row=mysql_fetch_row($rslt);
		$array_temp["$row[0]"] = $row[1];
		$ranks_to_print --;
	}
	$stmt="select status,status_name from vicidial_campaign_statuses";
	$rslt=mysql_query($stmt, $link);
	$ranks_to_print = mysql_num_rows($rslt);
	while ($ranks_to_print > 0){
		$row=mysql_fetch_row($rslt);
		$array_temp["$row[0]"] = $row[1];
		$ranks_to_print --;
	}
	return $array_temp;
}

/*
@该函数为处理0开头的字符串
@$str_number 字符串
@$suffix_number 返回去除0开头的字符串
*/
function suffix_number($str_number)
{
	$suffix_number = "";
	$arr_suffix_number = str_split($str_number);
	$str_count=count($arr_suffix_number);
	for($i=0; $i<$str_count; $i++)
	{
		if($arr_suffix_number[$i] != 0)
		{
			$suffix_number = substr($str_number,$i);
			break;
		}
	}
	return $suffix_number;
}

?>
