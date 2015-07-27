<?php
require("../../inc/pub_func.php");
$with_rollup=trim($_REQUEST["with_rollup"]);
$drop_opt=trim($_REQUEST["drop_opt"]); 


switch($action){
  	
	//业务统计报表
	case "data_report":
		
		$dis_drop=trim($_REQUEST["dis_drop"]);
     		
		$sql1=" and a.call_date between '".$start_date."' and '".$end_date."'";
		
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
				
				$sql2="  and a.user =='".$_SESSION["username"]."' ";
				
			}elseif($_SESSION["session_users_list"]!=""){
				
				if(strpos($_SESSION["session_users_list"],",")>-1){
					 
					$sql2=" and a.user in(".$_SESSION["session_users_list"].")";
				}else{
					$sql2=" and a.user =".$_SESSION["session_users_list"];
				}	
			}
				
		}
		
		if($phone_login<>""){
			$phone_login=str_replace(",","','",$phone_login);
			$phone_login="'".$phone_login."'";
			//$sql3=" and c.phone_login in(".$phone_login.") ";
		}
		
		if($phone_number<>""){
  				
			if ($search_accuracy=="="){
				$exist_sql=" = '".$phone_number."'";
			}elseif($search_accuracy=="in"){
				$exist_sql="in('".$phone_number."')";
			}elseif($search_accuracy=="not in"){
				$exist_sql="not in('".$phone_number."')";
			}elseif($search_accuracy=="like_top"){
				$exist_sql="like '".$phone_number."%'";
			}elseif($search_accuracy=="like_end"){
				$exist_sql="like '%".$phone_number."'";
			}elseif($search_accuracy=="like"){
				$exist_sql="like '%".$phone_number."%'";
			}
 			
			$sql4=" and a.phone_number ".$exist_sql;
		}		
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql5=" and a.campaign_id in(".$campaign_id.") ";
			}else{
				$sql5=" and a.campaign_id ='".$campaign_id."' ";
			}
		}else{
			
			if($_SESSION["allow_campaigns"]=="none"){
				$sql5=" and a.campaign_id !='' ";
				
			}elseif($_SESSION["session_campaigns_list"]!=""){
				
				if(strpos($_SESSION["session_campaigns_list"],",")>-1){
					 
					$sql5=" and a.campaign_id in(".$_SESSION["session_campaigns_list"].")";
				}else{
					$sql5=" and a.campaign_id =".$_SESSION["session_campaigns_list"];
				}	
			}
				
		} 
		
		if($phone_lists<>""){
			if(strpos($phone_lists,",")>-1){
				$phone_lists=str_replace(",","','",$phone_lists);
				$phone_lists="'".$phone_lists."'";
				$sql6=" and a.list_id in(".$phone_lists.") ";
			}else{
				$sql6=" and a.list_id = '".$phone_lists."' ";
			}
		}
 		
		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7;
		
		$data_sql="select a.campaign_id,a.user,left(a.call_date,".$g_type.") as call_date,b.status_name from vicidial_log a left join data_sys_status b on a.status=b.status and b.status_type='call_status' where 1=1 ".$wheres."";	 
		//echo $data_sql.'<br><br>';
 		 
		if($drop_opt=="drop_opt_jt"){
			$sql_wrjt=",sum(case when status_name='无人接听' then 1 else 0 end ) as '无人接听'";
 			$sql_drop_p="+丢弃";
		}else{
			$sql_wrjt=",sum(case when status_name in('无人接听','丢弃') then 1 else 0 end ) as '无人接听'";
 			$sql_drop_p="";
		}
		
		if($dis_drop=="no"){
			$f_drop="";	
			$sum_drop="";
		}else if($dis_drop=="dq_count"){
			$sum_drop=",sum(丢弃) as '丢弃'";
			$f_drop=",丢弃";	
		}else if($dis_drop=="dq_ratio"){
			$sum_drop=",case when SUM(丢弃)=0 then concat(0,'%') else concat(ROUND((SUM(丢弃)/SUM(成功+一般+失败+丢弃+预约+非本店+二次回访))*100,2),'%') end as '丢弃率'";
			$f_drop=",丢弃率";	
		}else{
			$sum_drop=",sum(丢弃) as '丢弃',case when SUM(丢弃)=0 then concat(0,'%') else concat(ROUND((SUM(丢弃)/SUM(成功+一般+失败+丢弃+预约+非本店+二次回访))*100,2),'%') end as '丢弃率'";
			$f_drop=",丢弃,丢弃率";	
		}
		
		$group_sql=",sum(case when status_name='成功' then 1 else 0 end ) as '成功',sum(case when status_name='一般' then 1 else 0 end ) as '一般',sum(case when status_name='失败' then 1 else 0 end ) as '失败',sum(case when status_name='其他' then 1 else 0 end ) as '其他',sum(case when status_name='关机' then 1 else 0 end ) as '关机',sum(case when status_name='停机' then 1 else 0 end ) as '停机' ".$sql_wrjt.",sum(case when status_name='丢弃' then 1 else 0 end ) as '丢弃',sum(case when status_name='空号传真' then 1 else 0 end ) as '空号传真',sum(case when status_name='预约' then 1 else 0 end ) as '预约',sum(case when status_name='非本店' then 1 else 0 end ) as '非本店',sum(case when status_name='二次回访' then 1 else 0 end ) as '二次回访'";
		//echo $group_sql.'<br><br>';
		
		$case_sql=",sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.") as '接通量',sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p.") as '呼叫总数',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '呼通成功率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '整体成功率'".$sum_drop;
		
	  //统计类型
	  if($report_type=="report_1"){
		  	$report_field=",呼叫总数,成功,接通量,停机或空号,无人接听,关机或其他,接通率,呼通成功率,整体成功率".$f_drop;
			switch($data_type){
				
				//按日期统计
				case "data_1":
				
					$sql="select case when call_date is null then '合计' else call_date end as '日期',sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p.") as '呼叫总数',sum(成功+一般) as '成功',sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.") as '接通量',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '呼通成功率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '整体成功率'".$sum_drop." from( select call_date ".$group_sql." from (".$data_sql.") datas group by call_date  order by null) datas group by call_date ".$with_rollup."";
				
				break;
				
				//按月份统计
				case "data_1_month":
				
					$sql="select case when call_date is null then '合计' else call_date end as '月份',sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p.") as '呼叫总数',sum(成功+一般) as '成功',sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.") as '接通量',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '呼通成功率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '整体成功率'".$sum_drop." from( select call_date 	".$group_sql." from (".$data_sql.") datas group by call_date  order by null) datas group by call_date ".$with_rollup."";
				
				break;
 				
				//按业务统计
				case "data_2":
				
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums',campaign_id ,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他' ".$case_sql." from( select campaign_id ".$group_sql." from (".$data_sql.") datas group by campaign_id  order by null) datas group by  campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按日期、业务统计
				case "data_3":
					$sql="select case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as 日期,case when 日期 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when call_date is null then 'ZongJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id  order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按月份、业务统计
				case "data_3_month":
					$sql="select case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as 月份,case when 月份 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when call_date is null then 'ZongJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id  order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按业务、日期统计
				case "data_4":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date  order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、月份统计
				case "data_4_month":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date  order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				
				//按工号统计
				case "data_5":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名'".$report_field." from( select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select user".$group_sql." from (".$data_sql.") datas group by user  order by null) datas group by user ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、日期统计
				case "data_6":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date ,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date	 order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、月份统计
				case "data_6_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date ,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date	 order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;				
				//按工号、业务统计
				case "data_7":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from( select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,campaign_id,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select user,campaign_id".$group_sql." from (".$data_sql.") datas group by user,campaign_id order by null) datas group by user,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、工号统计
				case "data_8":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.user is null and datas.campaign_id is not null and sums='0' then '合计' else datas.user end as '工号',users.full_name as '姓名'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,user,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select campaign_id,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,user order by null) datas group by campaign_id,user ".$with_rollup." )datas left join vicidial_users users on datas.user=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	  
				break;
				
				//按工号、日期、业务统计
				case "data_9":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums',user,call_date,campaign_id,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	  
				break;

				//按工号、月份、业务统计
				case "data_9_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums',user,call_date,campaign_id,SUM(成功+一般) as '成功',sum(停机+空号传真) as '停机或空号',sum(无人接听) as '无人接听',sum(关机+其他) as '关机或其他'".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	  
				break;
				
				default :
			
			}
			
	  }elseif($report_type=="report_2"){
		    $report_field=",成功,失败,空号传真,其他,无人接听,关机停机,接通率,接通量,呼叫总数,整体成功率,呼通成功率".$f_drop;
			switch($data_type){
				//按日期统计
				case "data_1":
				
					$sql="select case when call_date is null then '合计' else call_date end as '日期'
,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '整体成功率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '呼通成功率'".$sum_drop." from( select call_date	".$group_sql." from (".$data_sql.") datas group by call_date order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按月份统计
				case "data_1_month":
				
					$sql="select case when call_date is null then '合计' else call_date end as '月份'
,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '整体成功率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/SUM(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '呼通成功率'".$sum_drop." from( select call_date	".$group_sql." from (".$data_sql.") datas group by call_date order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按业务统计
				case "data_2":
				
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id ".$group_sql." from (".$data_sql.") datas group by campaign_id order by null) datas group by  campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按日期、业务统计
				case "data_3":
					$sql="select case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as 日期,case when 日期 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when call_date is null then 'ZongJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按月份、业务统计
				case "data_3_month":
					$sql="select case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as 月份,case when 月份 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when call_date is null then 'ZongJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按业务、日期统计
				case "data_4":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,call_date,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、月份统计
				case "data_4_month":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,call_date,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;				
				//按工号统计
				case "data_5":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名'".$report_field." from(select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user".$group_sql." from (".$data_sql.") datas group by user order by null) datas group by user ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
						 			
				break;
				//按工号、日期统计
				case "data_6":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、月份统计
				case "data_6_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;				
				//按工号、业务统计
				case "data_7":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,campaign_id".$group_sql." from (".$data_sql.") datas group by user,campaign_id order by null) datas group by user,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、工号统计
				case "data_8":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.user is null and datas.campaign_id is not null and sums='0' then '合计' else datas.user end as '工号',users.full_name as '姓名'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,user,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,user order by null) datas group by campaign_id,user ".$with_rollup." )datas left join vicidial_users users on datas.user=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
 
 				break;
				//按工号、日期、业务统计
				case "data_9":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;				
				//按工号、月份、业务统计
				case "data_9_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;				
 				default :
 			}
			
 	  }elseif($report_type=="report_3"){
		  	$report_field=",呼叫总数,坐席数,接通量,成功,呼通成功率,接通率".$f_drop;
			switch($data_type){
				//按日期统计
				case "data_1":
				
					$sql="select case when call_date is null then '合计' else call_date end as '日期'
,sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p.") as '呼叫总数',count(case when user is not null and user!='VDAD' then 1 else 0 end ) as '坐席数',sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.") as '接通量',SUM(成功+一般) as '成功',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '呼通成功率',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率'".$sum_drop." from( select call_date,user ".$group_sql." from (".$data_sql.") datas group by call_date,user order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按月份统计
				case "data_1_month":
				
					$sql="select case when call_date is null then '合计' else call_date end as '月份'
,sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p.") as '呼叫总数',count(case when user is not null and user!='VDAD' then 1 else 0 end ) as '坐席数',sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.") as '接通量',SUM(成功+一般) as '成功',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '呼通成功率',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率'".$sum_drop." from( select call_date,user ".$group_sql." from (".$data_sql.") datas group by call_date,user order by null) datas group by call_date ".$with_rollup."";
				
				break;
				
				//按业务统计
				case "data_2":
				
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,count(case when user is not null and user!='VDAD' then 1 else 0 end ) as '坐席数',campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,user order by null) datas group by  campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按日期、业务统计
				case "data_3":
					$sql="select case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as 日期,case when 日期 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when call_date is null then 'ZongJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums' ,count(case when user is not null and user!='VDAD' then 1 else 0 end ) as '坐席数',campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select call_date,campaign_id,user ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id,user order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按月份、业务统计
				case "data_3_month":
					$sql="select case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as 月份,case when 月份 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when call_date is null then 'ZongJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums' ,count(case when user is not null and user!='VDAD' then 1 else 0 end ) as '坐席数',campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select call_date,campaign_id,user ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id,user order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;				
				
				//按业务、日期统计
				case "data_4":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when call_date is null and datas.campaign_id is not null and sums='0' then '合计' else call_date end as '日期'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,count(case when user is not null and user!='VDAD' then 1 else 0 end ) as '坐席数',campaign_id,call_date,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,call_date,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date,user order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、月份统计
				case "data_4_month":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when call_date is null and datas.campaign_id is not null and sums='0' then '合计' else call_date end as '月份'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,count(case when user is not null and user!='VDAD' then 1 else 0 end ) as '坐席数',campaign_id,call_date,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,call_date,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date,user order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;				
				//按工号统计
				case "data_5":
					$report_field=",呼叫总数,接通量,成功,呼通成功率,接通率".$f_drop;
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名'".$report_field." from(select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user".$group_sql." from (".$data_sql.") datas group by user order by null) datas group by user ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、日期统计
				case "data_6":
					$report_field=",呼叫总数,接通量,成功,呼通成功率,接通率".$f_drop;
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、月份统计
				case "data_6_month":
					$report_field=",呼叫总数,接通量,成功,呼通成功率,接通率".$f_drop;
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、业务统计
				case "data_7":
					$report_field=",呼叫总数,接通量,成功,呼通成功率,接通率".$f_drop;
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,campaign_id".$group_sql." from (".$data_sql.") datas group by user,campaign_id order by null) datas group by user,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、工号统计
				case "data_8":
					$report_field=",呼叫总数,接通量,成功,呼通成功率,接通率".$f_drop;
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.user is null and datas.campaign_id is not null and sums='0' then '合计' else datas.user end as '工号',users.full_name as '姓名'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,user,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,user order by null) datas group by campaign_id,user ".$with_rollup." )datas left join vicidial_users users on datas.user=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	  
				break;
				//按工号、日期、业务统计
				case "data_9":
					$report_field=",呼叫总数,接通量,成功,呼通成功率,接通率".$f_drop;
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按工号、月份、业务统计
				case "data_9_month":
					$report_field=",呼叫总数,接通量,成功,呼通成功率,接通率".$f_drop;
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id,SUM(成功+一般) as '成功',sum(失败) as '失败',sum(空号传真) as '空号传真',sum(其他) as '其他',sum(无人接听) as '无人接听',sum(关机+停机) as '关机停机',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				default :
			
			}
			
	  }elseif($report_type=="report_4"){
		  	$report_field=",成功,失败,停机,关机,其他,空号传真,无人接听,预约,非本店,接通量,呼叫总数,接通率,呼通成功率,整体成功率".$f_drop;
			switch($data_type){
				//按日期统计
				case "data_1":
				
					$sql="select case when call_date is null then '合计' else call_date end as '日期',sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select call_date ".$group_sql." from (".$data_sql.") datas group by call_date order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按月份统计
				case "data_1_month":
				
					$sql="select case when call_date is null then '合计' else call_date end as '月份',sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select call_date ".$group_sql." from (".$data_sql.") datas group by call_date order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按业务统计
				case "data_2":
				
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id ".$group_sql." from (".$data_sql.") datas group by campaign_id order by null) datas group by  campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按日期、业务统计
				case "data_3":
					$sql="select case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as 日期,case when 日期 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when call_date is null then 'ZongJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按月份、业务统计
				case "data_3_month":
					$sql="select case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as 月份,case when 月份 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when call_date is null then 'ZongJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;				
				//按业务、日期统计
				case "data_4":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、月份统计
				case "data_4_month":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按工号统计
				case "data_5":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名'".$report_field." from(select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',user,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user".$group_sql." from (".$data_sql.") datas group by user order by null) datas group by user ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、日期统计
				case "data_6":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、月份统计
				case "data_6_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、业务统计
				case "data_7":
					$sql="select 
