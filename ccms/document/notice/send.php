<?php
require("../../inc/pub_func.php");
require("../../inc/pub_set.php");
 
  	
switch($action){
	
    //公告列表
	case "get_notice":
  		 
		if($notice_id<>""){
 			
			if(strpos($notice_id,",")>-1){
				$notice_id=str_replace(",","','",$notice_id);
				$notice_id="'".$notice_id."'";
				$sql_notice_id=" in(".$notice_id.") ";
			}else{
				$sql_notice_id=" like '%".$notice_id."%' ";
			}
			$sql1=" and a.notice_id ".$notice_id."";
		}
		
		if($notice_title<>""){
 			$sql2=" and notice_title like '%".$notice_title."%'";
		} 
 		 
		if($notice_des<>""){
			$sql3=" and notice_des like '%".$notice_des."%' ";	
		} 
		
		$wheres=$sql1.$sql2.$sql3.$sql4;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from data_notice a left join vicidial_users b on a.user_id=b.user where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$script_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select notice_id,notice_title,notice_des,addtime,b.full_name,a.user_id from data_notice a left join vicidial_users b on a.user_id=b.user where 1=1 ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_script=mysqli_num_rows($rows);			
			
			$script_arr=array();
			$scripts_arr=array();
			if ($row_counts_script!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$script=array("notice_id"=>$rs['notice_id'],"notice_title"=>$rs['notice_title'],"notice_des"=>$rs['notice_des'],"addtime"=>$rs['addtime'],"full_name"=>$rs['full_name'],"user_id"=>$rs['user_id']);
					 
					array_push($script_arr,$script);
				}
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$script_arr=array('id'=>'none');
			}
 		} 
 		mysqli_free_result($rows);
 		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($script_arr)."";
		$json_data.="}";
		
		echo $json_data;
	 
	break;
 	
	//获取公告列表
	case "get_notice_alter":
  			
		$sql="select a.notice_title,a.notice_id from data_notice a inner join data_notice_user c on a.notice_id=c.notice_id and c.user_id='".$_SESSION['username']."' order by a.notice_id desc limit 0,20  ";
			
		//echo $sql;
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_script=mysqli_num_rows($rows);			
		
		$script_arr=array();
		$scripts_arr=array();
		if ($row_counts_script!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			 
				$script=array("notice_id"=>$rs['notice_id'],"notice_title"=>$rs['notice_title']);
				 
				array_push($script_arr,$script);
			}
			$counts="1";
			$des="获取成功！";
		}else {
			$counts="0";
			$des="未找到符合条件的数据！";
			$script_arr=array('id'=>'none');
		}
		
    	 
		mysqli_free_result($rows);
	
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($script_arr)."";
		$json_data.="}";
		
		echo $json_data;
	 
	break;
		
	 
	//添加、修改公告
	case "notice_set":
  		
		if($do_actions=="add"){
     			
			$sql="insert into data_notice (notice_title,notice_des,notice_content,user_list,user_id) select '".$notice_title."','".mysqli_real_escape_string($db_conn,$notice_des)."','".mysqli_real_escape_string($db_conn,$notice_content)."','".$agent_name_list."','".$_SESSION['username']."'";
			//echo $sql;
			
			if(mysqli_query($db_conn,$sql)){
				$notice_id=mysqli_insert_id($db_conn);
				//echo $notice_id;
				if($notice_id!=""){
					//$del_sql="delete from data_notice_user where notice_id='".$notice_id."'";
					//mysqli_query($db_conn,$del_sql);
					
					if($agent_name_list!=""){
						$agent_lists=explode(",",$agent_list);
		 
						foreach($agent_lists as $user_fields){
							 
							$user_id=$user_fields;
							$agent_name_list_sql.="('".$notice_id."','".$user_id."'),"; 
 						}
						
						$in_sql="insert into data_notice_user(notice_id,user_id) values ".substr($agent_name_list_sql,0,-1)."";
						//echo $in_sql;
						if(mysqli_query($db_conn,$in_sql)){
							$counts="1";
							$des="新建公告成功！";
						}else{
							$counts="0";
							$des="新建公告失败，设定查看权限错误！";	
 						}
						
					}else{
 						$counts="1";
						$des="新建公告成功！";
					}
				
				}else{
					$counts="0";
					$des="新建公告失败，请检查重试！";
				}
				 
			}else{
				$counts="0";
				$des="111111，请检查重试！";
			}
			 
 			
		}else if($do_actions=="update"){			
			if($notice_id!=""){
 				$sql="update data_notice set notice_title='".$notice_title."',notice_des='".mysqli_real_escape_string($db_conn,$notice_des)."',notice_content='".mysqli_real_escape_string($db_conn,$notice_content)."',user_list='".$agent_name_list."' where notice_id='".$notice_id."';";
				//echo $sql;
				if(mysqli_query($db_conn,$sql)){
  			 
					$del_sql="delete from data_notice_user where notice_id='".$notice_id."'";
					mysqli_query($db_conn,$del_sql);
					
					if($agent_name_list!=""){
						$agent_lists=explode(",",$agent_list);
		 
						foreach($agent_lists as $user_fields){
							 
							$user_id=$user_fields;
							$agent_name_list_sql.="('".$notice_id."','".$user_id."'),"; 
 						}
						
						$in_sql="insert into data_notice_user(notice_id,user_id) values ".substr($agent_name_list_sql,0,-1)."";
						if(mysqli_query($db_conn,$in_sql)){
							$counts="1";
							$des="修改公告成功！";
						}else{
							$counts="0";
							$des="修改公告失败，设定查看权限错误！";	
	
						}
					}else{
 						$counts="1";
						$des="修改公告成功！";
					}
				 
 				}else{
					$counts="0";
					$des="修改失败，请检查相关设置重试！";
				 
				}
				
 			}else{
				$counts="0";
				$des="修改失败，公告ID不存在！";
			}
						
		}else{
			 
 		}
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
  		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
    	
	//删除公告
  	case "del_notice":
 		
		if($cid!=""){
			
			if(strpos($cid,",")>-1){
				$cid=str_replace(",","','",$cid);
				$cid="'".$cid."'";
				$where_sql=" in(".$cid.") ";
			}else{
				$where_sql=" ='".$cid."' ";
			}
 		     
			$del_sql="delete from data_notice_user where notice_id ".$where_sql."";
  			//删除公告
			$sql="delete from data_notice where notice_id ".$where_sql." ";
			
			if (mysqli_query($db_conn,$sql)&&mysqli_query($db_conn,$del_sql)){
				$counts="1";
				$des="删除成功！";
			}else{
				$counts="0";
				$des="删除失败，请检查相关设置重试！";
			}
			
		}else{
			$counts="0";
			$des="删除失败，请输入要删除的行！";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
 		
	//人员权限列表
  	case "get_notice_user":
  		 
 		if($user_id!=""){
		 
				
  			$sql="select a.user_id,b.acc_dept from data_notice_user a left join vicidial_users b on a.user_id=b.user where a.user_id='".$user_id."' ";
			
 			//echo $sql;			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("user_id"=>$rs['user_id'],"dept_id"=>$rs['acc_dept']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				 
			}else {
				$counts="1";
				 
			}
			
		}else{
			$counts="0";
			$des="设置失败，请选择要设置的公告！";			
		}
 		 
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
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