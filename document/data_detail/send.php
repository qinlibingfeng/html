<?php
require("../../inc/pub_func.php");
require("../../inc/pub_set.php");

if(!$_SESSION["username"]){
 
	$json_data="{";
	$json_data.="\"counts\":\"-1\",";
	$json_data.="\"des\":\"您已登录超时或未登录,请登录后重试...\"";
	$json_data.="}";
	echo $json_data;
 	die();
}
$is_exit=0;
 
switch($action){
       
    //呼叫详单查询
	case "get_vicidial_list": 
		
		$skip_day=(strtotime($s_date)-strtotime($e_date))/86400;
		
			
		if($skip_day>$skip_days||$skip_day<-$skip_days){
		 
			$field_name_list=array("查询时间跨度超过$skip_days天");
			$list_arr=array('id'=>'none');
			$des="本功能只可查询时间跨度为 ".$skip_days." 天内数据!";
 			$is_exit=1;
		}
		
		$time_len_type=trim($_REQUEST["time_len_type"]);
		$call_date_type=trim($_REQUEST["call_date_type"]);
		 
		
		$sql1=" a.call_date between '".$start_date."' and '".$end_date."'";
		
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
		
		if($phone_login<>""){
			$phone_login=str_replace(",","','",$phone_login);
			$phone_login="'".$phone_login."'";
			$sql3=" and b.phone_login in(".$phone_login.") ";
		}
		
		$phone_count=0;
 		
		if($phone_number<>""){
			//echo $phone_number;
			$phone_number=eregi_replace("[^0-9\n]","",$phone_number);
			$phone_number_ary=array_unique(explode("\n",$phone_number));
			 
			$phone_count=count($phone_number_ary); 
		}
		
		//echo $phone_number; 
		if($call_date_type=="no_call_date"){
			
			if($phone_count>0){ 
			 	$i=0;
 				foreach($phone_number_ary as $phone){ 
					if($phone<>"" && preg_match("/^\d*$/",$phone) && $i<501){
						$phone=trim(eregi_replace("[^0-9]","",$phone));
						$sql_phone.="'".$phone."',";
						$i++;
					} 
				}
				
				if($sql_phone!=""){
					$sql_phone=substr($sql_phone, 0, -1);
				}else{
					$is_exit=1;
					$des="请输入有效的电话号码重试!";
				}
 				
			}else{
				$is_exit=1;
				$des="请输入有效的电话号码重试!";
			}
			
			$sql1=" a.phone_number in(".$sql_phone.")";
			
 		}else{
 			
			if($phone_count>0){
				
   				 if($search_accuracy=="in"){
					 
					$i=0;
					foreach($phone_number_ary as $phone){ 
						if($phone<>"" && preg_match("/^\d*$/",$phone) && $i<1001){
							$phone=trim(eregi_replace("[^0-9]","",$phone));
							$sql_phone.="'".$phone."',";
							$i++;
						} 
					}
					
					if($sql_phone!=""){
						$sql_phone=substr($sql_phone,0,-1);
						$exist_sql="in(".$sql_phone.")";
					} 
  					
				}else{
					$phone_number=$phone_number_ary[0];
					if ($search_accuracy=="="){
						$exist_sql=" = '".$phone_number."'";
					}elseif($search_accuracy=="like_top"){
						$exist_sql="like '".$phone_number."%'";
					}elseif($search_accuracy=="like_end"){
						$exist_sql="like '%".$phone_number."'";
					}elseif($search_accuracy=="like"){
						$exist_sql="like '%".$phone_number."%'";
					}
				}
				if($exist_sql){
 					$sql4=" and a.phone_number ".$exist_sql;
				}
			}
			
		}
   		
		if($comments<>""){
 			$sql5=" and a.comments='".$comments."'";
 		}
		
		if($time_zone<>""&&$time_len<>""){
			$sql6=" and a.".$time_len_type." ".$time_zone.$time_len. "";
		}
		
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql7=" and a.campaign_id in(".$campaign_id.") ";
			}else{
				$sql7=" and a.campaign_id ='".$campaign_id."' ";
			}
		}else{
			
			if($_SESSION["allow_campaigns"]=="none"){
				$sql7=" ";
				
			}elseif($_SESSION["session_campaigns_list"]!=""){
				
				if(strpos($_SESSION["session_campaigns_list"],",")>-1){
					 
					$sql7=" and a.campaign_id in(".$_SESSION["session_campaigns_list"].")";
				}else{
					$sql7=" and a.campaign_id =".$_SESSION["session_campaigns_list"];
				}	
			}
				
		}
  		
		if($call_des<>""){
 			$sql8=" and a.call_des like '%".$call_des."%'";
		}
		
		if($full_name<>""){
 			$sql9=" and c.first_name like '".$full_name."%'";
		}
		
 		if($quality_status<>""){
			if(strpos($quality_status,",")>-1){
				$quality_status=str_replace(",","','",$quality_status);
				$quality_status="'".$quality_status."'";
				$sql10=" and a.quality_status in(".$quality_status.") ";
			}else{
				$sql10=" and a.quality_status ='".$quality_status."' ";
			}
		}
		
		if($status<>""){
			if(strpos($status,",")>-1){
				$status=str_replace(",","','",$status);
				$status="'".$status."'";
				$sql11=" and a.status in(".$status.") ";
			}else{
				$sql11=" and a.status ='".$status."' ";
 			}
		}
		
		if($phone_lists<>""){
			if(strpos($phone_lists,",")>-1){
				$phone_lists=str_replace(",","','",$phone_lists);
				$phone_lists="'".$phone_lists."'";
				$sql12=" and a.list_id in(".$phone_lists.") ";
			}else{
				$sql12=" and a.list_id = '".$phone_lists."' ";
			}
		}
 		
		if($city<>""){
 			$sql13=" and c.city like '%".$city."%'";
		}
  		
		if($is_exit==1){
			
			$json_data="{";
			$json_data.="\"counts\":".json_encode(0).",";
			$json_data.="\"des\":".json_encode($des).",";
 			$json_data.="\"datalist\":".json_encode($list_arr)."";
			$json_data.="}";
			
			echo $json_data;
			
			die();				
		}
		
 		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sql13;
		
		//获取记录集个数
		if($do_actions=="count"){
			// left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id
			$sql="select count(*) from vicidial_log".$archive." a left join vicidial_users b on a.user=b.user left join vicidial_list".$archive." c on a.lead_id=c.lead_id left join recording_log".$archive." d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id where ".$wheres."  ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";} 

			$des="";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			//left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id 
 			$sql="select a.uniqueid,a.lead_id,a.list_id,a.campaign_id,a.call_date,a.phone_number,a.user,case when a.comments='auto' then '自动' else '手动' end as comments,b.full_name,b.phone_login,concat(c.province,'-',c.city) as citys,a.call_des,".$record_location." as locations,IFNULL(a.length_in_sec,0) as length_in_sec,IFNULL(a.talk_length_sec,0) as talk_length_sec,e.status_name,case when e.selectable='y' then 'yes' else 'no' end as is_qua,g.status_name as qualityname,h.campaign_name from vicidial_log".$archive." a left join vicidial_users b on a.user=b.user left join vicidial_list".$archive." c on a.lead_id=c.lead_id left join recording_log".$archive." d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id where ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("uniqueid"=>$rs['uniqueid'],"lead_id"=>$rs['lead_id'],"list_id"=>$rs['list_id'],"campaign_id"=>$rs['campaign_id'],"call_date"=>$rs['call_date'],"phone_number"=>$rs['phone_number'],"user"=>$rs['user'],"comments"=>$rs['comments'],"full_name"=>$rs['full_name'],"phone_login"=>$rs['phone_login'],"citys"=>$rs['citys'],"call_des"=>$rs['call_des'],"locations"=>$rs['locations'],"status_name"=>$rs['status_name'],"is_qua"=>$rs['is_qua'],"qualityname"=>$rs['qualityname'],"campaign_name"=>$rs['campaign_name'],"length_in_sec"=>$rs['length_in_sec'],"talk_length_sec"=>$rs['talk_length_sec']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="succ！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
  			
		}else if($do_actions=="excel"){
			 
			$field_list=str_replace("·","'",trim($_REQUEST["field_list"]));
			
		 
			if($field_list<>""){
				
				$field_sql="".$field_list;
				
				if(strpos($field_list,"i.dtmf_key")>-1){ 
					$g_left_sql=" left join (select dtmf_key,uniqueid from (select GROUP_CONCAT(dtmf_key) as dtmf_key,uniqueid from data_dtmf_log where dtmf_time between '".$start_date."' and '".$end_date."' group by uniqueid) tmp_dtmf ) i on a.uniqueid=i.uniqueid ";
				}
				
				$sql="select ".$field_sql." from vicidial_log".$archive." a left join vicidial_users b on a.user=b.user left join vicidial_list".$archive." c on a.lead_id=c.lead_id left join recording_log".$archive." d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id left join data_custom_list j on a.lead_id=j.lead_id ".$g_left_sql." where ".$wheres." ".$sort_sql." ";
				
			}else{
				
				$sql="select a.phone_number as '电话号码',a.user as '工号',b.full_name as '工号姓名',a.call_date as '呼叫时间',IFNULL(a.length_in_sec,0) as '呼叫时长',IFNULL(a.talk_length_sec,0) as '通话时长',h.campaign_name as '业务活动',e.status_name as '呼叫结果',a.call_des as '呼叫描述',g.status_name as '质检结果',f.qualitydes as '质检描述',replace(d.location,'".$record_ip."','".$record_web."') as '录音地址' from vicidial_log".$archive." a left join vicidial_users b on a.user=b.user left join vicidial_list".$archive." c on a.lead_id=c.lead_id left join recording_log".$archive." d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id where ".$wheres." ".$sort_sql." ";

			}
			 
   			//echo $sql;
 			echo json_encode(save_detail_excel($sql,"数据查询详单",$file_type));
			 
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
	
 
    //质检详单查询
	case "get_quality_list":
		
		$skip_day=(strtotime($s_date)-strtotime($e_date))/86400;
			
		if($skip_day>$skip_days||$skip_day<-$skip_days){
		 
			$field_name_list=array("查询时间跨度超过$skip_days天");
			$list_arr=array('id'=>'none');
			$des="本功能只可查询时间跨度为 ".$skip_days." 天内数据!";
 			$is_exit=1;
		}
		
		$sql1=" a.addtime between '".$start_date."' and '".$end_date."'";
		
		if($agent_list<>""){
			if(strpos($agent_list,",")>-1){
 				$agent_list=str_replace(",","','",$agent_list);
				$agent_list="'".$agent_list."'";
				$sql2=" and c.user in(".$agent_list.")";
			}else{
				$sql2=" and c.user ='".$agent_list."'";
			}
		}else{
			
			if($_SESSION["allow_users"]=="none"){
				$sql2=" ";
				
			}elseif($_SESSION["allow_users"]=="self"){
				
				$sql2="  and c.user ='".$_SESSION["username"]."' ";
				
			}elseif($_SESSION["session_users_list"]!=""){
				
				if(strpos($_SESSION["session_users_list"],",")>-1){
					 
					$sql2=" and c.user in(".$_SESSION["session_users_list"].")";
				}else{
					$sql2=" and c.user =".$_SESSION["session_users_list"];
				}	
			}
				
		}
 		
		if($phone_number<>""){
   				
			if ($search_accuracy=="="){
				$exist_sql=" = '".$phone_number."'";
			}elseif($search_accuracy=="in"){
				$phone_number=str_replace(",","','",$phone_number);
				$exist_sql="in('".$phone_number."')";
			}elseif($search_accuracy=="not in"){
				$phone_number=str_replace(",","','",$phone_number);
				$exist_sql="not in('".$phone_number."')";
			}elseif($search_accuracy=="like_top"){
				$exist_sql="like '".$phone_number."%'";
			}elseif($search_accuracy=="like_end"){
				$exist_sql="like '%".$phone_number."'";
			}elseif($search_accuracy=="like"){
				$exist_sql="like '%".$phone_number."%'";
			}
 			$sql4=" and c.phone_number ".$exist_sql;
		}
  		
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
				$sql7=" and a.campaign_id in(".$campaign_id.") ";
			}else{
				$sql7=" and a.campaign_id ='".$campaign_id."' ";
			}
		}else{
			
			if($_SESSION["allow_campaigns"]=="none"){
				$sql7=" ";
				
			}elseif($_SESSION["session_campaigns_list"]!=""){
				
				if(strpos($_SESSION["session_campaigns_list"],",")>-1){
					 
					$sql7=" and a.campaign_id in(".$_SESSION["session_campaigns_list"].")";
				}else{
					$sql7=" and a.campaign_id =".$_SESSION["session_campaigns_list"];
				}	
			}
				
		}
  		
		if($qualitydes<>""){
 			$sql8=" and a.qualitydes like '%".$qualitydes."%'";
		}
  		
 		if($quality_status<>""){
			if(strpos($quality_status,",")>-1){
				$quality_status=str_replace(",","','",$quality_status);
				$quality_status="'".$quality_status."'";
				$sql10=" and a.qualitystatus in(".$quality_status.") ";
			}else{
				$sql10=" and a.qualitystatus ='".$quality_status."' ";
			}
		}
		
		if($status<>""){
			if(strpos($status,",")>-1){
				$status=str_replace(",","','",$status);
				$status="'".$status."'";
				$sql11=" and c.status in(".$status.") ";
			}else{
				$sql11=" and c.status ='".$status."' ";
 			}
		}
		//质检人员
		if($quality_user<>""){
			if(strpos($quality_user,",")>-1){
				$quality_user=str_replace(",","','",$quality_user);
				$quality_user="'".$quality_user."'";
				$sql12=" and a.userid in(".$quality_user.") ";
			}else{
				$sql12=" and a.userid = '".$quality_user."' ";
			}
		}
  		
		if($call_des<>""){
 			$sql13=" and c.call_des like '%".$call_des."%'";
		}
		
		if($is_exit==1){
			
			$json_data="{";
			$json_data.="\"counts\":".json_encode(0).",";
			$json_data.="\"des\":".json_encode($des).",";
 			$json_data.="\"datalist\":".json_encode($list_arr)."";
			$json_data.="}";
			
			echo $json_data;
			
			die();
				
		}
		
		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sql13;
		
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from data_quality_log a left join data_sys_status b on a.qualitystatus=b.status and b.status_type='qua_status' left join vicidial_log".$archive." c on replace(a.vicidial_id,'_b','')=c.uniqueid and a.lead_id=c.lead_id left join vicidial_campaigns g on a.campaign_id=g.campaign_id left join vicidial_users e on a.userid=e.user left join vicidial_users f on c.user=f.user left join recording_log".$archive." d on replace(a.vicidial_id,'_b','')=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status h on c.status=h.status and h.status_type='call_status' left join data_sys_status i on a.status=i.status and i.status_type='call_status' where ".$wheres."  ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";} 

			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
 			$sql="select c.call_des,a.qualitydes,a.addtime,a.userid,e.full_name as qua_name,b.status_name as qualityname,c.phone_number,c.call_date,c.user,f.full_name as call_name,ifnull(g.campaign_name,a.campaign_id) as campaign_name,h.status_name,i.status_name as old_status,".$record_location." as locations from data_quality_log a left join data_sys_status b on a.qualitystatus=b.status and b.status_type='qua_status' left join vicidial_log".$archive." c on replace(a.vicidial_id,'_b','')=c.uniqueid and a.lead_id=c.lead_id left join vicidial_campaigns g on a.campaign_id=g.campaign_id left join vicidial_users e on a.userid=e.user left join vicidial_users f on c.user=f.user left join recording_log".$archive." d on replace(a.vicidial_id,'_b','')=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status h on c.status=h.status and h.status_type='call_status' left join data_sys_status i on a.status=i.status and i.status_type='call_status' where  ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){
					$old_status=$rs['old_status'];
				 	if(!$old_status){$old_status=" ";}
					$list=array("qualitydes"=>$rs['qualitydes'],"call_des"=>$rs['call_des'],"addtime"=>$rs['addtime'],"userid"=>$rs['userid'],"qua_name"=>$rs['qua_name'],"qualityname"=>$rs['qualityname'],"phone_number"=>$rs['phone_number'],"call_date"=>$rs['call_date'],"user"=>$rs['user'],"call_name"=>$rs['call_name'],"campaign_name"=>$rs['campaign_name'],"status_name"=>$rs['status_name'],"old_status"=>$old_status,"locations"=>$rs['locations']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="succ！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
  			
		}else if($do_actions=="excel"){
   				
			$sql="select c.phone_number as '电话号码',c.call_date as '呼叫时间',concat(c.user,' [',f.full_name,']') as '工号',ifnull(g.campaign_name,a.campaign_id) as '业务活动',h.status_name as '呼叫结果',i.status_name as '原呼叫结果',concat(a.userid,' [',e.full_name,']') as '质检人',b.status_name as '质检结果',a.addtime as '质检时间',c.call_des as '呼叫描述',a.qualitydes as '质检描述',".$record_location." as '录音地址' from data_quality_log a left join data_sys_status b on a.qualitystatus=b.status and b.status_type='qua_status' left join vicidial_log".$archive." c on replace(a.vicidial_id,'_b','')=c.uniqueid and a.lead_id=c.lead_id left join vicidial_campaigns g on a.campaign_id=g.campaign_id left join vicidial_users e on a.userid=e.user left join vicidial_users f on c.user=f.user left join recording_log".$archive." d on replace(a.vicidial_id,'_b','')=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status h on c.status=h.status and h.status_type='call_status' left join data_sys_status i on a.status=i.status and i.status_type='call_status' where ".$wheres." ".$sort_sql." ";
     			//echo $sql."<br><br>";
			echo json_encode(save_detail_excel($sql,"质检详单",$file_type));
			//echo $aa[0];
  		}
		
  		if($do_actions<>"excel"){
 			mysqli_free_result($rows);
		
 			$json_data="{";
			$json_data.="\"counts\":".json_encode($counts).",";
			$json_data.="\"des\":".json_encode($sql).",";
		 
			$json_data.="\"datalist\":".json_encode($list_arr)."";
			$json_data.="}";
			
			echo $json_data;
 		}
 		
	break;
	
	 //质检详单查询
	case "get_qua_his_list":
		
 		$sql1=" a.vicidial_id like '".$uniqueid."%'";
 		$wheres=$sql1;
		
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from data_quality_log a left join data_sys_status b on a.qualitystatus=b.status and b.status_type='qua_status' left join vicidial_log".$archive." c on replace(a.vicidial_id,'_b','')=c.uniqueid and a.lead_id=c.lead_id  left join vicidial_users e on a.userid=e.user left join data_sys_status h on c.status=h.status and h.status_type='call_status' left join data_sys_status i on a.status=i.status and i.status_type='call_status' where ".$wheres."  ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";} 

			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
 			$sql="select c.call_des,a.qualitydes,a.addtime,a.userid,e.full_name as qua_name,b.status_name as qualityname,c.call_date,c.user,h.status_name,i.status_name as old_status from data_quality_log a left join data_sys_status b on a.qualitystatus=b.status and b.status_type='qua_status' left join vicidial_log".$archive." c on replace(a.vicidial_id,'_b','')=c.uniqueid and a.lead_id=c.lead_id  left join vicidial_users e on a.userid=e.user left join data_sys_status h on c.status=h.status and h.status_type='call_status' left join data_sys_status i on a.status=i.status and i.status_type='call_status' where  ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){
					$old_status=$rs['old_status'];
				 	if(!$old_status){$old_status=" ";}
					$list=array("call_des"=>$rs['call_des'],"qualitydes"=>$rs['qualitydes'],"addtime"=>$rs['addtime'],"userid"=>$rs['userid'],"qua_name"=>$rs['qua_name'],"qualityname"=>$rs['qualityname'],"call_date"=>$rs['call_date'],"user"=>$rs['user'],"status_name"=>$rs['status_name'],"old_status"=>$old_status);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="succ！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
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
	
	//录音质检
	case "callqulity_set":
 
		$custom_field=trim($_REQUEST["custom_field"]);
		 
		$call_date=trim($_REQUEST["call_date"]);
		$old_call_date=trim($_REQUEST["old_call_date"]);
		$recording_id=trim($_REQUEST["recording_id"]);
		$qua_id=trim($_REQUEST["qua_id"]); 
		$is_change=trim($_REQUEST["is_change"]);
		//echo $custom_field."<br>";
		if($custom_field!=""&&$is_change="Y"){
			 
			$custom_field=explode("|+|",$custom_field);
			$f_id_sql="";
			$f_v_sql=""; 
			$l_v_sql="";
			foreach($custom_field as $form_value){
				$value_list=explode("|!|",$form_value);
											 
				$v_id=$value_list[0];
				$v_val=$value_list[1]; 
				if(substr($v_id,0,6)=="custom"){ 
					$f_v_list.=",'".mysqli_real_escape_string($db_conn,$v_val)."'";
					$f_id_list.=",".mysqli_real_escape_string($db_conn,$v_id)."";
				}else{
					$l_v_list.=",".mysqli_real_escape_string($db_conn,$v_id)."='".mysqli_real_escape_string($db_conn,$v_val)."'";
					 	
				}
			}
			
			if($f_id_list!=""){
				$c_in_sql="replace into data_custom_list(lead_id,list_id ".$f_id_list.") values ('".$lead_id."','".$list_id."' ".$f_v_list.")";
				//echo $c_in_sql;
				mysqli_query($db_conn,$c_in_sql);
			} 
			
		}
 
		if($uniqueid<>""){
			
			if($quality_status<>""){
 				
			/*$sql="select uniqueid from vicidial_log where uniqueid='".$uniqueid."' limit 0,1";
			
 			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);
  			
 			if ($row_counts_list!=0) {*/
				if(!$change_status){$change_status="Y";}
				if($quality_status=="1"&&strtolower($status)=="cg"&&$change_status=="Y"){
					$status="SB";
 				}
				$now_time=date("Y-m-d H:i:s");
				$status=strtoupper($status);
				
				/*if($call_date!=$old_call_date){
					$up_call_date_sql=",call_date='".$call_date."'";
					
					$up_recording_sql="update recording_log set start_time='".$call_date."' where recording_id=".$recording_id."";
					mysqli_query($db_conn,$up_recording_sql);
				}*/
				
				$today=date("Y-m-d");
				$time_dif=strtotime($now_time)-strtotime($old_call_date);
				
				
				//变更vicidial_log status
				
				
				$upsql1="update vicidial_log".$archive." set status='".$status."',quality_status='".$quality_status."',call_des='".mysqli_real_escape_string($db_conn,$call_des)."' ".$up_call_date_sql."  where uniqueid='".$uniqueid."'";
				mysqli_query($db_conn,$upsql1);
				//echo $upsql1;
 				
				$sql="select lead_id from vicidial_list".$archive." where lead_id='".$lead_id."' limit 1";
 				$rows=mysqli_query($db_conn,$sql);
				$row_counts_list=mysqli_num_rows($rows);
				
				if ($row_counts_list!=0) {
					
					//变更vicidial_list status
								
					$upsql2="update vicidial_list".$archive." set status='".$status."' ".$l_v_list." where lead_id=".$lead_id."";
					mysqli_query($db_conn,$upsql2);
					//echo $upsql2;
				}else{
					$in_list_sql="insert into vicidial_list".$archive." set lead_id='".$lead_id."',user='".$user."',called_count='1',list_id='".$list_id."',status='".$status."',called_since_last_reset='Y',phone_number='".$phone_number."',last_local_call_time='".$old_call_date."' ".$l_v_list."";
					//echo $in_list_sql;
					mysqli_query($db_conn,$in_list_sql);	
				}
				mysqli_free_result($rows);
				
				//变更vicidial_agent_log status
				$upsql3="update vicidial_agent_log".$archive." set status='".$status."'  where vicidial_id='".$uniqueid."'";
				mysqli_query($db_conn,$upsql3);
 				
				$u_vicidial_id=$uniqueid."_b";
				
				$upsql="update data_quality_log set vicidial_id='$u_vicidial_id' where vicidial_id='".$uniqueid."'";
				mysqli_query($db_conn,$upsql); 
				 
				$insql="insert into data_quality_log (qualitystatus,vicidial_id,lead_id,list_id,campaign_id,userid,qualitydes,status) select '".$quality_status."',vicidial_id,'".$lead_id."','".$list_id."','".$campaign_id."','".$_SESSION['username']."','".$qualitydes."','".$old_status."' from (select'".$uniqueid."' as vicidial_id ) tmp where not exists(select vicidial_id from data_quality_log where data_quality_log.vicidial_id=tmp.vicidial_id)";
				mysqli_query($db_conn,$insql);  
				//echo $time_dif;
				if($time_dif>5400){
  					
					$event_time=substr($old_call_date,0,-6);
					
					$del_agent_log="delete from data_report_agent_log_list where event_time='".$event_time."' and user='".$user."'";
					mysqli_query($db_conn,$del_agent_log);
					
					//echo  $del_agent_log."<br>";
					
					$in_agent_log="
					insert into data_report_agent_log_list(event_time,campaign_id,user,status,sub_status,pause_sec,max_pause_sec,wait_sec,max_wait_sec,talk_sec,max_talk_sec,dispo_sec,max_dispo_sec,dead_sec,max_dead_sec,talk_length_sec,max_talk_length_sec,counts,list_id) 
					select  left(a.event_time,13),a.campaign_id,a.user,ifnull(a.status,''),a.sub_status,ifnull(sum(a.pause_sec),0),ifnull(max(a.pause_sec),0),ifnull(sum(a.wait_sec),0),ifnull(max(a.wait_sec),0),ifnull(sum(a.talk_sec),0),ifnull(max(a.talk_sec),0),ifnull(sum(a.dispo_sec),0),ifnull(max(a.dispo_sec),0),ifnull(sum(a.dead_sec),0),ifnull(max(a.dead_sec),0),ifnull(sum(b.talk_length_sec),0),ifnull(max(b.talk_length_sec),0),count(*),b.list_id from vicidial_agent_log".$archive." a left join vicidial_log".$archive." b on a.vicidial_id=b.uniqueid and a.lead_id=b.lead_id where a.event_time BETWEEN '".$event_time.":00:00' and '".$event_time.":59:59' and a.user='".$user."' group by left(event_time,13),a.campaign_id,b.list_id,a.user,a.status,a.sub_status; ";
					mysqli_query($db_conn,$in_agent_log); 
					//echo  $in_agent_log."<br>";
					   
					/**ssssssssssssss**/ 
					
					$del_agent_log="delete from data_report_call_log_list where call_date='".$event_time."' and user='".$user."'";
					mysqli_query($db_conn,$del_agent_log);
					
					//echo  $del_agent_log."<br>";
					 
					$in_call_log="					
					insert into data_report_call_log_list(call_date,campaign_id,list_id,user,status,quality_status,counts,talk_length_sec,length_in_sec,max_talk_length_sec,max_length_in_sec )
					select left(call_date,13),campaign_id,list_id,user,status,quality_status,count(*),sum(talk_length_sec),sum(length_in_sec),ifnull(max(talk_length_sec),0),ifnull(max(length_in_sec),0) from vicidial_log".$archive." where call_date between '".$event_time.":00:00' and '".$event_time.":59:59' and user='".$user."' group by left(call_date,13),campaign_id,list_id,user,status,quality_status ";
					
					mysqli_query($db_conn,$in_call_log); 
					
					
					if(!$is_fee_log||$is_fee_log=="Y"){
					
						$del_fee_log="delete from data_report_fee_log_list where call_date='".$event_time."' and user='".$user."'";
						mysqli_query($db_conn,$del_fee_log);  
						
						//$days_dif=round($time_dif/86400);
						//$days_dif>0?$fee_data_table="vicidial_carrier_log_archive":$fee_data_table="vicidial_carrier_log";
						
						$in_fee_log="insert into data_report_fee_log_list(call_date,campaign_id,list_id,user,status,counts,fee_length_sec,fee,max_fee_length_sec,max_fee) select left(call_date,13),campaign_id,list_id,user,status,count(*),sum(talk_length_sec ),sum(ceil(talk_length_sec/60)*".$fee_rate."),ifnull(max(talk_length_sec ),0),max(ceil(talk_length_sec/60)*".$fee_rate.") from vicidial_log where call_date BETWEEN '".$event_time.":00:00' and '".$event_time.":59:59' and user='".$user."' group by left(call_date,13),campaign_id,list_id,user,status; ";
						
						mysqli_query($db_conn,$in_fee_log); 
					}
					
					//echo  $in_call_log."<br>";
 				}
 											
				//mysqli_free_result($rows_qua);
   				$counts="1";
				$des="质检结果提交成功！";
				
				//$status_=get_qua_name($status,"sta");
				//$qua_status_=get_qua_name($quality_status,"qua");
  				
			/*}else {
				$counts="0";
				$des="未找到符合条件的数据！";
  			}
 			mysqli_free_result($rows);				
 			*/
				
			}else{
				$counts="-1";
				$des="参数丢失#2，质检失败！";
			}
					
		}else{
 			$counts="-1";
			$des="参数丢失#1，质检失败！";
 		}
		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"now_time\":".json_encode($now_time)."";
 		$json_data.="}";
		
		echo $json_data;
 		
	break;
	
	//创建查询号码对照表
	case "create_phone_list_job":
		 
		$sql="insert into data_record_job(job_name,userid) values('号码查询对照表','".$_SESSION["username"]."')";
		mysqli_query($db_conn,$sql);
		$job_id=mysqli_insert_id($db_conn); 
		
		if($job_id<>""){
		 	if($phone_number){
				$phone_number=eregi_replace("[^0-9\n]","",$phone_number);
				$phone_number_ary=array_unique(explode("\n",$phone_number));
				 
				$phone_count=count($phone_number_ary);   
				 
				if($phone_count>0){
					$i=0;
					foreach($phone_number_ary as $phone){ 
						if($phone<>"" && preg_match("/^\d*$/",$phone) && $i<1000){
							$phone=trim(eregi_replace("[^0-9]","",$phone));
							$sql_phone.="('".$phone."','".$job_id."'),";
							$i++;
						} 
					}
					 
					if($sql_phone!=""){
						$in_sql_phone="insert into data_record_job_log(phone_number,job_id) values ".substr($sql_phone, 0, -1)."";
						mysqli_query($db_conn,$in_sql_phone);
					}
				 
					$counts="1";
					$des="";
					
				}else{
					$counts="0";
					$des="创建录音备份任务出错!电话号码不能为空!";
				}
			}else{
				$counts="0";
				$des="电话号码填写失败!未收到有效号码!";
			}
		}
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"job_id\":".json_encode($job_id)."";
 		$json_data.="}";
		
		echo $json_data;
	
 	break;
	//获取公告列表
	case "get_notice_list":
 	
		$sql="select title,id from data_notice order by id desc ";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 
				$list=array("title"=>$rs['title'],"id"=>$rs['id']);
				 
				array_push($list_arr,$list);
			}
			$counts="1";
			$des="succ！";
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
	
 	//呼叫状态、质检状态
	case "get_status_type":
 		$status_type=trim($_REQUEST["status_type"]);
		$sql="select status,status_name from data_sys_status where selectable='y' and status_type='".$status_type."' order by status ";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
 		
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$status_name=$rs['status_name'];
				
				$list=array("o_val"=>$rs['status'],"o_name"=>$status_name);
  				array_push($list_arr,$list);
				 
  			}
 			
			$counts="1";
			$des="suc";
		}else {
			$counts="0";
			$des="未找到符合条件的数据！";
 		}
  		
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break; 
	
	//获取自定义字段值 
	case "get_custom_field_val":
 	 	 
		if($campaign_id!=""){
			$sql="select a.libs_id,field_id ,field_name,field_type from data_custom_libs_cam b inner join data_custom_lib a on a.libs_id=b.libs_id where b.campaign_id='".$campaign_id."' and a.active='Y' and a.field_id not in('phone_number','call_des') order by field_order;";
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);
			
			$list_arr=array();
			$list_field="";
 			$field_name_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
					$lists_arr=array();	
 					$field_id=$rs['field_id'];
					 
					if($field_id!="call_des"&&$field_id!="phone_number"){
						if(substr($field_id,0,6)=="custom"){
							$field_prex="b.";
						}else{
							$field_prex="a.";	
						}
						$list_field.=$field_prex.$field_id.",";	 	
						 
					}
					 
					if($rs["field_type"]=="DX"||$rs["field_type"]=="DXX"||$rs["field_type"]=="XL"||$rs["field_type"]=="JL"){
						$sql_form="select a.set_value,a.set_id from data_custom_lib_set a left join data_custom_lib b on a.libs_id=b.libs_id and a.field_id=b.field_id and b.field_type='JL' where a.libs_id='".$rs["libs_id"]."' and a.field_id='".$rs["field_id"]."' and a.set_pid='0' order by a.set_order ";	
						$rows2=mysqli_query($db_conn,$sql_form);
						
						if(mysqli_num_rows($rows2)!=0){
							while($rs2= mysqli_fetch_array($rows2)){ 
								
								$chl_ary=array();
								
								if($rs2["set_id"]!=""){
									
									$sql_chl="select set_value from data_custom_lib_set where set_pid='".$rs2["set_id"]."' order by set_order";	
									$rows3=mysqli_query($db_conn,$sql_chl);
									
									if(mysqli_num_rows($rows3)!=0){
										while($rs3= mysqli_fetch_array($rows3)){ 
											 
											$chl=array("n"=>$rs3['set_value']);
											array_push($chl_ary,$chl);
										}
									} 
									mysqli_free_result($rows3); 
									
								}
								
								$lists=array("n"=>$rs2['set_value'],"s"=>$chl_ary);
								array_push($lists_arr,$lists);
							}
						} 
						mysqli_free_result($rows2);
					} 
					
 					$list=array("id"=>$rs['field_id'],"n"=>$rs['field_name'],"t"=>$rs['field_type'],"s"=>$lists_arr);
					array_push($list_arr,$list); 
				}
				 
			}else {
				 
				$list_arr=array();
				
				foreach($def_field_arr as $e_key=>$val){
					$lists_arr=array();	
					if($val['f_active']=="Y"&&$val['f_id']!="call_des"&&$val['f_id']!="phone_number"){
						$list_field.="a.".$val["f_id"].",";
						$list=array("id"=>$val['f_id'],"n"=>$val['f_n'],"t"=>$val['f_t'],"s"=>$lists_arr);
						array_push($list_arr,$list);
					}
				}   
			} 
		} 
		mysqli_free_result($rows);
 		 
		if($list_field!=""){
			$list_field=substr($list_field,0,-1);
 		}
		
		$sql="select ".$list_field." from vicidial_list".$archive." a left join data_custom_list b on a.lead_id=b.lead_id where a.lead_id='".$lead_id."' limit 1"; 
		//echo "<br>$sql<br>";
		
		$rows            = mysqli_query($db_conn,$sql);
        $row_counts_list = mysqli_num_rows($rows);
        $field_count     = mysqli_num_fields($rows);
        $fields          = mysqli_fetch_fields($rows);	
		
		$v_list_arr=array();
	 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				for ($f = 0; $f < $field_count; $f++) { 
					array_push($v_list_arr,array("n"=>"".$fields[$f]->name."","v"=>"".$rs[$f]."")); 
				}  
  			}  
		} 
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode("1").",";
 		$json_data.="\"des\":".json_encode("").",";
		$json_data.="\"f_list\":".json_encode($list_arr).",";
		$json_data.="\"v_list\":".json_encode($v_list_arr)."";
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