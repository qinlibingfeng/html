<?php 
require("../../inc/pub_func.php"); 
$tits=trim($_REQUEST["tits"]);
$job_name=trim($_REQUEST["job_name"]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title><?php echo $GLOBALS["system_name"] ?>-选择被叫号段</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<style>
.page_main{_margin-top:-1px;}
.s_input{width:196px}
.s_option{width:202px}
.page_main fieldset{margin:2px 8px 8px 8px;}
.highlight{padding:1px;background:#FFFF00;font-weight:bold;color:#000}
</style> 
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script>
$(document).ready(function() {
  	
	$('#text_search').bind('keyup change',function(ev){
        var searchTerm = $(this).val();
        $('.search_text_zone').removeHighlight();
        if(searchTerm){$('.search_text_zone').highlight(searchTerm);}
    });
	
});

//搜索
jQuery.fn.highlight = function(pat){function innerHighlight(node, pat){var skip = 0; if (node.nodeType == 3){var pos = node.data.toUpperCase().indexOf(pat); if (pos >= 0){var spannode = document.createElement('span'); spannode.className = 'highlight'; var middlebit = node.splitText(pos); var endbit = middlebit.splitText(pat.length); var middleclone = middlebit.cloneNode(true); spannode.appendChild(middleclone); middlebit.parentNode.replaceChild(spannode, middlebit); skip = 1;} } else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)){for (var i = 0; i < node.childNodes.length; ++i){i += innerHighlight(node.childNodes[i], pat);} } return skip;} return this.each(function(){innerHighlight(this, pat.toUpperCase());});};jQuery.fn.removeHighlight = function(){function newNormalize(node){for (var i = 0, children = node.childNodes, nodeCount = children.length; i < nodeCount; i++){var child = children[i]; if (child.nodeType == 1){newNormalize(child); continue;} if (child.nodeType != 3){continue;} var next = child.nextSibling; if (next == null || next.nodeType != 3){continue;} var combined_text = child.nodeValue + next.nodeValue; new_node = node.ownerDocument.createTextNode(combined_text); node.insertBefore(new_node, child); node.removeChild(child); node.removeChild(next); i--; nodeCount--;} } return this.find("span.highlight").each(function(){var thisParent = this.parentNode; thisParent.replaceChild(this.firstChild, this); newNormalize(thisParent);}).end();}; 

function text_search(){
	var searchTerm = $('#text_search').val();
	$('.search_text_zone').removeHighlight();
	if(searchTerm){$('.search_text_zone').highlight(searchTerm );}
}