case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,campaign_id,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,campaign_id".$group_sql." from (".$data_sql.") datas group by user,campaign_id order by null) datas group by user,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、工号统计
				case "data_8":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.user is null and datas.campaign_id is not null and sums='0' then '合计' else datas.user end as '工号',users.full_name as '姓名'".$report_field." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,user,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select campaign_id,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,user order by null) datas group by campaign_id,user ".$with_rollup." )datas left join vicidial_users users on datas.user=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	  
				break;
				//按工号、日期、业务统计
				case "data_9":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按工号、月份、业务统计
				case "data_9_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$report_field." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id,sum(成功+一般) as '成功',sum(失败) as '失败',sum(停机) as '停机',sum(关机) as '关机',sum(其他) as '其他',sum(空号传真) as '空号传真',sum(无人接听) as '无人接听',sum(预约) as '预约',sum(非本店) as '非本店' ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				default :
			
			}
	  }elseif($report_type=="report_5"){
		  
			$case_sql=",sum(成功+一般) as '定制量',sum(失败) as '拒绝用户',sum(停机+关机+其他+空号传真) as '停关机用户',sum(无人接听) as '无人接听',sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p.") as '外呼总量',sum(成功+一般+失败) as '接触用户数',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '推荐成功率',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '有效接通率'".$sum_drop;
			$fields_list=",定制量,拒绝用户,停关机用户,无人接听,外呼总量,接触用户数,推荐成功率,有效接通率".$f_drop;
			
			switch($data_type){
 
				//按日期统计
				case "data_1":
				
					$sql="select case when call_date is null then '合计' else call_date end as '日期'".$case_sql." from( select call_date ".$group_sql." from (".$data_sql.") datas group by call_date order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按月份统计
				case "data_1_month":
				
					$sql="select case when call_date is null then '合计' else call_date end as '月份'".$case_sql." from( select call_date ".$group_sql." from (".$data_sql.") datas group by call_date order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按业务统计
				case "data_2":
				
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id ".$case_sql." from( select campaign_id ".$group_sql." from (".$data_sql.") datas group by campaign_id order by null) datas group by  campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按日期、业务统计
				case "data_3":
					$sql="select case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as 日期,case when 日期 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when call_date is null then 'ZongJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id ".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按月份、业务统计
				case "data_3_month":
					$sql="select case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as 月份,case when 月份 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when call_date is null then 'ZongJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id ".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按业务、日期统计
				case "data_4":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$fields_list." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、月份统计
				case "data_4_month":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$fields_list." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按工号统计
				case "data_5":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名'".$fields_list." from(select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',user ".$case_sql." from( select user".$group_sql." from (".$data_sql.") datas group by user order by null) datas group by user ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、日期统计
				case "data_6":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、月份统计
				case "data_6_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、业务统计
				case "data_7":
					$sql="select 
case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,campaign_id".$case_sql." from( select user,campaign_id".$group_sql." from (".$data_sql.") datas group by user,campaign_id order by null) datas group by user,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、工号统计
				case "data_8":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.user is null and datas.campaign_id is not null and sums='0' then '合计' else datas.user end as '工号',users.full_name as '姓名'".$fields_list." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,user".$case_sql." from( select campaign_id,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,user order by null) datas group by campaign_id,user ".$with_rollup." )datas left join vicidial_users users on datas.user=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	  
				break;
				//按工号、日期、业务统计
				case "data_9":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按工号、月份、业务统计
				case "data_9_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				default :
			
			}
	  }elseif($report_type=="report_6"){
		  
		  $sql_group="select status_name from data_sys_status where status_type='call_status' group by status_name";
		  
		  $rows_group=mysqli_query($db_conn,$sql_group);
		  $row_counts_list_group=mysqli_num_rows($rows_group);
 			
		  if ($row_counts_list_group!=0) {
			  $group_sql="";
			  $case_sql="";
			  $sum_list="";
			  $fields_list="";
			  while($rs= mysqli_fetch_array($rows_group)){
				  
				  $group_sql.=",sum(case when status_name='".$rs["status_name"]."' then 1 else 0 end ) as '".$rs["status_name"]."'";
				  $case_sql.=",sum(".$rs["status_name"].") as '".$rs["status_name"]."'";
				  $sum_list.="".$rs["status_name"]."+";
				  $fields_list.=",".$rs["status_name"]."";
			  }
			   
			  $case_sql.=",sum(".rtrim($sum_list,"+").") as '外呼总量'";
			  $fields_list.=",外呼总量";
			  
 		  }
		  mysqli_free_result($rows_group); 
  			
			switch($data_type){
 
				//按日期统计
				case "data_1":
				
					$sql="select case when call_date is null then '合计' else call_date end as '日期'".$case_sql." from( select call_date ".$group_sql." from (".$data_sql.") datas group by call_date order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按月份统计
				case "data_1_month":
				
					$sql="select case when call_date is null then '合计' else call_date end as '月份'".$case_sql." from( select call_date ".$group_sql." from (".$data_sql.") datas group by call_date order by null) datas group by call_date ".$with_rollup."";
				
				break;
				//按业务统计
				case "data_2":
				
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id ".$case_sql." from( select campaign_id ".$group_sql." from (".$data_sql.") datas group by campaign_id order by null) datas group by  campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按日期、业务统计
				case "data_3":
					$sql="select case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as 日期,case when 日期 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when call_date is null then 'ZongJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id ".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按月份、业务统计
				case "data_3_month":
					$sql="select case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as 月份,case when 月份 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when call_date is null then 'ZongJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id ".$case_sql." from( select call_date,campaign_id ".$group_sql." from (".$data_sql.") datas group by call_date,campaign_id order by null) datas group by call_date,campaign_id ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	   
				break;
				//按业务、日期统计
				case "data_4":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$fields_list." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、月份统计
				case "data_4_month":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.campaign_id is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$fields_list." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date".$case_sql." from( select campaign_id,call_date ".$group_sql." from (".$data_sql.") datas group by campaign_id,call_date order by null) datas group by campaign_id,call_date ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按工号统计
				case "data_5":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名'".$fields_list." from(select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',user ".$case_sql." from( select user".$group_sql." from (".$data_sql.") datas group by user order by null) datas group by user ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、日期统计
				case "data_6":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、月份统计
				case "data_6_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date ".$case_sql." from( select user,call_date".$group_sql." from (".$data_sql.") datas group by user,call_date order by null) datas group by user,call_date ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user";
	 
				break;
				//按工号、业务统计
				case "data_7":
					$sql="select 
case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,campaign_id".$case_sql." from( select user,campaign_id".$group_sql." from (".$data_sql.") datas group by user,campaign_id order by null) datas group by user,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按业务、工号统计
				case "data_8":
					$sql="select case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when datas.user is null and datas.campaign_id is not null and sums='0' then '合计' else datas.user end as '工号',users.full_name as '姓名'".$fields_list." from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,user".$case_sql." from( select campaign_id,user ".$group_sql." from (".$data_sql.") datas group by campaign_id,user order by null) datas group by campaign_id,user ".$with_rollup." )datas left join vicidial_users users on datas.user=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	  
				break;
				//按工号、日期、业务统计
				case "data_9":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				//按工号、月份、业务统计
				case "data_9_month":
					$sql="select case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',users.full_name as '姓名',case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份',case when sums='0' and s_sums='1' and call_date is not null and datas.campaign_id is null then '小计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务'".$fields_list." from(select case when user is null then 'ZongJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums',case when campaign_id is null then '1' else '0' end as 's_sums' ,user,call_date,campaign_id ".$case_sql." from( select user,call_date,campaign_id".$group_sql." from (".$data_sql.") datas group by user,call_date,campaign_id order by null) datas group by user,call_date,campaign_id ".$with_rollup." )datas left join vicidial_users users on datas.工号=users.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	 
				break;
				default :
			
			}
		  
	  }
    	
	 //echo $sql.'<br><br>';
		 
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
					$des="获取成功！";
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
				echo json_encode(save_detail_excel($sql,"业务活动统计报表"));	
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
	case "timelen_report":
	
    	$time_type=trim($_REQUEST["time_type"]);
		$time_len_type=trim($_REQUEST["time_len_type"]);
		$time_sum_len_type=substr($time_len_type,2,strlen($time_len_type)-2);
		
		$sql1=" and a.call_date between '".$start_date."' and '".$end_date."'";
		
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
				
				$sql2="  and a.user =='".$_SESSION["username"]."' ";
				
			}elseif($_SESSION["session_users_list"]!=""){
				
				if(strpos($_SESSION["session_users_list"],",")>-1){
					 
					$sql2=" and a.user in(".$_SESSION["session_users_list"].")";
				}else{
					$sql2=" and a.user =".$_SESSION["session_users_list"];
				}	
			}
				
		}
  		
		if($phone_number<>""){
  				
			if ($search_accuracy=="="){
				$exist_sql=" = '".$phone_number."'";
			}elseif($search_accuracy=="in"){
				$exist_sql="in('".$phone_number."')";
			}elseif($search_accuracy=="not in"){
				$exist_sql="not in('".$phone_number."')";
			}elseif($search_accuracy=="like_top"){
				$exist_sql="like '".$phone_number."%'";
			}elseif($search_accuracy=="like_end"){
				$exist_sql="like '%".$phone_number."'";
			}elseif($search_accuracy=="like"){
				$exist_sql="like '%".$phone_number."%'";
			}
 			
			$sql4=" and a.phone_number ".$exist_sql;
		}		
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql5=" and a.campaign_id in(".$campaign_id.") ";
			}else{
				$sql5=" and a.campaign_id ='".$campaign_id."' ";
			}
		}else{
			
			if($_SESSION["allow_campaigns"]=="none"){
				$sql5=" and a.campaign_id !='' ";
				
			}elseif($_SESSION["session_campaigns_list"]!=""){
				
				if(strpos($_SESSION["session_campaigns_list"],",")>-1){
					 
					$sql5=" and a.campaign_id in(".$_SESSION["session_campaigns_list"].")";
				}else{
					$sql5=" and a.campaign_id =".$_SESSION["session_campaigns_list"];
				}	
			}
				
		} 
		
		if($phone_lists<>""){
			if(strpos($phone_lists,",")>-1){
				$phone_lists=str_replace(",","','",$phone_lists);
				$phone_lists="'".$phone_lists."'";
				$sql6=" and a.list_id in(".$phone_lists.") ";
			}else{
				$sql6=" and a.list_id = '".$phone_lists."' ";
			}
		}
 		
		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7;

		$sql="SELECT status from data_sys_status where status_type='drop_opt' limit 0,1";
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
		}

		$data_sql="select a.user,a.campaign_id,a.status,left(a.call_date,".$g_type.") as call_date,".$time_len_type." from vicidial_log a left join recording_log b on a.uniqueid=b.vicidial_id and a.lead_id=b.lead_id where 1=1 ".$wheres."";	
		
 		//'CG','HY','BXY','ZQ','HHMD','ZJBHG'
		$group_sql=",sum(case when status in('CG','YB') then 1 else 0 end ) as '成功',sum(case when status in('CG','SB','GJ15','HY','BXY','ZJBHG'".$sql_drop_p.") then 1 else 0 end ) as '呼通',count(*) as '呼叫量',sum(".$time_sum_len_type.") as '时长',max(".$time_sum_len_type.") as '最长时',min(".$time_sum_len_type.") as '最短时'";
		
		$case_sql=",sum(时长) as '时长',max(最长时) as '最长时',min(最短时) as '最短时',sum(成功) as '成功',sum(呼通) as '呼通',sum(呼叫量) as '呼叫量',case when SUM(时长)=0 then concat(0,'%') else ROUND((SUM(时长)/SUM(呼通)),2) end  as '平均时',case when SUM(成功)=0 then concat(0,'%') else concat(ROUND((SUM(成功)/SUM(呼叫量))*100,2),'%') end as '成功率',case when SUM(成功)=0 then concat(0,'%') else concat(ROUND((SUM(成功)/SUM(呼通))*100,2),'%') end as '呼通成功率',case when SUM(呼通)=0 then concat(0,'%') else concat(ROUND((SUM(呼通)/SUM(呼叫量))*100,2),'%') end as '呼通率'";
		
		if($time_type=="times"){
			$time_field="sec_to_time(时长) as 时长,sec_to_time(最长时) as 最长时,sec_to_time(最短时) as 最短时,sec_to_time(平均时) as 平均时,";
		}elseif($time_type=="sec"){
			$time_field="时长,最长时,最短时,平均时,";	
		}else{
			$time_field="ROUND(时长/60,2) as 时长,ROUND(最长时/60,2) as 最长时,ROUND(最短时/60,2) as 最短时,ROUND(平均时/60,2) as 平均时,";	
		}
		
		//统计类型
		switch($data_type){
			//按日期统计
			case "data_1":
			
				$sql="SELECT case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as '日期',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when call_date is null then 'HeJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums'".$case_sql." from(select call_date".$group_sql." from (".$data_sql.")datas group by call_date order by null)datas group by call_date ".$with_rollup." )datas";
			
			break;
 			//按月份统计
			case "data_1_month":
			
				$sql="SELECT case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as '月份',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when call_date is null then 'HeJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums'".$case_sql." from(select call_date".$group_sql." from (".$data_sql.")datas group by call_date order by null)datas group by call_date ".$with_rollup." )datas";
			
			break;
			//按工号统计
			case "data_2":
			
				$sql="SELECT case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',b.full_name as '姓名',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from( select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user".$case_sql." from(select user".$group_sql." from (".$data_sql.")datas group by user order by null)datas group by user ".$with_rollup." )datas left join vicidial_users b on datas.user=b.user";
 			break;
			//按业务统计
			case "data_3":
				$sql="SELECT case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else b.campaign_name end as '业务',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id".$case_sql." from(select campaign_id".$group_sql." from (".$data_sql." )datas group by campaign_id order by null)datas group by campaign_id ".$with_rollup." )datas left join vicidial_campaigns b on datas.campaign_id=b.campaign_id";
   
			break;
			//按日期工号统计
			case "data_4":
				$sql="SELECT case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as '日期',case when 日期 is not null and datas.user is null and sums='0' then '合计' else datas.user end as '工号',b.full_name as '姓名',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when call_date is null then 'HeJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums' ,user".$case_sql." from(select call_date,user".$group_sql." from (".$data_sql." )datas group by call_date,user order by null)datas group by call_date,user ".$with_rollup." )datas left join vicidial_users b on datas.user=b.user";
 
			break;
			//按月份工号统计
			case "data_4_month":
				$sql="SELECT case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as '月份',case when 月份 is not null and datas.user is null and sums='0' then '合计' else datas.user end as '工号',b.full_name as '姓名',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when call_date is null then 'HeJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums' ,user".$case_sql." from(select call_date,user".$group_sql." from (".$data_sql." )datas group by call_date,user order by null)datas group by call_date,user ".$with_rollup." )datas left join vicidial_users b on datas.user=b.user";
 
			break;
			//按工号日期统计
			case "data_5":
				$sql="SELECT case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',b.full_name as '姓名' ,case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date  end as '日期',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from( select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date".$case_sql." from(select user,call_date".$group_sql." from (".$data_sql." )datas group by user,call_date order by null)datas group by user,call_date ".$with_rollup." )datas left join vicidial_users b on datas.user=b.user";
 
			break;
			//按工号月份统计
			case "data_5_month":
				$sql="SELECT case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号',b.full_name as '姓名' ,case when 工号 is not null and call_date is null and sums='0' then '合计' else call_date  end as '月份',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from( select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,call_date".$case_sql." from(select user,call_date".$group_sql." from (".$data_sql." )datas group by user,call_date order by null)datas group by user,call_date ".$with_rollup." )datas left join vicidial_users b on datas.user=b.user";
 
			break;
			//按日期业务统计
			case "data_6":
				$sql="SELECT case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as '日期',case when 日期 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when call_date is null then 'HeJi' else call_date end as '日期',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id".$case_sql." from(select call_date,campaign_id ".$group_sql." from (".$data_sql." )datas group by call_date,campaign_id order by null)datas group by call_date,campaign_id ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
 
			break;
			//按月份业务统计
			case "data_6_month":
				$sql="SELECT case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as '月份',case when 月份 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when call_date is null then 'HeJi' else call_date end as '月份',case when call_date is null then '1' else '0' end as 'sums' ,campaign_id".$case_sql." from(select call_date,campaign_id ".$group_sql." from (".$data_sql." )datas group by call_date,campaign_id order by null)datas group by call_date,campaign_id ".$with_rollup.")datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
 
			break;
			//按业务日期统计
			case "data_7":
				$sql="SELECT case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when 业务 is not null and call_date is null and sums='0' then '合计' else call_date end as '日期',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date".$case_sql." from(select campaign_id,call_date".$group_sql." from (".$data_sql." )datas group by campaign_id,call_date order by null)datas group by campaign_id,call_date ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
				 
			break;
			//按业务月份统计
			case "data_7_month":
				$sql="SELECT case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when 业务 is not null and call_date is null and sums='0' then '合计' else call_date end as '月份',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,call_date".$case_sql." from(select campaign_id,call_date".$group_sql." from (".$data_sql." )datas group by campaign_id,call_date order by null)datas group by campaign_id,call_date ".$with_rollup." )datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
				 
			break;
			//按业务工号统计
			case "data_8":
				$sql="SELECT case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',case when 业务 is not null and datas.user is null and sums='0' then '合计' else datas.user end as '工号',b.full_name as '姓名',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from( select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,user ".$case_sql." from(select campaign_id,user".$group_sql." from (".$data_sql.")datas group by campaign_id,user order by null)datas group by campaign_id,user ".$with_rollup." )datas left join vicidial_users b on datas.user=b.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
				  
			break;
			
			//按工号业务统计
			case "data_9":
				$sql="SELECT case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else datas.user end as '工号',b.full_name as '姓名',case when 工号 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',".$time_field."成功,呼通,呼叫量,成功率,呼通成功率,呼通率 from(select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user,campaign_id".$case_sql." from(select user,campaign_id".$group_sql." from (".$data_sql.")datas group by user,campaign_id order by null)datas group by user,campaign_id ".$with_rollup." )datas left join vicidial_users b on datas.user=b.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
				  
			break;
 			default :
 		}
      	
	 //echo $sql.'<br><br>';
	 
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
					$des="获取成功！";
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
				echo json_encode(save_detail_excel($sql,"通话时长统计报表"));	
			}
					 
		 }else{
			
			$json_data="{";
			$json_data.="\"counts\":\"-1\",";
			$json_data.="\"des\":\"数据查询条件有误，请检查后重试...\",";
			$json_data.="}";
			echo $json_data;
		}
  	 
	break;
	
	//质检统计报表
	case "quality_report":
 			
			$sql1=" and a.addtime between '".$start_date."' and '".$end_date."'";
			
			if($agent_list<>""){
				if(strpos($agent_list,",")>-1){
					$agent_list=str_replace(",","','",$agent_list);
					$agent_list="'".$agent_list."'";
					$sql2=" and b.user in(".$agent_list.")";
				}else{
					$sql2=" and b.user ='".$agent_list."'";
				}
			}else{
			
				if($_SESSION["allow_users"]=="none"){
					$sql2=" ";
					
				}elseif($_SESSION["allow_users"]=="self"){
					
					$sql2="  and b.user =='".$_SESSION["username"]."' ";
					
				}elseif($_SESSION["session_users_list"]!=""){
					
					if(strpos($_SESSION["session_users_list"],",")>-1){
						 
						$sql2=" and b.user in(".$_SESSION["session_users_list"].")";
					}else{
						$sql2=" and b.user =".$_SESSION["session_users_list"];
					}	
				}
					
			}
	 
 			if($campaign_id<>""){
				if(strpos($campaign_id,",")>-1){
					$campaign_id=str_replace(",","','",$campaign_id);
					$campaign_id="'".$campaign_id."'";
					$sql3=" and b.campaign_id in(".$campaign_id.") ";
				}else{
					$sql3=" and b.campaign_id ='".$campaign_id."' ";
				}
			}else{
			
				if($_SESSION["allow_campaigns"]=="none"){
					$sql3="  ";
					
				}elseif($_SESSION["session_campaigns_list"]!=""){
					
					if(strpos($_SESSION["session_campaigns_list"],",")>-1){
						 
						$sql3=" and b.campaign_id in(".$_SESSION["session_campaigns_list"].")";
					}else{
						$sql3=" and b.campaign_id =".$_SESSION["session_campaigns_list"];
					}	
				}
				
			} 
			
			if($phone_lists<>""){
				if(strpos($phone_lists,",")>-1){
					$phone_lists=str_replace(",","','",$phone_lists);
					$phone_lists="'".$phone_lists."'";
					$sql4=" and a.list_id in(".$phone_lists.") ";
				}else{
					$sql4=" and a.list_id = '".$phone_lists."' ";
				}
			}
			
			if($quality_user<>""){
				if(strpos($quality_user,",")>-1){
					$quality_user=str_replace(",","','",$quality_user);
					$quality_user="'".$quality_user."'";
					$sql5=" and a.userid in(".$quality_user.") ";
				}else{
					$sql5=" and a.userid = '".$quality_user."' ";
				}
			}
 			
			if($quality_status<>""){
				if(strpos($quality_status,",")>-1){
					$quality_status=str_replace(",","','",$quality_status);
					$quality_status="'".$quality_status."'";
					$sql6=" and a.qualitystatus in(".$quality_status.") ";
				}else{
					$sql6=" and a.qualitystatus ='".$quality_status."' ";
				}
			}
			
			$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7;
	
			$data_sql="select qualitystatus,a.campaign_id,userid,left(addtime,".$g_type.") as addtime,b.user from data_quality_log a  left join vicidial_log b on a.vicidial_id=b.uniqueid and a.lead_id=b.lead_id where 1=1 ".$wheres."";	 
 			
			$group_sql=",sum(case when qualitystatus='0' then 1 else 0 end ) as '未质检',sum(case when qualitystatus='1' then 1 else 0 end ) as '不合格',sum(case when qualitystatus='2' then 1 else 0 end ) as '质量差',sum(case when qualitystatus='3' then 1 else 0 end ) as '普通',sum(case when qualitystatus='4' then 1 else 0 end ) as '优秀'";
 			
			$case_sql=",sum(未质检) as '未质检',sum(不合格) as '不合格',sum(质量差) as '质量差',sum(普通) as '普通',sum(优秀) as '优秀',sum(未质检+不合格+质量差+普通+优秀) as '质检总量',case when SUM(+质量差+普通+优秀)=0 then concat(0,'%') else concat(ROUND((SUM(+质量差+普通+优秀)/SUM(未质检+不合格+质量差+普通+优秀))*100,2),'%') end as '合格率',case when SUM(不合格)=0 then concat(0,'%') else concat(ROUND((SUM(不合格)/SUM(未质检+不合格+质量差+普通+优秀))*100,2),'%') end as '不合格率',case when SUM(优秀)=0 then concat(0,'%') else concat(ROUND((SUM(优秀)/SUM(未质检+不合格+质量差+普通+优秀))*100,2),'%') end as '优秀率'";
			
			//统计类型
			switch($data_type){
				//按日期统计
				case "data_1":
				
					$sql="SELECT case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as '日期',未质检,不合格,质量差,普通,优秀,质检总量,不合格率,优秀率 from(select case when addtime is null then 'HeJi' else addtime end as '日期',case when addtime is null then '1' else '0' end as 'sums',addtime ".$case_sql." from(select addtime".$group_sql." from (".$data_sql." )datas group by addtime order by null)datas group by addtime ".$with_rollup." )datas ";
				
				break;
				//按月份统计
				case "data_1_month":
				
					$sql="SELECT case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as '月份',未质检,不合格,质量差,普通,优秀,质检总量,不合格率,优秀率 from(select case when addtime is null then 'HeJi' else addtime end as '月份',case when addtime is null then '1' else '0' end as 'sums',addtime ".$case_sql." from(select addtime".$group_sql." from (".$data_sql." )datas group by addtime order by null)datas group by addtime ".$with_rollup." )datas ";
 				break;
				
				//按工号统计
				case "data_2":
				
					$sql="SELECT case when 工号='HeJi' then '合计' when 工号='XiaoJi' then '小计' when 工号='ZongJi' then '总计' else 工号 end as '工号' ,b.full_name as '姓名' ,未质检,不合格,质量差,普通,优秀,质检总量,不合格率,优秀率 from(select case when user is null then 'HeJi' else user end as '工号',case when user is null then '1' else '0' end as 'sums' ,user".$case_sql." from(select user".$group_sql." from ( ".$data_sql.")datas group by user order by null)datas group by user ".$with_rollup." )datas left join vicidial_users b on datas.user=b.user";
	 
				break;
				//按业务统计
				case "data_3":
					$sql="SELECT case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else b.campaign_name end as '业务',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when campaign_id is null then 'HeJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id".$case_sql." from(select campaign_id".$group_sql." from ( ".$data_sql." )datas group by campaign_id order by null)datas group by campaign_id ".$with_rollup." )datas left join vicidial_campaigns b on datas.campaign_id=b.campaign_id";
	   
				break;
				//按质检人统计
				case "data_4":
					$sql="SELECT case when 质检人='HeJi' then '合计' when 质检人='XiaoJi' then '小计' when 质检人='ZongJi' then '总计' else concat(userid,'[',b.full_name,']') end as '质检人',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when userid is null then 'HeJi' else userid end as '质检人',case when userid is null then '1' else '0' end as 'sums' ,userid".$case_sql." from(select userid".$group_sql." from (".$data_sql.")datas group by userid order by null)datas group by userid ".$with_rollup." )datas left join vicidial_users b on datas.userid=b.user";
	 
				break;
				//按日期工号统计
				case "data_5":
					$sql="SELECT case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as '日期',case when 日期 is not null and datas.user is null and sums='0' then '合计' else datas.user end as '工号',b.full_name as '姓名',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when addtime is null then 'ZongJi' else addtime end as '日期',case when addtime is null then '1' else '0' end as 'sums' ,addtime,user".$case_sql." from(select addtime,user ".$group_sql." from (".$data_sql." )datas group by addtime,user order by null)datas group by addtime,user ".$with_rollup.")datas left join vicidial_users b on datas.user=b.user ";
	 
				break;
				//按月份工号统计
				case "data_5_month":
					$sql="SELECT case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as '月份',case when 月份 is not null and datas.user is null and sums='0' then '合计' else datas.user end as '工号',b.full_name as '姓名',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when addtime is null then 'ZongJi' else addtime end as '月份',case when addtime is null then '1' else '0' end as 'sums' ,addtime,user".$case_sql." from(select addtime,user ".$group_sql." from (".$data_sql." )datas group by addtime,user order by null)datas group by addtime,user ".$with_rollup.")datas left join vicidial_users b on datas.user=b.user ";
	 
				break;
				//按日期业务统计
				case "data_6":
					$sql="SELECT case when 日期='HeJi' then '合计' when 日期='XiaoJi' then '小计' when 日期='ZongJi' then '总计' else 日期 end as '日期',case when 日期 is not null and datas.campaign_id is null and sums='0' then '合计' else b.campaign_name end as '业务',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when addtime is null then 'ZongJi' else addtime end as '日期',case when addtime is null then '1' else '0' end as 'sums' ,addtime,campaign_id ".$case_sql." from(select addtime,campaign_id".$group_sql." from (".$data_sql." )datas group by addtime,campaign_id order by null )datas group by addtime,campaign_id ".$with_rollup." )datas left join vicidial_campaigns b on datas.campaign_id=b.campaign_id";
	 
				break;
				//按月份业务统计
				case "data_6_month":
					$sql="SELECT case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as '月份',case when 月份 is not null and datas.campaign_id is null and sums='0' then '合计' else b.campaign_name end as '业务',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when addtime is null then 'ZongJi' else addtime end as '月份',case when addtime is null then '1' else '0' end as 'sums' ,addtime,campaign_id ".$case_sql." from(select addtime,campaign_id".$group_sql." from (".$data_sql." )datas group by addtime,campaign_id order by null )datas group by addtime,campaign_id ".$with_rollup." )datas left join vicidial_campaigns b on datas.campaign_id=b.campaign_id";
	 
				break;
				//按业务工号统计
				case "data_7":
					$sql="SELECT case when 业务='HeJi' then '合计' when 业务='XiaoJi' then '小计' when 业务='ZongJi' then '总计' else b.campaign_name end as '业务',case when 业务 is not null and datas.user is null and sums='0' then '合计' else datas.user end as '工号',c.full_name,未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when campaign_id is null then 'ZongJi' else campaign_id end as '业务',case when campaign_id is null then '1' else '0' end as 'sums' ,campaign_id,user".$case_sql." from( select campaign_id,user".$group_sql." from (".$data_sql.")datas group by campaign_id,user order by null)datas group by campaign_id,user ".$with_rollup.")datas left join vicidial_campaigns b on datas.campaign_id=b.campaign_id left join vicidial_users c on datas.user=c.user";
	 
				break;
				//按月份质检人统计
				case "data_8_month":
					$sql="SELECT case when 月份='HeJi' then '合计' when 月份='XiaoJi' then '小计' when 月份='ZongJi' then '总计' else 月份 end as '月份',case when 月份 is not null and datas.userid is null and sums='0' then '合计' else concat(datas.userid,'[',b.full_name,']') end as '质检人',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when addtime is null then 'ZongJi' else addtime end as '月份',case when addtime is null then '1' else '0' end as 'sums' ,addtime,userid".$case_sql." from(select addtime,userid".$group_sql." from (".$data_sql.")datas group by addtime,userid order by null)datas group by addtime,userid ".$with_rollup." )datas left join vicidial_users b on datas.userid=b.user";
	  
				break;
				//按质检人工号统计
				case "data_9":
					$sql="SELECT case when 质检人='HeJi' then '合计' when 质检人='XiaoJi' then '小计' when 质检人='ZongJi' then '总计' else concat(datas.userid,'[',b.full_name,']') end as '质检人',case when 质检人 is not null and datas.user is null and sums='0' then '合计' else datas.user end as '工号',c.full_name as '姓名',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when userid is null then 'ZongJi' else userid end as '质检人',case when userid is null then '1' else '0' end as 'sums' ,userid,user".$case_sql." from(select userid,user".$group_sql." from (".$data_sql.")datas group by userid,user order by null)datas group by userid,user ".$with_rollup." )datas left join vicidial_users b on datas.userid=b.user left join vicidial_users c on datas.user=c.user";
						  
				break;
				//按质检人业务统计
				case "data_10":
					$sql="SELECT case when 质检人='HeJi' then '合计' when 质检人='XiaoJi' then '小计' when 质检人='ZongJi' then '总计' else concat(datas.userid,'[',b.full_name,']') end as '质检人',case when 质检人 is not null and datas.campaign_id is null and sums='0' then '合计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']')) end as '业务',未质检,不合格,质量差,普通,优秀,质检总量,合格率,不合格率,优秀率 from(select case when userid is null then 'ZongJi' else userid end as '质检人',case when userid is null then '1' else '0' end as 'sums' ,userid,campaign_id ".$case_sql." from(select userid,campaign_id".$group_sql." from (".$data_sql." )datas group by userid,campaign_id order by null)datas group by userid,campaign_id ".$with_rollup." )datas left join vicidial_users b on datas.userid=b.user left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
	  
				break;
  				
				default :
			
			}
  			
		 //echo $sql.'<br><br>';
		 
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
					$des="获取成功！";
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
				echo json_encode(save_detail_excel($sql,"业务活动统计报表"));	
			}
					 
		 }else{
			
			$json_data="{";
			$json_data.="\"counts\":\"-1\",";
			$json_data.="\"des\":\"数据查询条件有误，请检查后重试...\",";
			$json_data.="}";
			echo $json_data;
		}
		 
	break;	
 	
	//获取昨日、上周六个人工作量统计
	case "get_work_person":
 		$yes_day=date("Y-m-d",strtotime("-1 day"));
		$yes_day_s=$yes_day." 00:00:01";
		$yes_day_e=$yes_day." 23:59:59";
		
		if($drop_opt=="drop_opt_jt"){
			$sql_wrjt=",sum(case when status_name='无人接听' then 1 else 0 end ) as '无人接听',sum(case when status_name='丢弃' then 1 else 0 end ) as '丢弃'";
 			$sql_drop_p="+丢弃";
		}else{
			$sql_wrjt=",sum(case when status_name in('无人接听','丢弃') then 1 else 0 end ) as '无人接听'";
 			$sql_drop_p="";
		}
		
		$sql="select concat(users.full_name,'[',datas.user,']') as gh,成功 as cg,总量 as zl,接通率 as jtl,整体成功率 as ztcgl,不合格 as bhg,sec_to_time(时长) as sc from(select user,sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p.") as '总量',SUM(成功+一般) as '成功' ,SUM(不合格) as '不合格' ,SUM(时长) as '时长' ,case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '呼通成功率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '整体成功率' from( select user,quality_status,sum(case when status_name='成功' then 1 else 0 end ) as '成功',sum(case when status_name='一般' then 1 else 0 end ) as '一般',sum(case when status_name='失败' then 1 else 0 end ) as '失败',sum(case when status_name='其他' then 1 else 0 end ) as '其他',sum(case when status_name='关机' then 1 else 0 end ) as '关机',sum(case when status_name='停机' then 1 else 0 end ) as '停机',sum(case when status_name='预约' then 1 else 0 end ) as '预约',sum(case when status_name='非本店' then 1 else 0 end ) as '非本店'".$sql_wrjt.",sum(case when status_name='空号传真' then 1 else 0 end ) as '空号传真',sum(case when quality_status='1' then 1 else 0 end ) as '不合格',sum(length_in_sec) as '时长' from (select a.user,a.quality_status,a.status,b.status_name,c.length_in_sec from vicidial_log a left join data_sys_status b on a.status=b.status and b.status_type='call_status' left join recording_log c on a.uniqueid=c.vicidial_id and a.lead_id=c.lead_id where a.user!='VDAD' and a.call_date BETWEEN '".$yes_day_s."' and '".$yes_day_e."') datas group by user,quality_status  order by null) datas group by user  order by null)datas left join vicidial_users users on datas.user=users.user order by 成功+0 desc,left(整体成功率,length(整体成功率)-1)+0 desc";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
		$i=0;
		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 	$i=$i+1;
				$list=array("xh"=>$i,"gh"=>$rs['gh'],"cg"=>$rs['cg'],"zl"=>$rs['zl'],"jtl"=>$rs['jtl'],"ztcgl"=>$rs['ztcgl'],"bhg"=>$rs['bhg'],"sc"=>$rs['sc']);
				 
				array_push($list_arr,$list);
			}
			$counts="1";
			$des="获取成功！";
		}else {
			$counts="0";
			$des="未找到符合条件的数据！";
			$list_arr=array('id'=>'none');
		}
  		mysqli_free_result($rows);
		//echo $sql."<br>";
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	//获取昨日、上周六业务统计
	case "get_work_cam":
		$yes_day=date("Y-m-d",strtotime("-1 day"));
		$yes_day_s=$yes_day." 00:00:01";
		$yes_day_e=$yes_day." 23:59:59";
		
 		if($drop_opt=="drop_opt_jt"){
			$sql_wrjt=",sum(case when status_name='无人接听' then 1 else 0 end ) as '无人接听',sum(case when status_name='丢弃' then 1 else 0 end ) as '丢弃'";
 			$sql_drop_p="+丢弃";
		}else{
			$sql_wrjt=",sum(case when status_name in('无人接听','丢弃') then 1 else 0 end ) as '无人接听'";
 			$sql_drop_p="";
		}
		
		$sql="select case when yw='HeJi' then '合计' when yw='XiaoJi' then '小计' when yw='ZongJi' then '总计' else ifnull(cam.campaign_name,concat('未知业务 [',datas.campaign_id,']'))end as 'yw',坐席数 as zxs,成功 as cg,总量 as zl,接通率 as jtl,整体成功率 as ztcgl,未质检 as wzj,不合格率 as bhgl from(select case when campaign_id is null then 'HeJi' else campaign_id end as 'yw',case when campaign_id is null then '1' else '0' end as 'sums' ,sum(case when user is not null and user!='VDAD' then 1 else 0 end ) as '坐席数',campaign_id,SUM(成功+一般) as '成功' ,SUM(未质检) as '未质检' ,sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p.") as '总量',case when sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")=0 then concat(0,'%') else concat(ROUND((sum(成功+一般+失败+预约+非本店+二次回访".$sql_drop_p.")/sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '接通率',case when SUM(成功+一般)=0 then concat(0,'%') else concat(ROUND((SUM(成功+一般)/sum(成功+一般+失败+其他+关机+停机+无人接听+空号传真+预约+非本店+二次回访".$sql_drop_p."))*100,2),'%') end as '整体成功率',case when SUM(不合格)=0 then concat(0,'%') else concat(ROUND((SUM(不合格)/SUM(未质检+不合格+质量差+普通+优秀))*100,2),'%') end as '不合格率' from( select campaign_id,user,sum(case when status_name='成功' then 1 else 0 end ) as '成功',sum(case when status_name='一般' then 1 else 0 end ) as '一般',sum(case when status_name='失败' then 1 else 0 end ) as '失败',sum(case when status_name='其他' then 1 else 0 end ) as '其他',sum(case when status_name='关机' then 1 else 0 end ) as '关机',sum(case when status_name='停机' then 1 else 0 end ) as '停机',sum(case when status_name='预约' then 1 else 0 end ) as '预约',sum(case when status_name='非本店' then 1 else 0 end ) as '非本店'".$sql_wrjt.",sum(case when status_name='空号传真' then 1 else 0 end ) as '空号传真',sum(case when quality_status='0' and status_name in('成功','一般') then 1 else 0 end ) as '未质检',sum(case when quality_status='1' then 1 else 0 end ) as '不合格',sum(case when quality_status='2' then 1 else 0 end ) as '质量差',sum(case when quality_status='3' then 1 else 0 end ) as '普通',sum(case when quality_status='4' then 1 else 0 end ) as '优秀' from (select a.campaign_id,a.user,a.quality_status,b.status_name from vicidial_log a left join data_sys_status b on a.status=b.status and b.status_type='call_status' where a.call_date BETWEEN '".$yes_day_s."' and '".$yes_day_e."' and a.campaign_id!='') datas group by campaign_id,user  order by null) datas group by campaign_id ".$with_rollup."  order by null)datas left join vicidial_campaigns cam on datas.campaign_id=cam.campaign_id";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				$list=array("yw"=>$rs['yw'],"zxs"=>$rs['zxs'],"cg"=>$rs['cg'],"zl"=>$rs['zl'],"jtl"=>$rs['jtl'],"ztcgl"=>$rs['ztcgl'],"wzj"=>$rs['wzj'],"bhgl"=>$rs['bhgl']);
				 
				array_push($list_arr,$list);
			}
			$counts="1";
			$des="获取成功！";
		}else {
			$counts="0";
			$des="未找到符合条件的数据！";
			$list_arr=array('id'=>'none');
		}
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	//获取昨日、上周六质检统计
	case "get_work_qua":
 		$yes_day=date("Y-m-d",strtotime("-1 day"));
		$yes_day_s=$yes_day." 00:00:01";
		$yes_day_e=$yes_day." 23:59:59";
		
		$sql="SELECT case when zjr='HeJi' then '合计' when zjr='XiaoJi' then '小计' when zjr='ZongJi' then '总计' else concat(userid,'[',b.full_name,']') end as zjr,不合格 as bhg,质量差 as zlc,普通 as pt,优秀 as yx,质检总量 as zjzl from(select case when userid is null then 'HeJi' else userid end as 'zjr',case when userid is null then '1' else '0' end as 'sums' ,userid ,sum(不合格) as '不合格',sum(质量差) as '质量差',sum(普通) as '普通',sum(优秀) as '优秀',sum(未质检+不合格+质量差+普通+优秀) as '质检总量'from(select userid,sum(case when qualitystatus='0' then 1 else 0 end ) as '未质检',sum(case when qualitystatus='1' then 1 else 0 end ) as '不合格',sum(case when qualitystatus='2' then 1 else 0 end ) as '质量差',sum(case when qualitystatus='3' then 1 else 0 end ) as '普通',sum(case when qualitystatus='4' then 1 else 0 end ) as '优秀' from (select qualitystatus,userid from data_quality_log where addtime BETWEEN '".$yes_day_s."' and '".$yes_day_e."')datas group by userid  order by null )datas group by userid ".$with_rollup."  order by null)datas left join vicidial_users b on datas.userid=b.user";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				$list=array("zjr"=>$rs['zjr'],"bhg"=>$rs['bhg'],"zlc"=>$rs['zlc'],"pt"=>$rs['pt'],"yx"=>$rs['yx'],"zjzl"=>$rs['zjzl']);
				 
				array_push($list_arr,$list);
			}
			$counts="1";
			$des="获取成功！";
		}else {
			$counts="0";
			$des="未找到符合条件的数据！";
			$list_arr=array('id'=>'none');
		}
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	case "set_drop_opt":
 		 
		if($do_actions=="up"){
			$sql="update data_sys_status set status='drop_opt_".$drop_opt."' where status_type='drop_opt'";
			if(mysqli_query($db_conn,$sql)){
				$counts="1";
				$des=":) 设置默认项成功！";
				$drop_opt="drop_opt_".$drop_opt;
			}else{
				$counts="1";
				$des=":( 设置默认项失败！请检查重试！";
			}
			
		}else{
			$sql="SELECT status from data_sys_status where status_type='drop_opt' limit 0,1";
			 
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
  			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
					$drop_opt=$rs['status'];
				}
				$counts="1";
				$des="";
			}else{
				$drop_opt="drop_opt_wrjt";
				$counts="0";
				$des="";
				$list_arr=array('id'=>'none');
			}
			mysqli_free_result($rows);
		}
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"drop_opt\":".json_encode($drop_opt)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	
	//服务器负载
	case "system_load":
 		
		$os = strtolower(PHP_OS);
		if(strpos($os, "win") === false){
			if(file_exists("/proc/loadavg")) {
				$load = file_get_contents("/proc/loadavg");
				$load = explode(' ', $load);
				
				$load_1=$load[0];
				$load_5=$load[1];
				$load_15=$load[2];				
				
			}elseif(function_exists("shell_exec")){
				$load = explode(' ', `uptime`);
				//return $load[count($load)-3] . ' ' . $load[count($load)-2] . ' ' . $load[count($load)-1];
				
				$load_1=$load[count($load)-3];
				$load_5=$load[count($load)-2];
				$load_15=$load[count($load)-1];
				
			}else{
				return false;
			}
		}
		
		$json_data="{";
 		$json_data.="\"counts\":\"1\",";
 		$json_data.="\"load_1\":\"".$load_1."\",";
 		$json_data.="\"load_5\":\"".$load_5."\",";
 		$json_data.="\"load_15\":\"".$load_15."\"";

  		$json_data.="}";
		
		echo $json_data;
 	
 	default :
  
}

unset($list_arr);
unset($lists_arr); 
unset($json_data);
unset($sql); 
mysqli_close($db_conn);
 
?>