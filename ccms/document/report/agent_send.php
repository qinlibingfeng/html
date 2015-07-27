<?php
require("../../inc/pub_func.php");
$with_rollup=trim($_REQUEST["with_rollup"]);
$drop_opt=trim($_REQUEST["drop_opt"]); 
$start_date = $s_date . " " . $s_hour;
$end_date   = $e_date . " " . $e_hour;

switch($action){
  	
 	//通话时长统计报表
	case "agent_event_report":
	
		if($with_rollup==""){
			$with_rollup=" ";
		}
    	$time_type=trim($_REQUEST["time_type"]);
		$sql1=" event_time between '".$start_date."' and '".$end_date."'";
		
		$agent_list=$_REQUEST["agent_name_list"];
		if($agent_list<>""){
			if(strpos($agent_list,",")>-1){
 				$agent_list=str_replace(",","','",$agent_list);
				$agent_list="'".$agent_list."'";
				$sql2=" and  a.user in(".$agent_list.")";
			}else{
				$sql2=" and  a.user ='".$agent_list."'";
			}
		}else{
			
			if($_SESSION["allow_users"]=="none"){
				$sql2=" ";
				
			}elseif($_SESSION["allow_users"]=="self"){
				
				$sql2="  and  a.user ='".$_SESSION["username"]."' ";
				
			}elseif($_SESSION["session_users_list"]!=""){
				
				if(strpos($_SESSION["session_users_list"],",")>-1){
					 
					$sql2=" and a.user in(".$_SESSION["session_users_list"].")";
				}else{
					$sql2=" and a.user =".$_SESSION["session_users_list"];
				}	
			}
				
		}
 		 	
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql3=" and campaign_id in(".$campaign_id.") ";
			}else{
				$sql3=" and campaign_id ='".$campaign_id."' ";
			}
		}else{
			
			if($_SESSION["allow_campaigns"]=="none"){
				$sql3=" ";
				
			}elseif($_SESSION["session_campaigns_list"]!=""){
				
				if(strpos($_SESSION["session_campaigns_list"],",")>-1){
					 
					$sql3=" and campaign_id in(".$_SESSION["session_campaigns_list"].")";
				}else{
					$sql3=" and campaign_id =".$_SESSION["session_campaigns_list"];
				}	
			}
				
		}
		 
  		
		$wheres=$sql1.$sql2.$sql3;

		/*$sql="SELECT status from data_sys_status where status_type='drop_opt' limit 0,1";
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		 
		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
				$drop_opt=$rs['status'];
			}
 		} 
		mysqli_free_result($rows);
		
		if($drop_opt=="drop_opt_jt"){
  			$sql_drop_p=",'DROP'";
		}else{
  			$sql_drop_p="";
		}*/

		$group_sql=",sum(pause_sec) as pause_sec,ROUND(sum(pause_sec)/sum(counts),2) as avg_pause_sec,max(max_pause_sec) as max_pause_sec,sum(wait_sec) as wait_sec,ROUND(sum(wait_sec)/sum(counts),2) as avg_wait_sec,max(max_wait_sec) as max_wait_sec,sum(talk_sec) as talk_sec,ROUND(sum(talk_sec)/sum(counts),2) as avg_talk_sec,max(max_talk_sec) as max_talk_sec,sum(dispo_sec+dead_sec) as dispo_sec,ROUND(sum(dispo_sec+dead_sec)/sum(counts),2) as avg_dispo_sec,max(max_dispo_sec+max_dead_sec) as max_dispo_sec,sum(pause_sec+wait_sec+dispo_sec+dead_sec+talk_sec) as online_sec,ROUND(sum(pause_sec+wait_sec+dispo_sec+dead_sec+talk_sec)/sum(counts),2) as avg_online_sec,max(max_pause_sec+max_wait_sec+max_dispo_sec+max_dead_sec+max_talk_sec) as max_online_sec,sum(case when sub_status not in('','LOGIN') then pause_sec else 0 end) as xx_sec,ROUND(sum(case when sub_status not in('','LOGIN') then pause_sec else 0 end)/sum(counts),2) as avg_xx_sec,max(case when sub_status not in('','LOGIN') then max_pause_sec else 0 end) as max_xx_sec,sum(talk_length_sec) as talk_length_sec,ifnull(ROUND(sum(talk_length_sec)/sum(case when status!='' then counts else 0 end),2),0) as avg_talk_length_sec,max(max_talk_length_sec)as max_talk_length_sec,sum(case when status!='' then counts else 0 end) as calls,sum(case when status in('CG','SB','YY','FBD','GJ15','HY','BXY','ZJBHG') then counts else 0 end) as jt,sum(case when status ='CG' then counts else 0 end) as cg";
		
		

		$case_sql=",a.calls as '呼叫量',a.cg as '成功量',a.jt as '接通量',case when jt=0 then concat(0,'%') else concat(ROUND((jt/calls)*100,2),'%') end as '接通率',case when cg=0 then concat(0,'%') else concat(ROUND((cg/jt)*100,2),'%') end as '接通成功率',case when cg=0 then concat(0,'%') else concat(ROUND((cg/calls)*100,2),'%') end as '总体成功率'";
		
		if($time_type=="times"){
			$time_f_l="sec_to_time(";
			$time_f_r=")";
		}elseif($time_type=="min"){
		 	$time_f_l="ROUND(";
			$time_f_r="/60,2)";
		}else{
			$time_f_l="";
			$time_f_r="";	
		}
		
		$time_field=",".$time_f_l."a.pause_sec".$time_f_r." as '暂停时长',".$time_f_l."a.avg_pause_sec".$time_f_r." as '平均暂停时长',".$time_f_l."a.max_pause_sec".$time_f_r." as '最大暂停时长',".$time_f_l."a.wait_sec".$time_f_r." as '等待时长',".$time_f_l."a.avg_wait_sec".$time_f_r." as '平均等待时长',".$time_f_l."a.max_wait_sec".$time_f_r." as '最大等待时长',".$time_f_l."a.talk_sec".$time_f_r." as '呼叫时长',".$time_f_l."a.avg_talk_sec".$time_f_r." as '平均呼叫时长',".$time_f_l."a.max_talk_sec".$time_f_r." as '最大呼叫时长',".$time_f_l."a.talk_length_sec".$time_f_r." as '通话时长',".$time_f_l."a.avg_talk_length_sec".$time_f_r." as '平均通话时长',".$time_f_l."a.max_talk_length_sec".$time_f_r." as '最大通话时长',".$time_f_l."a.dispo_sec".$time_f_r." as '处理时长',".$time_f_l."a.avg_dispo_sec".$time_f_r." as '平均处理时长',".$time_f_l."a.max_dispo_sec".$time_f_r." as '最大处理时长',".$time_f_l."a.online_sec".$time_f_r." as '在线时长',".$time_f_l."a.avg_online_sec".$time_f_r." as '平均在线时长',".$time_f_l."a.max_online_sec".$time_f_r." as '最大在线时长',".$time_f_l."a.xx_sec".$time_f_r." as '小休时长',".$time_f_l."a.avg_xx_sec".$time_f_r." as '平均小休时长',".$time_f_l."a.max_xx_sec".$time_f_r." as '最大小休时长'";
		
  		$left_sql=" left join vicidial_users b on a.user=b.user ";
		
		//统计类型
		switch($data_type){
			//按日期统计
			case "data_1":
				
				$by_sql=" DATE_FORMAT( event_time,'%Y-%m-%d') ";
				$by_sql_name=" as '日期' ";
				$left_sql=" ";
 				
				$sql="SELECT case when 日期 is null then '合计' else 日期 end as '日期' ".$case_sql.$time_field." from(select ".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by ".$by_sql." ".$with_rollup.")a ";
			
			break;
			
			//按工号日期统计
			case "data_12":
				
				$by_sql=" DATE_FORMAT( event_time,'%Y-%m-%d') ";
				$by_sql_name=" as '日期' ";
  				
				$sql="SELECT case when a.user is null and 日期 is null then '总计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号',case when 日期 is null and a.user is not null then '合计' else 日期 end as '日期' ".$case_sql.$time_field." from(select user,".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by user,".$by_sql." ".$with_rollup.")a ".$left_sql;
				
			break;
			
 			 
			//按周统计
			case "data_2":
			
				$by_sql=" weekday( event_time) ";
				$by_sql_name=" as '日期' ";
				$left_sql=" ";
 				
				$sql="SELECT case when 日期 is null then '合计' when 日期=0 then '周天' when 日期=1 then '周一' when 日期=2 then '周二' when 日期=3 then '周三' when 日期=4 then '周四' when 日期=5 then '周五' when 日期=6 then '周六' end  as '日期' ".$case_sql.$time_field." from(select ".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by ".$by_sql." ".$with_rollup.")a ";
				
 			break;
			
			//按工号、周统计
			case "data_22":
			
				$by_sql=" weekday( event_time) ";
				$by_sql_name=" as '日期' ";
  				
				$sql="SELECT case when a.user is null and 日期 is null then '总计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号',case when 日期 is null and a.user is not null  then '合计' when 日期=0 then '周天' when 日期=1 then '周一' when 日期=2 then '周二' when 日期=3 then '周三' when 日期=4 then '周四' when 日期=5 then '周五' when 日期=6 then '周六' end  as '日期' ".$case_sql.$time_field." from(select user,".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by user,".$by_sql." ".$with_rollup.")a ".$left_sql;
				
 			break;
			
			//按月份统计
			case "data_3":
				$by_sql=" DATE_FORMAT( event_time,'%Y-%m') ";
				$by_sql_name=" as '月份' ";
				$left_sql=" ";
 				$sql="SELECT case when 月份 is null then '合计' else 月份 end as '月份' ".$time_field.$case_sql." from(select ".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by ".$by_sql." ".$with_rollup.")a ";
			break;	
			//按工号、月份统计
			case "data_32":
				$by_sql=" DATE_FORMAT( event_time,'%Y-%m') ";
				$by_sql_name=" as '月份' ";
				 
 				$sql="SELECT case when a.user is null and 月份 is null then '总计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号',case when 月份 is null and a.user is not null  then '合计' else 月份 end as '月份' ".$time_field.$case_sql." from(select user,".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by user,".$by_sql." ".$with_rollup.")a ".$left_sql;

				
			break;
			
			//按业务统计
			case "data_4":
				$by_sql=" campaign_id  ";
				$by_sql_name=" ";
				$left_sql=" left join vicidial_campaigns d on a.campaign_id=d.campaign_id ";
				$group_filed=" ";
				
 				$sql="SELECT case when a.campaign_id is null then '合计' else concat(ifnull(d.campaign_name,'未知业务'),' [',a.campaign_id,']') end as '业务' ".$case_sql.$time_field." from(select ".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by ".$by_sql." ".$with_rollup.")a ".$left_sql;
 
			break;
			
			//按工号、业务统计
			case "data_42":
				$by_sql=" campaign_id  ";
				$by_sql_name=" ";
				$left_sql=" left join vicidial_users b on a.user=b.user left join vicidial_campaigns c on a.campaign_id=c.campaign_id ";
				$group_filed=" ";
				
 				$sql="SELECT case when a.user is null and a.campaign_id is null then '总计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号',case when a.campaign_id is null and a.user is not null then '合计' else concat(ifnull(c.campaign_name,'未知业务'),' [',a.campaign_id,']') end as '业务' ".$case_sql.$time_field." from(select user,".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by user,".$by_sql." ".$with_rollup.")a ".$left_sql;
 
			break;
			
			//按工号统计
			case "data_5":
				$by_sql=" user ";
				$by_sql_name="  ";
				

				//echo "1:".$wheres."\n";
				//echo "2:".$case_sql."\n";
				//echo "3:".$time_field."\n";
				//echo "4:".$with_rollup."\n";
				
 
 				$sql="SELECT case when a.user is null then '合计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号' ".$time_field." from(select ".$by_sql.$group_sql." from data_report_agent_log_list a where ".$wheres." group by ".$by_sql.")a ".$left_sql;

				
				//echo "5:".$sql."\n";
				//echo $sql."\n";
			break;
			//坐席组
			case "data_6":
				$by_sql="   ";
				$by_sql_name=" as '坐席组' ";
				$left_sql=" left join vicidial_user_groups b on a.user_group=b.user_group ";
 				$sql="SELECT case when a.user_group is null then '合计' else concat(a.user_group,' [',ifnull(b.group_name,'未知组'),']') end as '坐席组' ".$case_sql.$time_field." from(select b.user_group ".$group_sql." from data_report_agent_log_list a left join vicidial_users b on a.user=b.user where ".$wheres." group by b.user_group ".$with_rollup.")a ".$left_sql;
 
			break;
			 
 			default :
 		}
  	 
		$list=array();
		$list_arr=array();
		 
		$field_name_list=array();
		
		if($sql<>""){
			if($do_actions=="") { 
				$rows=mysqli_query($db_conn,$sql);
				$row_counts_list=mysqli_num_rows($rows);
				$field_count=mysqli_num_fields($rows);
				$fields = mysqli_fetch_fields($rows);
				
				for($i=0;$i<$field_count;$i++){
					array_push($field_name_list,$fields[$i]->name);
				}
				
				if ($row_counts_list!=0) {
					while($rs= mysqli_fetch_array($rows)){ 
						 
						for ($k=0;$k<$field_count;$k++){
						 
							$list=array_merge($list,array($fields[$k]->name=>$rs[$k]));
						}
						array_push($list_arr,$list);
					}
					 
					$counts="1";
					$des="succ";
				}else {
					
					$counts="0";
					$des="未找到符合条件的数据！";
					$list_arr=array('id'=>'none');
				}
				mysqli_free_result($rows);
				
				$json_data="{";
				$json_data.="\"counts\":".json_encode($counts).",";
				$json_data.="\"des\":".json_encode($des).",";
				$json_data.="\"field_name_list\":".json_encode($field_name_list).",";
				$json_data.="\"datalist\":".json_encode($list_arr)."";
				$json_data.="}";
				
				echo $json_data;
			
			}else{
				echo json_encode(save_detail_excel($sql,"坐席绩效报表"));	
			}
					 
		 }else{
			
			$json_data="{";
			$json_data.="\"counts\":\"-1\",";
			$json_data.="\"des\":\"数据查询条件有误，请检查后重试...\",";
			$json_data.="}";
			echo $json_data;
		}
  	 
	break;
	
  	//通话时长统计报表
	case "agent_event_sub_report":
		 
    	$time_type=trim($_REQUEST["time_type"]);
		$sql1=" event_time between '".$start_date."' and '".$end_date."'";
		
		if($agent_list<>""){
			if(strpos($agent_list,",")>-1){
 				$agent_list=str_replace(",","','",$agent_list);
				$agent_list="'".$agent_list."'";
				$sql2=" and a.user in(".$agent_list.")";
			}else{
				$sql2=" and a.user ='".$agent_list."'";
			}
		}else{
			
			if($_SESSION["allow_users"]=="none"){
				$sql2=" ";
				
			}elseif($_SESSION["allow_users"]=="self"){
				
				$sql2="  and a.user ='".$_SESSION["username"]."' ";
				
			}elseif($_SESSION["session_users_list"]!=""){
				
				if(strpos($_SESSION["session_users_list"],",")>-1){
					 
					$sql2=" and a.user in(".$_SESSION["session_users_list"].")";
				}else{
					$sql2=" and a.user =".$_SESSION["session_users_list"];
				}	
			}
				
		}
 		 	
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql3=" and  campaign_id in(".$campaign_id.") ";
			}else{
				$sql3=" and  campaign_id ='".$campaign_id."' ";
			}
		}else{
			
			if($_SESSION["allow_campaigns"]=="none"){
				$sql3=" ";
				
			}elseif($_SESSION["session_campaigns_list"]!=""){
				
				if(strpos($_SESSION["session_campaigns_list"],",")>-1){
					 
					$sql3=" and campaign_id in(".$_SESSION["session_campaigns_list"].")";
				}else{
					$sql3=" and campaign_id =".$_SESSION["session_campaigns_list"];
				}	
			}
				
		}
		 
 		$wheres=$sql1.$sql2.$sql3;

 		if($time_type=="times"){
			$time_f_l="sec_to_time(";
			$time_f_r=")";
		}elseif($time_type=="min"){
		 	$time_f_l="ROUND(";
			$time_f_r="/60,2)";
		}else{
			$time_f_l="";
			$time_f_r="";	
		}
 
		$sql="select pause_code,pause_code_name from vicidial_pause_codes limit 50";
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
  		
		$group_sql=",".$time_f_l."sum(case when sub_status not in('','LOGIN') then pause_sec else 0 end)".$time_f_r." as 小休时长,".$time_f_l."sum(case when sub_status not in('','LOGIN') then pause_sec else 0 end)/sum(counts)".$time_f_r." as 平均小休时长,".$time_f_l."max(case when sub_status not in('','LOGIN') then max_pause_sec else 0 end)".$time_f_r." as 最大小休时长";
 		
		$case_sql=",小休时长,平均小休时长,最大小休时长";
		$left_sql=" left join vicidial_users b on a.user=b.user ";
		
		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){
				
				$pause_code=$rs["pause_code"];
				$pause_code_name=$rs["pause_code_name"];
				
				$group_sql.=",".$time_f_l."sum(case when sub_status ='".$pause_code."' then pause_sec else 0 end)".$time_f_r." as `".$pause_code."时长`,".$time_f_l."sum(case when sub_status ='".$pause_code."' then pause_sec else 0 end)/sum(counts)".$time_f_r." as `".$pause_code."平均时长`,".$time_f_l."max(case when sub_status ='".$pause_code."'  then max_pause_sec else 0 end)".$time_f_r." as `".$pause_code."最大时长`";
				
				$case_sql.=",`".$pause_code."时长`,`".$pause_code."平均时长`,`".$pause_code."最大时长`";
			}
 		} 
		mysqli_free_result($rows);
 		
  		//统计类型
		switch($data_type){
			
			//按日期统计
			case "data_1":
				
				$by_sql=" DATE_FORMAT(event_time,'%Y-%m-%d') ";
				$by_sql_name=" as '日期' ";
				$left_sql=" ";
				
				$sql="select case when 日期 is null then '合计' else 日期 end as '日期' ".$case_sql." from(select ".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by ".$by_sql." ".$with_rollup.")a";
			
			break;
			
			//按工号、日期
			case "data_12":
				
				$by_sql=" DATE_FORMAT(event_time,'%Y-%m-%d') ";
				$by_sql_name=" as '日期' ";
			 
				
				$sql="select case when a.user is null and 日期 is null then '总计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号',case when 日期 is null and a.user is not null then '合计' else 日期 end as '日期' ".$case_sql." from(select user,".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by  user,".$by_sql." ".$with_rollup.")a ".$left_sql;
			
			break;
			 
			//按周统计
			case "data_2":
			
				$by_sql=" weekday(event_time) ";
				$by_sql_name=" as '日期' ";
				$left_sql=" ";
				
				$sql="select case when 日期 is null then '合计' when 日期=0 then '周天' when 日期=1 then '周一' when 日期=2 then '周二' when 日期=3 then '周三' when 日期=4 then '周四' when 日期=5 then '周五' when 日期=6 then '周六' end  as '日期' ".$case_sql." from(select ".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a  where ".$wheres." group by ".$by_sql." ".$with_rollup.")a ";
				
			break;
			
			//按工号、周
			case "data_22":
			
				$by_sql=" weekday(event_time) ";
				$by_sql_name=" as '日期' ";
 				
				$sql="select case when a.user is null and 日期 is null then '总计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号',case when 日期 is null and a.user is not null then '合计' when 日期=0 then '周天' when 日期=1 then '周一' when 日期=2 then '周二' when 日期=3 then '周三' when 日期=4 then '周四' when 日期=5 then '周五' when 日期=6 then '周六' end  as '日期' ".$case_sql." from(select user,".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by user,".$by_sql." ".$with_rollup.")a ".$left_sql;
				
			break;
			
			//按月份统计
			case "data_3":
				$by_sql=" DATE_FORMAT(event_time,'%Y-%m') ";
				$by_sql_name=" as '月份' ";
				$left_sql=" ";
				$sql="select case when 月份 is null then '合计' else 月份 end as '月份' ".$case_sql." from(select ".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a ".$left_sql." where ".$wheres." group by ".$by_sql." ".$with_rollup.")a";
	
			break;
			
			//按工号月份统计
			case "data_32":
				$by_sql=" DATE_FORMAT(event_time,'%Y-%m') ";
				$by_sql_name=" as '月份' ";
				 
				$sql="select case when a.user is null and 月份 is null then '总计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号',case when 月份 is null and a.user is not null then '合计' else 月份 end as '月份' ".$case_sql." from(select user,".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a  where ".$wheres." group by user,".$by_sql." ".$with_rollup.")a ".$left_sql;
	
			break;
			
			//按业务统计
			case "data_4":
				$by_sql=" campaign_id ";
				$by_sql_name="  ";
				$left_sql=" left join vicidial_campaigns d on a.campaign_id=d.campaign_id ";
 				
				$sql="select case when a.campaign_id is null then '合计' else concat(ifnull(d.campaign_name,'未知业务'),' [',a.campaign_id,']') end as '业务' ".$case_sql." from(select ".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by ".$by_sql." ".$with_rollup.")a ".$left_sql;
	
			break;
			
			//按工号、业务统计
			case "data_42":
			 
 				$by_sql=" campaign_id  ";
				$by_sql_name=" ";
				$left_sql=" left join vicidial_users b on a.user=b.user left join vicidial_campaigns c on a.campaign_id=c.campaign_id ";
				$group_filed=" ";
				
 				$sql="SELECT case when a.user is null and a.campaign_id is null then '总计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号',case when a.campaign_id is null and a.user is not null then '合计' else concat(ifnull(c.campaign_name,'未知业务'),' [',a.campaign_id,']') end as '业务' ".$case_sql.$time_field." from(select user,".$by_sql.$by_sql_name.$group_sql." from data_report_agent_log_list a where ".$wheres." group by user,".$by_sql." ".$with_rollup.")a ".$left_sql;
	
			break;
			
			//工号统计
			case "data_5":
				$by_sql=" user ";
  	
				$sql="select case when a.user is null then '合计' else concat(a.user,' [',ifnull(b.full_name,'未知姓名'),']') end as '工号'  ".$case_sql." from(select ".$by_sql.$group_sql." from data_report_agent_log_list a  where ".$wheres." group by ".$by_sql." ".$with_rollup.")a ".$left_sql;
	
			break;
			//按工号日期统计
			case "data_6":
				$by_sql=" ";
				$by_sql_name=" as '坐席组' ";
				 
				$sql="SELECT case when a.user_group is null then '合计' else concat(a.user_group,' [',ifnull(b.group_name,'未知组'),']') end as '坐席组' ".$case_sql." from(select b.user_group ".$group_sql." from data_report_agent_log_list a left join vicidial_users b on a.user=b.user where ".$wheres." group by b.user_group ".$with_rollup.")a  left join vicidial_user_groups b on a.user_group=b.user_group ";
	
			break;
			 
			default :
		}
  	 
		$list=array();
		$list_arr=array();
		 
		$field_name_list=array();
		
		if($sql<>""){
			if($do_actions=="") { 
				$rows=mysqli_query($db_conn,$sql);
				$row_counts_list=mysqli_num_rows($rows);
				$field_count=mysqli_num_fields($rows);
				$fields = mysqli_fetch_fields($rows);
				
				for($i=0;$i<$field_count;$i++){
					array_push($field_name_list,$fields[$i]->name);
				}
				
				if ($row_counts_list!=0) {
					while($rs= mysqli_fetch_array($rows)){ 
						 
						for ($k=0;$k<$field_count;$k++){
						 
							$list=array_merge($list,array($fields[$k]->name=>$rs[$k]));
						}
						array_push($list_arr,$list);
					}
					 
					$counts="1";
					$des="succ";
				}else {
					
					$counts="0";
					$des="未找到符合条件的数据！";
					$list_arr=array('id'=>'none');
				}
				mysqli_free_result($rows);
				
				$json_data="{";
				$json_data.="\"counts\":".json_encode($counts).",";
				$json_data.="\"des\":".json_encode($des).",";
				$json_data.="\"field_name_list\":".json_encode($field_name_list).",";
				$json_data.="\"datalist\":".json_encode($list_arr)."";
				$json_data.="}";
				
				echo $json_data;
			
			}else{
				echo json_encode(save_detail_excel($sql,"坐席绩效报表"));	
			}
					 
		 }else{
			
			$json_data="{";
			$json_data.="\"counts\":\"-1\",";
			$json_data.="\"des\":\"数据查询条件有误，请检查后重试...\",";
			$json_data.="}";
			echo $json_data;
		}
  	 
	break;
 	default :
  
}

unset($list_arr);
unset($lists_arr); 
unset($json_data);
unset($sql); 
mysqli_close($db_conn);
 
?>