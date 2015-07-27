<?php
require("../../inc/pub_func.php");
require("../../inc/pub_set.php");
    
//保持用户的会话状态
//成功返回 1 ，失败返回 -1
function keepUser($username,$fullname,$userid,$user_group,$vdc_agent_api_access,$allow_users,$allow_campaigns,$user_level,$phone_login,$iscookie){
 	if($username != ''){
		
		$_SESSION["username"] = $username;
		$_SESSION["fullname"] = $fullname;
		$_SESSION["userid"] = $userid;
		$_SESSION["user_group"] = $user_group;
 	 	$_SESSION["vdc_agent_api_access"] = $vdc_agent_api_access;
		$_SESSION["allow_campaigns"] = $allow_campaigns;
 	 	$_SESSION["allow_users"] = $allow_users;
		$_SESSION["user_level"] = $user_level;
		$_SESSION["phone_login"] = $phone_login;
 		
		if($iscookie=="yes"){
			PutCookie('acc_username', $username, 3600 * 240, '/');
			PutCookie('acc_fullname', $fullname, 3600 * 240, '/');
			PutCookie('acc_userid', $userid, 3600 * 240, '/');
			PutCookie('acc_user_group', $user_group, 3600 * 240, '/');
			PutCookie('acc_vdc_agent_api_access', $view_reports, 3600 * 240, '/');
			PutCookie('allow_users', $allow_users, 3600 * 240, '/');
			PutCookie('allow_campaigns', $allow_campaigns, 3600 * 240, '/');
			PutCookie('user_level', $user_level, 3600 * 240, '/');
			PutCookie('phone_login', $user_level, 3600 * 240, '/');
			PutCookie('acc_LoginTime', time(), 3600 * 240, '/');
		}
  		return 1;
	}else{
		return 0;
	}
}
 
