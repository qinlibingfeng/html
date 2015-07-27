<?php
require("../../inc/pub_func.php");
  
 
switch($action){
       
    //呼叫详单查询
	case "get_vicidial_list":
	
		
		$day_part=(strtotime($s_date)-strtotime($e_date))/86400;
			
		if($day_part>91||$day_part<-91){
		 
			$field_name_list=array("查询时间跨度超过91天");
			$list_arr=array('id'=>'none');
			
			$json_data="{";
			$json_data.="\"counts\":".json_encode(0).",";
			$json_data.="\"des\":".json_encode("本查询只可查询时间跨度为91天内数据!").",";
 			$json_data.="\"datalist\":".json_encode($list_arr)."";
			$json_data.="}";
			
			echo $json_data;
			
			die();
		}
		
		$time_len_type=trim($_REQUEST["time_len_type"]);
		
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
 			$sql4=" and a.phone_number ".$exist_sql;
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
				$select_ont_list="1";
			}
		}
 		
		if($city<>""){
 			$sql13=" and c.city like '%".$city."%'";
		}
		
		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sql13;
		
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id  where ".$wheres."  ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";} 

			$des="";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
 			$sql="select a.uniqueid,a.lead_id,a.list_id,a.campaign_id,a.call_date,a.phone_number,a.user,case when a.comments='auto' then '自动' else '手动' end as comments,b.full_name,b.phone_login,concat(c.province,'-',c.city) as citys,a.call_des,".$record_location." as locations,IFNULL(a.length_in_sec,0) as length_in_sec,IFNULL(a.talk_length_sec,0) as talk_length_sec,e.status_name,case when e.selectable='y' then 'yes' else 'no' end as is_qua,f.userid as qualityuser,f.addtime,f.qualitydes,g.status_name as qualityname,h.campaign_name from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id where ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("uniqueid"=>$rs['uniqueid'],"lead_id"=>$rs['lead_id'],"list_id"=>$rs['list_id'],"campaign_id"=>$rs['campaign_id'],"call_date"=>$rs['call_date'],"phone_number"=>$rs['phone_number'],"user"=>$rs['user'],"comments"=>$rs['comments'],"full_name"=>$rs['full_name'],"phone_login"=>$rs['phone_login'],"citys"=>$rs['citys'],"call_des"=>$rs['call_des'],"locations"=>$rs['locations'],"status_name"=>$rs['status_name'],"is_qua"=>$rs['is_qua'],"addtime"=>$rs['addtime'],"qualitydes"=>$rs['qualitydes'],"qualityuser"=>$rs['qualityuser'],"qualityname"=>$rs['qualityname'],"campaign_name"=>$rs['campaign_name'],"length_in_sec"=>$rs['length_in_sec'],"talk_length_sec"=>$rs['talk_length_sec']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
  			
		}else if($do_actions=="excel"){
	
			 $sql_custom_field = "";		
			if($select_ont_list=="1"){//选择了单个客户清单

				$rslt=mysqli_query($db_conn,"select field_name, field_label from list_fields  where list_id=".$phone_lists." order by field_id asc");
				
				$table_name = "list_".$phone_lists."_fields";
										
				while($con=mysqli_fetch_assoc($rslt)){//通过循环读取数据内容				
					$sql_custom_field .= 	",k.".$con['field_name']." as '".str_replace("：","",$con['field_label'])."'";					
				}
				mysqli_free_result($rslt);
		 		$sql_join_field=" left join ".$table_name." k on k.lead_id=c.lead_id ";

			}

			$field_list=str_replace("·","'",trim($_REQUEST["field_list"]));
			if($file_type!="txt_n"){
				if($field_list<>""){
					
					$field_sql=",".$field_list;
					
					if(strpos($field_list,"i.dtmf_key")>-1){ 
						$g_left_sql=" left join (select dtmf_key,uniqueid from (select GROUP_CONCAT(dtmf_key) as dtmf_key,uniqueid from data_dtmf_log where dtmf_time between '".$start_date."' and '".$end_date."' group by uniqueid) tmp_dtmf ) i on a.uniqueid=i.uniqueid ";
					}
					
					$sql="select a.phone_number as '被叫号码'".$field_sql." from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id ".$g_left_sql."  ".$sql_join_field." where ".$wheres." ".$sort_sql." ";
					$sql2= "";
				}else{
					

					//$sql="select a.phone_number as '被叫号码',a.user as '工号',b.full_name as '工号姓名',a.call_date as '呼叫时间',IFNULL(a.length_in_sec,0) as '呼叫时长',IFNULL(a.talk_length_sec,0) as '通话时长',h.campaign_name as '业务活动',e.status_name as '呼叫结果',a.call_des as '呼叫描述',g.status_name as '质检结果',f.qualitydes as '质检描述',replace(d.location,'".$record_ip."','".$record_web."') as '录音地址' from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id where ".$wheres." ".$sort_sql." ";
					$sql="select a.phone_number as '被叫号码',a.user as '工号',b.full_name as '工号姓名',a.call_date as '呼叫时间',IFNULL(a.length_in_sec,0) as '呼叫时长',IFNULL(a.talk_length_sec,0) as '通话时长',h.campaign_name as '业务活动',e.status_name as '呼叫结果',a.call_des as '呼叫描述',g.status_name as '质检结果',f.qualitydes as '质检描述',replace(d.location,'".$record_ip."','".$record_web."') as '录音地址' ".$sql_custom_field." from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id ".$sql_join_field." where ".$wheres." ".$sort_sql." ";
	
				}
			}else{
				$sql="select 'C011','130002' as `c_130002`,'861300005101' as `c_861300005101`,'dxhbfc' as `dxhbfc`,c.first_name as '客户姓名',case when c.gender like '%男%' then 'M' when c.gender like '%女%' then 'F' else c.gender end as '客户姓别',CAST(replace(replace(replace(c.date_of_birth,' ','-'),'-','-'),'－','-') as date) as '客户生日',a.phone_number as '客户手机号',DATE_FORMAT(a.call_date,'%Y-%m-%d') as '销售日期','0' as `c_0`,c.title as '职业' from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id where ".$wheres." ".$sort_sql." ";
			}
   		
   		
   		
   		//echo $sql;
 			echo json_encode(save_detail_excel($sql,"营销数据查询详单",$file_type));
			 
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
		
		$day_part=(strtotime($s_date)-strtotime($e_date))/86400;
			
		if($day_part>91||$day_part<-91){
		 
			$field_name_list=array("查询时间跨度超过91天");
			$list_arr=array('id'=>'none');
			
			$json_data="{";
			$json_data.="\"counts\":".json_encode(0).",";
			$json_data.="\"des\":".json_encode("本查询只可查询时间跨度为91天内数据!").",";
 			$json_data.="\"datalist\":".json_encode($list_arr)."";
			$json_data.="}";
			
			echo $json_data;
			
			die();
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
		
		$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sql13;
		
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from data_quality_log a left join data_sys_status b on a.qualitystatus=b.status and b.status_type='qua_status' left join vicidial_log c on replace(a.vicidial_id,'_b','')=c.uniqueid and a.lead_id=c.lead_id left join vicidial_campaigns g on a.campaign_id=g.campaign_id left join vicidial_users e on a.userid=e.user left join vicidial_users f on c.user=f.user left join recording_log d on replace(a.vicidial_id,'_b','')=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status h on c.status=h.status and h.status_type='call_status' left join data_sys_status i on a.status=i.status and i.status_type='call_status' where ".$wheres."  ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";} 

			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
 			$sql="select c.call_des,a.qualitydes,a.addtime,a.userid,e.full_name as qua_name,b.status_name as qualityname,c.phone_number,c.call_date,c.user,f.full_name as call_name,ifnull(g.campaign_name,a.campaign_id) as campaign_name,h.status_name,i.status_name as old_status,".$record_location." as locations from data_quality_log a left join data_sys_status b on a.qualitystatus=b.status and b.status_type='qua_status' left join vicidial_log c on replace(a.vicidial_id,'_b','')=c.uniqueid and a.lead_id=c.lead_id left join vicidial_campaigns g on a.campaign_id=g.campaign_id left join vicidial_users e on a.userid=e.user left join vicidial_users f on c.user=f.user left join recording_log d on replace(a.vicidial_id,'_b','')=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status h on c.status=h.status and h.status_type='call_status' left join data_sys_status i on a.status=i.status and i.status_type='call_status' where  ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
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
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
  			
		}else if($do_actions=="excel"){
   				
			$sql="select c.phone_number as '电话号码',c.call_date as '呼叫时间',concat(c.user,' [',f.full_name,']') as '工号',ifnull(g.campaign_name,a.campaign_id) as '业务活动',h.status_name as '呼叫结果',i.status_name as '原呼叫结果',concat(a.userid,' [',e.full_name,']') as '质检人',b.status_name as '质检结果',a.addtime as '质检时间',c.call_des as '呼叫描述',a.qualitydes as '质检描述',".$record_location." as '录音地址' from data_quality_log a left join data_sys_status b on a.qualitystatus=b.status and b.status_type='qua_status' left join vicidial_log c on replace(a.vicidial_id,'_b','')=c.uniqueid and a.lead_id=c.lead_id left join vicidial_campaigns g on a.campaign_id=g.campaign_id left join vicidial_users e on a.userid=e.user left join vicidial_users f on c.user=f.user left join recording_log d on replace(a.vicidial_id,'_b','')=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status h on c.status=h.status and h.status_type='call_status' left join data_sys_status i on a.status=i.status and i.status_type='call_status' where ".$wheres." ".$sort_sql." ";
     			//echo $sql."<br><br>";
			echo json_encode(save_detail_excel($sql,"质检详单",$file_type));
			//echo $aa[0];
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
	
	//录音质检
	case "callqulity_set":
 
		$title=trim($_REQUEST["title"]);
		$first_name=trim($_REQUEST["first_name"]);
		$middle_initial=trim($_REQUEST["middle_initial"]);
		$last_name=trim($_REQUEST["last_name"]);
		$address1=trim($_REQUEST["address1"]);
		$address2=trim($_REQUEST["address2"]);
		$address3=trim($_REQUEST["address3"]);
		$city=trim($_REQUEST["city"]);
		$state=trim($_REQUEST["state"]);
		$postal_code=trim($_REQUEST["postal_code"]);
		$province=trim($_REQUEST["province"]);
		$gender_list=trim($_REQUEST["gender_list"]);
		$alt_phone=trim($_REQUEST["alt_phone"]);
		$email=trim($_REQUEST["email"]);
		$date_of_birth=trim($_REQUEST["date_of_birth"]);
		$isedit=trim($_REQUEST["isedit"]);
		$call_date=trim($_REQUEST["call_date"]);
		$old_call_date=trim($_REQUEST["old_call_date"]);
		$recording_id=trim($_REQUEST["recording_id"]);
		$qua_id=trim($_REQUEST["qua_id"]);
		$old_status=trim($_REQUEST["old_status"]);
		
		if($isedit=="yes"){
			$list_upsql=",title='".$title."',first_name='".$first_name."',middle_initial='".$middle_initial."',last_name='".$last_name."',address1='".$address1."',address2='".$address2."',address3='".$address3."',city='".$city."',state='".$state."',postal_code='".$postal_code."',province='".$province."',gender='".$gender_list."',alt_phone='".$alt_phone."',email='".$email."',date_of_birth='".$date_of_birth."',comments='".$comments."'";
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
				
				if($call_date!=$old_call_date){
					$up_call_date_sql=",call_date='".$call_date."'";
					
					$up_recording_sql="update recording_log set start_time='".$call_date."' where recording_id=".$recording_id."";
					mysqli_query($db_conn,$up_recording_sql);
				}
				
				$today=date("Y-m-d");
				$time_dif=strtotime($now_time)-strtotime($old_call_date);
				
				
				//变更vicidial_log status
				$upsql1="update vicidial_log set status='".$status."',quality_status='".$quality_status."',call_des='".mysqli_real_escape_string($db_conn,$call_des)."' ".$up_call_date_sql."  where uniqueid='".$uniqueid."'";
				mysqli_query($db_conn,$upsql1);
 				
				//变更vicidial_list status
				$upsql2="update vicidial_list set status='".$status."' ".$list_upsql." where lead_id=".$lead_id."";
				mysqli_query($db_conn,$upsql2);
				
				//变更vicidial_agent_log status
				$upsql3="update vicidial_agent_log set status='".$status."'  where vicidial_id='".$uniqueid."'";
				mysqli_query($db_conn,$upsql3);
				
				
				$upsql="update data_quality_log set vicidial_id=concat(vicidial_id,'_b') where vicidial_id='".$uniqueid."'";
				mysqli_query($db_conn,$upsql);
		 
				$insql="insert into data_quality_log (qualitystatus,vicidial_id,lead_id,list_id,campaign_id,userid,qualitydes,status) values('".$quality_status."','".$uniqueid."','".$lead_id."','".$list_id."','".$campaign_id."','".$_SESSION['username']."','".$qualitydes."','".$old_status."')";
				mysqli_query($db_conn,$insql);
 				
 				
 				

		 		$sql_2="update list_".$list_id."_fields set lead_id='".$lead_id."' ";

				$rslt=mysqli_query($db_conn,"select field_name from list_fields  where list_id=".$list_id);
				
				while($con=mysqli_fetch_assoc($rslt)){//通过循环读取数据内容				
					$sql_2 .= ",".$con['field_name']." ='".trim($_REQUEST[$con['field_name']])."'";
				}
				$sql_2 .= " where lead_id='".$lead_id."'";

	 			mysqli_query($db_conn,$sql_2);
          				
 				
 				
 				
 				
 				
				//echo $time_dif;
				if($time_dif>5400){
  					
					$event_time=substr($old_call_date,0,-6);
					
					$del_agent_log="delete from data_report_agent_log_list where event_time='".$event_time."' and user='".$user."'";
					mysqli_query($db_conn,$del_agent_log);
					
					//echo  $del_agent_log."<br>";
					
					$in_agent_log="
					insert into data_report_agent_log_list(event_time,campaign_id,user,status,sub_status,pause_sec,max_pause_sec,wait_sec,max_wait_sec,talk_sec,max_talk_sec,dispo_sec,max_dispo_sec,dead_sec,max_dead_sec,talk_length_sec,max_talk_length_sec,counts ) 
					select  left(a.event_time,13),a.campaign_id,a.user,ifnull(a.status,''),a.sub_status,ifnull(sum(a.pause_sec),0),ifnull(max(a.pause_sec),0),ifnull(sum(a.wait_sec),0),ifnull(max(a.wait_sec),0),ifnull(sum(a.talk_sec),0),ifnull(max(a.talk_sec),0),ifnull(sum(a.dispo_sec),0),ifnull(max(a.dispo_sec),0),ifnull(sum(a.dead_sec),0),ifnull(max(a.dead_sec),0),ifnull(sum(b.talk_length_sec),0),ifnull(max(b.talk_length_sec),0),count(*) from vicidial_agent_log a left join vicidial_log b on a.vicidial_id=b.uniqueid where a.event_time BETWEEN '".$event_time.":00:00' and '".$event_time.":59:59' and a.user='".$user."' group by left(event_time,13),a.campaign_id,a.user,a.status,a.sub_status; ";
					mysqli_query($db_conn,$in_agent_log); 
					//echo  $in_agent_log."<br>";
					   
					/**ssssssssssssss**/ 
					
					$del_agent_log="delete from data_report_call_log_list where call_date='".$event_time."' and user='".$user."'";
					mysqli_query($db_conn,$del_agent_log);
					
					//echo  $del_agent_log."<br>";
					 
					$in_call_log="					
					insert into data_report_call_log_list(call_date,campaign_id,list_id,user,status,quality_status,counts,talk_length_sec,length_in_sec,max_talk_length_sec,max_length_in_sec )
					select left(call_date,13),campaign_id,list_id,user,status,quality_status,count(*),sum(talk_length_sec),sum(length_in_sec),ifnull(max(talk_length_sec),0),ifnull(max(length_in_sec),0) from vicidial_log where call_date between '".$event_time.":00:00' and '".$event_time.":59:59' and user='".$user."' group by left(call_date,13),campaign_id,list_id,user,status,quality_status ";
					
					mysqli_query($db_conn,$in_call_log); 
					
					
					
					
					$del_fee_log="delete from data_report_fee_log_list where call_date='".$event_time."' and user='".$user."'";
					mysqli_query($db_conn,$del_fee_log);  
					
					//$days_dif=round($time_dif/86400);
					//$days_dif>0?$fee_data_table="vicidial_carrier_log_archive":$fee_data_table="vicidial_carrier_log";
					
 					$in_fee_log="insert into data_report_fee_log_list(call_date,campaign_id,list_id,user,status,counts,fee_length_sec,fee,max_fee_length_sec,max_fee) select left(call_date,13),campaign_id,list_id,user,status,count(*),sum(talk_length_sec ),sum(ceil(talk_length_sec/60)*0.07),ifnull(max(talk_length_sec ),0),max(ceil(talk_length_sec/60)*0.07) from vicidial_log where call_date BETWEEN '".$event_time.":00:00' and '".$event_time.":59:59' and user='".$user."' group by left(call_date,13),campaign_id,list_id,user,status; ";
					
					mysqli_query($db_conn,$in_fee_log); 
					
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
			$des="sucess";
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
	case "get_custom_field_list":
 	
 		$list_arr=array();

 		if($list_id<>""){
			if(strpos($list_id,",")>-1){
					$counts="0";
					$des="不支持多选客户清单！";
			}else{
					 	 	
				$sql="select field_name,field_label from list_fields  where list_id='".$list_id."'order by field_id";
		 		//echo $sql;
				$rows=mysqli_query($db_conn,$sql);
				$row_counts_list=mysqli_num_rows($rows);			
				
				
	
		 		if ($row_counts_list > 0) {			
		 			
					while($rs=mysqli_fetch_assoc($rows)){//通过循环读取数据内容				
						//$list_arr[]=array($rs['field_name']=>str_replace("：","",$rs['field_label']));	
						array_merge($list_arr,array($rs['field_name']=>str_replace("：","",$rs['field_label'])));
					}
									
		 			$counts="1";
					$des="获取成功！";
				}else {
					$counts="0";
					$des="未找到符合条件的数据！";
		 		}
		  
		  	mysqli_free_result($rows);
			}
		}


 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	case "get_custom_field_value":
 			 		

		$sql="select list_id,field_id,field_name,field_label,field_type,field_options from list_fields  where list_id='".$list_id."'order by field_id";
		
		$rslt=mysqli_query( $db_conn, $sql);							
		$row_counts_list=mysqli_num_rows($rslt);			
		$field_value_arr=array();			
		$field_arr=array();		
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rslt)){ 
	
					$list_option =explode(',',$rs['field_options']); 
					$list=array( "list_id"=>$rs['list_id'],"field_id"=>$rs['field_id'],"field_name"=>$rs['field_name'],"field_label"=>$rs['field_label'],"field_type"=>$rs['field_type'],"field_options"=>$list_option);

					array_push($field_arr,$list);
  			}
 			$counts="1";
			$des="获取自定义字段信息成功！";
		}else {

			$counts="0";
			$des="未找到符合条件的自定义字段信息！";
 		}			 		
 		mysqli_free_result($rslt);

 		if($counts=="1"){
 			$sql="select * from list_".$list_id."_fields  where lead_id='".$lead_id."'";
			$rslt=mysqli_query($db_conn, $sql);	
			
			$rs=mysqli_fetch_array($rslt);		
			foreach($field_arr as $list){	
				$list['field_value'] = $rs[$list['field_name']];					
				array_push($field_value_arr, $list);
			} 						
 		}
 		mysqli_free_result($rslt);
 		//print_r($field_value_arr);
 	
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"fields\":".json_encode($field_value_arr)."";
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