function do_setagent_list(){
 	var agent_list="";
	var agent_name="";
 	 $('#form1 input[name="agents"]:enabled:checked').each(function(i){
		 //if(this.checked){
			 var list_s=$(this).val().split("|")[1];
 			 agent_list+=list_s+",";
			 
			 var list_s_r=$(this).val().split("|")[0];
 			 agent_name+=list_s_r+",";
		// }  
   	}); 
 	if (agent_list!=""){agent_list=agent_list.substr(0,agent_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#agent_list").val(agent_list);
	
	if (agent_name!=""){agent_name=agent_name.substr(0,agent_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#agent_name_list").val(agent_name);
	
 	$(_DialogInstance.ParentWindow.document).find("#agent_name_list").attr("title","双击<?php echo $tits; ?>："+agent_name);
 	setTimeout('Dialog.close();',10); 
}

function dis_unactive(){
 	$(".check_items ul li[active='N']").each(function(){
 		//alert($(this).find(":input[type=checkbox]").attr("disabled"));
		if($(this).find(":input[type=checkbox]").is(":disabled")==true){
   			$(this).find(":input[type=checkbox]").attr("disabled",false);
		}else{
			$(this).find(":input[type=checkbox]").attr("disabled",true);
 		}
 		
		$(this).toggle();
	});
	 
 }
    
</script>

</head>
 
<body>

<?php 
  
switch($action){
	case "get_agent_list":
  
	function get_agent_list(){
		
		global $db_conn;
			
		$sql="select user,full_name from vicidial_users";
		
		//$sql="select user_group,group_name from vicidial_user_groups ";
		
		$rows=mysqli_query($db_conn,$sql);
		$row_counts=mysqli_num_rows($rows);
		
		$list_arr=array();
		 
		if ($row_counts!=0) {
	?>
<table width="100%" border=0 cellpadding=0 cellspacing=2>
  <?php 
			while($rs= mysqli_fetch_array($rows)){ 
		?>
  <tr >
   <!-- <td  style="border-bottom: 1px dotted #999;" height="24" align="left" class="deepgreen"><label for="agents_item_<?php echo $rs["user"]; ?>" onclick="CheckItemsAll('form1','agents_item_<?php echo $rs["user"]; ?>');">
        <input type="checkbox" id="<?php echo $rs["user"]; ?>" name="agents_item" value="<?php echo $rs["user"]; ?>" parentid="<?php echo $rs["user"]; ?>" >
        <?php echo $rs["full_name"]; ?></label></td>-->
    <td align="left" class="check_items" style="border-bottom: 1px dotted #999;"><ul>
       <span>
          <input type="checkbox" parentid="<?php echo $rs["user"]; ?>" id="<?php echo $rs["user"]; ?>" name="agents" onclick="CheckItems('form1','<?php echo $rs["user"]; ?>','<?php echo $rs["user"]; ?>');" value="<?php echo $rs["full_name"]; ?>">
          <label for="<?php echo $rs["user"]; ?>_<?php echo $rs["user"]; ?>"><?php echo $rs["full_name"]; ?> [<?php echo $rs["user"]; ?>]</label>
          </span>
        
      </ul></td>
  <tr>
    <?php 
	  
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

    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits; ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend><label for="agents"><input type="checkbox" id="agents" name="" parentid="agents_" value="" onclick="CheckItemsAll('form1','agents')" /><?php echo $tits; ?></label></legend>
      		<div style="position:absolute;right:10px;top:36px"><input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" /> <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" /></div>
     		 <form action="" method="post" name="form1" id="form1">
 				
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone">
                       
                       <?php echo get_agent_list(); ?>
                      
                       </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>
<?php 

break;

case "get_phone_login_list":
?>

 
<script>
function do_setphone_login_list(){
 	var callstatus_list="";
	var callstatus_name="";
 	 $('#form1 input[name="phone_login"]:enabled:checked').each(function(i){
		 //if(this.checked){
			 
			 var list_s_r=$(this).val().split("|")[0];
 			 callstatus_name+=list_s_r+",";
			 
			 var list_s=$(this).val().split("|")[1];
 			 callstatus_list+=list_s+",";
 		 //}  
   	}); 
 	if (callstatus_list!=""){callstatus_list=callstatus_list.substr(0,callstatus_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#phone_login").val(callstatus_list);
	
	if (callstatus_name!=""){callstatus_name=callstatus_name.substr(0,callstatus_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#phone_login_list").val(callstatus_name);
	
 	$(_DialogInstance.ParentWindow.document).find("#phone_login_list").attr("title","双击选择<?php echo $tits ?>："+callstatus_name);
	
  	setTimeout('Dialog.close();',10); 
}
</script>
 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend> <label for="phone_login"><input type="checkbox" id="phone_login" name="" parentid="phone_login_all" value="" onclick="CheckItemsAll('form1','phone_login')" /><?php echo $tits ?></label> <a href="javascript:void(0);" onclick="dis_unactive()" id="dis_unactive" style="font-weight:normal">显示禁用</a></legend>
      <div style="position:absolute;right:10px;top:36px"><input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" /> <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" /></div>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone check_items">
                       <ul>
			<?php       	
		
			$sqls="SELECT voicemail_id,fullname from phones where active='y' and protocol='sip' order by voicemail_id asc";
			$rows=mysqli_query($db_conn,$sqls);
			
			if(mysqli_num_rows($rows)!=0){
				while($rs= mysqli_fetch_array($rows)){ 
		 ?>  
             <li><label for="phone_login_<?php echo $rs["voicemail_id"] ?>" onclick="CheckItems('form1','phone_login','phone_login_all');"><input type="checkbox" parentid="phone_login_all" id="phone_login_<?php echo $rs["voicemail_id"] ?>" name="phone_login" value="<?php echo $rs["fullname"] ?>|<?php echo $rs["voicemail_id"] ?>"><?php echo $rs["fullname"] ?></label></li>
			<?php 
				}
			}else{
				
				echo "无分机可供选择！";
			}
			mysqli_free_result($rows);
	   ?>     </ul>
                       </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>

<?php 

break;

case "get_campaign_id_list":
?>

<script>
function do_setcampaign_id_list(){
 	var callstatus_list="";
	var callstatus_name="";
 	 $('#form1 input[name="campaign_id"]:enabled:checked').each(function(i){
		 //if(this.checked){
			 
			 var list_s_r=$(this).val().split("|")[0];
 			 callstatus_name+=list_s_r+",";
			 
			 var list_s=$(this).val().split("|")[1];
 			 callstatus_list+=list_s+",";
 		 //}  
   	}); 
 	if (callstatus_list!=""){callstatus_list=callstatus_list.substr(0,callstatus_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#campaign_id").val(callstatus_list);
	
	if (callstatus_name!=""){callstatus_name=callstatus_name.substr(0,callstatus_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#campaign_id_list").val(callstatus_name);
	
 	$(_DialogInstance.ParentWindow.document).find("#campaign_id_list").attr("title","双击选择业务活动："+callstatus_name);
 	
 	setTimeout('Dialog.close();',10); 
}

</script>
 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend> <label for="campaign_id"><input type="checkbox" id="campaign_id" name="" parentid="campaign_id_all" value="" onclick="CheckItemsAll('form1','campaign_id')" /><?php echo $tits ?></label>  <a href="javascript:void(0);" onclick="dis_unactive()" id="dis_unactive" style="font-weight:normal">显示禁用</a></legend>
      		 <div style="position:absolute;right:10px;top:36px"><input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" /> <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" /></div>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone check_items">
                       <ul>
                        <?php       	
                    
                        $sqls="select campaign_id,campaign_name,active from vicidial_campaigns order by campaign_id";
                        $rows=mysqli_query($db_conn,$sqls);
                        
                        if(mysqli_num_rows($rows)!=0){
							$is_dis="";
                            while($rs= mysqli_fetch_array($rows)){ 
								if(strtoupper($rs["active"])=="N"){$is_dis="style='display:none' active='N'";$disabled="disabled='disabled'";}else{$is_dis="";$disabled="";}
                     ?>  
                         <li <?php echo $is_dis;?>><label for="campaign_id_<?php echo $rs["campaign_id"] ?>" onclick="CheckItems('form1','campaign_id','campaign_id_all');"><input type="checkbox" parentid="campaign_id_all" id="campaign_id_<?php echo $rs["campaign_id"] ?>" <?php echo $disabled ?> name="campaign_id" value="<?php echo $rs["campaign_name"] ?>|<?php echo $rs["campaign_id"] ?>"><?php echo $rs["campaign_name"] ?> [<?php echo $rs["campaign_id"] ?>]</label></li>
                        <?php 
                            }
                        }else{
                            
                            echo "无业务活动可供选择！";
                        }
                        mysqli_free_result($rows);
                   ?>     
              
                      </ul>
                       </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>
<?php 

break;

case "get_status_list":
?>
<script>
function do_setstatus_list(){
 	var callstatus_list="";
	var callstatus_name="";
 	 $('#form1 input[name="status"]:checked').each(function(i){
		 //if(this.checked){
			 
			 var list_s_r=$(this).val().split("|")[0];
 			 callstatus_name+=list_s_r+",";
			 
			 var list_s=$(this).val().split("|")[1];
 			 callstatus_list+=list_s+",";
 		 //}  
   	}); 
 	if (callstatus_list!=""){callstatus_list=callstatus_list.substr(0,callstatus_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#status").val(callstatus_list);
	
	if (callstatus_name!=""){callstatus_name=callstatus_name.substr(0,callstatus_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#status_list").val(callstatus_name);
	
 	$(_DialogInstance.ParentWindow.document).find("#status_list").attr("title","双击<?php echo $tits ?>："+callstatus_name);
 	
 	setTimeout('Dialog.close();',10); 
}
</script>
 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend> <label for="status"><input type="checkbox" id="status" name="" parentid="status_all" value="" onclick="CheckItemsAll('form1','status')" /><?php echo $tits ?></label></legend>
      <div style="position:absolute;right:10px;top:36px"><input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" /> <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" /></div>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone check_items">
                       <ul>
                        <?php       	
                    
                        $sqls="select status,status_name from data_sys_status where status_type='call_status' and selectable='y' order by status,status_name desc";
                        $rows=mysqli_query($db_conn,$sqls);
                        
                        if(mysqli_num_rows($rows)!=0){
                            while($rs= mysqli_fetch_array($rows)){ 
							 
                     ?>  
                         <li><label for="status_<?php echo $rs["status"] ?>" onclick="CheckItems('form1','status','status_all');"><input type="checkbox" parentid="status_all" id="status_<?php echo $rs["status"] ?>" name="status" value="<?php echo $rs["status_name"] ?>|<?php echo $rs["status"] ?>"><?php echo $rs["status_name"] ?> [<?php echo $rs["status"] ?>]</label></li>
                        <?php 
                            }
                        }else{
                            
                            echo "无呼叫结果可供选择！";
                        }
                        mysqli_free_result($rows);
                   ?>     
                        
                        </ul>
                        
                        
                      
                       </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>


<?php 

break;

case "get_phone_lists":
?>
<script>
function do_setphone_lists(){
 	var callstatus_list="";
	var callstatus_name="";
 	 $('#form1 input[name="lists"]:enabled:checked').each(function(i){
		 //if(this.checked){
			 
			 var list_s_r=$(this).val().split("|")[0];
 			 callstatus_name+=list_s_r+",";
			 
			 var list_s=$(this).val().split("|")[1];
 			 callstatus_list+=list_s+",";
 		 //}  
   	}); 
 	if (callstatus_list!=""){callstatus_list=callstatus_list.substr(0,callstatus_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#phone_lists").val(callstatus_list);
	
	if (callstatus_name!=""){callstatus_name=callstatus_name.substr(0,callstatus_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#phone_lists_list").val(callstatus_name);
	
 	$(_DialogInstance.ParentWindow.document).find("#phone_lists_list").attr("title","双击<?php echo $tits ?>："+callstatus_name);
 	
 	setTimeout('Dialog.close();',10); 
}
</script>
 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend> <label for="lists"><input type="checkbox" id="lists" name="" parentid="status_all" value="" onclick="CheckItemsAll('form1','lists')" /><?php echo $tits ?></label>  <a href="javascript:void(0);" onclick="dis_unactive()" id="dis_unactive" style="font-weight:normal">显示禁用</a></legend>
      <div style="position:absolute;right:10px;top:36px"><input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" /> <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" /></div>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone check_items">
                       <ul>
                        <?php       	
                    
                        $sqls="select a.list_id,a.list_name,b.campaign_name,a.active,a.list_description from vicidial_lists a left join vicidial_campaigns b on a.campaign_id=b.campaign_id";
                        $rows=mysqli_query($db_conn,$sqls);
                        
                        if(mysqli_num_rows($rows)!=0){
							$is_dis="";
                            while($rs= mysqli_fetch_array($rows)){ 
								if(strtoupper($rs["active"])=="N"){$is_dis="style='display:none' active='N'";$disabled="disabled='disabled'";}else{$is_dis="";$disabled="";}
						 ?>  
                         <li <?php echo $is_dis;?> title="所属活动：<?php echo $rs["campaign_name"] ?> <?php echo $rs["list_description"] ?>"><label for="lists_<?php echo $rs["list_id"] ?>" onclick="CheckItems('form1','lists','lists_all');"><input type="checkbox" parentid="lists_all" id="lists_<?php echo $rs["list_id"] ?>" <?php echo $disabled ?> name="lists" value="<?php echo $rs["list_name"] ?>|<?php echo $rs["list_id"] ?>"><span class="<?php echo $class; ?>"><?php echo $rs["list_name"] ?>[<?php echo $rs["list_id"] ?>]</span></label></li>
                        <?php 
                            }
                        }else{
                            
                            echo "无客户清单可供选择！";
                        }
                        mysqli_free_result($rows);
                   ?>     
                        
                        </ul>
                        
                        </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>

<?php 

break;

case "get_quality_user_list":
?>
<script>
function do_setquality_user_list(){
 	var callstatus_list="";
	var callstatus_name="";
 	 $('#form1 input[name="quality_user"]:checked').each(function(i){
		 //if(this.checked){
			 
			 var list_s_r=$(this).val().split("|")[0];
 			 callstatus_name+=list_s_r+",";
			 
			 var list_s=$(this).val().split("|")[1];
 			 callstatus_list+=list_s+",";
 		 //}  
   	}); 
 	if (callstatus_list!=""){callstatus_list=callstatus_list.substr(0,callstatus_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#quality_user").val(callstatus_list);
	
	if (callstatus_name!=""){callstatus_name=callstatus_name.substr(0,callstatus_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#quality_user_list").val(callstatus_name).attr("title","双击<?php echo $tits ?>："+callstatus_name);
  	
 	setTimeout('Dialog.close();',10); 
}
</script>
 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend> <label for="quality_user"><input type="checkbox" id="quality_user" name="" parentid="quality_user_all" value="" onclick="CheckItemsAll('form1','quality_user')" /><?php echo $tits ?></label> </legend>
      <div style="position:absolute;right:10px;top:36px"><input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" /> <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" /></div>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone check_items">
                       <ul>
                       <?php       	
                    
                        $sqls="select a.userid,b.full_name from data_quality_log a left join vicidial_users b on a.Userid=b.user group by a.userid";
                        $rows=mysqli_query($db_conn,$sqls);
                        
                        if(mysqli_num_rows($rows)!=0){
                             while($rs= mysqli_fetch_array($rows)){ 
							 $full_name=$rs["full_name"];
							 $userid=$rs["userid"];
							 if(!$full_name){
								 $full_name=$userid;
							 }
 						 ?>  
                         <li <?php echo $is_dis;?>><label for="quality_user_<?php echo $userid ?>" onclick="CheckItems('form1','quality_user','quality_user_all');"><input type="checkbox" parentid="quality_user_all" id="quality_user_<?php echo $userid ?>" name="quality_user" value="<?php echo $full_name ?>|<?php echo $userid ?>"><span class="<?php echo $class; ?>"><?php echo $full_name ?> [<?php echo $userid ?>]</span></label></li>
                        <?php 
                            }
                        }else{
                            
                            echo "无质检人员可供选择！";
                        }
                        mysqli_free_result($rows);
                   ?>    
                        </ul>
                        
                        </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>

<?php 

break;

case "get_quality_status_list":
?>
<script>
function do_setquality_status_list(){
 	var callstatus_list="";
	var callstatus_name="";
 	 $('#form1 input[name="quality_status"]:checked').each(function(i){
		// if(this.checked){
			 
			 var list_s_r=$(this).val().split("|")[0];
 			 callstatus_name+=list_s_r+",";
			 
			 var list_s=$(this).val().split("|")[1];
 			 callstatus_list+=list_s+",";
 		// }  
   	}); 
 	if (callstatus_list!=""){callstatus_list=callstatus_list.substr(0,callstatus_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#quality_status").val(callstatus_list);
	
	if (callstatus_name!=""){callstatus_name=callstatus_name.substr(0,callstatus_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#quality_status_list").val(callstatus_name);
	
 	$(_DialogInstance.ParentWindow.document).find("#quality_status_list").attr("title","双击<?php echo $tits ?>："+callstatus_name);
 	
 	setTimeout('Dialog.close();',10); 
}
</script>
 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend> <label for="quality_status"><input type="checkbox" id="quality_status" name="quality_status_all" parentid="quality_status_all" value="" onclick="CheckItemsAll('form1','quality_status')" /><?php echo $tits ?></label></legend>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone check_items">
                       <ul>
                   <?php       	
                    
                        $sqls="select status,status_name from data_sys_status where selectable='y' and status_type='qua_status' order by status";
                        $rows=mysqli_query($db_conn,$sqls);
                        
                        if(mysqli_num_rows($rows)!=0){
                            while($rs= mysqli_fetch_array($rows)){ 
                     ?>  
                         <li><label for="quality_status_<?php echo $rs["status"] ?>" onclick="CheckItems('form1','quality_status','quality_status_all');"><input type="checkbox" parentid="quality_status_all" id="quality_status_<?php echo $rs["status"] ?>" name="quality_status" value="<?php echo $rs["status_name"] ?>|<?php echo $rs["status"] ?>"><?php echo $rs["status_name"] ?></label></li>
                        <?php 
                            }
                        }else{
                            
                            echo "无质检状态可供选择！";
                        }
                        mysqli_free_result($rows);
                   ?>  
                        </ul>
                      
                       </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>

<?php 

break;


case "get_fields_list":
?>
<script>
function do_setfields_list(){
 	var field_list="";
	//var callstatus_name="";
	$('#form1 input[name="field"]:checked').each(function(i){
		 //if(this.checked){
 			 //var list_s_r=$(this).val().split("|")[0];
 			 //callstatus_name+=list_s_r+",";
 			 var list_s=$(this).val().split("|")[1];
 			 field_list+=list_s+",";
 		 //}
   	}); 
 	if (field_list!=""){field_list=field_list.substr(0,field_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#field_list").val(field_list);
  	setTimeout("Dialog.close();",10);
	_DialogInstance.ParentWindow.check_form('excel_field');
}
</script>
 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend> <label for="field"><input type="checkbox" id="field" name="field_all" parentid="field_all" value="" onclick="CheckItemsAll('form1','field')" /><?php echo $tits ?></label>  <a href="javascript:void(0);" onclick="dis_unactive()" id="dis_unactive" style="font-weight:normal">显示禁用</a></legend>
      <div style="position:absolute;right:10px;top:36px"><input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" /> <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" /></div>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone check_items">
                       <ul>
                   <?php       	
 						
 						foreach($field_ary as $field_value =>$field_name ){
							//echo ("$field_name => $field_value <br>");
                       ?>  
                         <li><label for="field_<?php echo $field_value ?>" onclick="CheckItems('form1','field','field_all');"><input type="checkbox" parentid="field_all" id="field_<?php echo $field_value ?>" name="field" value="<?php echo $field_name ?>|<?php echo $field_value ?> as ·<?php echo $field_name ?>·"><?php echo $field_name ?></label></li>
                        <?php 
                         
                         }
                        
                   		?>  
                        </ul>
                                             
                       </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>

<?php 

break;

case "get_status_list2":
?>
<script>
function do_setstatus_list(){
 	var callstatus_list="";
	var callstatus_name="";
 	 $('#form1 input[name="status"]').each(function(i){
		 if(this.checked){
			 
			 var list_s_r=$(this).val().split("|")[0];
 			 callstatus_name+=list_s_r+",";
			 
			 var list_s=$(this).val().split("|")[1];
 			 callstatus_list+=list_s+",";
 		 }  
   	}); 
 	if (callstatus_list!=""){callstatus_list=callstatus_list.substr(0,callstatus_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#status").val(callstatus_list);
	
	if (callstatus_name!=""){callstatus_name=callstatus_name.substr(0,callstatus_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#status_list").val(callstatus_name);
	
 	$(_DialogInstance.ParentWindow.document).find("#status_list").attr("title","双击<?php echo $tits ?>："+callstatus_name);
 	
 	setTimeout('Dialog.close();',10); 
}
</script>
 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="call_black" type="hidden" id="call_black" value="" />
      <fieldset><legend> <label for="status"><input type="checkbox" id="status" name="" parentid="status_all" value="" onclick="CheckItemsAll('form1','status')" /><?php echo $tits ?></label></legend>
      <div style="position:absolute;right:10px;top:36px"><input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" /> <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" /></div>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top" class="search_text_zone">
  <?php
			  
	    $sql="select distinct selectable,case when selectable='y' then '人工' else '系统' end as select_desc from vicidial_statuses order by selectable asc";
		
		$rows=mysqli_query($db_conn,$sql);
		$row_counts=mysqli_num_rows($rows);
		
		 
		 
		if ($row_counts!=0) {
	?> 
	
	<table width="100%" border=0 cellpadding=0 cellspacing=2>
		<?php 
			while($rs= mysqli_fetch_array($rows)){ 
		?>
			<tr >
				 
				<td width="" height="24" align="left" class="deepgreen"><label for="status_item_<?php echo $rs["selectable"]; ?>" onclick="CheckItemsAll('form1','status_item_<?php echo $rs["selectable"]; ?>');"><input type="checkbox" id="status_item_<?php echo $rs["selectable"]; ?>" name="status_item" value="<?php echo $rs["selectable"]; ?>" parentid="status_<?php echo $rs["selectable"]; ?>" ><?php echo $rs["select_desc"]; ?></label></td>
				<td align="left" class="check_items">
              <ul>
		<?php       	
		
			$sqls="select a.status,b.status_name,case when a.selectable='y' then '人工' else '系统' end as selectable from vicidial_statuses a left join data_sys_status b on a.status=b.status and b.status_type='call_status' where a.selectable ='".$rs["selectable"]."' order by b.status_name desc";
			$rows2=mysqli_query($db_conn,$sqls);
			
			if(mysqli_num_rows($rows2)!=0){
				while($rs2= mysqli_fetch_array($rows2)){ 
				
				if(strtolower($rs["selectable"])=="y"){$class="red";}
		 ?>      
			 <li><label for="status_<?php echo $rs["selectable"]; ?>_<?php echo $rs2["status"]; ?>" onclick="CheckItems('form1','status_<?php echo $rs["selectable"]; ?>','status_item_<?php echo $rs["status"]; ?>');"><input type="checkbox" parentid="status_item_<?php echo $rs["selectable"]; ?>" id="status_<?php echo $rs["selectable"]; ?>_<?php echo $rs2["status"]; ?>" name="status" value="<?php echo $rs2["status_name"]; ?>|<?php echo $rs2["status"]; ?>"><span class="<?php echo $class; ?>"><?php echo $rs2["status_name"]; ?> [<?php echo $rs2["status"]; ?>]</span></label></li>
		<?php 
					$class="";
				}
			} 
			mysqli_free_result($rows2);
	   ?>
       </ul>
		</td>
	  <tr>
	  <?php 
	  
		}
	 
	  ?>
		
	</table>
	<?php	
	 
		}else {
			 echo "当前系统没有呼叫结果选择！";
		}
		mysqli_free_result($rows);
	 ?>
                        
                      
                       </td>
                    </tr>
                  </table>
                </form>
      </fieldset>
</div>

<?php 

break;

case "phone_number_list":

$job_id=trim($_REQUEST["job_id"]);
$job_name2=trim($_REQUEST["job_name"]);

$sqls="select phone_number from data_record_job_log where job_id='".$job_id."'";
$rows=mysqli_query($db_conn,$sqls);

if(mysqli_num_rows($rows)!=0){
	while($rs= mysqli_fetch_array($rows)){ 
		$phone_numbers.=$rs["phone_number"]."\n";
	}
} 
mysqli_free_result($rows);

?>
<script>
  
function do_setphone_number_list(){
 
 	if($("#job_name").val()==""){
		alert("请输入任务名称！");
		$("#job_name").focus();
		return false;
	}else{
		if($("#job_name").val().indexOf('\\')!=-1 || $("#job_name").val().indexOf('/')!=-1){
			alert("任务名称输入含有特殊字符 \\ /，请更正！");
			$("#job_name").select();
			return false;
		}	
	}
	
 	if($("#phones").val()==""){
		alert("请填写被叫号码！");
 		return false;
	}
 	
	var url="action=create_record_job&"+$('#form1').serialize();
	//alert(url);
	//return false;
   	$.ajax({
		 
		url: "send.php",
		data:url,
		
  		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
 		success: function(json){ 
 		    alert(json.des);
		    if(json.counts=="1"){
				$(_DialogInstance.ParentWindow.document).find("#job_name").val(json.job_name);
				$(_DialogInstance.ParentWindow.document).find("#job_id").val(json.job_id);
				$("#job_id").val(json.job_id);
				$(_DialogInstance.ParentWindow.document).find("#job_name_bak").val(json.job_name);
  				$(_DialogInstance.ParentWindow.document).find("#phone_number_list").val("有效号码："+json.pcount2+"个").attr("title","有效号码："+json.pcount2+"个");
				//_DialogInstance.ParentWindow.set_job_id();
				if(json.pcount2>0){
					setTimeout('Dialog.close();',10);
				}
 			} 
           			
  		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
   	});
	
 }
</script>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	
      <fieldset><legend> <label for="quality_status_all"><?php echo $tits ?> </label></legend>
     		 <form action="" method="post" name="form1" id="form1">
 				  <input name="job_id" type="hidden" id="job_id" value="" />
                  <table width="100%" border="0" align="center" cellpadding=2 cellspacing=0>
                    
                    <tr>
                      <td width="22%" height="24" align="right">任务名称：</td>
                      <td height="24"><input name="job_name" type="text" id="job_name" size="50" maxlength="80" value="<?php echo $job_name2 ?>"/><span class="red">※</span></td>
                    </tr>
                    <tr>
                      <td width="22%" height="" align="right">被叫号码：</td>
                      <td align="left" valign="middle"><textarea name="phones" id="phones" cols="50" rows="5" style="height:130px"><?php echo $phone_numbers; ?></textarea><span class="red">※</span></td>
                    </tr>                    
                  </table>
                </form>
      </fieldset>
</div>

<?php 

	break;
 
	default :
	
		echo "action:error";
	
}
mysqli_close($db_conn);
?>  
</body>
</html>