switch($action){
	 
	 //用户登录
	case "user_login":
		//user_login($username,$userpass);
		if ($username&&$userpass){
			 
			$sql="select user_id,full_name,user_level,user,phone_login,active,vdc_agent_api_access,ast_admin_access,user_group,allow_users,allow_campaigns from vicidial_users where USER='".$username."' and pass='".$userpass."'";
			 
			$rs=mysqli_query($db_conn,$sql);
			$row_counts=mysqli_num_rows($rs);
			//echo $sql;
			if ($row_counts!=0) {
				
				while($rs_arr= mysqli_fetch_array($rs)){ 
					
					if(strtolower($rs_arr["active"])=="y"){
						//if($rs_arr["ast_admin_access"]=="1"){
							$counts="1";
							$des="登陆成功!";
							keepUser($rs_arr["user"],$rs_arr["full_name"],$rs_arr["user_id"],$rs_arr["user_group"],$rs_arr["vdc_agent_api_access"],$rs_arr["allow_users"],$rs_arr["allow_campaigns"],$rs_arr["user_level"],$rs_arr["phone_login"],"no");
						//}else{
						//	$counts="0";
						//	$des="当前用户未被授权使用本系统，请检查后重新登陆!";
						//}
						
					}else{
						$counts="-1";
						$des="该用户已被禁用!请输入其他账号登陆!";
					}
				}
				$result_arrs=array('counts'=>"$counts","des"=>"$des");
					
			}else {
				$result_arrs=array('counts'=>'-1',"des"=>"用户名或密码错误，请检查后重试!");
			}
			mysqli_free_result($rs);
		
		}else {
			$result_arrs=array('counts'=>'-1',"des"=>'用户名、密码为空，请重新输入!');
		}
		echo json_encode($result_arrs);
 		
	break;
	
	//获取所有用户列表
	case "get_user_pope_list":
 	
		$sql="select pope_type,data_id from data_user_pope where user='".$_SESSION["username"]."'";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
  		$session_users_list="";
		$session_campaigns_list="";
		
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){
				
				if($rs['pope_type']=="users"){
					$session_users_list.="'".$rs['data_id']."',";	
				}else{
					$session_campaigns_list.="'".$rs['data_id']."',";		
				}
 				
 			}
			$session_users_list=substr($session_users_list,0,-1);
			$session_campaigns_list=substr($session_campaigns_list,0,-1);
			
			if($session_users_list!=""){
				$_SESSION["session_users_list"]=$session_users_list;
			}
			
			if($session_campaigns_list!=""){
				$_SESSION["session_campaigns_list"]=$session_campaigns_list;
			}
			 
			$counts="1";
			$des="获取成功!";
		}else {
			$counts="0";
			$des="未找到符合条件的数据!";
 		}
  		
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
		
	//获取权限菜单
	case "get_menu_list":
 		//get_menu_list($do_actions);
 		
		if($do_actions=="index"){
			$sql="select popeid,popename,popelink,superid,linktarget,popeimg,icoclass,icoinfo from data_pope_list where isactive='1' and superid='0' ".$where_str." order by popeid ";
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts=mysqli_num_rows($rows);
			
			$list_arr=array();
			 
			if ($row_counts!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("PopeName_List"=>$rs['popename'],"PopeLink_List"=>$rs['popelink'],"PopeImg_List"=>$rs['popeimg'],"IcoInfo_List"=>$rs['icoinfo']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功!";
			}else {
				$counts="0";
				$des="未找到授权菜单!";
				$list_arr=array('id'=>'none');
			}
			
		}else{
			
			$sql="select popeid,popename,popelink,superid,linktarget,popeimg,icoclass,icoinfo from data_pope_list where popeid in(select superid from (select superid from data_pope_group where group_id='".$_SESSION["user_group"]."' group by superid)temp_tbl ) and isactive='1' order by popeid";
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts=mysqli_num_rows($rows);
			
			$list_arr=array();
			
			if ($row_counts!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
					$lists_arr=array();
					$sqls="select a.popeid,a.popename,a.popelink,a.superid,a.linktarget,a.popeimg,a.icoclass,a.icoinfo,'' as is_re from data_pope_list a inner join (select popeid from(select popeid from data_pope_group where group_id='".$_SESSION["user_group"]."' and SuperID='".$rs["popeid"]."' group by popeid)temp_tbl)b on a.popeid=b.popeid where a.isactive='1' order by a.popeid asc";
					$rows2=mysqli_query($db_conn,$sqls);
					
					if(mysqli_num_rows($rows2)!=0){
						while($rs2= mysqli_fetch_array($rows2)){ 
							
							$lists=array("PopeID_List"=>$rs2['popeid'],"PopeName_List"=>$rs2['popename'],"PopeLink_List"=>$rs2['popelink'],"SuperID_List"=>$rs2['superid'],"LinkTarget_List"=>$rs2['linktarget'],"popeImg_List"=>$rs2['popeimg'],"IcoClass_List"=>$rs2['icoclass'],"IcoInfo_List"=>$rs2['icoinfo']);
							array_push($lists_arr,$lists);
						}
					} 
					mysqli_free_result($rows2);
				
					$list=array("PopeID"=>$rs['popeid'],"PopeName"=>$rs['popename'],"pope_list"=>$lists_arr);
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功!";
			}else {
				$counts="0";
				$des="未找到授权菜单!";
				$list_arr=array('id'=>'none');
			}
			
		}
		mysqli_free_result($rows);
		
		$json_data="{";
		
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		
		$json_data.="}";
		
		echo $json_data;
 		
	break;
		
    //工号列表
	case "get_user_list":
   		 
		if($user<>""){
 			
			if(strpos($user,",")>-1){
				$user=str_replace(",","','",$user);
				$user="'".$user."'";
				$sql_user=" in(".$user.") ";
			}else{
				$sql_user=" like '%".$user."%' ";
			}
			$sql1=" and a.user ".$sql_user."";
		}
		
		if($full_name<>""){
 			$sql2=" and a.full_name like '%".$full_name."%'";
		} 
		
		if($phone_login<>""){
 			$sql3=" and a.phone_login like '%".$phone_login."%'";
		}
		
		if($user_level<>""){
			$sql4=" and a.user_level='".$user_level."'";		
		} 
		
		if($user_group<>""){
			$sql5=" and a.user_group='".$user_group."'";		
		} 
		
		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from vicidial_users a left join vicidial_user_groups b on a.user_group=b.user_group where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select a.user_id,a.user,a.full_name,a.user_level,a.phone_login,case when a.active='Y' then '启用' else '禁用' end as active,ifnull(b.group_name,'未指定') as group_name from vicidial_users a left join vicidial_user_groups b on a.user_group=b.user_group where 1=1 ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("user_id"=>$rs['user_id'],"user"=>$rs['user'],"full_name"=>$rs['full_name'],"user_level"=>$rs['user_level'],"phone_login"=>$rs['phone_login'],"active"=>$rs['active'],"group_name"=>$rs['group_name']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功!";
			}else {
				$counts="0";
				$des="未找到符合条件的数据!";
				$list_arr=array('id'=>'none');
			}
  			
		}else if($do_actions=="excel"){
   				
			$sql="select a.user as '坐席工号',a.full_name as '坐席姓名',a.user_level as '坐席级别',a.phone_login as '使用分机号',case when a.active='Y' then '启用' else '禁用' end as '激活',ifnull(b.group_name,'未指定') as '坐席组' from vicidial_users a left join vicidial_user_groups b on a.user_group=b.user_group where 1=1 ".$wheres." ".$sort_sql."";
     	 
			echo json_encode(save_detail_excel($sql,"工号列表",$file_type));
			 
  		}
		
  		if($do_actions<>"excel"){
 			mysqli_free_result($rows);
		
 			$json_data="{";
			$json_data.="\"counts\":".json_encode($counts).",";
			$json_data.="\"des\":".json_encode($des).",";
 			$json_data.="\"datalist\":".json_encode($list_arr)."";
			$json_data.="}";
			
			echo $json_data;
 		} 
	 
	break;
   	
	//获取所有用户列表
	case "get_user_all_list":
 	
		$sql="select user_id,user,full_name,pass from vicidial_users where user not in('VDAD','1000') order by user_id ";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("user_id"=>$rs['user_id'],"user"=>$rs['user'],"full_name"=>$rs['full_name'],"pass"=>$rs['pass'],"pass"=>$rs['pass']);
				array_push($list_arr,$list);
				
 			}
			 
			$counts="1";
			$des="获取成功!";
		}else {
			$counts="0";
			$des="未找到符合条件的数据!";
 		}
  		
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	//获取工号组别
	case "get_user_group":
 	
		$sql="select user_group,group_name from vicidial_user_groups order by user_group desc";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("user_group"=>$rs['user_group'],"group_name"=>$rs['group_name']);
				array_push($list_arr,$list);
				
 			}
			 
			$counts="1";
			$des="获取成功!";
		}else {
			$counts="0";
			$des="未找到符合条件的数据!";
 		}
  		
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
 	
	
	//验证用户是否存在
	case "check_user":
 		
		if($user!=""){
			$sql="select user from vicidial_users where user='".$user."' limit 0,1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list!=0) {
 				 
				$counts="0";
				$des="该坐席工号已存在，请检查更换其他!";
			}else {
				$counts="1";
				$des="";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入坐席工号!";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;	
 	
	//添加工号
	case "user_set":
  		
		$allow_users            = trim($_REQUEST["allow_users"]);
		$allow_campaigns        = trim($_REQUEST["allow_campaigns"]);
		$allow_users_list       = trim($_REQUEST["allow_users_list"]);
		$allow_campaigns_list   = trim($_REQUEST["allow_campaigns_list"]);
 		
		if($do_actions=="add"){
			
			$sql="INSERT INTO vicidial_users (user,pass,full_name,user_level,user_group,phone_login,phone_pass,delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,export_reports,delete_from_dnc,email,allow_alerts,agent_choose_territories,custom_one,custom_two,custom_three,custom_four,custom_five,allow_users,allow_campaigns)
			
			select '".$user."','".$pass."','".$full_name."','".$user_level."','".$user_group."','".$user."','".$user."','".$delete_users."','".$delete_user_groups."','".$delete_lists."','".$delete_campaigns."','".$delete_ingroups."','".$delete_remote_agents."','".$load_leads."','".$campaign_detail."','".$ast_admin_access."','".$ast_delete_phones."','".$delete_scripts."','".$modify_leads."','".$hotkeys_active."','".$change_agent_campaign."','".$agent_choose_ingroups."','".$closer_campaigns."','".$scheduled_callbacks."','".$agentonly_callbacks."','".$agentcall_manual."','".$vicidial_recording."','".$vicidial_transfers."','".$delete_filters."','".$alter_agent_interface_options."','".$closer_default_blended."','".$delete_call_times."','".$modify_call_times."','".$modify_users."','".$modify_campaigns."','".$modify_lists."','".$modify_scripts."','".$modify_filters."','".$modify_ingroups."','".$modify_usergroups."','".$modify_remoteagents."','".$modify_servers."','".$view_reports."','".$vicidial_recording_override."','".$alter_custdata_override."','".$qc_enabled."','".$qc_user_level."','".$qc_pass."','".$qc_finish."','".$qc_commit."','".$add_timeclock_log."','".$modify_timeclock_log."','".$delete_timeclock_log."','".$alter_custphone_override."','".$vdc_agent_api_access."','".$modify_inbound_dids."','".$delete_inbound_dids."','".$active."','".$alert_enabled."','".$download_lists."','".$agent_shift_enforcement_override."','".$manager_shift_enforcement_override."','".$export_reports."','".$delete_from_dnc."','".$email."','".$allow_alerts."','".$agent_choose_territories."','".$custom_one."','".$custom_two."','".$custom_three."','".$custom_four."','".$custom_five."','".$allow_users."','".$allow_campaigns."' from (select '".$user."' as user ) datas where datas.user not in(select user from(select user from vicidial_users)temp_tbl) ";
			
 			//echo $sql;
			
			if(mysqli_query($db_conn,$sql)){
				$user_id=mysqli_insert_id($db_conn);
				//echo $que_id;
				if($user_id!="0"){
 					
					$sql2="insert into vicidial_inbound_group_agents(user,group_id) select user,'AGENTDIRECT' from (select '".$user."' as user ) datas where not EXISTS(select user from vicidial_inbound_group_agents a where a.user=datas.user);";
					mysqli_query($db_conn,$sql2);
			
					$sql3="insert into vicidial_campaign_agents(user,campaign_id) select user,campaign_id from (
select '".$user."' as user,campaign_id from vicidial_campaigns) datas where not EXISTS(select campaign_id from vicidial_campaign_agents a where a.user=datas.user and a.campaign_id=datas.campaign_id);";
					mysqli_query($db_conn,$sql3);
  					
					if($allow_users_list!=""&&$allow_users=="setup"){
 						$allow_users_lists=explode("|",$allow_users_list);
 						foreach($allow_users_lists as $data_id){							 
  							$in_user_sql.="('".$user."','users','".$data_id."'),";
						}
					}
					
					if($allow_campaigns_list!=""&&$allow_campaigns=="setup"){
 						$allow_campaigns_lists=explode("|",$allow_campaigns_list);
 						foreach($allow_campaigns_lists as $data_id){							 
  							$in_campaigns_sql.="('".$user."','campaigns','".$data_id."'),";
						}
						 
					}
					
					if($in_user_sql!=""||$in_campaigns_sql!=""){
						$in_user_pope_sql="insert into data_user_pope(user,pope_type,data_id) values ".$in_user_sql.$in_campaigns_sql;
						
						$in_user_pope_sql=substr($in_user_pope_sql,0,-1);
						mysqli_query($db_conn,$in_user_pope_sql);
					}
					 
					$sql_phone="INSERT INTO phones (extension,conf_secret,dialplan_number,voicemail_id,phone_ip,computer_ip,server_ip,login,pass,status,active,phone_type,fullname,protocol,local_gmt,outbound_cid,messages,old_messages) select '$extension','$pass',max(dialplan_number)+1,max(voicemail_id)+1,'$phone_ip','$computer_ip','$server_ip','$login','$pass','ACTIVE','$active','$phone_type','$fullname','$protocol','$local_gmt','$outbound_cid','0','0' from phones;";
					
					if(mysqli_query($db_conn,$sql_phone)){
  					
						$sql_update="UPDATE servers SET rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y' and server_ip='$server_ip';";
						mysqli_query($db_conn,$sql_update);
						
						$counts="1";
						$des="新建成功!";
					}else{
						$counts="0";
						$des="新建分机失败，该分机已存在，请检查重试!";
						$user_id="0";
					}
					
					$counts="1";
					$des="新建坐席 ".$full_name." [".$user."] 成功!";
				}else{
					
					$counts="0";
					$des="新建坐席 ".$full_name." [".$user."] 失败，该坐席已存在，请检查重试!";
				}
			}
 			
 			
		}elseif($do_actions=="copy"){
			
			$sql="INSERT INTO vicidial_users (user,pass,full_name,user_level,user_group,phone_login,phone_pass,delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts,agent_choose_territories,custom_one,custom_two,custom_three,custom_four,custom_five,allow_users,allow_campaigns) 
			SELECT '".$user."','".$pass."','".$full_name."',user_level,user_group,'".$user."','".$pass."',delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts,agent_choose_territories,custom_one,custom_two,custom_three,custom_four,custom_five,allow_users,allow_campaigns from vicidial_users where user='".$source_user_id."'";
  
			if(mysqli_query($db_conn,$sql)){
				$user_id=mysqli_insert_id($db_conn);
				//echo $que_id;
				if($user_id!="0"){
					
					$in_user_pope_sql="insert into data_user_pope(user,pope_type,data_id) select '".$user."',pope_type,data_id where user='".$source_user_id."'";
  					mysqli_query($db_conn,$in_user_pope_sql);
					
   					
					$user_sql="select phone_ip,computer_ip,server_ip,status,active,phone_type,protocol,local_gmt,outbound_cid,messages,old_messages from phones where extension='".$source_user_id."' limit 0,1";
					
					$rows=mysqli_query($db_conn,$user_sql);
					$row_counts_list=mysqli_num_rows($rows);			
 					 
					if ($row_counts_list!=0) {
						while($rs= mysqli_fetch_array($rows)){ 
  							//$conf_secret_c=$rs["conf_secret"];
							$phone_ip_c=$rs["phone_ip"];
							$computer_ip_c=$rs["computer_ip"];
							$server_ip_c=$rs["server_ip"];
							$status_c=$rs["status"];
							$active_c=$rs["active"];
							$phone_type_c=$rs["phone_type"];
							$protocol_c=$rs["protocol"];
							$local_gmt_c=$rs["local_gmt"];
							$outbound_cid_c=$rs["outbound_cid"];
							$messages_c=$rs["messages"];
							$old_messages_c=$rs["old_messages"];
 					
							$sql_phone="INSERT INTO phones (extension,conf_secret,dialplan_number,voicemail_id,phone_ip,computer_ip,server_ip,login,pass,status,active,phone_type,fullname,protocol,local_gmt,outbound_cid,messages,old_messages) select '".$user."','".$pass."',max(dialplan_number)+1,max(voicemail_id)+1,'".$phone_ip_c."','".$computer_ip_c."','".$server_ip_c."','".$user."','".$user."','".$status_c."','".$active_c."','".$phone_type_c."','".$full_name."','".$protocol_c."','".$local_gmt_c."','".$outbound_cid_c."','".$messages_c."','".$old_messages_c."' from phones;";
							
							if(mysqli_query($db_conn,$sql_phone)){
							
								$sql="INSERT INTO vicidial_inbound_group_agents(user,group_id,group_rank,group_weight,calls_today) select user,group_id,group_rank,group_weight,calls_today from(SELECT '".$user."' as user,group_id,group_rank,group_weight,'0' as calls_today from vicidial_inbound_group_agents where user='".$source_user_id."')datas where not exists (select user from vicidial_inbound_group_agents a where a.user=datas.user and a.group_id=datas.group_id );";
								mysqli_query($db_conn,$sql);
					
								$sql="INSERT INTO vicidial_campaign_agents (user,campaign_id,campaign_rank,campaign_weight,calls_today) select user,campaign_id,campaign_rank,campaign_weight from( select '".$user."' as user,campaign_id,campaign_rank,campaign_weight,'0' as calls_today from vicidial_campaign_agents where user='".$source_user_id."')datas where not exists(select campaign_id from vicidial_campaign_agents a on a.user=b.user and a.campaign_id=b.campaign_id) ;";
								mysqli_query($db_conn,$sql);
								
								$sql_update_server="update servers SET rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y' and server_ip='".$server_ip_c."';";
								mysqli_query($db_conn,$sql_update_server);
								
								$counts="1";
								$des="复制成功!";
							}else{
								$counts="0";
								$des="复制分机失败，该分机已存在，请检查重试!";
							}
 						}
						
 					}else{
						$counts="0";
						$des="复制分机失败，该用户不存在，请检查重试!";
 					}
 					
				}else{
					
					$counts="0";
					$des="复制坐席 ".$full_name." [".$user."] 失败，该用户已存在，请检查重试!";
				}
			}else{
 				$counts="0";
				$des="复制坐席 ".$full_name." [".$user."] 失败，请检查重试!";
			}
 
 			
		}else{			
			if($user_id!=""){
				
				$sql="update vicidial_users set pass='".$pass."',full_name='".$full_name."',user_level='".$user_level."',user_group='".$user_group."',email='".$email."',active='".$active."',agentcall_manual='".$agentcall_manual."',vicidial_recording='".$vicidial_recording."',vicidial_transfers='".$vicidial_transfers."',hotkeys_active='".$hotkeys_active."',agent_choose_ingroups='".$agent_choose_ingroups."',view_reports='".$view_reports."',export_reports='".$export_reports."',vdc_agent_api_access='".$vdc_agent_api_access."',alter_agent_interface_options='".$alter_agent_interface_options."',modify_users='".$modify_users."',change_agent_campaign='".$change_agent_campaign."',delete_users='".$delete_users."',modify_usergroups='".$modify_usergroups."',delete_user_groups='".$delete_user_groups."',modify_lists='".$modify_lists."',delete_lists='".$delete_lists."',load_leads='".$load_leads."',modify_leads='".$modify_leads."',download_lists='".$download_lists."',delete_from_dnc='".$delete_from_dnc."',modify_campaigns='".$modify_campaigns."',campaign_detail='".$campaign_detail."',delete_campaigns='".$delete_campaigns."',modify_ingroups='".$modify_ingroups."',delete_ingroups='".$delete_ingroups."',modify_inbound_dids='".$modify_inbound_dids."',delete_inbound_dids='".$delete_inbound_dids."',modify_remoteagents='".$modify_remoteagents."',delete_remote_agents='".$delete_remote_agents."',modify_scripts='".$modify_scripts."',delete_scripts='".$delete_scripts."',modify_filters='".$modify_filters."',delete_filters='".$delete_filters."',ast_admin_access='".$ast_admin_access."',ast_delete_phones='".$ast_delete_phones."',modify_call_times='".$modify_call_times."',delete_call_times='".$delete_call_times."',modify_servers='".$modify_servers."',add_timeclock_log='".$add_timeclock_log."',modify_timeclock_log='".$modify_timeclock_log."',delete_timeclock_log='".$delete_timeclock_log."',manager_shift_enforcement_override='".$manager_shift_enforcement_override."',allow_alerts='".$allow_alerts."',allow_users='".$allow_users."',allow_campaigns='".$allow_campaigns."' where user_id='".$user_id."';";
				//echo $sql;
				if(mysqli_query($db_conn,$sql)){
 					
					if($allow_users_list!=""&&$allow_users=="setup"){
						$del_user_pope_sql="delete from data_user_pope where user='".$user."' and pope_type='users'";
						mysqli_query($db_conn,$del_user_pope_sql);
						
 						$allow_users_lists=explode("|",$allow_users_list);
 						foreach($allow_users_lists as $data_id){							 
  							$in_user_sql.="('".$user."','users','".$data_id."'),";
						}
					}
					if($allow_users!="setup"){
						$del_user_pope_sql="delete from data_user_pope where user='".$user."' and pope_type='users'";
						mysqli_query($db_conn,$del_user_pope_sql);
					}
					
					if($allow_campaigns_list!=""&&$allow_campaigns=="setup"){
						
						$del_user_pope_sql="delete from data_user_pope where user='".$user."' and pope_type='campaigns'";
						mysqli_query($db_conn,$del_user_pope_sql);
						
 						$allow_campaigns_lists=explode("|",$allow_campaigns_list);
 						foreach($allow_campaigns_lists as $data_id){							 
  							$in_campaigns_sql.="('".$user."','campaigns','".$data_id."'),";
						}
						 
					}
					
					if($allow_campaigns!="setup"){
						$del_user_pope_sql="delete from data_user_pope where user='".$user."' and pope_type='campaigns'";
						mysqli_query($db_conn,$del_user_pope_sql);
					}
					
					if($in_user_sql!=""||$in_campaigns_sql!=""){
						$in_user_pope_sql="insert into data_user_pope(user,pope_type,data_id) values ".$in_user_sql.$in_campaigns_sql;
						
						$in_user_pope_sql=substr($in_user_pope_sql,0,-1);
						mysqli_query($db_conn,$in_user_pope_sql);
					}
					
					if($_SESSION["username"]==$user){
						$_SESSION["allow_campaigns"]=$allow_campaigns;
						$_SESSION["allow_users"]=$allow_users;
					}
					
					$sql_update_phone="update phones set fullname='".$full_name."',server_ip='".$server_ip."',conf_secret='".$pass."',pass='".$pass."' where extension='".$phone_login."'";
					
					$sql_update_server="update servers SET rebuild_conf_files='Y' where generate_vicidial_conf='Y' and active_asterisk_server='Y' and server_ip='$server_ip';";
 					
					if(mysqli_query($db_conn,$sql_update_phone)&&mysqli_query($db_conn,$sql_update_server)){
						$counts="1";
						$des="修改坐席 ".$full_name." [".$user."] 成功!";
 					}else{
						$counts="0";
						$des="修改关联分机设置失败，请检查相关设置重试!";
					}
					
				}else{
					$counts="0";
					$des="修改坐席 ".$full_name." [".$user."] 失败，请检查相关设置重试!";
				}
				
 			}else{
				$counts="0";
				$des="修改坐席 ".$full_name." [".$user."] 失败，坐席工号不存在!";
			}
			
		}
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"user_id\":".json_encode($user_id).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
  	 
  	
	//删除 
  	case "del_user":
  		 
		$user_id=$cid;
		
		if($user_id!=""){
			
			if(strpos($user_id,",")>-1){
				$user_id=str_replace(",","','",$user_id);
				$user_id="'".$user_id."'";
				$where_sql=" in(".$user_id.") ";
			}else{
				$where_sql=" ='".$user_id."' ";
			}
				
			//删除工号使用分机
			$sql_1="delete from phones where extension in(select phone_login from(select phone_login from vicidial_users where user_id ".$where_sql." )temp_tbl)";
			mysqli_query($db_conn,$sql_1);
			
			//删除工号使用分机
			$sql_2="delete from vicidial_inbound_group_agents where user in(select user from (select user from vicidial_users where user_id ".$where_sql." )temp_tbl )";
			mysqli_query($db_conn,$sql_2);
			
			//删除工号使用分机
			$sql_3="delete from vicidial_campaign_agents where user in(select user from (select user from vicidial_users where user_id ".$where_sql.")temp_tbl )";
			mysqli_query($db_conn,$sql_3);
			
			//删除工号使用分机
			$sql_5="delete from data_user_pope where user in(select user from (select user from vicidial_users where user_id ".$where_sql.")temp_tbl )";
			mysqli_query($db_conn,$sql_5);
			
 			//删除工号
			$sql_4="delete from vicidial_users where user_id ".$where_sql." ";
			
			if (mysqli_query($db_conn,$sql_4)){
				$counts="1";
				$des="删除成功!";
			}else{
				$counts="0";
				$des="删除失败，请检查相关设置重试!";
			}
			
		}else{
			$counts="0";
			$des="删除失败，请输入要删除的行!";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
  
	//分机列表
	case "get_phone_list":
		
 		if($extension<>""){
 			
			if(strpos($extension,",")>-1){
				$extension=str_replace(",","','",$extension);
				$extension="'".$extension."'";
				$sql_user=" in(".$extension.") ";
			}else{
				$sql_user=" like '%".$extension."%' ";
			}
			$sql1=" and extension ".$sql_user."";
		}
		
		if($fullname<>""){
 			$sql2=" and fullname like '%".$fullname."%'";
		} 
    		
		$wheres=$sql1.$sql2;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from phones where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select extension,dialplan_number,server_ip,case when status='active' then '活动' else status end as status,case when active='y' then '启用' else '禁用' end as active,fullname,protocol from phones where 1=1 ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("extension"=>$rs['extension'],"dialplan_number"=>$rs['dialplan_number'],"server_ip"=>$rs['server_ip'],"status"=>$rs['status'],"active"=>$rs['active'],"active"=>$rs['active'],"fullname"=>$rs['fullname'],"protocol"=>$rs['protocol']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功!";
			}else {
				$counts="0";
				$des="未找到符合条件的数据!";
				$list_arr=array('id'=>'none');
			}
  			
		} 
   	 
		mysqli_free_result($rows);
	
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		$json_data.="}";
		
		echo $json_data;
	 
	break; 
	 
	 //用户组列表
	case "get_user_group_list":
  		 
		if($user_group<>""){
 			
			if(strpos($user_group,",")>-1){
				$extension=str_replace(",","','",$user_group);
				$user_group="'".$user_group."'";
				$sql_user_group=" in(".$user_group.") ";
			}else{
				$sql_user_group=" like '%".$user_group."%' ";
			}
			$sql1=" and a.user_group ".$sql_user_group."";
		}
		
		if($group_name<>""){
 			$sql2=" and group_name like '%".$group_name."%'";
		} 
    		
		$wheres=$sql1.$sql2;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from vicidial_user_groups a left join(select user_group,count(*) as user_count from vicidial_users group by user_group )b on a.user_group =b.user_group where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select a.user_group,group_name,ifnull(b.user_count,0) as user_count,allowed_campaigns,case when forced_timeclock_login='Y' then '启用' when forced_timeclock_login='ADMIN_EXEMPT' then '管理员例外' else '禁用'  end as forced_timeclock_login,case when shift_enforcement='OFF' then '禁用' when shift_enforcement='ALL' then '所有用户' when shift_enforcement='START' then '开始' when shift_enforcement='ADMIN_EXEMPT' then '管理员例外' else '其他' end as shift_enforcement,agent_status_viewable_groups from vicidial_user_groups a left join(select user_group,count(*) as user_count from vicidial_users group by user_group )b on a.user_group =b.user_group where 1=1 ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("user_group"=>$rs['user_group'],"user_count"=>$rs['user_count'],"group_name"=>$rs['group_name'],"allowed_campaigns"=>$rs['allowed_campaigns'],"forced_timeclock_login"=>$rs['forced_timeclock_login'],"shift_enforcement"=>$rs['shift_enforcement'],"agent_status_viewable_groups"=>$rs['agent_status_viewable_groups']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功!";
			}else {
				$counts="0";
				$des="未找到符合条件的数据!";
				$list_arr=array('id'=>'none');
			}
  			
		} 
   	 
		mysqli_free_result($rows);
	
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		$json_data.="}";
		
		echo $json_data;
	 
	break; 
	 
 	//验证用户组是否存在
	case "check_user_group":
 		
		if($user_group!=""){
			$sql="select user_group from vicidial_user_groups where user_group='".$user_group."' limit 0,1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list!=0) {
 				 
				$counts="0";
				$des="该坐席组ID已存在，请检查更换其他!";
			}else {
				$counts="1";
				$des="";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入坐席组ID号!";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;	
 	 
 	 
 	//坐席组设置
	case "user_group_set":
	
		if (strlen($campaigns)>2) {$campaigns.= " -";}
		if (strlen($qc_allowed_campaigns)>2) {$qc_allowed_campaigns.= " -";}
		
		$group_shifts=$group_shifts." ";
		$campaigns=" ".$campaigns;
		$agent_status_viewable_groups=" ".$agent_status_viewable_groups." ";
  		 
		if($do_actions=="add"){
			
			$sql="SELECT count(*) as counts from vicidial_user_groups where user_group='".$user_group."';";
			$rs=mysqli_query($db_conn,$sql);
			$row=mysqli_fetch_row($rs);
			if ($row["counts"] > 0){
				
				$counts="0";
				$des="新建坐席组失败，该坐席组已存在，请检查重试!";
				
			}else {
 				 
				$sql="insert into  vicidial_user_groups(user_group,group_name,allowed_campaigns,qc_allowed_campaigns,qc_allowed_inbound_groups,group_shifts,forced_timeclock_login,shift_enforcement,agent_status_viewable_groups,agent_status_view_time) select '".$user_group."','".$group_name."','".$campaigns."','".$qc_allowed_campaigns."','".$qc_allowed_inbound_groups."','".$group_shifts."','".$forced_timeclock_login."','".$shift_enforcement."','".$agent_status_viewable_groups."','".$agent_status_view_time."' from (select '".$user_group."' as user_group) datas where datas.user_group not in(select user_group from(select user_group from vicidial_user_groups)temp_tbl) ";
				
				//echo $sql;
 				if(mysqli_query($db_conn,$sql)){
					   
					$counts="1";
					$des="新建坐席组成功!";
				}else{
					
					$counts="0";
					$des="新建坐席组失败，该坐席组已存在，请检查重试!";
				 
				}
 			
			}
		
		}elseif($do_actions=="copy"){
			
			$sql="INSERT INTO vicidial_users (user,pass,full_name,user_level,user_group,phone_login,phone_pass,delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts,agent_choose_territories,custom_one,custom_two,custom_three,custom_four,custom_five) 
			SELECT '".$user."','".$pass."','".$full_name."',user_level,user_group,'".$user."','".$pass."',delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts,agent_choose_territories,custom_one,custom_two,custom_three,custom_four,custom_five from vicidial_users where user='".$source_user_id."'";
  
			if(mysqli_query($db_conn,$sql)){
				$user_id=mysqli_insert_id($db_conn);
				//echo $que_id;
				if($user_id!="0"){
  					 
 					$counts="1";
					$des="复制成功!";
				}else{
					
					$counts="0";
					$des="复制用户失败，该用户已存在，请检查重试!";
				}
			}else{
 				$counts="0";
				$des="复制用户失败，请检查重试!";
			}
 
 			
		}else{			
			if($OLDuser_group!=""){
				
				
				$sql="update vicidial_user_groups set user_group='".$user_group."',group_name='".$group_name."',allowed_campaigns='".$campaigns."',qc_allowed_campaigns='".$qc_allowed_campaigns."',qc_allowed_inbound_groups='".$qc_allowed_inbound_groups."',group_shifts='".$group_shifts."',forced_timeclock_login='".$forced_timeclock_login."',shift_enforcement='".$shift_enforcement."',agent_status_viewable_groups='".$agent_status_viewable_groups."',agent_status_view_time='".$agent_status_view_time."' where user_group='".$OLDuser_group."' ";
 
				//echo $sql;
				if(mysqli_query($db_conn,$sql)){
					
					$sql_update="update vicidial_users set user_group='".$user_group."' where user_group='".$OLDuser_group."'";
					mysqli_query($db_conn,$sql_update);
					
					$counts="1";
					$des="修改成功!";
 					
				}else{
					$counts="0";
					$des="修改失败，请检查相关设置重试!";
				}
				
 			}else{
				$counts="0";
				$des="修改失败，坐席组ID不存在!";
			}
			
		}
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"user_group\":".json_encode($user_group).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	//删除坐席组 
  	case "del_user_group":
  		 
		$group_id=$cid;
		
		if($group_id!=""){
			
			if(strpos($group_id,",")>-1){
				$group_id=str_replace(",","','",$group_id);
				$group_id="'".$group_id."'";
				$where_sql=" in(".$group_id.") ";
			}else{
				$where_sql=" ='".$group_id."' ";
			}
				
  			//删除坐席组
			$sql_1="delete from vicidial_user_groups where user_group ".$where_sql." ";
			
			if (mysqli_query($db_conn,$sql_1)){
				$counts="1";
				$des="删除坐席组成功!";
			}else{
				$counts="0";
				$des="删除坐席组失败，请检查相关设置重试!";
			}
			
		}else{
			$counts="0";
			$des="删除失败，请输入要删除的行!";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
	
	//转移坐席组 
  	case "user_group_change":
  		
		if($group!=""){
 			
			if ($do_actions=="one"){
				$sql="update vicidial_users set user_group='".$group."' where user_group='".$old_group."'";
				$des="$old_group 成功转移到 $group";
 			}
		
 			if ($do_actions=="all"){
				$sql="update vicidial_users set user_group='".$group."' where user_group!='admin'";
  				$des="所有非管理员坐席成功转移到 $group";
 			}
			
			//echo $sql;
   			
			if (mysqli_query($db_conn,$sql)){
				$counts="1";
 			}else{
				$counts="0";
				$des="坐席组转移失败，请检查相关设置重试!";
			}
			
		}else{
			$counts="0";
			$des="转移失败，未选择坐席组!";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
	
	//用户菜单权限列表
  	case "get_pope_group":
  		 
 		if($group_id!=""){
		 
   			$sql="select popeid,superid from data_pope_group where group_id='".$group_id."' ";
  			 
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("popeid"=>$rs['popeid'],"superid"=>$rs['superid']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				 
			}else {
				$counts="1";
				 
			}
			
		}else{
			$counts="0";
			$des="设置失败，请选择要设置的用户组!";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
 	
	//用户组权限列表
  	case "pope_group_set":
	
  		$pope_list=trim($_REQUEST["pope_list"]);
		
 		if($group_id!=""){
 				
  			$sql="delete from data_pope_group where group_id='".$group_id."' ";
			
 			if(mysqli_query($db_conn,$sql)){
				if($pope_list!=""){
					$pope_lists=explode(",",$pope_list);
	 
					foreach($pope_lists as $pope_fields){
						$value_list=explode("_",$pope_fields);
						$pope_id=$value_list[0];
						$super_id=$value_list[1];
						
 						$in_sql_v.="('".$pope_id."','".$super_id."','".$group_id."'),";
 					}
					
					$in_sql="insert into data_pope_group(popeid,superid,group_id) values ".substr($in_sql_v,0,-1).";";
					
					if(mysqli_query($db_conn,$in_sql)){
						$counts="1";
						$des="菜单权限设置成功!";	
					}else{
						$counts="0";
						$des="设置失败，设定新权限错误!";	
 					}
					
				}else{
					$counts="1";
					$des="菜单权限设置成功!";			
				}
			}else{
				$counts="0";
				$des="设置失败，清除原权限错误!";			
			}
 			
		}else{
			$counts="0";
			$des="设置失败，请选择要设置的角色!";			
		}
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
   		$json_data.="}";
		
		echo $json_data;
		
	break;
	
	case "get_types_list":
  
 		if ($do_actions=="users"){
			
			$sql="select user_group,group_name from vicidial_user_groups ";
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts=mysqli_num_rows($rows);
			
			if ($row_counts!=0) {
				echo '<table style="width:99%;*width:96%;" border=0 cellpadding=0 cellspacing=0>';
		  
				while($rs= mysqli_fetch_array($rows)){ 
			 		$user_group=$rs["user_group"];
					
					echo '<tr ><td height="24" align="left" class="deepgreen" style="border-bottom: 1px dotted #999;" nowrap><label for="agents_item_'.$user_group.'" onclick="CheckItemsAll(\'opt_form_1\',\'agents_item_'.$user_group.'\');set_seletct_count(1)"><input type="checkbox" id="agents_item_'.$user_group.'" name="agents_item" value="'.$user_group.'" parentid="agents_'.$user_group.'" >'.$rs["group_name"].'</label></td><td align="left" class="check_items" style="border-bottom: 1px dotted #999;"><ul>';
		
					$sqls="select a.user,a.full_name,b.data_id from vicidial_users a left join data_user_pope b on a.user=b.data_id and b.user='".$user."' and b.pope_type='users' where a.user_group='".$user_group."' order by a.user";
					$rows2=mysqli_query($db_conn,$sqls);
					
					if(mysqli_num_rows($rows2)!=0){
						
						while($rs2= mysqli_fetch_array($rows2)){ 
						
							$class="";
							$check_ed="";
							if($rs2["data_id"]!=""){
								$class=" class='blue' ";
								$check_ed=" checked ";
							}
							$users=$rs2["user"];
							$full_name=$rs2["full_name"];
							
							echo '<li><span'.$class.'><input type="checkbox" parentid="agents_item_'.$user_group.'" '.$check_ed.' id="agents_item_'.$user_group.'_'.$users.'" name="opt_field_1" onclick="CheckItems(\'opt_form_1\',\'agents_'.$user_group.'\',\'agents_item_'.$user_group.'\');set_seletct_count(1);" value="'.$users.'"><label for="agents_item_'.$user_group.'_'.$users.'" title="'.$full_name.' ['.$users.']">'.$full_name.' ['.$users.']</label></span></li>';
			   
						}
					} 
					mysqli_free_result($rows2);
			 
					echo '</ul></td><tr>';
		  
				}
			
				echo '</table> ';
	
			}else {
				 echo "<span class='red'>系统当前没有可选择工号!</div>";
			}
		}else{
			
			$sql="select status,status_name from data_sys_status where status_type='dial_method' ";
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts=mysqli_num_rows($rows);
			
			if ($row_counts!=0) {
				echo '<table style="width:99%;*width:96%;" border=0 cellpadding=0 cellspacing=0>';
		  
				while($rs= mysqli_fetch_array($rows)){ 
			 		
					$status_1=$rs["status"];
					
					echo '<tr ><td height="24" align="left" class="deepgreen" style="border-bottom: 1px dotted #999;" nowrap><label for="campaigns_item_'.$status_1.'" onclick="CheckItemsAll(\'opt_form_2\',\'campaigns_item_'.$status_1.'\');set_seletct_count(2)"><input type="checkbox" id="campaigns_item_'.$status_1.'" name="campaigns_item" value="'.$status_1.'" parentid="campaigns_'.$status_1.'" >'.$rs["status_name"].'</label></td><td align="left" class="check_items" style="border-bottom: 1px dotted #999;"><ul>';
		
					$sqls="select a.campaign_id,a.campaign_name,b.data_id from vicidial_campaigns a left join data_user_pope b on a.campaign_id=b.data_id and b.user='".$user."' and b.pope_type='campaigns' where a.dial_method='".$status_1."' order by a.campaign_id";
					$rows2=mysqli_query($db_conn,$sqls);
					
					if(mysqli_num_rows($rows2)!=0){
						
						while($rs2= mysqli_fetch_array($rows2)){ 
						
							$class="";
							$check_ed="";
							if($rs2["data_id"]!=""){
								$class=" class='blue' ";
								$check_ed=" checked ";
							}
 							
							$campaign_id=$rs2["campaign_id"];
							$campaign_name=$rs2["campaign_name"];							
							
							echo '<li><span'.$class.'><input type="checkbox" parentid="campaigns_item_'.$status_1.'" '.$check_ed.' id="campaigns_item_'.$status_1.'_'.$campaign_id.'" name="opt_field_2" onclick="CheckItems(\'opt_form_2\',\'campaigns_'.$status_1.'\',\'campaigns_item_'.$status_1.'\');set_seletct_count(2);" value="'.$campaign_id.'"><label for="campaigns_item_'.$status_1.'_'.$campaign_id.'" title="'.$campaign_name.' ['.$campaign_id.']">'.$campaign_name.' ['.$campaign_id.']</label></span></li>';
			   
						}
					} 
					mysqli_free_result($rows2);
			 
					echo '</ul></td><tr>';
		  
				}
			
				echo '</table> ';
	
			}else {
				 echo "<span class='red'>系统当前没有可选择业务!</div>";
			}
			
		}
 
  	break;
	
	
	case "set_group_user":
		
		$allow_users            = trim($_REQUEST["allow_users"]);
		$allow_campaigns        = trim($_REQUEST["allow_campaigns"]);
		$allow_users_list       = trim($_REQUEST["allow_users_list"]);
		$allow_campaigns_list   = trim($_REQUEST["allow_campaigns_list"]);
		
		if($user_group!=""){
				
			$sql="update vicidial_users set  user_level='".$user_level."',active='".$active."',agentcall_manual='".$agentcall_manual."',vicidial_recording='".$vicidial_recording."',vicidial_transfers='".$vicidial_transfers."',hotkeys_active='".$hotkeys_active."',agent_choose_ingroups='".$agent_choose_ingroups."',view_reports='".$view_reports."',export_reports='".$export_reports."',vdc_agent_api_access='".$vdc_agent_api_access."',alter_agent_interface_options='".$alter_agent_interface_options."',modify_users='".$modify_users."',change_agent_campaign='".$change_agent_campaign."',delete_users='".$delete_users."',modify_usergroups='".$modify_usergroups."',delete_user_groups='".$delete_user_groups."',modify_lists='".$modify_lists."',delete_lists='".$delete_lists."',load_leads='".$load_leads."',modify_leads='".$modify_leads."',download_lists='".$download_lists."',delete_from_dnc='".$delete_from_dnc."',modify_campaigns='".$modify_campaigns."',campaign_detail='".$campaign_detail."',delete_campaigns='".$delete_campaigns."',modify_ingroups='".$modify_ingroups."',delete_ingroups='".$delete_ingroups."',modify_inbound_dids='".$modify_inbound_dids."',delete_inbound_dids='".$delete_inbound_dids."',modify_remoteagents='".$modify_remoteagents."',delete_remote_agents='".$delete_remote_agents."',modify_scripts='".$modify_scripts."',delete_scripts='".$delete_scripts."',modify_filters='".$modify_filters."',delete_filters='".$delete_filters."',ast_admin_access='".$ast_admin_access."',ast_delete_phones='".$ast_delete_phones."',modify_call_times='".$modify_call_times."',delete_call_times='".$delete_call_times."',modify_servers='".$modify_servers."',add_timeclock_log='".$add_timeclock_log."',modify_timeclock_log='".$modify_timeclock_log."',delete_timeclock_log='".$delete_timeclock_log."',manager_shift_enforcement_override='".$manager_shift_enforcement_override."',allow_alerts='".$allow_alerts."',allow_users='".$allow_users."',allow_campaigns='".$allow_campaigns."' where user_group='".$user_group."';";
			//echo $sql;
			if(mysqli_query($db_conn,$sql)){
				
				if($allow_users=="setup"){
					$del_user_pope_sql="delete data_user_pope from data_user_pope,vicidial_users where data_user_pope.user=vicidial_users.user and data_user_pope.pope_type='users' and vicidial_users.user_group='".$user_group."'";
					mysqli_query($db_conn,$del_user_pope_sql);
					
					if($allow_users_list!=""){
						$allow_users_lists=explode("|",$allow_users_list);
						foreach($allow_users_lists as $data_id){							 
							//$in_user_sql.="('".$user."','users','".$data_id."'),";
							$in_user_sql.="select user,'users','".$data_id."' from vicidial_users where user_group='".$user_group."';";
							mysqli_query($db_conn,$in_user_sql);
						}
					}
				}
				
				if($allow_users!="setup"){
					$del_user_pope_sql="delete data_user_pope from data_user_pope,vicidial_users where data_user_pope.user=vicidial_users.user and data_user_pope.pope_type='users' and vicidial_users.user_group='".$user_group."'";
					mysqli_query($db_conn,$del_user_pope_sql);
				}
				
				if($allow_campaigns=="setup"){
					
					$del_user_pope_sql="delete data_user_pope from data_user_pope,vicidial_users where data_user_pope.user=vicidial_users.user and data_user_pope.pope_type='campaigns' and vicidial_users.user_group='".$user_group."'";
					mysqli_query($db_conn,$del_user_pope_sql);
					
					$allow_campaigns_lists=explode("|",$allow_campaigns_list);
					foreach($allow_campaigns_lists as $data_id){							 
				 
						$in_campaigns_sql.="select user,'campaigns','".$data_id."' from vicidial_users where user_group='".$user_group."';";
						mysqli_query($db_conn,$in_campaigns_sql);
					}
					 
				}
				
				if($allow_campaigns!="setup"){
					$del_user_pope_sql="delete data_user_pope from data_user_pope,vicidial_users where data_user_pope.user=vicidial_users.user and data_user_pope.pope_type='campaigns' and vicidial_users.user_group='".$user_group."'";
					mysqli_query($db_conn,$del_user_pope_sql);
				}
  				 
 				
				$counts="1";
				$des="修改 ".$group_name." [".$user_group."] 成员设置成功!";
			 
				
			}else{
				$counts="0";
				$des="修改 ".$group_name." [".$user_group."] 成员设置失败，请检查相关设置重试!";
			}
			
		}else{
			$counts="0";
			$des="修改 ".$group_name." [".$user_group."] 成员设置失败，坐席组不存在!";
		}
		
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
   		$json_data.="}";
		
		echo $json_data;
		
	break;
	
		
	default :
		 
}

unset($list_arr);
unset($lists_arr); 
unset($json_data);
unset($sql); 
mysqli_close($db_conn);

?>