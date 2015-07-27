<?php 


//if ( file_exists("/etc/astguiclient.conf")){
 		
//	$DBCagc = file("/etc/astguiclient.conf");
//	foreach ($DBCagc as $DBCline){
//		$DBCline = preg_replace("/ |>|\n|\r|\t|\#.*|;.*/","",$DBCline);
//		if (ereg("^PATHlogs", $DBCline))
//			{$PATHlogs = $DBCline;   $PATHlogs = preg_replace("/.*=/","",$PATHlogs);}
//		if (ereg("^PATHweb", $DBCline))
//			{$WeBServeRRooT = $DBCline;   $WeBServeRRooT = preg_replace("/.*=/","",$WeBServeRRooT);}
//		if (ereg("^VARserver_ip", $DBCline))
//			{$WEBserver_ip = $DBCline;   $WEBserver_ip = preg_replace("/.*=/","",$WEBserver_ip);}
//		if (ereg("^VARDB_server", $DBCline))
//			{$VARDB_server = $DBCline;   $VARDB_server = preg_replace("/.*=/","",$VARDB_server);}
//		if (ereg("^VARDB_database", $DBCline))
//			{$VARDB_database = $DBCline;   $VARDB_database = preg_replace("/.*=/","",$VARDB_database);}
//		if (ereg("^VARDB_user", $DBCline))
//			{$VARDB_user = $DBCline;   $VARDB_user = preg_replace("/.*=/","",$VARDB_user);}
//		if (ereg("^VARDB_pass", $DBCline))
//			{$VARDB_pass = $DBCline;   $VARDB_pass = preg_replace("/.*=/","",$VARDB_pass);}
//		if (ereg("^VARDB_port", $DBCline))
//			{$VARDB_port = $DBCline;   $VARDB_port = preg_replace("/.*=/","",$VARDB_port);}
//	}
//}else{
 		
	#defaults for DB connection
//	$VARDB_server = 'localhost';
//	$VARDB_port = '';
//	$VARDB_user = 'cron';
//	$VARDB_pass = '1234';
//	$VARDB_database = 'asterisk';
//	$WeBServeRRooT = '/usr/local/apache2/htdocs';
//}


require("../inc/config.ini.php");

//数据库
$db_conn = mysqli_connect("$db_host","$db__user","$db__pass");
 
if (!$db_conn){
	
    //die('数据库连接错误：'.mysqli_error());
	
	$json_data="{";
	$json_data=$json_data."\"counts\":\"0\",";
	$json_data=$json_data."\"des\":\"数据库连接错误\"";
 	$json_data=$json_data."}";
	
	echo $json_data;
	die();
}
mysqli_select_db($db_conn,$db__name);
mysqli_query($db_conn,"SET NAMES utf8"); 


$action=trim($_REQUEST["action"]);
$do_actions=trim($_REQUEST["do_actions"]);
$uniqueid=trim($_REQUEST["uniqueid"]);
$user=trim($_REQUEST["user"]);
$agent_list=$user;
$cid=trim($_REQUEST["cid"]);  
$user_group=trim($_REQUEST["user_group"]);
$campaign_id=trim($_REQUEST["campaign_id"]);
$status=trim($_REQUEST["status"]);
$quality_status=trim($_REQUEST["quality_status"]);
$list_id=trim($_REQUEST["list_id"]);
$call_des=trim($_REQUEST["call_des"]);
$comments=trim($_REQUEST["comments"]);
$today=date('Y-m-d');
$vicidial_id=trim($_REQUEST["vicidial_id"]);
$lead_id=trim($_REQUEST["lead_id"]);
  
