<?php
require("../../inc/pub_func.php");
require("../../inc/pub_set.php");
        
switch($action){
	 
    //话术列表
	case "get_scripts":
  		 
		if($script_id<>""){
 			
			if(strpos($script_id,",")>-1){
				$script_id=str_replace(",","','",$script_id);
				$script_id="'".$script_id."'";
				$sql_script_id=" in(".$script_id.") ";
			}else{
				$sql_script_id=" like '%".$script_id."%' ";
			}
			$sql1=" and script_id ".$sql_script_id."";
		}
		
		if($script_name<>""){
 			$sql2=" and script_name like '%".$script_name."%'";
		} 
 		
		if($active<>""){
			$sql3=" and active='".$active."'";		
		} 
		
		if($script_comments<>""){
			$sql4=" and script_comments like '%".$script_comments."%' ";	
		} 
		
		$wheres=$sql1.$sql2.$sql3.$sql4;
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from vicidial_scripts a left join (select campaign_script,count(*) as counts from vicidial_campaigns group by campaign_script order by null) b on a.script_id=b.campaign_script left join data_sys_status c on a.active=c.status and c.status_type='active' where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$script_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select script_id,script_name,script_comments,c.status_name as active,ifnull(b.counts,0) as counts from vicidial_scripts a left join (select campaign_script,count(*) as counts from vicidial_campaigns group by campaign_script) b on a.script_id=b.campaign_script left join data_sys_status c on a.active=c.status and c.status_type='active' where 1=1 ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_script=mysqli_num_rows($rows);			
			
			$script_arr=array();
			$scripts_arr=array();
			if ($row_counts_script!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$script=array("script_id"=>$rs['script_id'],"script_name"=>$rs['script_name'],"script_comments"=>$rs['script_comments'],"active"=>$rs['active'],"counts"=>$rs['counts']);
					 
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
	
   	
	//验证话术是否存在
	case "check_script":
 		
		if($script_id!=""){
			$sql="select script_id from vicidial_scripts where script_id='".$script_id."' limit 0,1";
			
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_script=mysqli_num_rows($rows);			
			
			if ($row_counts_script!=0) {
 				 
				$counts="0";
				$des="该话术ID已存在，请检查更换其他！";
			}else {
				$counts="1";
				$des="";
			}
			
			mysqli_free_result($rows);
			
		}else{
			$counts="-1";
			$des="未输入话术ID！";
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;	
	
	 
	//添加、修改话术
	case "script_set":
  		
		if($do_actions=="add"){
			
			$sql="select script_id from vicidial_scripts where script_id='".$script_id."' limit 0,1";
 			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_script=mysqli_num_rows($rows);			
			mysqli_free_result($rows);
			
			if ($row_counts_script!=0) {
 				$counts="0";
				$des="该话术ID已存在，请检查更换其他！";
				
			}else {
   			
				 $sql="insert into vicidial_scripts (script_id,script_name,script_comments,active,script_text)
				  select '".$script_id."','".$script_name."','".$script_comments."','".$active."','".mysqli_real_escape_string($db_conn,re_script_info($script_text))."' from (select '".$script_id."' as script_id ) datas where not exists(select script_id from vicidial_scripts a where a.script_id=datas.script_id );";
  			 	//echo $sql;
				if(mysqli_query($db_conn,$sql)){
					
  					$counts="1";
					$des="新建话术成功！";
					
 				}else{
					$counts="0";
					$des="新建话术失败，请检查重试！";
 				}
			}
 			
		}else if($do_actions=="update"){			
			if($script_id!=""){
 				$sql="update vicidial_scripts set script_name='".$script_name."',script_comments='".$script_comments."',active='".$active."',script_text='".mysqli_real_escape_string($db_conn,re_script_info($script_text))."' where script_id='".$script_id."';";
				//echo $sql;
				if(mysqli_query($db_conn,$sql)){
  			 
 					$counts="1";
					$des="修改成功！";
				 
 				}else{
					$counts="0";
					$des="修改失败，请检查相关设置重试！";
				 
				}
				
 			}else{
				$counts="0";
				$des="修改失败，话术ID不存在！";
			}
						
		}else{
			if($script_id!=""){
				$source_script_id=trim($_REQUEST["source_script_id"]);
				
				$sql="insert into vicidial_scripts(script_id,script_name,script_comments,script_text,active)
select '".$script_id."','".$script_name."','".$script_comments."',script_text,active from vicidial_scripts where script_id='".$source_script_id."'";
 				
				if(mysqli_query($db_conn,$sql)){
					$counts="1";
					$des="话术复制成功！";
					 
				}else{
					$counts="0";
					$des="话术复制失败，系统错误，请检查重试！";
				 
				}
				
			}else{
				$counts="0";
				$des="复制失败，话术ID不存在！";
			}
 		}
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
  		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
    	
	//删除话术
  	case "del_script":
 		
		if($cid!=""){
			
			if(strpos($cid,",")>-1){
				$cid=str_replace(",","','",$cid);
				$cid="'".$cid."'";
				$where_sql=" in(".$cid.") ";
			}else{
				$where_sql=" ='".$cid."' ";
			}
 		
  			//删除话术
			$sql="delete from vicidial_scripts where script_id ".$where_sql." ";
			
			if (mysqli_query($db_conn,$sql)){
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
 		
	  	//用户资料字段获取
	case "get_field_list":
	 
		$i=0;
		$str="";
 		$list_arr=array();
 		 
		foreach($script_list_ary as $field_value =>$field_name ){
			$i+=1;
		 
			$list=array("field_name"=>"$field_name");
			
			array_push($list_arr,$list);
		}
		$counts="1";
		$des="success";
		$json_data="{";
		$json_data.="\"counts\":".$counts.",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
		$json_data.="}";
		
		echo $json_data;
		 
   		
	break;

	
    //应用话术活动列表
	case "get_script_campaign_list":
  		 
		if($script_id<>""){
 			
 			$sql1=" and campaign_script ='".$script_id."'";
 			
			$wheres=$sql1;
			//获取记录集个数
			if($do_actions=="count"){
				
				$sql="select count(*) from vicidial_campaigns a left join data_sys_status b on a.dial_method=b.status and b.status_type='dial_method' where 1=1 ".$wheres." ";
				//echo $sql;
				$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
				$counts=$rows[0];
				if(!$counts){$counts="0";}
				$des="d";
				$script_arr=array('id'=>'none');
				
			}else if($do_actions=="list"){
			
				$offset=($pages-1)*$pagesize;
				
				$sql="select campaign_id,campaign_name,campaign_description,case when active='Y' then '启用' else '禁用' end as active,auto_dial_level,campaign_cid,b.status_name from vicidial_campaigns a left join data_sys_status b on a.dial_method=b.status and b.status_type='dial_method' where 1=1 ".$wheres." ".$sort_sql." limit ".$offset.",".$pagesize." ";
				
				//echo $sql;
				
				$rows=mysqli_query($db_conn,$sql);
				$row_counts_script=mysqli_num_rows($rows);			
				
				$script_arr=array();
				$scripts_arr=array();
				if ($row_counts_script!=0) {
					while($rs= mysqli_fetch_array($rows)){ 
					 
						$script=array("campaign_id"=>$rs['campaign_id'],"campaign_name"=>$rs['campaign_name'],"campaign_description"=>$rs['campaign_description'],"active"=>$rs['active'],"auto_dial_level"=>$rs['auto_dial_level'],"campaign_cid"=>$rs['campaign_cid'],"status_name"=>$rs['status_name']);
						 
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
		
		}else{
			
			$counts="0";
			$des="未传递话术ID！";
			$script_arr=array('id'=>'none');
 		}
		$json_data="{";
		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($script_arr)."";
		$json_data.="}";
		
		echo $json_data;
	 
	break;
 	
	//获取单项问题
	case "get_scripts_all_list":
 	
		$sql="select script_id,script_name,active from vicidial_scripts order by script_name,script_id ";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		$act_y=array();
		$act_n=array();
		
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
  				
				$list=array("o_val"=>$rs['script_id'],"o_name"=>$rs['script_name']);
 				
				if ($rs["active"]=="Y"){
 					array_push($act_y,$list);
				}else{
					array_push($act_n,$list);
				}
  			}
			array_push($list_arr,array("o_name"=>"已启用","o_c_list"=>$act_y));
			array_push($list_arr,array("o_name"=>"已禁用","o_c_list"=>$act_n));
			
			$counts="1";
			$des="获取成功！";
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
	
 			
	default :
  
}


unset($list_arr);
unset($lists_arr); 
unset($json_data);
unset($sql); 
mysqli_close($db_conn);

?>