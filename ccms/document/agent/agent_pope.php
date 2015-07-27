<?php 
require("../../inc/pub_func.php"); 
require("../../inc/pub_set.php"); 
$tits=trim($_REQUEST["tits"]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title><?php echo $system_name ?></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script>
function get_pope_group(group_id){
	
	var datas="action=get_pope_group&group_id="+group_id+times;
	$("#form1 :checkbox[name^='pope']").attr("checked",false);
	$("#form_menu_pope,#form_menu_reset").off("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
	 
	if(group_id!=""){
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 
			   if(json.counts=="1"){
				   
					$("#form_menu_pope").off("click").on("click",function(){
						do_set_pope_group();	
					});
				   $("#form_menu_pope,#form_menu_reset").attr("disabled",false).css({"cursor":"pointer","color":""});
				   
				   $(".search_text_zone span").removeClass("blue");
				   $.each(json.datalist,function(index,con){
					    
						$("#pope_"+con.superid+"_"+con.popeid).attr("checked","checked").parent().addClass("blue");
						$("#pope_item_"+con.superid).attr("checked","checked");
				   });
			   } 
			  
			} 
		});
	}
} 
 

function get_task_user(task_id){
	
	var datas="action=get_task_user&task_id="+task_id+times;
	$("#form2 :checkbox[name^='agents']").attr("checked",false);
	$("#form_task_pope,#form_task_reset").off("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
	if(task_id!=""){
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 
			   if(json.counts=="1"){
				   
					$("#form_task_pope").off("click").on("click",function(){
						do_set_task_user();	
					});
				   $("#form_task_pope,#form_task_reset").attr("disabled",false).css({"cursor":"pointer","color":""});
				   $.each(json.datalist,function(index,con){
					    
						$("#form2 #agents_item_"+con.dept_id+"_"+con.user_id).attr("checked","checked");
 				   });
			   } 
			  
			} 
		});
	}
} 

function do_set_task_user(do_actions){
   	var user_list="";
 	$('#form2 input[name="agents"]:enabled:checked').each(function(i){
		 
		 var user_id=$(this).val();
 		 user_list+=user_id+",";
  		 
   	}); 
  	
 	if (user_list!=""){
		user_list=user_list.substr(0,user_list.length-1);
 	}else{
		 if(confirm("当前业务还未选择设置使用人员工号！\n\n您确定不设置吗？")){}else{return false;}
  	}
	
 	$('#load').show();
	var datas="action=task_pope_set&do_actions="+do_actions+"&task_id="+$("#task_id").val()+"&user_list="+user_list+times;
 	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			request_tip(json.des,json.counts);
  			if(json.counts=="1"){
  				 
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}

 
function get_user_user(user_id){
	
	var datas="action=get_user_user&user_id="+user_id+times;
	$("#form3 :checkbox[name^='agents3']").attr("checked",false);
	$("#form_user_pope,#form_user_reset").off("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
	if(user_id!=""){
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 
			   if(json.counts=="1"){
				    
					$("#form_user_pope").off("click").on("click",function(){
						do_set_user_user();	
					});
					 
				   $("#form_user_pope,#form_user_reset").attr("disabled",false).css({"cursor":"pointer","color":""});
				   $.each(json.datalist,function(index,con){
					     
						$("#form3 #agents3_item_"+con.dept_id+"_"+con.acc_id).attr("checked","checked");
 				   });
			   } 
			  
			} 
		});
	}
} 

