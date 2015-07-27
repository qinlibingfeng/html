<?php
require("../../inc/pub_func.php");
$auto_turn=trim($_REQUEST["auto_turn"]);
       
switch($action){
	 
    //问卷列表
	case "get_ask_list":
		
		if($s_date!=""&&$e_date!=""){
			$sql1=" and a.addtime between '".$start_date."' and '".$end_date."'";
		}
		 
		if($ask_title<>""){
 			$sql2=" and a.ask_title like '%".$ask_title."%'";
		}
		
		if($ask_des<>""){
 			$sql3=" and a.ask_des like '%".$ask_des."%'";
		} 
		
		if($yes_des<>""){
 			$sql4=" and (a.yes_des like '%".$yes_des."%' or a.no_des like '%".$yes_des."%') ";
		}
		
		if($ask_id>0){
			$wheres=" and a.ask_id='".$ask_id."'";		
		}else{
			$wheres=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sql13;
		}
 		
		//获取记录集个数
		if($do_actions=="count"){
			
			$sql="select count(*) from data_ask a left join (select ask_id,ifnull(count(*),0)as counts from data_ask_question group by ask_id order by null) b on a.ask_id=b.ask_id left join vicidial_users c on a.user=c.user where 1=1 ".$wheres." ";
			//echo $sql;
			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
			
			$sql="select a.ask_id,a.ask_title,left(a.ask_des,20) as ask_des,a.show_info,case when a.ask_type='list' then '单页列表' when a.ask_type='que' then '单题跳转' end as ask_type,a.addtime,ifnull(b.counts,0) as counts,concat(c.full_name,'[',c.user,']') as user from data_ask a left join (select ask_id,ifnull(count(*),0)as counts from data_ask_question group by ask_id order by null) b on a.ask_id=b.ask_id left join vicidial_users c on a.user=c.user where 1=1 ".$wheres." ".$sort_sql."  limit ".$offset.",".$pagesize." ";
			
 			//echo $sql;
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("ask_title"=>$rs['ask_title'],"ask_des"=>$rs['ask_des'],"show_info"=>$rs['show_info'],"ask_type"=>$rs['ask_type'],"addtime"=>$rs['addtime'],"counts"=>$rs['counts'],"user"=>$rs['user'],"ask_id"=>$rs['ask_id']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
  			
		}else if($do_actions=="all_list"){
			 
			$sql="select ask_id,ask_title,left(ask_des,20) as ask_des from data_ask where 1=1 ".$wheres." order by ask_id desc ";
			
 			//echo $sql;
 			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				 
					$list=array("ask_id"=>$rs['ask_id'],"ask_title"=>$rs['ask_title'],"ask_des"=>$rs['ask_des']);
					 
					array_push($list_arr,$list);
				}
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
				$list_arr=array('id'=>'none');
			}
			 
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
 	
	//获取本调查内问题跳转列表
	case "get_step_turn_list":
 	
		$sql="select left(case when que_type='des' then concat(que_title,que_des) else que_title end,18) as que_tit,que_title,que_id from data_ask_question where ask_id='".$ask_id."' order by que_order asc";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
				if($que_id!=$rs['que_id']){
					$list=array("que_title"=>$rs['que_title'],"que_id"=>$rs['que_id'],"que_tit"=>$rs['que_tit']);
					array_push($list_arr,$list);
				}
			}
			 
			$counts="1";
			$des="获取成功！";
		}else {
			$counts="0";
			$des="未找到符合条件的数据！";
 		}
		$list_1=array("que_title"=>"营销成功结束语","que_tit"=>"营销成功结束语","que_id"=>"yes_des");
		$list_2=array("que_title"=>"营销失败结束语","que_tit"=>"营销失败结束语","que_id"=>"no_des");
		array_push($list_arr,$list_1);
		array_push($list_arr,$list_2);
 		
  		mysqli_free_result($rows);
 		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des).",";
		$json_data.="\"datalist\":".json_encode($list_arr)."";
 		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	
 	//获取本调查内问题列表
	case "get_ask_que_list":
	
		//require('../../inc/cache.php');//必须在文件最开始处包含本页 
		//$cache = new ArrCache('cache');//设置缓存文件夹 
		//$cache->path="../../data/cache/";
 			$go_tit=trim($_REQUEST["go_tit"]);
			
 			if($go_tit==""){
				
				$sql="select que_id,que_title,que_des,que_type,postion,step_turn,case when que_type in('checkbox','radio') then 'y' else 'n' end as is_form,is_break,break_pos,break_des,form_size,is_end,que_order,b.status_name from data_ask_question a left join data_sys_status b on a.que_type=b.status and b.status_type='que_type' ";
				
			}else{
				
				$sql="select a.que_id,a.que_title,a.que_des,a.que_type,a.postion,a.step_turn,case when a.que_type in('checkbox','radio') then 'y' else 'n' end as is_form,a.is_break,a.break_pos,a.break_des,a.form_size,a.is_end,a.que_order,b.status_name,case when a.que_type in('des','text','textarea') and a.is_end!='y' then 'y' else 'n' end as is_to,case when a.step_turn='yes_des' then '成功结束语' when a.step_turn='no_des' then '失败结束语' else ifnull(left(case when c.que_type='des' then c.que_des else c.que_title end,10),'跳转目标错误') end as to_que from data_ask_question a left join data_sys_status b on a.que_type=b.status and b.status_type='que_type' left join data_ask_question c on a.step_turn=c.que_id and a.que_type in('des','text','textarea') ";
				
			}
 			
			if($do_actions=="ask"){
				
				if($que_title!=""){
					$sql_tit=" and (a.que_title like '%".$que_title."%' or a.que_des like '%".$que_title."%')";
				}else{
					$sql_tit="";
				}			
					
				$sql=$sql."where a.ask_id='".$ask_id."' ".$sql_tit." order by a.que_order asc ";
				
			}elseif($do_actions=="list"){
				$sql=$sql."where a.ask_id='".$ask_id."' order by a.que_order asc ";
				
			}elseif($do_actions=="que"){
				$sql=$sql."where a.que_id='".$que_id."'";
				
			}elseif($do_actions=="que_first"){
				$sql=$sql."where a.ask_id='".$ask_id."' order by a.que_order asc limit 0,1";
				
			}elseif($do_actions=="que_step"){
				$sql=$sql."where a.que_id='".$que_id."'";
			}
			
			$is_re=trim($_REQUEST["is_re"]);
			if($is_re==""){$is_re="n";}
			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			$lists_arr=array();
			if ($row_counts_list!=0) {
 				
				while($rs= mysqli_fetch_array($rows)){ 
					 
					if($rs["is_form"]=="y"){
						
						if($go_tit==""){
							$sql_form="select form_id,form_value,step_turn,do_func from data_ask_que_form where que_id='".$rs["que_id"]."' order by form_id asc";
						}else{
							$sql_form="select form_id,form_value,a.step_turn,do_func,case when a.step_turn='yes_des' then '成功结束语' when a.step_turn='no_des' then '失败结束语' else ifnull(left(case when b.que_type='des' then b.que_des else b.que_title end,10),'跳转目标错误') end as to_que from data_ask_que_form a left join data_ask_question b on a.step_turn=b.que_id where a.que_id='".$rs["que_id"]."' order by form_id asc";
						}
						
						$rows2=mysqli_query($db_conn,$sql_form);
						
						if(mysqli_num_rows($rows2)!=0){
							if($go_tit=="y"){
								while($rs2= mysqli_fetch_array($rows2)){ 
									$lists=array("form_id"=>$rs2['form_id'],"form_value"=>$rs2['form_value'],"step_turn"=>$rs2['step_turn'],"do_func"=>$rs2['do_func'],"to_que"=>$rs2['to_que']);
  									 
									array_push($lists_arr,$lists);
								}
								
							}else{
								while($rs2= mysqli_fetch_array($rows2)){ 
									$lists=array("form_id"=>$rs2['form_id'],"form_value"=>$rs2['form_value'],"step_turn"=>$rs2['step_turn'],"do_func"=>$rs2['do_func']);
									array_push($lists_arr,$lists);
								}
							}
							
						} 
						mysqli_free_result($rows2);
						 
					} 
					
					$list=array("que_id"=>$rs['que_id'],"que_title"=>re_info($rs['que_title'],$phone_number,$is_re),"que_des"=>nl2br(re_info($rs['que_des'],$phone_number,$is_re)),"que_type"=>$rs['que_type'],"postion"=>$rs['postion'],"step_turn"=>$rs['step_turn'],"is_break"=>$rs['is_break'],"break_pos"=>$rs['break_pos'],"break_des"=>$rs['break_des'],"form_size"=>$rs['form_size'],"is_end"=>$rs['is_end'],"que_order"=>$rs['que_order'],"status_name"=>$rs['status_name'],"form_list"=>$lists_arr);

					if($go_tit=="y"){
 						//$list_to=array("to_que"=>$rs['to_que'],"is_to"=>$rs['is_to']);
						//array_unshift($list,$list_to);
						$list["to_que"]=$rs['to_que'];
						$list["is_to"]=$rs['is_to'];
						
						//array_push($list,$list_to);
 					} 
					array_push($list_arr,$list);
					$lists_arr=array();
					
				}
				 
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据...";
			}
			mysqli_free_result($rows);
			
			
			$json_data="{";
			$json_data.="\"counts\":".json_encode($counts).",";
			$json_data.="\"des\":".json_encode($des).",";
			$json_data.="\"datalist\":".json_encode($list_arr)."";
			$json_data.="}";
			
			echo $json_data;
			
		//$cache->endCache();
		 
	break;
 	

	//获取单项问题
	case "get_que":
 	
		$sql="select que_id,que_title,que_des,que_type,postion,step_turn,case when que_type in('checkbox','radio') then 'y' else 'n' end as is_form,is_break,break_pos,break_des,form_size from data_ask_question where que_id='".$que_id."';";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);
		
		$list_arr=array();
		$lists_arr=array();
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
 				 
				if($rs["is_form"]=="y"){
					
					$sql_form="select form_id,form_value,step_turn,do_func from data_ask_que_form where que_id='".$rs["que_id"]."' order by form_id asc";	
 					$rows2=mysqli_query($db_conn,$sql_form);
					
					if(mysqli_num_rows($rows2)!=0){
						while($rs2= mysqli_fetch_array($rows2)){ 
							
							$lists=array("form_id"=>$rs2['form_id'],"form_value"=>$rs2['form_value'],"step_turn"=>$rs2['step_turn'],"do_func"=>$rs2['do_func']);
							array_push($lists_arr,$lists);
						}
					} 
					mysqli_free_result($rows2);
					 
 				} 
				$list=array("que_id"=>$rs['que_id'],"que_title"=>re_info($rs['que_title'],$phone_number,$is_re),"que_des"=>re_info($rs['que_des'],$phone_number,$is_re),"que_type"=>$rs['que_type'],"postion"=>$rs['postion'],"step_turn"=>$rs['step_turn'],"is_break"=>$rs['is_break'],"break_pos"=>$rs['break_pos'],"break_des"=>$rs['break_des'],"form_size"=>$rs['form_size'],"form_list"=>$lists_arr);
				
 				array_push($list_arr,$list);
				
				$lists_arr=array();
				
 			}
			 
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

 	
	//获取单项问题表单列表
	case "get_que_form_list":
 	
		$sql="select form_id,form_value,step_turn,do_func from data_ask_que_form where que_id='".$que_id."' order by form_id asc";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("form_id"=>$rs['form_id'],"form_value"=>$rs['form_value'],"step_turn"=>$rs['step_turn'],"do_func"=>$rs['do_func']);
				array_push($list_arr,$list);
				
 			}
			 
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
	
	//获取问卷问题类型
	case "get_que_type_list":
 	
		$sql="select status,status_name from data_sys_status where status_type='que_type' and selectable='Y'";
		
		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				$list=array("status"=>$rs['status'],"status_name"=>$rs['status_name']);
				array_push($list_arr,$list);
				
 			}
			 
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
  	
	//添加问卷
	case "ask_set":
		
		
  		
		if($do_actions=="add"){
			$sql="insert into data_ask(Ask_Title,ask_des,yes_des,no_des,postion,show_info,info_list,info_name,ask_type,User,auto_turn) values ('".mysqli_real_escape_string($db_conn,$ask_title)."','".mysqli_real_escape_string($db_conn,$ask_des)."','".mysqli_real_escape_string($db_conn,$yes_des)."','".mysqli_real_escape_string($db_conn,$no_des)."','".$postion."','".$show_info."','".mysqli_real_escape_string($db_conn,$info_list)."','".mysqli_real_escape_string($db_conn,$info_name)."','".$ask_type."','".$_SESSION["username"]."','".$auto_turn."')";
			
			if(mysqli_query($db_conn,$sql)){
				$ask_id=mysqli_insert_id($db_conn);
				//echo $que_id;
				if($ask_id!="0"){
					
					if($form_list!=""){
						$form_lists=explode("|",$form_list);
 
						foreach($form_lists as $form_value){
							$value_list=explode("#_#",$form_value);
							
							if($value_list[1]=="des"){
								$que_title="";
								$que_des=$value_list[0];
								$que_type=$value_list[1];
								$is_end=$value_list[2];
								$que_order=$value_list[3];
							}else{
								$que_title=$value_list[0];
								$que_type=$value_list[1];
								$que_des="";
								$is_end=$value_list[2];
								$que_order=$value_list[3];
							}
  							
							$qua_in_sql.="('".mysqli_real_escape_string($db_conn,$que_title)."','".mysqli_real_escape_string($db_conn,$que_des)."','".$que_type."','".$ask_id."','".$que_order."','".$is_end."'),";
							//echo $in_sql."<br>\n";
						}
						
						if($qua_in_sql){
							$in_sql="insert into data_ask_question(que_title,que_des,que_type,ask_id,que_order,is_end) values ".substr($qua_in_sql,0,-1)." ";
								
							mysqli_query($db_conn,$in_sql);
						}
						
					}
					
					$result="1";
				}
			}
 					
			if($result=="1"){
				$counts="1";
				$des="新建成功！";
			}else{
				$counts="0";
				$des="新建失败，请检查重试！";
				$que_id="0";
			}
 			
		}else{
			
			if($ask_id!=""){
				$sql="update data_ask set Ask_Title='".mysqli_real_escape_string($db_conn,$ask_title)."',ask_des='".mysqli_real_escape_string($db_conn,$ask_des)."',yes_des='".mysqli_real_escape_string($db_conn,$yes_des)."',no_des='".mysqli_real_escape_string($db_conn,$no_des)."',postion='".$postion."',show_info='".$show_info."',auto_turn='".$auto_turn."',info_list='".mysqli_real_escape_string($db_conn,$info_list)."',info_name='".mysqli_real_escape_string($db_conn,$info_name)."',ask_type='".$ask_type."' where ask_id='".$ask_id."'";
				
				if($sql!=""&&mysqli_query($db_conn,$sql)){
					$counts="1";
					$des=$des."成功！";
					$ask_id=mysqli_insert_id($db_conn);
				}else{
					$counts="0";
					$des=$des."失败，请检查相关设置重试！";
				}
 			}
		}
 		//echo $sql;
  		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
		$json_data.="\"ask_id\":".json_encode($ask_id).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
	
 	
	//修改问卷
	case "edit_ask":
  			
		$des="修改";
		
		if($do_actions=="ask_title"){
			
			$sql="update data_ask set ask_title='".$ask_title."' where ask_id='".$ask_id."'";
			
		}elseif($do_actions=="ask_des"){
			
			$sql="update data_ask set ask_des='".mysqli_real_escape_string($db_conn,$ask_des)."' where ask_id='".$ask_id."'";
			
		}elseif($do_actions=="yes_des"){
			
			$sql="update data_ask set yes_des='".mysqli_real_escape_string($db_conn,$yes_des)."' where ask_id='".$ask_id."'";
			
		}elseif($do_actions=="no_des"){
			
			$sql="update data_ask set no_des='".mysqli_real_escape_string($db_conn,$no_des)."' where ask_id='".$ask_id."'";
			
		}elseif($do_actions=="info_list"){
			
			$sql="update data_ask set show_info='".mysqli_real_escape_string($db_conn,$show_info)."',info_list='".mysqli_real_escape_string($db_conn,$info_list)."',info_name='".$info_name."' where ask_id='".$ask_id."'";
			
		}elseif($do_actions=="ask"){
			
			$sql="update data_ask set ask_title='".mysqli_real_escape_string($db_conn,$ask_title)."',ask_des='".mysqli_real_escape_string($db_conn,$ask_des)."',yes_des='".mysqli_real_escape_string($db_conn,$yes_des)."',no_des='".mysqli_real_escape_string($db_conn,$no_des)."',postion='".$postion."',auto_turn='".$auto_turn."',show_info='".$show_info."',info_list='".$info_list."',info_name='".$info_name."',ask_type='".$ask_type."' where ask_id='".$ask_id."'";
			
		}
 			
  		//echo $sql;
		
		if($sql!=""&&mysqli_query($db_conn,$sql)){
			$counts="1";
			$des=$des."成功！";
 		}else{
			$counts="0";
			$des=$des."失败，请检查相关设置重试！";
		}
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
	
 	
	//删除问卷、问题、表单
  	case "del_ask":
		 
 		if($do_actions=="ask"){
			$ask_id=$cid;
			
			if($ask_id!=""){
				
				if(strpos($ask_id,",")>-1){
					$ask_id=str_replace(",","','",$ask_id);
					$ask_id="'".$ask_id."'";
					$where_sql=" in(".$ask_id.") ";
				}else{
					$where_sql=" ='".$ask_id."' ";
				}
					
				//删除问卷表单
				$sql_1="delete from data_ask_que_form where ask_id ".$where_sql." ";
				
				//删除问卷问题
				$sql_2="delete from data_ask_question where ask_id ".$where_sql." ";
				
				//删除问卷
				$sql_3="delete from data_ask where ask_id ".$where_sql." ";
				
				
 				if (mysqli_query($db_conn,$sql_1)&&mysqli_query($db_conn,$sql_2)&&mysqli_query($db_conn,$sql_3)){
					
					//$sql_4="delete from data_ask_result where ask_id ".$where_sql." ";
					//mysqli_query($db_conn,$sql_4);
					
					$result="1";
				}else{
					$result="0";
				}
				
			}
		}else if($do_actions=="que"){
 			if($que_id!=""){
				
				if(strpos($que_id,",")>-1){
					$que_id=str_replace(",","','",$que_id);
					$que_id="'".$que_id."'";
					$where_sql=" in(".$que_id.") ";
				}else{
					$where_sql=" ='".$que_id."' ";
				}
				
				//删除问卷表单
				$sql_1="delete from data_ask_que_form where que_id".$where_sql." ";
 
 				//删除问卷问题
				$sql_2="delete from data_ask_question where que_id".$where_sql." ";
				
  				if (mysqli_query($db_conn,$sql_1)&&mysqli_query($db_conn,$sql_2)){
					$result="1";
				}else{
					$result="0";
				}
				
  			}
		}else if($do_actions=="form"){
 			if($form_id!=""){
				
				if(strpos($form_id,",")>-1){
					$form_id=str_replace(",","','",$form_id);
					$form_id="'".$form_id."'";
					$where_sql=" in(".$form_id.") ";
				}else{
					$where_sql=" ='".$form_id."' ";
				}
				
				$sql_1="delete from data_ask_que_form where form_id".$where_sql." ";
  				if (mysqli_query($db_conn,$sql_1)){
					$result="1";
				}else{
					$result="0";
				}
 			}
		}
 		//echo $sql;
		
		if($result=="1"){
			$counts="1";
			$des="删除成功！";
 		}else{
			$counts="0";
			$des="删除失败，请检查相关设置重试！";
		}
 		
 		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
 
	//问题设置
	case "set_que":
		
		if($do_actions=="add"){
			if($ask_id!=""){
				
				$sql="insert into data_ask_question(que_title,que_des,que_type,step_turn,ask_id,postion,is_break,break_pos,break_des,form_size,que_order,is_end) select  '".mysqli_real_escape_string($db_conn,$que_title)."','".mysqli_real_escape_string($db_conn,$que_des)."','".$que_type."','".$step_turn."','".$ask_id."','".$postion."','".$is_break."','".$break_pos."','".mysqli_real_escape_string($db_conn,$break_des)."','".$form_size."',ifnull((select que_order from data_ask_question where ask_id='".$ask_id."' order by que_order desc limit 0,1),0)+1 as que_order,'".$is_end."' ";
				//echo $sql."<br/>";
				if(mysqli_query($db_conn,$sql)){
					$que_id=mysqli_insert_id($db_conn);
					//echo $que_id;
					if($que_id!="0"){
						
						if($form_list!=""){
							$form_lists=explode("|",$form_list);
	 						$f_in_sql="";
							foreach($form_lists as $form_value){
								$value_list=explode("#_#",$form_value);								 
								$v_name=mysqli_real_escape_string($db_conn,$value_list[0]);
								 
								$f_in_sql.="('".$v_name."','".$v_name."','".$value_list[1]."','".$value_list[2]."','".$ask_id."','".$que_id."'),";
							}
							if($f_in_sql){
								$in_sql="insert into data_ask_que_form(form_name,form_value,step_turn,do_func,ask_id,que_id) values  ".substr($f_in_sql,0,-1)." ";
								mysqli_query($db_conn,$in_sql);
							}
						}
						
						$result="1";
					}
				}
			}
					
			if($result=="1"){
				$counts="1";
				$des="新建成功！";
			}else{
				$counts="0";
				$des="新建失败，请检查重试！";
				$que_id="0";
			}
		
		}elseif($do_actions=="edit"){
			
			if($que_id!=""){
				
				$sql="update data_ask_question set que_title='".mysqli_real_escape_string($db_conn,$que_title)."',que_des='".mysqli_real_escape_string($db_conn,$que_des)."',que_type='".$que_type."',step_turn='".$step_turn."',postion='".$postion."',is_break='".$is_break."',break_pos='".$break_pos."',break_des='".mysqli_real_escape_string($db_conn,$break_des)."',form_size='".$form_size."',is_end='".$is_end."' where que_id='".$que_id."' ";
				//echo $sql."<br/>";
				if(mysqli_query($db_conn,$sql)){
					
  					$del_sql="delete from data_ask_que_form where que_id='".$que_id."'";
					mysqli_query($db_conn,$del_sql);
					
					if($form_list!=""){
						$form_lists=explode("|",$form_list);
 						
						$f_in_sql="";
						foreach($form_lists as $form_value){
							$value_list=explode("#_#",$form_value);								 
							$v_name=mysqli_real_escape_string($db_conn,$value_list[0]);
							 
							$f_in_sql.="('".$v_name."','".$v_name."','".$value_list[1]."','".$value_list[2]."','".$ask_id."','".$que_id."'),";
						}
						
						if($f_in_sql){
							$in_sql="insert into data_ask_que_form(form_name,form_value,step_turn,do_func,ask_id,que_id) values  ".substr($f_in_sql,0,-1)."  ";
							mysqli_query($db_conn,$in_sql);
						}
 					}
					
					$result="1";
				}else{
					$result="0";
				}
				
			}else{
				$result="0";	
			}
					
			if($result=="1"){
				$counts="1";
				$des="修改成功！";
			}else{
				$counts="0";
				$des="修改失败，请检查重试！";
				$que_id="0";
			}
 			
		}elseif($do_actions=="order"){//调整问题顺序
			$order_list=trim($_REQUEST["order_list"]);
			if($order_list!=""){
				$order_lists=explode("|",$order_list);
				
 				foreach($order_lists as $order_arr){
					$orders=explode("_",$order_arr);
					$up_sql="update data_ask_question set que_order='".$orders[1]."' where que_id='".$orders[0]."'";
					mysqli_query($db_conn,$up_sql);
					//echo $in_sql."<br>\n";
				}
				
 				$counts="1";
				$des="修改排序成功！";
			}else{
				$counts="0";
				$des="修改排序失败！";
			}
		
		}
		
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
  		$json_data.="\"que_id\":".json_encode($que_id).",";
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
		
	break;
  	
  	//用户资料字段获取
	case "get_field_list":
	 
		$i=0;
		$str="";
		$is_json=trim($_REQUEST["is_json"]);
		$list_arr=array();
		if($is_json==""){
			foreach($ask_list_ary as $field_value =>$field_name ){
				$i+=1;
			 
				$str.="<a href='javascript:void(0)' class=\"field_list_1\" onclick=\"insert_field('field_$i','$field_name');\" id=\"field_$i\" title=\"点击插入：$field_name\">$field_name</a>";
		  
			}
		 
			$str.="<a href='javascript:void(0)' onclick=\"show_field_div('hide','hide')\" title=\"关闭\" class=\"close\" ></a>";
 			echo $str;
			
		}else{
			
			foreach($ask_list_ary as $field_value =>$field_name ){
				$i+=1;
			 
				$str.="<a href='javascript:void(0)' class=\"field_list_1\" onclick=\"insert_field('field_$i','$field_name');\" id=\"field_$i\" title=\"点击插入：$field_name\">$field_name</a>";
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
		 
   		}
  		
	break;
 	
	//问卷结果保存
	case "ask_save":
		$is_test=trim($_REQUEST["is_test"]);
		if($is_test=="y"){
			$counts="1";
			$des="\"保存成功！请返回原主页提交呼叫结果！\"";
 		}else{
			
			//if($phone_number!=""){
				
				if($vicidial_id==""){
					
					/*if(!$lead_id){
						$lead_sql="select lead_id from vicidial_list where user='".$user."' and list_id='5095' order by last_local_call_time desc limit 1";
					}
					
					*/
					$sel_sql="select uniqueid,lead_id from vicidial_log where lead_id='".$lead_id."' and user='".$user."' order by call_date desc limit 1";
					$rows=mysqli_fetch_row(mysqli_query($db_conn,$sel_sql));
					$vicidial_id=$rows[0];
					$v_lead_id=$rows[1];
					mysqli_free_result($rows);
					
					(!$lead_id)?$lead_id=$v_lead_id:$lead_id;
					
				}
				if($vicidial_id!=""){
					$del_sql="delete from data_ask_result where vicidial_id='".$vicidial_id."'";
					mysqli_query($db_conn,$del_sql);
				}
 				
				foreach($_POST as $Tag_Name=>$Tag_Value){
		
					if(strpos($Tag_Name,"ask_")>-1&&$Tag_Name!="ask_id"&&$Tag_Value!=""){
						
						$vals="";
						if(is_array($Tag_Value)){
							
							foreach($Tag_Value as $val){
								$vals .= "".$val.",";
							}
							$vals = rtrim($vals,",");
							
							$insql.="('".$Tag_Name."','".mysqli_real_escape_string($db_conn,$vals)."','".$list_id."','".$lead_id."','".$vicidial_id."','".$campaign_id."','".$user."','".$ask_id."','".str_replace("ask_","",$Tag_Name)."','".$phone_number."'),";
							
						}else{
							
							$insql.="('".$Tag_Name."','".mysqli_real_escape_string($db_conn,$Tag_Value)."','".$list_id."','".$lead_id."','".$vicidial_id."','".$campaign_id."','".$user."','".$ask_id."','".str_replace("ask_","",$Tag_Name)."','".$phone_number."'),";
						}
						
					}	
				}
				
				$counts="1";
				if($insql!=""){
 					$in_result_sql="insert into data_ask_result(form_name,form_value,list_id,lead_id,vicidial_id,campaign_id,user,ask_id,que_id,phone_number) values ".substr($insql,0,-1)."";
					if(mysqli_query($db_conn,$in_result_sql)){
						$counts="1";
 					}else{
						$counts="0";
 					}
 				}
 			
				if($counts=="1"){
					$counts="1";
					$des="\"保存成功！请返回原主页提交呼叫结果！\"";
				 	 
 					foreach($ask_list_ary as $field_v=>$field_n){
						unset($_SESSION[$field_v."_".$phone_number]);
					} 
 					
				}else{
					$counts="0";
					$des="\"保存失败！请返回检查重试！\"";
					
					$fp = fopen("./ask_result_his.txt","a"); 
					
					fwrite($fp,$in_result_sql."\n"); 
					fclose($fp);
					
				}
				
			//}else{
			//	$counts="1";
			//	$des="\"本次结果未收到拨打号码信息，保存失败！\"";	
			//}
		}
		
		$json_data="{";
		$json_data.="\"counts\":".$counts.",";
		$json_data.="\"des\":".$des."";
		$json_data.="}";
		
		echo $json_data;
		
	break;
	
	//调查结果导出
	case "ask_result_export":
		$que_field_1=trim($_REQUEST["que_field_1"]);
		$que_field_2=trim($_REQUEST["que_field_2"]);
		$is_ask_result=trim($_REQUEST["is_ask_result"]);
		
		if($is_ask_result=="y"){
			$join_table="inner";
			$group_field="b.vicidial_id,b.lead_id";
			$g_uniqueid=",a.uniqueid";
		}else{
			$join_table="left";	
			$group_field="a.uniqueid,a.lead_id";
			$g_uniqueid="";
		}
		
		if($que_field_1==""||$que_field_2==""){
			if($que_id!=""){
				if(strpos($que_id,",")>-1){
					$que_id=str_replace(",","','",$que_id);
					$que_id="'".$que_id."'";
					$where_sql=" que_id in(".$que_id.") ";
				}else{
					$where_sql=" que_id='".$que_id."' ";
				}
			}else{
				$where_sql=" ask_id='".$ask_id."' ";	
			}
			
			$sql="select que_id,left(que_title,30) as que_title,que_order from data_ask_question where ".$where_sql." and Que_Type!='des' order by que_order asc";
			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			$list_arr=array();
			 
			$field_name_list=array("被叫号码","坐席工号","业务活动","呼叫结果","质检结果","呼叫时间","操作");
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
				
					$que_field_1.=",max(case when que_id='".$rs["que_id"]."' then form_value end) as `".$rs['que_title']."_Q".$rs['que_order']."`";
					$que_field_2.=",a.`".$rs["que_title"]."_Q".$rs['que_order']."` ";
					if($do_actions=="count"){					
						array_push($field_name_list,$rs["que_title"]."_Q".$rs['que_order']);
					}
				}
				$que_field_1.=",max(case when que_id='calldes' then form_value end) as `呼叫备注描述`";
				$que_field_2.=",a.`呼叫备注描述`";
				
				if($do_actions=="count"){					
					array_push($field_name_list,"呼叫备注描述");
				}
				 
				$counts="1";
				$des="获取成功！";
			}else {
				$counts="0";
				$des="未找到符合条件的数据！";
			}
			
			mysqli_free_result($rows);
			//echo $que_field_2."<br>";
		}
		
 		$sql1=" a.call_date between '".$start_date."' and '".$end_date."' ";
		
		if($campaign_id<>""){
			if(strpos($campaign_id,",")>-1){
				$campaign_id=str_replace(",","','",$campaign_id);
				$campaign_id="'".$campaign_id."'";
 				$sql2_11=" and a.campaign_id in(".$campaign_id.") ";
				 
			}else{
 				$sql2_11=" and a.campaign_id ='".$campaign_id."' ";
 			}
		}
		
		
		if($agent_list<>""){
			if(strpos($agent_list,",")>-1){
 				$agent_list=str_replace(",","','",$agent_list);
				$agent_list="'".$agent_list."'";
 				$sql3_11=" and a.user in(".$agent_list.")";
				 
			}else{
 				$sql3_11=" and a.user ='".$agent_list."'";
				 
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
 			$sql4_11=" and a.phone_number ".$exist_sql;
		}
  
		if($phone_lists<>""){
			if(strpos($phone_lists,",")>-1){
				$phone_lists=str_replace(",","','",$phone_lists);
				$phone_lists="'".$phone_lists."'";
 				$sql5_11=" and a.list_id in(".$phone_lists.") ";
			}else{
 				$sql5_11=" and a.list_id = '".$phone_lists."' ";
			}
		}
 		
		if($status<>""){
			if(strpos($status,",")>-1){
				$status=str_replace(",","','",$status);
				$status="'".$status."'";
 				$sql6_11=" and a.status in(".$status.") ";
			}else{
 				$sql6_11=" and a.status ='".$status."' ";
 			}
		}
		
 		if($quality_status<>""){
			if(strpos($quality_status,",")>-1){
				$quality_status=str_replace(",","','",$quality_status);
				$quality_status="'".$quality_status."'";
 				$sql7_11=" and a.quality_status in(".$quality_status.") ";
			}else{
 				$sql7_11=" and a.quality_status ='".$quality_status."' ";
			}
		}
  		
 		$wheres_2=$sql1.$sql2_11.$sql3_11.$sql4_11.$sql5_11.$sql6_11.$sql7_11;
 		
		//获取记录集个数
		if($do_actions=="count"){
			
 			$sql="select count(*) from (select ".$group_field.$g_uniqueid.",a.status,a.campaign_id,a.user,a.quality_status from vicidial_log a ".$join_table." join data_ask_result b on b.vicidial_id=a.uniqueid and a.lead_id=b.lead_id and b.ask_id='".$ask_id."' where ".$wheres_2." group by ".$group_field.")a left join vicidial_users b on a.user=b.user left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status  and e.status_type='call_status' left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id";
			//echo $sql;
 			$rows=mysqli_fetch_row(mysqli_query($db_conn,$sql));
			$counts=$rows[0];
			if(!$counts){$counts="0";}
			$des="d";
			$list_arr=array('id'=>'none');
   			
		}else if($do_actions=="list"){
		
			$offset=($pages-1)*$pagesize;
		 
 			//$sql="concat(a.uniqueid,'|',a.lead_id,'|',ifnull(".$record_location.",'')) as '操作'"
			//where a.call_date between '".$start_date."' and '".$end_date."'".$wheres_2."
			
			$sql="select a.phone_number as '被叫号码',ifnull(concat(b.full_name,' [',b.user,']'),concat('未知工号 [',a.user,']')) as '坐席工号',concat(ifnull(h.campaign_name,'未知业务'),' [',a.campaign_id,']') as '业务活动',e.status_name as '呼叫结果',g.status_name as '质检结果',a.call_date as '呼叫时间',a.uniqueid,a.lead_id,".$record_location." as localtion ".$que_field_2." from (select ".$group_field.$g_uniqueid.",a.call_date,a.phone_number,a.status,a.campaign_id,a.user,a.quality_status ".$que_field_1." from vicidial_log a ".$join_table." join data_ask_result b on b.vicidial_id=a.uniqueid and a.lead_id=b.lead_id and b.ask_id='".$ask_id."'  where ".$wheres_2." group by ".$group_field." ".$sort_sql." limit ".$offset.",".$pagesize." )a left join vicidial_users b on a.user=b.user left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status  and e.status_type='call_status' left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id ";
 			 
			$list=array();
 		 	$list_arr=array();			 
 			
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);
			$field_count=mysqli_num_fields($rows);
			$fields = mysqli_fetch_fields($rows);
 			
			if ($row_counts_list!=0) {
 				 
				while($rs= mysqli_fetch_array($rows)){ 
					
					$list=array_merge($list,array("被叫号码"=>$rs["被叫号码"]));
					$list=array_merge($list,array("坐席工号"=>$rs["坐席工号"]));
					$list=array_merge($list,array("业务活动"=>$rs["业务活动"]));
					$list=array_merge($list,array("呼叫结果"=>$rs["呼叫结果"]));
					$list=array_merge($list,array("质检结果"=>$rs["质检结果"]));
					$list=array_merge($list,array("呼叫时间"=>$rs["呼叫时间"]));
					$list=array_merge($list,array("操作"=>$rs["uniqueid"]."|".$rs["lead_id"]."|".$rs["localtion"]));
					
					for ($k=9;$k<$field_count;$k++){					 
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
  			 
		}else if($do_actions=="excel"){
			 
			$field_list=str_replace("·","'",trim($_REQUEST["field_list"]));
			 
			if($field_list<>""){
				
				$field_sql=",".$field_list;
				
				if(strpos($field_list,"i.dtmf_key")>-1){ 
						$g_left_sql=" left join (select dtmf_key,uniqueid from (select GROUP_CONCAT(dtmf_key) as dtmf_key,uniqueid from data_dtmf_log where dtmf_time between '".$start_date."' and '".$end_date."' group by uniqueid) tmp_dtmf ) i on a.uniqueid=i.uniqueid ";
					}
  				
				$sql="select a.phone_number as '被叫号码'".$field_sql.$que_field_2." from (select ".$group_field.$g_uniqueid.",a.call_date,a.phone_number,a.status,a.campaign_id,a.user,a.quality_status,a.call_des,a.talk_length_sec,a.length_in_sec,a.comments ".$que_field_1." from vicidial_log a ".$join_table." join data_ask_result b on b.vicidial_id=a.uniqueid and a.lead_id=b.lead_id and b.ask_id='".$ask_id."' where ".$wheres_2." group by ".$group_field." order by null)a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status  and e.status_type='call_status' left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join vicidial_campaigns h on a.campaign_id=h.campaign_id ".$g_left_sql." ".$sort_sql." ";
  				
			}else{
				
				$sql="select a.phone_number as '被叫号码',ifnull(concat(b.full_name,' [',b.user,']'),concat('未知工号 [',a.user,']')) as '坐席工号',ifnull(h.campaign_name,concat('未知业务 [',a.campaign_id,']')) as '业务活动',e.status_name as '呼叫结果',g.status_name as '质检结果',a.call_date as '呼叫时间'".$que_field_2." from (select ".$group_field.$g_uniqueid.",a.call_date,a.phone_number,a.status,a.campaign_id,a.user,a.quality_status,a.call_des,a.talk_length_sec,a.comments ".$que_field_1." from vicidial_log a ".$join_table." join data_ask_result b on b.vicidial_id=a.uniqueid and a.lead_id=b.lead_id and b.ask_id='".$ask_id."' where ".$wheres_2." group by ".$group_field." order by null)a left join vicidial_users b on a.user=b.user left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_sys_status e on a.status=e.status  and e.status_type='call_status' left join data_sys_status g on a.quality_status=g.status and g.status_type='qua_status' left join vicidial_campaigns h on a.campaign_id=h.campaign_id  ".$sort_sql." ";

			}
   			//echo $sql."<br><br>";
			echo json_encode(save_detail_excel($sql,"问卷结果详单",$file_type));
			//echo $aa[0];
  		}
		
  		if($do_actions<>"excel"){
 			mysqli_free_result($rows);
		
 			$json_data="{";
			$json_data.="\"counts\":".json_encode($counts).",";
			$json_data.="\"des\":".json_encode($des).",";
			
			if($do_actions=="count"){
		 		$json_data.="\"field_name_list\":".json_encode($field_name_list).",";
				$json_data.="\"que_field_1\":".json_encode($que_field_1).",";
				$json_data.="\"que_field_2\":".json_encode($que_field_2).",";
			}
			$json_data.="\"datalist\":".json_encode($list_arr)."";
			$json_data.="}";
			
			echo $json_data;
 		}
 		
	break;
  	
	//获取单条问卷结果详单
	case "get_ask_result_one":
 		
		if($vicidial_id!=""){
			 
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
 	
	//获取单条问卷结果详单
	case "get_ask_result_callback":
 		
		if($lead_id!=""){
			 
			$sql="select a.que_id,a.form_value from data_ask_result a inner join(select max(vicidial_id) as vicidial_id from data_ask_result where  ask_id='".$ask_id."' and lead_id='".$lead_id."' )b on a.vicidial_id=b.vicidial_id left join data_ask_question c on a.que_id=c.que_id order by c.que_order";
 			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
 			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){
 					$list=array("que_id"=>$rs['que_id'],"form_value"=>$rs['form_value']);
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
	
	//获取当前客户清单所属成功统计
	case "get_ask_list_count":
 		
		if($campaign_id!=""){
			 
			$sql="select a.list_id,b.list_name,sum(case when a.status='CG' then 1 else 0 end) as counts from vicidial_list a inner join vicidial_lists b on a.list_id=b.list_id and b.campaign_id='".$campaign_id."' group by a.list_id;";
 			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
 			$list_arr=array();
			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){
 					$list=array("list_id"=>$rs['list_id'],"list_name"=>$rs['list_name'],"counts"=>$rs['counts']);
					array_push($list_arr,$list);
 				}
				 
				$counts="1";
				$des=""; 
			}else {
				$counts="0";
				$des="no_data";
			}
 			
			mysqli_free_result($rows);
			
			$sql="select count(*) as login_count,sum(case when status='INCALL' then 1 else 0 end) as incall_count from vicidial_live_agents where campaign_id='".$campaign_id."'";
 			//echo $sql;
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
 			 
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){
 					$login_count=$rs['login_count'];
					$incall_count=$rs['incall_count'];
					if($incall_count==""){$incall_count=0;}
  				}
 			}else{
				$login_count=0;
				$incall_count=0;
 			}
 			mysqli_free_result($rows);
			
 		}else{
			
			$counts="0";
			$des="error";
			$login_count=0;
			$incall_count=0;
		}
		$json_data="{";
 		$json_data.="\"counts\":".json_encode($counts).",";
 		$json_data.="\"des\":".json_encode($sql).",";
		$json_data.="\"cg_list\":".json_encode($list_arr).",";
		$json_data.="\"login_count\":".json_encode($login_count).",";
		$json_data.="\"incall_count\":".json_encode($incall_count)."";
 		$json_data.="}";
		
		echo $json_data;
 		
	break;
	
	
	//质检与问卷结果修改
	case "ask_result_up_qua":
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
		$vendor_lead_code=trim($_REQUEST["vendor_lead_code"]);
		$security_phrase=trim($_REQUEST["security_phrase"]);
		$isedit=trim($_REQUEST["isedit"]);
		$call_date=trim($_REQUEST["call_date"]);
		$old_call_date=trim($_REQUEST["old_call_date"]);
		$recording_id=trim($_REQUEST["recording_id"]);
		$qua_id=trim($_REQUEST["qua_id"]);
		$call_des=trim($_REQUEST["call_des"]);
		
		if($form_list!=""){
			$form_lists=explode("|",$form_list);

			foreach($form_lists as $form_value){
				$value_list=explode("#_#",$form_value);
				$v0=$value_list[0];
				$v1=$value_list[1];
				$v2=$value_list[2];
				$v3=$value_list[3];
				
				if($v1=="N"){
					if($v0!=""){
						$insql.="('ask_".$v2."','".mysqli_real_escape_string($db_conn,$v0)."','".$list_id."','".$lead_id."','".$uniqueid."','".$campaign_id."','".$user."','".$ask_id."','".$v2."','".$v3."'),";
						
					}
					 
 				}else{
 					$up_sql="update data_ask_result set form_value='".mysqli_real_escape_string($db_conn,$v0)."' where id=".$v1."";
					mysqli_query($db_conn,$up_sql);
				}
 			}
		}
 		
		if($insql!=""){
			$in_result_sql="insert into data_ask_result(form_name,form_value,list_id,lead_id,vicidial_id,campaign_id,user,ask_id,que_id,call_date) values ".substr($insql,0,-1)."";
			mysqli_query($db_conn,$in_result_sql);	
		}
		
		if($isedit=="yes"){
			$list_upsql=",title='".$title."',first_name='".$first_name."',middle_initial='".$middle_initial."',last_name='".$last_name."',address1='".$address1."',address2='".$address2."',address3='".$address3."',city='".$city."',state='".$state."',postal_code='".$postal_code."',province='".$province."',gender='".$gender_list."',alt_phone='".$alt_phone."',email='".$email."',security_phrase='".$security_phrase."',vendor_lead_code='".$vendor_lead_code."',date_of_birth='".$date_of_birth."',comments='".$comments."'";
		}
 
		if($uniqueid<>""){
			
			if($quality_status<>""){
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
					
					//$in_fee_log="insert into data_report_fee_log_list(call_date,campaign_id,list_id,user,status,counts,fee_length_sec,max_fee_length_sec) select left(a.call_date,13),a.campaign_id,a.list_id,a.user,a.status,count(*),sum(case when b.lead_id is not null then a.talk_length_sec else 0 end),ifnull(max(case when b.lead_id is not null then a.talk_length_sec else 0 end),0) from vicidial_log a left join ".$fee_data_table." b on a.lead_id=b.lead_id and TIMESTAMPDIFF(second,a.call_date,b.call_date) between -5 and 120  and b.dialstatus='ANSWER' where a.call_date BETWEEN '".$event_time.":00:00' and '".$event_time.":59:59' and a.user='".$user."' group by left(a.call_date,13),a.campaign_id,a.list_id,a.user,a.status; ";
					$in_fee_log="insert into data_report_fee_log_list(call_date,campaign_id,list_id,user,status,counts,fee_length_sec,fee,max_fee_length_sec,max_fee) select left(call_date,13),campaign_id,list_id,user,status,count(*),sum(talk_length_sec ),sum(ceil(talk_length_sec/60)*0.07),ifnull(max(talk_length_sec ),0),max(ceil(talk_length_sec/60)*0.07) from vicidial_log where call_date BETWEEN '".$event_time.":00:00' and '".$event_time.":59:59' and user='".$user."' group by left(call_date,13),campaign_id,list_id,user,status; ";
					
					mysqli_query($db_conn,$in_fee_log); 
					
					//echo  $in_call_log."<br>";
 				}
   				
				//mysqli_free_result($rows_qua);
   				$counts="1";
				$des="质检结果提交成功！";
 				
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
		 
 		$json_data.="\"des\":".json_encode($des)."";
  		$json_data.="}";
		
		echo $json_data;
	
	break;
	
	case "get_ask_all_list":
 		
		$o_val_type=trim($_REQUEST["o_val_type"]);
		
		$sql="select ask_id,ask_title from data_ask order by ask_id";
 		//echo $sql;
		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
		
		$list_arr=array();
		 
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
			
				if($o_val_type==""||$o_val_type=="ask_url"){
					$o_val="http://".$_SERVER["HTTP_HOST"]."/document/ask_flow/ask_sub.php?ask_id=".$rs['ask_id'];
				}else{
					$o_val=$rs['ask_id'];
				}
				$list=array("o_val"=>$o_val,"o_name"=>$rs['ask_title']);
				array_push($list_arr,$list);
  			}
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