switch($action){
	
  	case "get_notice_list":
	
		$sql="select a.notice_title,a.notice_id,b.is_read from data_notice a inner join data_notice_user b on a.notice_id=b.notice_id and b.user_id='".$user."' order by a.notice_id desc limit 0,20  ";
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		
		$list_arr=array();
		$list=array();
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 
				$list=array("notice_id"=>$rs['notice_id'],"notice_title"=>$rs['notice_title'],"is_read"=>$rs['is_read']);
				 
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
	
	case "get_notice_alter":
	
		$sql="select ifnull(count(*),0) as counts from data_notice a inner join data_notice_user b on a.notice_id=b.notice_id and b.user_id='".$user."' and b.is_read='0' ";
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		$n_counts=0;
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				 $n_counts=$rs["counts"];
			}
			$counts="1";
			$des="获取成功！";
		}else {
			$counts="0";
 		}
     	 
		mysqli_free_result($rows);
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"n_counts\":".json_encode($n_counts)."";
  		$json_data.="}";
		
		echo $json_data;
 	
	break;
	
	case "set_notice_read":
	
		if($cid!=""){
			$up_sql="update data_notice_user set is_read='1' where notice_id='".$cid."' and user_id='".$user."'";
			if(mysqli_query($db_conn,$up_sql)){
				$counts="1";
			}else{
				$counts="0";
			}
		}else{
			$counts="0";
		}
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
   		$json_data.="}";
		
		echo $json_data;
 	
	break;
	
	case "get_notice_con":
	
		$sql="select a.notice_title,a.notice_content,a.addtime,a.user_id,b.full_name,c.is_read from data_notice a left join vicidial_users b on a.user_id=b.user inner join data_notice_user c on a.notice_id=c.notice_id and c.user_id='".$user."' where  a.notice_id='".$cid."' limit 0,1 ";
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		
 		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 
				$notice_title=$rs['notice_title'];
				$notice_content=$rs['notice_content'];
				$addtime=$rs['addtime'];
				$user_id=$rs['user_id'];
				$full_name=$rs['full_name'];
				$is_read=$rs['is_read'];
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
		$json_data.="\"notice_title\":".json_encode($notice_title).",";
		$json_data.="\"notice_content\":".json_encode($notice_content).",";
		$json_data.="\"addtime\":".json_encode($addtime).",";
		$json_data.="\"user_id\":".json_encode($user_id).",";
		$json_data.="\"is_read\":".json_encode($is_read).",";
		$json_data.="\"full_name\":".json_encode($full_name)."";
  		$json_data.="}";
		
		echo $json_data;
 	
	break;
	
	case "get_work_count":
		
		$sql="select a.user,b.full_name,cg,counts from(select user,IFNULL(sum(case when status='cg' then counts else 0 end ),0) as 'cg' ,IFNULL(sum(counts),0) as counts from data_report_call_log_list  where  call_date BETWEEN '".$today." 00' and '".$today." 23' group by user )a left join vicidial_users b on a.user=b.user order by cg+0 desc";
 
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		
 		$list_arr=array();
		$list=array();
		$i=0;
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 	$cgl="0";
				$cg=$rs['cg'];
				$counts=$rs['counts'];
				
				if($rs['cg']!="0"){
					$cgl=round(($cg/$counts),2)*100;
 				}
 				$i++;
				$list=array("order"=>$i,"user"=>$rs['user'],"full_name"=>$rs['full_name'],"cg"=>$cg,"counts"=>$counts,"cgl"=>$cgl."%");
				 
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
 		
		$sql="select a.user,b.full_name,cg,counts from(select user,IFNULL(sum(case when status='cg' then counts else 0 end ),0) as 'cg' ,IFNULL(sum(counts),0) as counts from data_report_call_log_list where and campaign_id='".$campaign_id."' and call_date BETWEEN '".$today." 00' and '".$today." 23' group by user )a left join vicidial_users b on a.user=b.user order by cg+0 desc";
 
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		
 		$list_cam_arr=array();
		$list_cam=array();
		$i=0;
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 	$cgl="0";
				$cg=$rs['cg'];
				$counts=$rs['counts'];
				
				if($rs['cg']!="0"){
					$cgl=round(($cg/$counts),2)*100;
 				}
 				$i++;
				$list_cam=array("order"=>$i,"user"=>$rs['user'],"full_name"=>$rs['full_name'],"cg"=>$cg,"counts"=>$counts,"cgl"=>$cgl."%");
				 
				array_push($list_cam_arr,$list_cam);
			}
			$cam_counts="1";
			$cam_des="获取成功！";
		}else {
			$cam_counts="0";
			$cam_des="未找到符合条件的数据！";
			$list_cam_arr=array('id'=>'none');
		}
     	 
		mysqli_free_result($rows);
 		
  		
		$sql="select a.user from(select a.user,IFNULL(sum(case when status='cg' then counts else 0 end ),0) as 'cg' from data_report_call_log_list a inner join vicidial_users b on a.user=b.user and b.user_group='".$user_group."' where a.call_date  BETWEEN '".$today." 00' and '".$today." 23' group by a.user )a order by cg+0 desc";
 		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
 		$i=0;
		$group_order=0;
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			  	$i++;
				if($rs["user"]==$user){
					$group_order=$i;	
				}
 			}
 		} 
 		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"cam_counts\":".json_encode($cam_counts).",";
 		$json_data.="\"group_order\":".json_encode($group_order).",";
		$json_data.="\"datalist\":".json_encode($list_arr).",";
		$json_data.="\"datalist_cam\":".json_encode($list_cam_arr)."";
		
  		$json_data.="}";
		
		echo $json_data;
 	
	break;
	
	case "get_status_list":
	
		$sql="select a.status,b.status_name from vicidial_statuses a inner join data_sys_status b on a.status=b.status and b.status_type='call_status' and a.selectable ='y' order by a.orders  ";
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		
		$list_arr=array();
		$list=array();
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 
				$list=array("status"=>$rs['status'],"status_name"=>$rs['status_name']);
				 
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
	
	case "get_qua_status_list":
	
		$sql="select status,status_name from data_sys_status where selectable='y' and status_type='qua_status' order by status  ";
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		
		$list_arr=array();
		$list=array();
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 
				$list=array("status"=>$rs['status'],"status_name"=>$rs['status_name']);
				 
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
	
	case "get_lists_list":
	
		$sql="select list_id,list_name from vicidial_lists where campaign_id='".$campaign_id."' order by list_id  ";
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		
		$list_arr=array();
		$list=array();
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 
				$list=array("status"=>$rs['list_id'],"status_name"=>$rs['list_name']);
				 
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
	
	//呼叫详单查询
	case "get_vicidial_list":
		
			
		//$record_location="case when left(d.location,4)='http' then '同步中' else replace(d.location,'".$record_ip."','".$record_web."') end ";
		
		$pages    = trim($_REQUEST["pages"]);
		$sorts    = trim($_REQUEST["sorts"]);
		$order    = trim($_REQUEST["order"]);
		$pagesize = trim($_REQUEST["pagesize"]);
		
		if (!$pagesize || !is_numeric($pagesize)) {
			$pagesize = 15;
		}
		if (!$pages || !is_numeric($pages)) {
			$pages = 1;
		}
		if (!$order) {
			$order = "desc";
		}
		if ($sorts != "") {
			$sort_sql = " order by " . $sorts . " " . $order . " ";
		} else {
			$sort_sql = "";
		}
		
		$s_date = trim($_REQUEST["begintime"]);
		$s_hour = trim($_REQUEST["s_hour"]);
		$s_min  = trim($_REQUEST["s_min"]);
		$e_date = trim($_REQUEST["endtime"]);
		$e_hour = trim($_REQUEST["e_hour"]);
		$e_min  = trim($_REQUEST["e_min"]);
   		$today=date("Y-m-d");
		
		$search_accuracy = trim($_REQUEST["search_accuracy"]);
		
		$start_date = $s_date . " " . $s_hour . ":" . $s_min . ":00";
		$end_date   = $e_date . " " . $e_hour . ":" . $e_min . ":59";
		
		if ($s_date == "" && $e_date == "") {
			$start_date = $today . " 00:00:01";
			$end_date   = $today . " 23:59:59";
		}
		
		$date1=strtotime($start_date);
		$date2=strtotime($today." 23:59:59");
		$day_part=(($date1-$date2)/86400);
		
		if($day_part<1&&$day_part>-1){
			
			$sql1=" a.call_date between '".$start_date."' and '".$end_date."'";
			
			if($agent_list<>""){
				if(strpos($agent_list,",")>-1){
					$agent_list=str_replace(",","','",$agent_list);
					$agent_list="'".$agent_list."'";
					$sql2=" and a.user in(".$agent_list.")";
				}else{
					$sql2=" and a.user ='".$agent_list."'";
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
				$sql4=" and a.phone_number ".$exist_sql;
			}
			
			if($comments<>""){
				$sql5=" and a.comments='".$comments."'";
			}
			
			if($time_zone<>""&&$time_len<>""){
				$sql6=" and a.talk_length_sec ".$time_zone.$time_len. "";
			}
			
			if($campaign_id<>""){
				if(strpos($campaign_id,",")>-1){
					$campaign_id=str_replace(",","','",$campaign_id);
					$campaign_id="'".$campaign_id."'";
					$sql7=" and a.campaign_id in(".$campaign_id.") ";
				}else{
					$sql7=" and a.campaign_id ='".$campaign_id."' ";
				}
			}
			
			if($call_des<>""){
				$sql8=" and a.call_des like '%".$call_des."%'";
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
			
			$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sql13;
			
			//获取记录集个数
			if($do_actions=="count"){
				
				$sql="select count(*) from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' where ".$wheres."  ";
				//echo $sql;
				$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
				$counts=$rows[0];
				if(!$counts){$counts="0";} 
	
				$des="";
				$list_arr=array('id'=>'none');
				
			}else if($do_actions=="list"){
			
				$offset=($pages-1)*$pagesize;
				
				$sql="select a.uniqueid,a.lead_id,a.list_id,a.campaign_id,a.call_date,a.phone_number,a.user,a.comments,c.comments as comments_des,a.call_des,".$record_location." as locations,ifnull(a.talk_length_sec,0) as length_in_sec,ifnull(a.talk_length_sec,0) as talk_length_sec,e.status_name,g.status_name as qualityname,f.qualitydes from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status and e.status_type='call_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' where ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
				
				//echo $sql;
				
				$rows=mysqli_query($db_conn,$sql);
				$row_counts_list=mysqli_num_rows($rows);			
				
				$list_arr=array();
				 
				if ($row_counts_list!=0) {
					while($rs= mysqli_fetch_array($rows)){ 
					 
						$list=array("uniqueid"=>$rs['uniqueid'],"lead_id"=>$rs['lead_id'],"list_id"=>$rs['list_id'],"call_date"=>$rs['call_date'],"phone_number"=>$rs['phone_number'],"comments"=>$rs['comments'],"comments_des"=>$rs['comments_des'],"call_des"=>$rs['call_des'],"locations"=>$rs['locations'],"status_name"=>$rs['status_name'],"qualityname"=>$rs['qualityname'],"talk_length_sec"=>$rs['talk_length_sec'],"length_in_sec"=>$rs['length_in_sec'],"qualitydes"=>$rs['qualitydes']);
						 
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
			} 
 			
		}else{
			$counts="0";
			$des="本查询只可查找2天以内数据！";
		}
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
	 
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		$json_data.="}";
		
		echo $json_data;
 		 
 		
	break;
	
	//获取单条问卷结果详单
	case "get_ask_res":
 		
		if($vicidial_id!=""){
			
			$sql="select ask_id from data_ask_result where vicidial_id='".$vicidial_id."' and lead_id='".$lead_id."' limit 0,1";
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
					$ask_id=$rs['ask_id'];
				}
			} 
			mysqli_free_result($rows);
			 
			$sql="select a.que_id,case when a.que_type='des' then a.que_des else a.que_title end as que_title
,b.id,b.form_value,b.lead_id,a.que_order,c.status_name as que_type from data_ask_question a left join data_ask_result b on a.que_id=b.que_id and b.vicidial_id='".$vicidial_id."' and b.lead_id='".$lead_id."' left join data_sys_status c on a.que_type=c.status and c.status_type='que_type' where a.ask_id='".$ask_id."' union all select 'calldes' as que_id,'呼叫备注描述' as que_title,id,form_value,lead_id,0 as que_order,'呼叫备注描述' as que_type from data_ask_result where vicidial_id='".$vicidial_id."' and que_id='calldes' order by que_order";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){
					$form_value=$rs['form_value'];
					$is_f_val="Y";
				    if($form_value==""){
						$form_value="";
						$is_f_val="N";
					}
					$list=array("que_id"=>$rs['que_id'],"id"=>$rs['id'],"form_value"=>$form_value,"que_title"=>$rs['que_title'],"que_order"=>$rs['que_order'],"que_type"=>$rs['que_type'],"is_f_val"=>$is_f_val);
					array_push($list_arr,$list);
					 
				}
				 
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
			}
 			
			mysqli_free_result($rows);
		}else{
			
			$counts="0";
			$des="请输入要查找的结果ID！";
		}
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
 	
	//获取最新业务属性
	case "get_campaign_set":
 		
		if($campaign_id!=""){
 			 
			$sql="select a.que_id,case when a.que_type='des' then a.que_des else a.que_title end as que_title
,b.id,b.form_value,b.lead_id,a.que_order,c.status_name as que_type from data_ask_question a left join data_ask_result b on a.que_id=b.que_id and b.vicidial_id='".$vicidial_id."' and b.lead_id='".$lead_id."' left join data_sys_status c on a.que_type=c.status and c.status_type='que_type' where a.ask_id='".$ask_id."' union all select 'calldes' as que_id,'呼叫备注描述' as que_title,id,form_value,lead_id,0 as que_order,'呼叫备注描述' as que_type from data_ask_result where vicidial_id='".$vicidial_id."' and que_id='calldes' order by que_order";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){
					$form_value=$rs['form_value'];
					$is_f_val="Y";
				    if($form_value==""){
						$form_value="";
						$is_f_val="N";
					}
					$list=array("que_id"=>$rs['que_id'],"id"=>$rs['id'],"form_value"=>$form_value,"que_title"=>$rs['que_title'],"que_order"=>$rs['que_order'],"que_type"=>$rs['que_type'],"is_f_val"=>$is_f_val);
					array_push($list_arr,$list);
					 
				}
				 
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
			}
 			
			mysqli_free_result($rows);
		}else{
			
			$counts="0";
			$des="请输入要查找的业务ID！";
		}
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
 	
	//获取DTMF
	case "get_dtmf":
  		
		if($uniqueid!=""){
			$dtmf_id=trim($_REQUEST["dtmf_id"]);
			
 			if(!$dtmf_id){
				$dtmf_id=1;
			}
			
			$sql="select dtmf_id,dtmf_key from data_dtmf_log where uniqueid='".$uniqueid."' and dtmf_id>".$dtmf_id." order by dtmf_id desc limit 1";
			 
 			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
 			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
					$dtmf_key=$rs['dtmf_key'];
					$dtmf_id=$rs['dtmf_id'];
 				}
				 
				$counts="1";
 			}else {
				$counts="0";
				$dtmf_id=1;
 			}
 			
			mysqli_free_result($rows);
		}else{
 			$counts="0";
			$dtmf_id=1;
 		}
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"dtmf_id\":".json_encode($dtmf_id).",";
 		$json_data.="\"dtmf_key\":".json_encode($dtmf_key)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	 
 	
	case "up_recording_log";
		$lead_id    = trim($_REQUEST["lead_id"]);
		$record_id    = trim($_REQUEST["record_id"]);
		$record_filename    = trim($_REQUEST["record_filename"]);
		
		$file=dirname(__FILE__)."/record_1122.txt";
		$fp=fopen($file,"a");
  		
		$record_log=$lead_id."\t".$record_id."\t".$record_filename."\t".date("Y-m-d H:i:s")."\r\n";
		fwrite($fp,$record_log);
		fclose($fp);
		
	break;
 	default :
}
 
 mysqli_close($db_conn);
?>