function do_set_user_user(do_actions){
   	var user_list="";
 	$('#form3 input[name="agents3"]:enabled:checked').each(function(i){
 		 var user_id=$(this).val();
 		 user_list+=user_id+",";
	}); 
  	
 	if (user_list!=""){
		user_list=user_list.substr(0,user_list.length-1);
 	}else{
		 if(confirm("当前用户还未选择设置可查看的人员工号！\n\n您确定不设置吗？")){}else{return false;}
  	}
	
 	$('#load').show();
	var datas="action=user_pope_set&do_actions="+do_actions+"&user_id="+$("#user_id").val()+"&user_list="+user_list+times;
 	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			request_tip(json.des,json.counts);
  			if(json.counts=="1"){
  				 
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
}
 

function do_set_pope_group(do_actions){
   	var pope_list="";
 	$('#form1 input[name="popeid"]:enabled:checked').each(function(i){
 		 var pope_id=$(this).val();
		 var super_id=$(this).attr("pid");
		 pope_list+=pope_id+"_"+super_id+",";
	}); 
  	
 	if (pope_list!=""){
		pope_list=pope_list.substr(0,pope_list.length-1);
 	}else{
		 if(confirm("当前用户组还未选择权限菜单！\n\n您确定不设置吗？")){}else{return false;}
  	}
	
 	$('#load').show();
	var datas="action=pope_group_set&do_actions="+do_actions+"&group_id="+$("#group_id").val()+"&pope_list="+pope_list+times;
 	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			request_tip(json.des,json.counts);
   			if(json.counts=="1"){
  			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}  

function hide_pope(pope_){
	$(".pope_list_").not("#"+pope_).fadeOut("fast");
	$("#"+pope_).fadeIn("fast");
}
 
$(document).ready(function(){
	$("#form_menu_pope,#form_menu_reset,#form_task_pope,#form_task_reset,#form_user_pope,#form_user_reset").off("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
	
 	$(".alt_list tr:even").addClass("alt");
	hide_pope("pope_set");
	
	$(".check_items input[type=checkbox]").click(function(){if(this.checked==true){$(this).parent().addClass("blue")}else{$(this).parent().removeClass("blue")}});
	//$("#pope_set").hide();
});
   
 </script>
 </head>
 <body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<div class="page_main">
   <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
    <tr>
       <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' taonex='-1' onselectstart='return false' priv="true" onclick="hide_pope('pope_set');" title="菜单权限设置"><img src="/images/icons/icon022a6.gif" /><b>菜单权限设置&nbsp;</b></a><!--<a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' taonex='-1' onselectstart='return false' priv="true" onClick="hide_pope('task_set');" title="可呼叫、查询业务权限设置"><img src="/images/icons/icon022a7.gif" /><b>业务权限&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' taonex='-1' onselectstart='return false' priv="true" onClick="hide_pope('user_set');" title="可查看人员权限设置"><img src="/images/icons/icon021a11.gif" /><b>人员权限&nbsp;</b></a>--></td>
     </tr>
  </table>
   <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
    <tr>
       <td style=""><fieldset class="pope_list_" id="pope_set">
           <legend>
          <input type="checkbox" id="pope" name="pope_all" parentid="pope_all" value="" onclick="CheckItemsAll('form1','pope')" />
          <label for="pope" >菜单权限设置</label>
          </legend>
           <select name="group_id" id="group_id" onchange="get_pope_group(this.value)" >
            <option value=''>请选择设置用户组</option>
            <?php 
                                        
                $sql="select user_group,group_name from vicidial_user_groups order by group_name";
                
                $rows=mysqli_query($db_conn,$sql);
                $row_counts_list=mysqli_num_rows($rows);			
                
                if ($row_counts_list!=0) {
                    while($rs= mysqli_fetch_array($rows)){ 
                        $option.="<option value='".$rs["user_group"]."'>".$rs["group_name"]."</option>\n";
                    }
                 
                }else {
                    $option="<option value=''>系统当前未添加用户组</option>";
                }
                echo $option;
                mysqli_free_result($rows);
            ?>
          </select>
           <form action="" method="post" name="form1" id="form1">
            <input name="form_menu_pope" type="button" id="form_menu_pope"  style="cursor:pointer"  value="提交保存" />
            <input type="reset" name="form_menu_reset" id="form_menu_reset" value="重置" />
            <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
               <tr>
                <td align="left" valign="top" class="search_text_zone"><?php
			  
	    $sql="select popeid,popename,popelink,superid,linktarget,popeimg,icoclass,icoinfo from data_pope_list where isactive='1' and SuperID='0' order by popeid ";
		
		$rows=mysqli_query($db_conn,$sql);
		$row_counts=mysqli_num_rows($rows);
 
 		if ($row_counts!=0) {
	?>
                   <table width="100%" border=0 cellpadding=2 cellspacing=0>
                    <?php 
			while($rs= mysqli_fetch_array($rows)){ 
		?>
                    <tr >
                       <td width="30%" height="24" align="left" class="deepgreen"><label for="pope_item_<?php echo $rs["popeid"]; ?>" onclick="CheckItemsAll('form1','pope_item_<?php echo $rs["popeid"]; ?>');">
                           <input type="checkbox" id="pope_item_<?php echo $rs["popeid"]; ?>" name="pope_item" value="<?php echo $rs["popeid"]; ?>" parentid="pope_<?php echo $rs["popeid"]; ?>" >
                           <?php echo $rs["popename"]; ?></label></td>
                       <td width="76%" align="left" class="check_items"><ul>
                           <?php       	
		
							$sqls="select popeid,popename,popelink,superid,linktarget,popeimg,icoclass,icoinfo from data_pope_list where isactive='1' and SuperID='".$rs["popeid"]."' order by popeid asc";
							$rows2=mysqli_query($db_conn,$sqls);
							
							if(mysqli_num_rows($rows2)!=0){
								while($rs2= mysqli_fetch_array($rows2)){ 
						 ?>
                           <li><span>
                             <input type="checkbox" parentid="pope_item_<?php echo $rs["popeid"]; ?>" id="pope_<?php echo $rs["popeid"]; ?>_<?php echo $rs2["popeid"]; ?>" pid="<?php echo $rs["popeid"]; ?>" name="popeid" value="<?php echo $rs2["popeid"]; ?>" onclick="CheckItems('form1','pope_<?php echo $rs["popeid"]; ?>','pope_item_<?php echo $rs["popeid"]; ?>');">
                             <label for="pope_<?php echo $rs["popeid"]; ?>_<?php echo $rs2["popeid"]; ?>"><?php echo $rs2["popename"]; ?></label>
                             </span> </li>
                           <?php 
									}
								} 
								mysqli_free_result($rows2);
						   ?>
                         </ul></td>
                     <tr>
                       <?php 
	  
						}
					 
					  ?>
                   </table>
                   <?php	
	 
					}else {
						 echo "当前系统没有可选操作菜单！";
					}
					mysqli_free_result($rows);
				 ?></td>
              </tr>
             </table>
          </form>
         </fieldset>
        <fieldset class="pope_list_" id="task_set">
           <legend>
          <label> 业务权限设置</label>
          </legend>
           <form action="" method="post" name="form2" id="form2">
   <?php   
      function get_agent_list($form_id,$a_id){
		
		global $db_conn;
			
		$sql="select dept_id,dept_name,ifnull(b.counts,0) as counts from data_dept a left join (select acc_dept,count(*) as counts from TX_ACCOUNT group by acc_dept) b on a.dept_id=b.acc_dept ";
		
		$rows=mysqli_query($db_conn,$sql);
		$row_counts=mysqli_num_rows($rows);
		
 		if ($row_counts!=0) {
	?>
            <table width="100%" border=0 cellpadding=0 cellspacing=2>
               <?php 
			while($rs= mysqli_fetch_array($rows)){ 
				if($rs["counts"]!="0"){
		?>
               <tr >
                <td width="14%" height="20" align="left" class="green"><label for="<?php echo $a_id ?>_item_<?php echo $rs["dept_id"]; ?>" onclick="CheckItemsAll('<?php echo $form_id; ?>','<?php echo $a_id ?>_item_<?php echo $rs["dept_id"]; ?>');">
                    <input type="checkbox" id="<?php echo $a_id ?>_item_<?php echo $rs["dept_id"]; ?>" name="<?php echo $a_id ?>_item" value="<?php echo $rs["dept_id"]; ?>" parentid="<?php echo $a_id ?>_<?php echo $rs["dept_id"]; ?>" >
                    <?php echo $rs["dept_name"]; ?></label></td>
                <td width="86%" align="left" class="check_items"><ul>
                    <?php       	
		
			$sqls="select acc_id,acc_name from TX_ACCOUNT where acc_dept='".$rs["dept_id"]."' order by acc_id";
			$rows2=mysqli_query($sqls,$db_conn);
			
			if(mysqli_num_rows($rows2)!=0){
				while($rs2= mysqli_fetch_array($rows2)){ 
		 ?>
                    <li><span>
                      <input type="checkbox" parentid="<?php echo $a_id ?>_item_<?php echo $rs["dept_id"]; ?>" id="<?php echo $a_id ?>_item_<?php echo $rs["dept_id"]; ?>_<?php echo $rs2["acc_id"]; ?>" onclick="CheckItems('<?php echo $form_id; ?>','<?php echo $a_id ?>_<?php echo $rs["dept_id"]; ?>','<?php echo $a_id ?>_item_<?php echo $rs["dept_id"]; ?>');" name="<?php echo $a_id ?>" value="<?php echo $rs2["acc_id"]; ?>">
                      <label for="<?php echo $a_id ?>_item_<?php echo $rs["dept_id"]; ?>_<?php echo $rs2["acc_id"]; ?>"><?php echo $rs2["acc_name"]; ?> [<?php echo $rs2["acc_id"]; ?>]</label>
                      </span></li>
                    <?php 
 				}
				
			} 
			mysqli_free_result($rows2);
	   ?>
                  </ul></td>
              <tr>
                <?php 
	  		}
		}
	 
	  ?>
            </table>
            <?php	
	 
		}else {
			 echo "当前系统没有授权工号！";
		}
		mysqli_free_result($rows);
	}
 ?>
            <table width="100%" border="0" cellpadding="2" cellspacing="0" >
               <tr>
                <td width="16%" height="30" align="right">授权业务：</td>
                <td height="30"><select name="task_id"  id="task_id" onchange="get_task_user(this.value)">
                    <option value="">请选择授权业务</option>
                    <?php 
                                                
                        /*$sql="select task_id,task_name from TX_OUTCALL_TASKS order by task_name desc";
                        
                        $rows=mysqli_query($db_conn,$sql);
                        $row_counts_list=mysqli_num_rows($rows);			
                        $option="";
                        if ($row_counts_list!=0) {
                            while($rs= mysqli_fetch_array($rows)){ 
                                $option.="<option value='".$rs["task_id"]."'>".$rs["task_name"]."</option>\n";
                            }
                         
                        }else {
                            $option="<option value=''>系统当前未添加业务</option>";
                        }
                        echo $option;
                        mysqli_free_result($rows);*/
                    ?>
                  </select></td>
              </tr>
               <tr>
                <td height="30" align="right">人员工号
                   <input type="checkbox" id="agents" name="" parentid="agents_" value="" onclick="CheckItemsAll('form2','agents')" />
                   ：</td>
                <td height="30"><div class='treeContainer'>
                    <div class="treeItem">
                      <?php //get_agent_list("form2","agents")?>
                    </div>
                  </div></td>
              </tr>
               <tr>
                <td width="16%" height="30" align="right">&nbsp;</td>
                <td height="30"><input type="button" name="form_task_pope" id="form_task_pope" value="提交保存"  style="cursor:pointer" >
                   <input type="reset" name="form_task_reset" id="form_task_reset" value="重置" /></td>
              </tr>
             </table>
          </form>
         </fieldset>
        <fieldset class="pope_list_" id="user_set">
           <legend>
          <label>可查看人员权限设置</label>
          </legend>
           <form action="" method="post" name="form3" id="form3">
            <table width="100%" border="0" cellpadding="2" cellspacing="0" >
               <tr>
                <td width="16%" height="30" align="right">人员工号：</td>
                <td height="30"><select name="user_id"  id="user_id" onchange="get_user_user(this.value)">
                    <option value="">请选择须设置的人员工号</option>
                    <?php 
                                                
                        /*$sql="select acc_id,acc_name from TX_ACCOUNT order by acc_name desc";
                        
                        $rows=mysqli_query($db_conn,$sql);
                        $row_counts_list=mysqli_num_rows($rows);			
                        $option="";
                        if ($row_counts_list!=0) {
                            while($rs= mysqli_fetch_array($rows)){ 
                                $option.="<option value='".$rs["acc_id"]."'>".$rs["acc_name"]." [".$rs["acc_id"]."]</option>\n";
                            }
                         
                        }else {
                            $option="<option value=''>系统当前未添加用户</option>";
                        }
                        echo $option;
                        mysqli_free_result($rows);*/
                    ?>
                  </select></td>
              </tr>
               <tr>
                <td height="30" align="right">人员工号
                   <input type="checkbox" id="agents3" name="agents3" parentid="agents3" value="" onclick="CheckItemsAll('form3','agents3')" />
                   ：</td>
                <td height="30"><div class='treeContainer'>
                    <div class="treeItem">
                      <?php //get_agent_list("form3","agents3")?>
                    </div>
                  </div></td>
              </tr>
               <tr>
                <td width="16%" height="30" align="right">&nbsp;</td>
                <td height="30"><input type="button" name="form_user_pope" id="form_user_pope" value="提交保存"  style="cursor:pointer" >
                   <input type="reset" name="form_user_reset" id="form_user_reset" value="重置" /></td>
              </tr>
             </table>
          </form>
         </fieldset></td>
     </tr>
  </table>
 </div>
<?
mysqli_close($db_conn);

?>
</body>
</html>
