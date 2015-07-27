<?php 
require("../../inc/pub_func.php"); 
require("../../inc/pub_set.php"); 
$tits=trim($_REQUEST["tits"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<link href="/css/list.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<style>
 
.strategySel div{cursor:pointer;}
.strategySel,.bus_strategySel,.strategySel_on,.bus_strategySel_on{background:url("/images/new_map_nav.gif") no-repeat scroll 0 0 transparent;height:26px;line-height:26px;margin:6px 10px 2px 2px;overflow:hidden;width:315px; position:relative}
.strategySel_on,.bus_strategySel_on{background-position:0 -32px;}
.strategySel .sel,.bus_strategySel .sel{font-weight:700;}
.strategySel .noSel,.strategySel .sel{float:left;line-height:26px;overflow:hidden;text-align:center;width:104px;}
.strategySel .noSel,.bus_strategySel .noSel{background:url("/images/new_map_nav.gif") no-repeat scroll -2px -64px transparent;cursor:pointer;}.strategySel .noSel_on,.bus_strategySel .noSel_on{background-position:-2px -96px;}
.strategySel span.lineBg,.bus_strategySel span.lineBg{background:url("/images/new_map_nav.gif") no-repeat scroll 0 -128px transparent;display:block;text-align:center;}.strategySel_r{height:26px;}
.strategySel span.lineBg_on,.bus_strategySel span.lineBg_on{background-position:0 -160px;}
.bus_strategySel .noSel,.bus_strategySel .sel{float:left;line-height:24px;*line-height:26px;margin:0;overflow:hidden;padding:0;text-align:center;width:78px;}
.strategySel_r .leftBorLine,.strategySel_r .rightBorLine{float:left;font-size:0;height:26px;overflow:hidden;width:2px;}
.strategySel_r .leftBorLine{background:url("/images/new_map_nav.gif") no-repeat scroll left 0 transparent;width:1px;}
.strategySel_r .leftBorLine_on{background:url("/images/new_map_nav.gif") no-repeat scroll left -96px transparent;}
.strategySel_r .leftBorLine_active_on{background:url("/images/new_map_nav.gif") no-repeat scroll left -32px transparent;}.strategySel_r .rightBorLine{background:url("/images/new_map_nav.gif") no-repeat scroll right 0 transparent;}
.strategySel_r .rightBorLine_on{background:url("/images/new_map_nav.gif") no-repeat scroll right -96px transparent;}
.strategySel_r .rightBorLine_active_on{background:url("/images/new_map_nav.gif") no-repeat scroll right -32px transparent;}

.opt_f_list{width:620px;border:2px solid #709CBE;position:absolute;left:10px;background:#FFF;z-index:12;margin-top:22px;display:none;box-shadow: 0 2px 7px rgba(0, 0, 0, 0.7);}
#opt_layer_1_list,#opt_layer_2_list{width:98%;position:relative;padding:4px;float:left;min-height:120px;max-height:300px;overflow:auto}
.opt_f_list .head{background:#F1F7FC;width:100%;border-bottom:1px solid #C5C5C5;position:relative;line-height:25px;height:26px;float:left}
.opt_f_list .bottom{background:#F1F7FC;width:100%;border-top:1px solid #C5C5C5;position:relative;line-height:24px;height:26px;text-align:right;float:left}
.opt_f_list a.close{width:20px;height:20px;line-height:20px;background:url(/images/agent_c/ico_side.png) no-repeat -23px 0px;display:inline;position:absolute;right:6px;top:3px;cursor:pointer;font-size:1px}
.opt_f_list a.close:hover{background-position:-23px -23px}
.opt_f_list .chart_c_line{line-height:20px;height:20px;border-bottom:1px dotted #CCC;float:left;width:100%}

.s_input{width:196px}
.s_option{width:202px}

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
	$(".search_text_zone input[type=checkbox]").click(function(){if(this.checked==true){$(this).parent().addClass("blue")}else{$(this).parent().removeClass("blue")}});
});

jQuery.fn.highlight = function(pat){function innerHighlight(node, pat){var skip = 0; if (node.nodeType == 3){var pos = node.data.toUpperCase().indexOf(pat); if (pos >= 0){var spannode = document.createElement('em'); spannode.className = 'highlight'; var middlebit = node.splitText(pos); var endbit = middlebit.splitText(pat.length); var middleclone = middlebit.cloneNode(true); spannode.appendChild(middleclone); middlebit.parentNode.replaceChild(spannode, middlebit); skip = 1;} } else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)){for (var i = 0; i < node.childNodes.length; ++i){i += innerHighlight(node.childNodes[i], pat);} } return skip;} return this.each(function(){innerHighlight(this, pat.toUpperCase());});};jQuery.fn.removeHighlight = function(){function newNormalize(node){for (var i = 0, children = node.childNodes, nodeCount = children.length; i < nodeCount; i++){var child = children[i]; if (child.nodeType == 1){newNormalize(child); continue;} if (child.nodeType != 3){continue;} var next = child.nextSibling; if (next == null || next.nodeType != 3){continue;} var combined_text = child.nodeValue + next.nodeValue; new_node = node.ownerDocument.createTextNode(combined_text); node.insertBefore(new_node, child); node.removeChild(child); node.removeChild(next); i--; nodeCount--;} } return this.find("em.highlight").each(function(){var thisParent = this.parentNode; thisParent.replaceChild(this.firstChild, this); newNormalize(thisParent);}).end();}; 

function text_search(){
	var searchTerm = $('#text_search').val();
	$('.search_text_zone').removeHighlight();
	if(searchTerm){$('.search_text_zone').highlight(searchTerm );}
}
   
function order_datatable_(){
	
	$("#datatable tbody tr").removeClass("alt").find(".up_d").addClass("up_e").removeClass("up_d");
	$("#datatable tbody tr").find(".dw_d").addClass("dw_e").removeClass("dw_d");
	$("#datatable tbody tr:first").find(".up_e").addClass("up_d").removeClass("up_e").unbind("click");
	$("#datatable tbody tr:last").find(".dw_e").addClass("dw_d").removeClass("dw_e").unbind("click");
	$("#datatable tbody tr:odd").addClass("alt");
	$("#datatable tbody tr").mouseover(function(){$(this).addClass("over")}).mouseout(function(){$(this).removeClass("over")});
}

function set_tree_class(){
	$("#tree_list p").removeClass("cur");
	$("#tree_list label").click(function(){
		$(this)	.parent().addClass("cur");
	});
}

function check_user(){
	if($("#user").val()!=""){
		
		if($("#user").val().length>20||$("#user").val().length<2){
			 
			request_tip("坐席工号位数必须介于2-20位字符之间！",0);
			$("#user").select();
			return false;
		}
		
		var datas="action=check_user&user="+$("#user").val()+times;
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			async:false,
			success: function(json){
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#user").select();
					$("#full_name").val("");
					$("#pass").val("");
			   }else{
					if($("#full_name").val()==""){$("#full_name").val($("#user").val())}
					if($("#pass").val()==""){$("#pass").val($("#user").val())}
   
			   }
			} 
		});
	}
}

function check_user_group(){
	if($("#user_group").val()!=""){
		
		if($("#user_group").val().length>20||$("#user_group").val().length<2){
			 
			request_tip("坐席组ID位数必须介于2-20位字符之间！",0);
			$("#user_group").select();
			return false;
		}
		
		var datas="action=check_user_group&user_group="+$("#user_group").val()+times;
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			async:false,
			success: function(json){
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#user_group").select();
 			   } 
			} 
		});
	}
}

function set_campaign_all(all_){
									
	if(all_==""||all_==null||all_==undefined){
		$("#all_campaigns").attr("checked",false);
	}else{
		$("input[name='campaigns']:not('#all_campaigns')").attr("checked",false);
	}
} 

function set_agent_status_all(all_){
									
	if(all_==""||all_==null||all_==undefined){
		$("#all_groups").attr("checked",false);
	}else{
		$("input[name='agent_status_viewable_groups']:not('#all_groups,#campaign_agents')").attr("checked",false);
	}
}

function show_types_list(types,lay_id,top){
	
  	$("div.opt_f_list").hide();
	$("#opt_layer_"+lay_id).show().css("top",(top-185)+"px");
	
	get_id=$("#get_lay_"+lay_id).val();
	
	if(get_id=="0"){
		var datas="action=get_types_list&do_actions="+types+"&user="+$("#user").val()+times;
		$.ajax({
			
			dataType: "html",
			url: "send.php",
			data:datas,
			complete :function(){$('#opt_load_img_'+lay_id).hide();},	 
			success: function(json){
			   $("#opt_layer_"+lay_id+"_list").html(json);
			   set_seletct_count(lay_id);
			   $("#get_lay_"+lay_id).val("1");
			   $("#opt_form_"+lay_id+" input[type=checkbox]").click(function(){if(this.checked==true){$(this).parent().addClass("blue")}else{$(this).parent().removeClass("blue")}});
			   
			} 
		});
	}else{
		set_seletct_count(lay_id);	
	}
  	 
}
function set_p_data(input,p_id){
	
    var p_name = "",
    p_names = "",
    p_val = "",
    p_vals = "";
    $('#opt_form_' + p_id + ' input[name="opt_field_'+p_id+'"]:checked').each(function(i){
        var p_val = $(this).val();
        p_vals += p_val + "|";
    });
   
    if (p_vals != "") {
        p_vals = p_vals.substr(0, p_vals.length - 1)
    }
    $("#" + input).val(p_vals);
    $("#opt_layer_" + p_id).hide()
}


function set_seletct_count(types){
	$("#seletct_count_"+types).html($("#opt_form_"+types+" .check_items input[type=checkbox]:checked").length);
}
</script>
 
</head>
<body>
<input type="hidden" name="current_input" id="current_input"/>
<input type="hidden" name="step_id" id="step_id"/>
 <input type="hidden" name="get_lay_1" id="get_lay_1" value="0"/>
    <input type="hidden" name="get_lay_2" id="get_lay_2" value="0"/>

<div id="opt_layer_1" class="opt_f_list">
    <form name="opt_form_1" id="opt_form_1">
      <div class="head"><strong class="">&nbsp;选择可查询坐席</strong><span class="font_14 font_w red" style="margin:0 6px 0 6px" id="seletct_count_1">0</span>个 <img src="/images/loading.gif" id="opt_load_img_1" /><a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#opt_layer_1').fadeOut()"></a></div>
      <div id="opt_layer_1_list">
         
      </div>
      <div class="bottom">
        <input type="button" name="" value="确定选择" onclick="set_p_data('allow_users_list','1')" title="点击设定该工号可查询的坐席工号呼叫记录" />
        <span style="margin-right:4px">
        <input type="button" name="" value="关 闭" onclick="javascript:$('#opt_layer_1').fadeOut()" />
        </span></div>
    </form>
</div>

<div id="opt_layer_2" class="opt_f_list">
    <form name="opt_form_2" id="opt_form_2">
      <div class="head"><strong class="">&nbsp;选择可查询业务活动</strong><span class="font_14 font_w red" style="margin:0 6px 0 6px" id="seletct_count_2">0</span>个 <img src="/images/loading.gif" id="opt_load_img_2" /><a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#opt_layer_2').fadeOut()"></a></div>
      <div id="opt_layer_2_list">
         
      </div>
      <div class="bottom">
        <input type="button" name="" value="确定选择" onclick="set_p_data('allow_campaigns_list','2')" title="点击设定该工号可查询的业务活动呼叫记录" />
        <span style="margin-right:4px">
        <input type="button" name="" value="关 闭" onclick="javascript:$('#opt_layer_2').fadeOut()" />
        </span></div>
    </form>
</div>


<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<div class="field_list_div field_list" id="field_list_div"></div>
<?php
switch($action){
  
case "add_user":
?>
<script>

function do_add_user(){
   	
	if($("#user").val() == ""){
		alert("请填写坐席工号！");
		$("#user").focus();
		return false;
	}else if($("#user").val().length>20||$("#user").val().length<2){
		alert("坐席工号位数必须介于2-20位字符之间！");
		$("#user").select();
		return false;
	}
	
	if($("#full_name").val() == ""){
		alert("请填写坐席姓名！");
		$("#full_name").focus();
		return false;
	}else if($("#full_name").val().length>20||$("#full_name").val().length<2){
		alert("坐席姓名位数必须介于2-20位字符之间！");
		$("#full_name").select();
		return false;
	}

	if($("#pass").val() == ""){
		alert("请填写坐席密码！");
		$("#pass").focus();
		return false;
	}else if($("#pass").val().length>20||$("#pass").val().length<2){
		alert("坐席密码位数必须介于2-20位字符之间！");
		$("#pass").select();
		return false;
	}
	
	if($("#user_group").val() == ""){
		alert("请选择坐席组！");
		$("#user_group").focus();
		return false;
	}
	
	if($("#server_ip").val() == ""){
		alert("请选择注册服务器！");
		$("#server_ip").focus();
		return false;
	}	
	
	$('#load').show();
	var datas="action=user_set&do_actions=add&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		    request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
 				 
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 
  
   
$(document).ready(function(){
 	//$("#user").focus();
	$('.td_underline tr:visible:odd').addClass('alt');
	$("#tree_list label").bind("click",function(){
		set_tree_class();
	}).hover(
		function(){
			$(this)	.parent().addClass("cur");			
		},function(){
			$(this)	.parent().removeClass("cur");			
		}
	);
	
	
	$("div.strategySel_r div").click(function(event){
		
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
		 
 	});
	
	$("div.opt_f_list").click(function(event){  
	  var e=window.event || event;  
	  if(e.stopPropagation){  
	  	e.stopPropagation();  
	  }else{  
	   	e.cancelBubble = true;  
	  }  
	});
	
	$(document).click(function(){
		$("div.opt_f_list").hide();
	});
	
	
	$("#chk_all_pope").click(function(){
		var checkbox=$('#tree_list :checkbox:enabled');
 		if(this.checked==true){
			$(checkbox).attr("checked",this.checked);
 		}else{
			$(checkbox).attr("checked",this.checked);
		}
	});
	
	$('#strategySel div').click(function(){
		$this=$(this);
	　　$this.addClass('sel').removeClass("noSel").siblings().removeClass('sel').addClass("noSel").children("span").removeClass("lineBg_on");
		$this.children("span").addClass("lineBg_on");
		x_top1=$this.offset().top;
		attrs=$this.attr("allow");
		(attrs=="setup")?show_types_list("users",1,x_top1):$("#opt_layer_1").hide();
		$("#allow_users").val(attrs);
	});
	
	
	$('#strategySel2 div').click(function(){
		$this=$(this);
	　　$this.addClass('sel').removeClass("noSel").siblings().removeClass('sel').addClass("noSel").children("span").removeClass("lineBg_on");
		$this.children("span").addClass("lineBg_on");
		x_top2=$this.offset().top;
		attrs=$this.attr("allow");
		(attrs=="setup")?show_types_list("campaigns",2,x_top2):$("#opt_layer_2").hide();
		$("#allow_campaigns").val(attrs);
	});
 	
});


 
</script> 
  
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">坐席管理</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <input name="user_id" id="user_id" type="hidden" value="" />
  <input name="form_index" id="form_index" type="hidden" value="1" />
   
   
  
    <form action="" method="post" name="form1" id="form1">
  
        <input type="hidden" name="allow_users_list" id="allow_users_list" value="0"/>
        <input type="hidden" name="allow_campaigns_list" id="allow_campaigns_list" value="0"/>
        
        <input type="hidden" name="allow_users" id="allow_users" value="none"/>
        <input type="hidden" name="allow_campaigns" id="allow_campaigns" value="none"/>
    	<table width="99%" align="center" cellspacing="0">
        <tr>
          <td valign="top" ><fieldset style="margin:-2px 2px 2px 2px">
              <legend style="font-weight:normal">
              <label>基本信息</label>
              </legend>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_underline">
                <tr>
                  <td width="30%" align="right" nowrap="nowrap" >坐席工号：</td>
                  <td><input name="user"  type="text" id="user" size="30" class="s_input" maxlength="15" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')" onblur="this.value=value.replace(/[^\w\/,]/ig,'');check_user()"/>
                    <span class="red">※</span><span class="gray">2-15个字符长度</span></td>
                </tr>
                <tr>
                  <td align="right" >坐席姓名：</td>
                  <td><input name="full_name"  type="text" id="full_name" size="30" class="s_input" maxlength="15" />
                    <span class="red">※</span><span class="gray">2-15个字符长度</span></td>
                </tr>
                <tr >
                  <td align="right" >坐席密码：</td>
                  <td><input name="pass" type="text" id="pass" value="" size="30" class="s_input" maxlength="10" onkeyup="this.value=value.replace(/[^\w\/_,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/_,]/ig,'')"/>
                    <span class="red">※</span><span class="gray">2-10个字符长度</span></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >坐席邮箱：</td>
                  <td><input name="email"  type="text" id="email" size="30" class="s_input" maxlength="20" onkeyup="this.value=value.replace(/[^\w\/@-_,.]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/@-_,.]/ig,'')"/></td>
                </tr>
                <tr >
                  <td align="right" >坐席级别：</td>
                  <td><select name="user_level" class="s_option" id="user_level">
                      <?php
                        for($i=1;$i<10;$i++){
                    ?>
                      <option value="<?php echo $i?>"><?php echo $i?></option>
                      <?php
                        }
                    ?>
                    </select>
                    <span class="red">※</span></td>
                </tr>
                <tr>
                  <td align="right" >坐席组别：</td>
                  <td ><select name="user_group" class="s_option" id="user_group" >
                      <?php 
                        
                            $sql="select user_group,group_name from vicidial_user_groups order by user_group desc";
                            
                            $rows=mysqli_query($db_conn,$sql);
                            $row_counts_list=mysqli_num_rows($rows);			
                            
                            if ($row_counts_list!=0) {
                                while($rs= mysqli_fetch_array($rows)){ 
                                
                                     echo "<option value='".$rs["user_group"]."'>".$rs["group_name"]."</option>";
                                }
                             
                            }
                            mysqli_free_result($rows);
                        ?>
                    </select>
                    <span class="red">※</span></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >注册服务器：</td>
                  <td ><select name="server_ip" class="s_option" id="server_ip" >
                      <?php 
                        
                            $sql="select server_ip,server_id,server_description from servers order by server_id";
                            
                            $rows=mysqli_query($db_conn,$sql);
                            $row_counts_list=mysqli_num_rows($rows);			
                            
                            if ($row_counts_list!=0) {
                                while($rs= mysqli_fetch_array($rows)){ 
                                
                                     echo "<option value='".$rs["server_ip"]."' title='".$rs["server_description"]."'>".$rs["server_id"]." [".$rs["server_ip"]."]</option>";
                                }
                             
                            }
                            mysqli_free_result($rows);
                        ?>
                    </select>
                    <span class="red">※</span></td>
                </tr>
                <tr>
                  <td align="right" >激活使用：</td>
                  <td ><select name="active" class="s_option" id="active">
                      <option value="Y">启用</option>
                      <option value="N">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >手动拨号：</td>
                  <td ><select name="agentcall_manual" class="s_option" id="agentcall_manual">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >通话录音：</td>
                  <td><select name="vicidial_recording" class="s_option" id="vicidial_recording">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >通话转移：</td>
                  <td><select name="vicidial_transfers" class="s_option" id="vicidial_transfers">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >使用热键：</td>
                  <td><select name="hotkeys_active" class="s_option" id="hotkeys_active">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >选择呼入组：</td>
                  <td><select name="agent_choose_ingroups" class="s_option" id="agent_choose_ingroups">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="">
                  <td align="right" >电话进线提醒：</td>
                  <td><select name="allow_alerts" class="s_option" id="allow_alerts">
                      <option value="1">启用</option>
                      <option value="0" selected="selected">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >可查询的坐席：</td>
                  <td><div id="route_type" class="bus_strategySel bus_strategySel_on" style="width:236px">
  <div class="strategySel_r">
    <div id="strategySel" style="width:319px">
      <span class="leftBorLine"></span>
      <div id="allow_users_none" class="sel" allow="none" title="可查询任何坐席的呼叫记录"><span class="lineBg">无限制</span></div>
      <div id="allow_users_self" class="noSel" allow="self" title="只可查询坐席个人的呼叫记录"><span class="lineBg">只查自己</span> </div>
      <div id="allow_users_setup" class="noSel" allow="setup" title="查询指定坐席的呼叫记录"><span class="lineBg">查询指定</span> </div>
      <span class="rightBorLine"></span> 
    </div>
  </div>
</div><div class="gray">重登陆查询页后生效</div></td>
                </tr>
                <tr>
                  <td align="right" >可查询的业务：</td>
                  <td><div id="route_type" class="bus_strategySel bus_strategySel_on" style="width:158px">
  <div class="strategySel_r">
    <div id="strategySel2" style="width:319px">
      <span class="leftBorLine leftBorLine_on"></span>
      <div id="allow_campaigns_none" class="sel" allow="none" title="不限定查询业务活动"><span class="lineBg">无限制</span></div>
      <div id="allow_campaigns_setup" class="noSel" allow="setup" title="查询指定业务活动的呼叫记录"><span class="lineBg">查询指定</span> </div>
      <span class="rightBorLine"></span> 
    </div>
  </div>
</div><span class="gray f">重登陆查询页后生效</span></td>
                </tr>
              </table>
            </fieldset></td>
          <td width="236" valign="top"><fieldset style="margin:-2px 2px 2px 2px">
              <legend style="font-weight:normal">
              <label>操作权限设置</label>
              </legend>
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><div id='tree_container' class='treeContainer' style='width:220px;height:390px'>
                      <div id='tree1' class='treeItem' style="overflow:hidden; overflow-x:hidden;overflow-y:scroll">
                        <table>
                          <tr>
                            <td><p id="TreeRoot"><img src='/images/icons/icon021a6.gif' align="absmiddle" style="margin-right:4px">
                               <input type="checkbox" name="chk_all_pope" id="chk_all_pope" value="1"/> <label for="chk_all_pope">所有权限</label>
                              </p>
                              <div id="tree_list">
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="view_reports">
                                    <input type="checkbox" name="view_reports" id="view_reports" value="1"/>
                                    查看报表</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="export_reports">
                                    <input type="checkbox" name="export_reports" id="export_reports" value="1"/>
                                    导出报表</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="vdc_agent_api_access">
                                    <input type="checkbox" name="vdc_agent_api_access" id="vdc_agent_api_access" value="1"/>
                                    质检录音</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="alter_agent_interface_options">
                                    <input type="checkbox" name="alter_agent_interface_options" id="alter_agent_interface_options" value="1"/>
                                    编辑坐席功能</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_users">
                                    <input type="checkbox" name="modify_users" id="modify_users" value="1"/>
                                    修改坐席资料</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="change_agent_campaign">
                                    <input type="checkbox" name="change_agent_campaign" id="change_agent_campaign" value="1"/>
                                    改变坐席活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_users">
                                    <input type="checkbox" name="delete_users" id="delete_users" value="1"/>
                                    删除坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_usergroups">
                                    <input type="checkbox" name="modify_usergroups" id="modify_usergroups" value="1"/>
                                    修改坐席组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_user_groups">
                                    <input type="checkbox" name="delete_user_groups" id="delete_user_groups" value="1"/>
                                    删除坐席组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_lists">
                                    <input type="checkbox" name="modify_lists" id="modify_lists" value="1"/>
                                    修改客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_lists">
                                    <input type="checkbox" name="delete_lists" id="delete_lists" value="1"/>
                                    删除客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="load_leads">
                                    <input type="checkbox" name="load_leads" id="load_leads" value="1"/>
                                    导入客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_leads">
                                    <input type="checkbox" name="modify_leads" id="modify_leads" value="1"/>
                                    修改客户资料</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="download_lists">
                                    <input type="checkbox" name="download_lists" id="download_lists" value="1"/>
                                    下载客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_from_dnc">
                                    <input type="checkbox" name="delete_from_dnc" id="delete_from_dnc" value="1"/>
                                    删除黑名单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_campaigns">
                                    <input type="checkbox" name="modify_campaigns" id="modify_campaigns" value="1"/>
                                    修改业务活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="campaign_detail">
                                    <input type="checkbox" name="campaign_detail" id="campaign_detail" value="1"/>
                                    查看活动配置</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_campaigns">
                                    <input type="checkbox" name="delete_campaigns" id="delete_campaigns" value="1"/>
                                    删除活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_ingroups">
                                    <input type="checkbox" name="modify_ingroups" id="modify_ingroups" value="1"/>
                                    修改呼入组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_ingroups">
                                    <input type="checkbox" name="delete_ingroups" id="delete_ingroups" value="1"/>
                                    删除呼入组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_inbound_dids">
                                    <input type="checkbox" name="modify_inbound_dids" id="modify_inbound_dids" value="1"/>
                                    修改DID</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_inbound_dids">
                                    <input type="checkbox" name="delete_inbound_dids" id="delete_inbound_dids" value="1"/>
                                    删除DID</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_remoteagents">
                                    <input type="checkbox" name="modify_remoteagents" id="modify_remoteagents" value="1"/>
                                    修改远程坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_remote_agents">
                                    <input type="checkbox" name="delete_remote_agents" id="delete_remote_agents" value="1"/>
                                    删除远程坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_scripts">
                                    <input type="checkbox" name="modify_scripts" id="modify_scripts" value="1"/>
                                    修改话术</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_scripts">
                                    <input type="checkbox" name="delete_scripts" id="delete_scripts" value="1"/>
                                    删除话术</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_filters">
                                    <input type="checkbox" name="modify_filters" id="modify_filters" value="1"/>
                                    修改过滤规则</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_filters">
                                    <input type="checkbox" name="delete_filters" id="delete_filters" value="1"/>
                                    删除过滤规则</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="ast_admin_access">
                                    <input type="checkbox" name="ast_admin_access" id="ast_admin_access" value="1"/>
                                    登陆管理后台</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="ast_delete_phones">
                                    <input type="checkbox" name="ast_delete_phones" id="ast_delete_phones" value="1"/>
                                    删除分机</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_call_times">
                                    <input type="checkbox" name="modify_call_times" id="modify_call_times" value="1"/>
                                    修改话务时间</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_call_times">
                                    <input type="checkbox" name="delete_call_times" id="delete_call_times" value="1"/>
                                    删除话务时间</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_servers">
                                    <input type="checkbox" name="modify_servers" id="modify_servers" value="1"/>
                                    修改服务器</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="add_timeclock_log">
                                    <input type="checkbox" name="add_timeclock_log" id="add_timeclock_log" value="1"/>
                                    添加时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_timeclock_log">
                                    <input type="checkbox" name="modify_timeclock_log" id="modify_timeclock_log" value="1"/>
                                    修改时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_timeclock_log">
                                    <input type="checkbox" name="delete_timeclock_log" id="delete_timeclock_log" value="1"/>
                                    删除时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon07.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="manager_shift_enforcement_override">
                                    <input type="checkbox" name="manager_shift_enforcement_override" id="manager_shift_enforcement_override" value="1" />
                                    管理强制班次-覆盖</label>
                                </p>
                              </div></td>
                          </tr>
                        </table>
                      </div>
                    </div></td>
                </tr>
              </table>
            </fieldset></td>
        </tr>
      </table>
      
    </form>
 
</div>
<?php 

break;

case "edit_user":
?>
<?php

$sql="select user,a.pass,full_name,user_level,user_group,a.email,b.server_ip,a.active,phone_login,agentcall_manual,vicidial_recording,vicidial_transfers,hotkeys_active,agent_choose_ingroups,view_reports,export_reports,vdc_agent_api_access,alter_agent_interface_options,modify_users,change_agent_campaign,delete_users,modify_usergroups,delete_user_groups,modify_lists,delete_lists,load_leads,modify_leads,download_lists,delete_from_dnc,modify_campaigns,campaign_detail,delete_campaigns,modify_ingroups,delete_ingroups,modify_inbound_dids,delete_inbound_dids,modify_remoteagents,delete_remote_agents,modify_scripts,delete_scripts,modify_filters,delete_filters,ast_admin_access,ast_delete_phones,modify_call_times,delete_call_times,modify_servers,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,manager_shift_enforcement_override,allow_alerts,allow_users,allow_campaigns from vicidial_users a left join phones b on a.phone_login=b.extension where a.user_id='".$user_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

$list_arr=array();
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$user=$rs["user"];
 		$pass=$rs["pass"];
 		$full_name=$rs["full_name"];
		$user_level=$rs["user_level"];
  		$user_group=$rs["user_group"];
		$email=$rs["email"];
		$phone_login=$rs["phone_login"];
		
		$allow_users=$rs["allow_users"];
		$allow_campaigns=$rs["allow_campaigns"];
		
 		$delete_users=$rs["delete_users"];
		if($delete_users=="1"){$delete_users="true";}else{$delete_users="false";}
		
 		$delete_user_groups=$rs["delete_user_groups"];
		if($delete_user_groups=="1"){$delete_user_groups="true";}else{$delete_user_groups="false";}
		
		$delete_lists=$rs["delete_lists"];
		if($delete_lists=="1"){$delete_lists="true";}else{$delete_lists="false";}
		
  		$delete_campaigns=$rs["delete_campaigns"];
		if($delete_campaigns=="1"){$delete_campaigns="true";}else{$delete_campaigns="false";}
		
 		$delete_ingroups=$rs["delete_ingroups"];
		if($delete_ingroups=="1"){$delete_ingroups="true";}else{$delete_ingroups="false";}
		
 		$delete_remote_agents=$rs["delete_remote_agents"];
		if($delete_remote_agents=="1"){$delete_remote_agents="true";}else{$delete_remote_agents="false";}
		
		$load_leads=$rs["load_leads"];
		if($load_leads=="1"){$load_leads="true";}else{$load_leads="false";}
		
  		$campaign_detail=$rs["campaign_detail"];
		if($campaign_detail=="1"){$campaign_detail="true";}else{$campaign_detail="false";}
		
 		$ast_admin_access=$rs["ast_admin_access"];
		if($ast_admin_access=="1"){$ast_admin_access="true";}else{$ast_admin_access="false";}
		
 		$ast_delete_phones=$rs["ast_delete_phones"];
		if($ast_delete_phones=="1"){$ast_delete_phones="true";}else{$ast_delete_phones="false";}
		
		$delete_scripts=$rs["delete_scripts"];
		if($delete_scripts=="1"){$delete_scripts="true";}else{$delete_scripts="false";}
		
  		$modify_leads=$rs["modify_leads"];
		if($modify_leads=="1"){$modify_leads="true";}else{$modify_leads="false";}
		
 		$change_agent_campaign=$rs["change_agent_campaign"];
		if($change_agent_campaign=="1"){$change_agent_campaign="true";}else{$change_agent_campaign="false";}
  		
  		$delete_filters=$rs["delete_filters"];
		if($delete_filters=="1"){$delete_filters="true";}else{$delete_filters="false";}
		
 		$alter_agent_interface_options=$rs["alter_agent_interface_options"];
		if($alter_agent_interface_options=="1"){$alter_agent_interface_options="true";}else{$alter_agent_interface_options="false";}
  		
  		$delete_call_times=$rs["delete_call_times"];
		if($delete_call_times=="1"){$delete_call_times="true";}else{$delete_call_times="false";}
		
 		$modify_call_times=$rs["modify_call_times"];
		if($modify_call_times=="1"){$modify_call_times="true";}else{$modify_call_times="false";}
		
 		$modify_users=$rs["modify_users"];
		if($modify_users=="1"){$modify_users="true";}else{$modify_users="false";}
		
		$modify_campaigns=$rs["modify_campaigns"];
		if($modify_campaigns=="1"){$modify_campaigns="true";}else{$modify_campaigns="false";}
		
  		$modify_lists=$rs["modify_lists"];
		if($modify_lists=="1"){$modify_lists="true";}else{$modify_lists="false";}
		
 		$modify_scripts=$rs["modify_scripts"];
		if($modify_scripts=="1"){$modify_scripts="true";}else{$modify_scripts="false";}
		
 		$modify_filters=$rs["modify_filters"];
		if($modify_filters=="1"){$modify_filters="true";}else{$modify_filters="false";}
		
		$modify_ingroups=$rs["modify_ingroups"];
		if($modify_ingroups=="1"){$modify_ingroups="true";}else{$modify_ingroups="false";}
		
  		$modify_usergroups=$rs["modify_usergroups"];
		if($modify_usergroups=="1"){$modify_usergroups="true";}else{$modify_usergroups="false";}
		
 		$modify_remoteagents=$rs["modify_remoteagents"];
		if($modify_remoteagents=="1"){$modify_remoteagents="true";}else{$modify_remoteagents="false";}
		
 		$modify_servers=$rs["modify_servers"];
		if($modify_servers=="1"){$modify_servers="true";}else{$modify_servers="false";}
		
		$view_reports=$rs["view_reports"];
		if($view_reports=="1"){$view_reports="true";}else{$view_reports="false";}
    		
		$add_timeclock_log=$rs["add_timeclock_log"];
		if($add_timeclock_log=="1"){$add_timeclock_log="true";}else{$add_timeclock_log="false";}
		
  		$modify_timeclock_log=$rs["modify_timeclock_log"];
		if($modify_timeclock_log=="1"){$modify_timeclock_log="true";}else{$modify_timeclock_log="false";}
		
 		$delete_timeclock_log=$rs["delete_timeclock_log"];
		if($delete_timeclock_log=="1"){$delete_timeclock_log="true";}else{$delete_timeclock_log="false";}
 		
		$vdc_agent_api_access=$rs["vdc_agent_api_access"];
		if($vdc_agent_api_access=="1"){$vdc_agent_api_access="true";}else{$vdc_agent_api_access="false";}
		
  		$modify_inbound_dids=$rs["modify_inbound_dids"];
		if($modify_inbound_dids=="1"){$modify_inbound_dids="true";}else{$modify_inbound_dids="false";}
		
 		$delete_inbound_dids=$rs["delete_inbound_dids"];
		if($delete_inbound_dids=="1"){$delete_inbound_dids="true";}else{$delete_inbound_dids="false";}
  		
  		$download_lists=$rs["download_lists"];
		if($download_lists=="1"){$download_lists="true";}else{$download_lists="false";}
 		
 		$manager_shift_enforcement_override=$rs["manager_shift_enforcement_override"];
		if($manager_shift_enforcement_override=="1"){$manager_shift_enforcement_override="true";}else{$manager_shift_enforcement_override="false";}
		
		$export_reports=$rs["export_reports"];
		if($export_reports=="1"){$export_reports="true";}else{$export_reports="false";}
		
 		$delete_from_dnc=$rs["delete_from_dnc"];
		if($delete_from_dnc=="1"){$delete_from_dnc="true";}else{$delete_from_dnc="false";}
 		
		////////////////////////
		$active=strtoupper($rs["active"]);
  		$agentcall_manual=$rs["agentcall_manual"];
 		$vicidial_recording=$rs["vicidial_recording"];
   		$vicidial_transfers=$rs["vicidial_transfers"];
   		$hotkeys_active=$rs["hotkeys_active"];
 		$agent_choose_ingroups=$rs["agent_choose_ingroups"];
		$allow_alerts=$rs["allow_alerts"];
		$server_ip=$rs["server_ip"];
    }
  	//$("#delete_users").attr("checked",'.$delete_users.');
	//if($active=='1'){$active='true';}else{$active='false';}
	echo "<script>$(document).ready(
	function(){
		$('.td_underline tr:visible:odd').addClass('alt');
		$('#tree_list label').bind('click',function(){
			set_tree_class();
		}).hover(
			function(){
				$(this)	.parent().addClass('cur');			
			},function(){
				$(this)	.parent().removeClass('cur');			
			}
		);
		
		$('div.strategySel_r div').click(function(event){
		
			var e=window.event || event;
			if(e.stopPropagation){
				e.stopPropagation();
			}else{
				e.cancelBubble = true;
			}
			 
		});
		
		$('div.opt_f_list').click(function(event){  
		  var e=window.event || event;  
		  if(e.stopPropagation){  
			e.stopPropagation();  
		  }else{  
			e.cancelBubble = true;  
		  }  
		});
		
		$(document).click(function(){
			$('div.opt_f_list').hide();
		});
		
		$('#chk_all_pope').click(function(){
			var checkbox=$('#tree_list :checkbox:enabled');
			if(this.checked==true){
				$(checkbox).attr('checked',this.checked);
			}else{
				$(checkbox).attr('checked',this.checked);
			}
		});
		
		$('#strategySel div').click(function(){
			\$this=$(this);
		　　\$this.addClass('sel').removeClass('noSel').siblings().removeClass('sel').addClass('noSel').children('span').removeClass('lineBg_on');
			\$this.children('span').addClass('lineBg_on');
			x_top1=\$this.offset().top;
			attrs=\$this.attr('allow');
			(attrs=='setup')?show_types_list('users',1,x_top1):$('#opt_layer_1').hide();
			$('#allow_users').val(attrs);
		});
		
		
		$('#strategySel2 div').click(function(){
			\$this=$(this);
		　　\$this.addClass('sel').removeClass('noSel').siblings().removeClass('sel').addClass('noSel').children('span').removeClass('lineBg_on');
			\$this.children('span').addClass('lineBg_on');
			x_top2=\$this.offset().top;
			attrs=\$this.attr('allow');
			(attrs=='setup')?show_types_list('campaigns',2,x_top2):$('#opt_layer_2').hide();
			$('#allow_campaigns').val(attrs);
		});
		
 		$('#allow_campaigns_".$allow_campaigns."').addClass('sel').removeClass('noSel').children('span').addClass('lineBg_on');
		$('#allow_users_".$allow_users."').addClass('sel').removeClass('noSel').children('span').addClass('lineBg_on');		
    		 
		$('#user_level').val('".$user_level."');
  		$('#user_group').val('".$user_group."'); 
		$('#server_ip').val('".$server_ip."'); 
		
		$('#active').val('".$active."');
 		$('#agentcall_manual').val('".$agentcall_manual."');
		$('#vicidial_recording').val('".$vicidial_recording."');
		$('#vicidial_transfers').val('".$vicidial_transfers."');
		$('#hotkeys_active').val('".$hotkeys_active."');
		$('#agent_choose_ingroups').val('".$agent_choose_ingroups."');
		$('#allow_alerts').val('".$allow_alerts."');
		
 		$('#view_reports').attr('checked',".$view_reports.");
		$('#export_reports').attr('checked',".$export_reports.");
		$('#vdc_agent_api_access').attr('checked',".$vdc_agent_api_access.");
		$('#alter_agent_interface_options').attr('checked',".$alter_agent_interface_options.");
		$('#modify_users').attr('checked',".$modify_users.");
		$('#change_agent_campaign').attr('checked',".$change_agent_campaign.");
		$('#delete_users').attr('checked',".$delete_users.");
		$('#modify_usergroups').attr('checked',".$modify_usergroups.");
		$('#delete_user_groups').attr('checked',".$delete_user_groups.");
		$('#modify_lists').attr('checked',".$modify_lists.");
		$('#delete_lists').attr('checked',".$delete_lists.");
		$('#load_leads').attr('checked',".$load_leads.");
		$('#modify_leads').attr('checked',".$modify_leads.");
		$('#download_lists').attr('checked',".$download_lists.");
		$('#delete_from_dnc').attr('checked',".$delete_from_dnc.");
		$('#modify_campaigns').attr('checked',".$modify_campaigns.");
		$('#campaign_detail').attr('checked',".$campaign_detail.");
		$('#delete_campaigns').attr('checked',".$delete_campaigns.");
		$('#modify_ingroups').attr('checked',".$modify_ingroups.");
		$('#delete_ingroups').attr('checked',".$delete_ingroups.");
		$('#modify_inbound_dids').attr('checked',".$modify_inbound_dids.");
		$('#delete_inbound_dids').attr('checked',".$delete_inbound_dids.");
		$('#modify_remoteagents').attr('checked',".$modify_remoteagents.");
		$('#delete_remote_agents').attr('checked',".$delete_remote_agents.");
		$('#modify_scripts').attr('checked',".$modify_scripts.");
		$('#delete_scripts').attr('checked',".$delete_scripts.");
		$('#modify_filters').attr('checked',".$modify_filters.");
		$('#delete_filters').attr('checked',".$delete_filters.");
		$('#ast_admin_access').attr('checked',".$ast_admin_access.");
		$('#ast_delete_phones').attr('checked',".$ast_delete_phones.");
		$('#modify_call_times').attr('checked',".$modify_call_times.");
		$('#delete_call_times').attr('checked',".$delete_call_times.");
		$('#modify_servers').attr('checked',".$modify_servers.");
		$('#add_timeclock_log').attr('checked',".$add_timeclock_log.");
		$('#modify_timeclock_log').attr('checked',".$modify_timeclock_log.");
		$('#delete_timeclock_log').attr('checked',".$delete_timeclock_log.");
		$('#manager_shift_enforcement_override').attr('checked',".$manager_shift_enforcement_override.");
		 
	});
	</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("坐席工号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<script>

function do_edit_user(){
	
	if($("#full_name").val() == "")
	{
		alert("请填写坐席姓名！");
		$("#full_name").focus();
		return false;
	}else if($("#full_name").val().length>20||$("#full_name").val().length<2){
		alert("坐席姓名位数必须介于2-20位字符之间！");
		$("#full_name").select();
		return false;
	}

	if($("#pass").val() == "")
	{
		alert("请填写坐席密码！");
		$("#pass").focus();
		return false;
	}else if($("#pass").val().length>20||$("#pass").val().length<2){
		alert("坐席密码位数必须介于2-20位字符之间！");
		$("#pass").select();
		return false;
	}
	
	if($("#user_group").val() == "")
	{
		alert("请选择坐席组！");
		$("#user_group").focus();
		return false;
	}
   	  
	$('#load').show();
	var datas="action=user_set&do_actions=update&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 request_tip(json.des,json.counts);
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			 
 			$(_DialogInstance.ParentWindow.document).find("#name_<?php echo $user_id ?>").html("<span class='green'>"+$("#full_name").val()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#level_<?php echo $user_id ?>").html("<span class='green'>"+$("#user_level").val()+"</span>");
 			$(_DialogInstance.ParentWindow.document).find("#group_<?php echo $user_id ?>").html("<span class='green'>"+$("#user_group option:selected").text()+"</span>");
			//if($(":input[name=active]:checked").val()=="Y"){active="启用"}else{active="禁用"}
			$(_DialogInstance.ParentWindow.document).find("#active_<?php echo $user_id ?>").html("<span class='green'>"+$("#active option:selected").text()+"</span>");
   			
			setTimeout('Dialog.close();',10);
		  }else{
			  alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">坐席管理</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
   
    <form action="" method="post" name="form1" id="form1">
    
        <input type="hidden" name="allow_users_list" id="allow_users_list" value="0"/>
        <input type="hidden" name="allow_campaigns_list" id="allow_campaigns_list" value="0"/>
        
        <input type="hidden" name="allow_users" id="allow_users" value="<?php echo $allow_users ?>"/>
        <input type="hidden" name="allow_campaigns" id="allow_campaigns" value="<?php echo $allow_campaigns ?>"/>

    
      <table width="99%" align="center" cellspacing="0">
        <tr>
          <td valign="top" ><fieldset style="margin:-2px 2px 2px 2px">
              <legend style="font-weight:normal">
              <label>基本信息</label>
              </legend>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_underline">
                <tr>
                  <td width="30%" align="right" nowrap="nowrap" >坐席工号：</td>
                  <td class="blue"><strong><?php echo $user ?></strong>
                    <input name="user" type="hidden" id="user" value="<?php echo $user;?>" />
                    <input name="user_id" type="hidden" id="user_id" value="<?php echo $user_id;?>" />
                    <input name="phone_login" type="hidden" id="phone_login" value="<?php echo $phone_login;?>" /></td>
                </tr>
                <tr>
                  <td align="right" >坐席姓名：</td>
                  <td><input name="full_name"  type="text" id="full_name" size="30" class="s_input" maxlength="15"  value="<?php echo $full_name ?>"/>
                    <span class="red">※</span><span class="gray">2-15个字符长度</span></td>
                </tr>
                <tr >
                  <td align="right" >坐席密码：</td>
                  <td><input name="pass" type="text" id="pass"  size="30" class="s_input" maxlength="10"  onkeyup="this.value=value.replace(/[^\w\/_,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/_,]/ig,'')" value="<?php echo $pass ?>"/>
                    <span class="red">※</span><span class="gray">2-10个字符长度</span></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >坐席邮箱：</td>
                  <td><input name="email"  type="text" id="email" size="30" class="s_input" maxlength="20"  value="<?php echo $email ?>" onkeyup="this.value=value.replace(/[^\w\/@-_,.]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/@-_,.]/ig,'')"/></td>
                </tr>
                <tr >
                  <td align="right" >坐席级别：</td>
                  <td><select name="user_level" class="s_option" id="user_level">
                      <?php
                for($i=1;$i<10;$i++){
            ?>
                      <option value="<?php echo $i?>"><?php echo $i?></option>
                      <?php
                }
            ?>
                    </select>
                    <span class="red">※</span></td>
                </tr>
                <tr>
                  <td align="right" >坐席组别：</td>
                  <td ><select name="user_group" class="s_option" id="user_group" >
                      <?php 
                
                    $sql="select user_group,group_name from vicidial_user_groups order by user_group desc";
                    
                    $rows=mysqli_query($db_conn,$sql);
                    $row_counts_list=mysqli_num_rows($rows);			
                    
                    if ($row_counts_list!=0) {
                        while($rs= mysqli_fetch_array($rows)){ 
                        
                             echo "<option value='".$rs["user_group"]."'>".$rs["group_name"]."</option>";
                        }
                     
                    }else {
                         
                    }
                    mysqli_free_result($rows);
                ?>
                    </select>
                    <span class="red">※</span></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >注册服务器：</td>
                  <td ><select name="server_ip" class="s_option" id="server_ip" >
                      <?php 
                
                    $sql="select server_ip,server_id,server_description from servers order by server_id";
                    
                    $rows=mysqli_query($db_conn,$sql);
                    $row_counts_list=mysqli_num_rows($rows);			
                    
                    if ($row_counts_list!=0) {
                        while($rs= mysqli_fetch_array($rows)){ 
                        
                             echo "<option value='".$rs["server_ip"]."' tile='".$rs["server_description"]."'>".$rs["server_id"]." [".$rs["server_ip"]."]</option>";
                        }
                     
                    }else {
                         
                    }
                    mysqli_free_result($rows);
                ?>
                    </select>
                    <span class="red">※</span></td>
                </tr>
                <tr>
                  <td align="right" >激活使用：</td>
                  <td ><select name="active" class="s_option" id="active">
                      <option value="Y">启用</option>
                      <option value="N">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >手动拨号：</td>
                  <td ><select name="agentcall_manual" class="s_option" id="agentcall_manual">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >通话录音：</td>
                  <td><select name="vicidial_recording" class="s_option" id="vicidial_recording">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >通话转移：</td>
                  <td><select name="vicidial_transfers" class="s_option" id="vicidial_transfers">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >使用热键：</td>
                  <td><select name="hotkeys_active" class="s_option" id="hotkeys_active">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >选择呼入组：</td>
                  <td><select name="agent_choose_ingroups" class="s_option" id="agent_choose_ingroups">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="">
                  <td align="right" >电话进线提醒：</td>
                  <td><select name="allow_alerts" class="s_option" id="allow_alerts">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >可查询的坐席：</td>
                  <td><div id="route_type" class="bus_strategySel bus_strategySel_on" style="width:236px">
  <div class="strategySel_r">
    <div id="strategySel" style="width:319px">
      <span class="leftBorLine"></span>
      <div id="allow_users_none" class="noSel" allow="none" title="可查询任何坐席的呼叫记录"><span class="lineBg">无限制</span></div>
      <div id="allow_users_self" class="noSel" allow="self" title="只可查询坐席个人的呼叫记录"><span class="lineBg">只查自己</span> </div>
      <div id="allow_users_setup" class="noSel" allow="setup" title="查询指定坐席的呼叫记录"><span class="lineBg">查询指定</span> </div>
      <span class="rightBorLine"></span> 
    </div>
  </div>
</div><span class="gray">重登陆查询页后生效</span></td>
                </tr>
                <tr>
                  <td align="right" >可查询的业务：</td>
                  <td><div id="route_type" class="bus_strategySel bus_strategySel_on" style="width:158px">
  <div class="strategySel_r">
    <div id="strategySel2" style="width:319px">
      <span class="leftBorLine leftBorLine_on"></span>
      <div id="allow_campaigns_none" class="noSel" allow="none" title="不限定查询业务活动"><span class="lineBg">无限制</span></div>
      <div id="allow_campaigns_setup" class="noSel" allow="setup" title="查询指定业务活动的呼叫记录"><span class="lineBg">查询指定</span> </div>
      <span class="rightBorLine"></span> 
    </div>
  </div>
</div><span class="gray">重登陆查询页后生效</span></td>
                </tr>
              </table>
            </fieldset></td>
          <td width="236" valign="top"><fieldset style="margin:-2px 2px 2px 2px">
              <legend style="font-weight:normal">
              <label>操作权限设置</label>
              </legend>
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><div id='tree_container' class='treeContainer' style='width:220px;height:390px'>
                      <div id='tree1' class='treeItem' style="overflow:hidden; overflow-x:hidden;overflow-y:scroll">
                        <table>
                          <tr>
                            <td><p id="TreeRoot"><img src='/images/icons/icon021a6.gif' align="absmiddle" style="margin-right:4px"><input type="checkbox" name="chk_all_pope" id="chk_all_pope" value="1"/> <label for="chk_all_pope">所有权限</label></p>
                              <div id="tree_list">
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="view_reports">
                                    <input type="checkbox" name="view_reports" id="view_reports" value="1"/>
                                    查看报表</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="export_reports">
                                    <input type="checkbox" name="export_reports" id="export_reports" value="1"/>
                                    导出报表</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="vdc_agent_api_access">
                                    <input type="checkbox" name="vdc_agent_api_access" id="vdc_agent_api_access" value="1"/>
                                    质检录音</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="alter_agent_interface_options">
                                    <input type="checkbox" name="alter_agent_interface_options" id="alter_agent_interface_options" value="1"/>
                                    编辑坐席功能</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_users">
                                    <input type="checkbox" name="modify_users" id="modify_users" value="1"/>
                                    修改坐席资料</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="change_agent_campaign">
                                    <input type="checkbox" name="change_agent_campaign" id="change_agent_campaign" value="1"/>
                                    改变坐席活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_users">
                                    <input type="checkbox" name="delete_users" id="delete_users" value="1"/>
                                    删除坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_usergroups">
                                    <input type="checkbox" name="modify_usergroups" id="modify_usergroups" value="1"/>
                                    修改坐席组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_user_groups">
                                    <input type="checkbox" name="delete_user_groups" id="delete_user_groups" value="1"/>
                                    删除坐席组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_lists">
                                    <input type="checkbox" name="modify_lists" id="modify_lists" value="1"/>
                                    修改客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_lists">
                                    <input type="checkbox" name="delete_lists" id="delete_lists" value="1"/>
                                    删除客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="load_leads">
                                    <input type="checkbox" name="load_leads" id="load_leads" value="1"/>
                                    导入客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_leads">
                                    <input type="checkbox" name="modify_leads" id="modify_leads" value="1"/>
                                    修改客户资料</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="download_lists">
                                    <input type="checkbox" name="download_lists" id="download_lists" value="1"/>
                                    下载客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_from_dnc">
                                    <input type="checkbox" name="delete_from_dnc" id="delete_from_dnc" value="1"/>
                                    删除黑名单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_campaigns">
                                    <input type="checkbox" name="modify_campaigns" id="modify_campaigns" value="1"/>
                                    修改业务活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="campaign_detail">
                                    <input type="checkbox" name="campaign_detail" id="campaign_detail" value="1"/>
                                    查看活动配置</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_campaigns">
                                    <input type="checkbox" name="delete_campaigns" id="delete_campaigns" value="1"/>
                                    删除活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_ingroups">
                                    <input type="checkbox" name="modify_ingroups" id="modify_ingroups" value="1"/>
                                    修改呼入组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_ingroups">
                                    <input type="checkbox" name="delete_ingroups" id="delete_ingroups" value="1"/>
                                    删除呼入组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_inbound_dids">
                                    <input type="checkbox" name="modify_inbound_dids" id="modify_inbound_dids" value="1"/>
                                    修改DID</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_inbound_dids">
                                    <input type="checkbox" name="delete_inbound_dids" id="delete_inbound_dids" value="1"/>
                                    删除DID</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_remoteagents">
                                    <input type="checkbox" name="modify_remoteagents" id="modify_remoteagents" value="1"/>
                                    修改远程坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_remote_agents">
                                    <input type="checkbox" name="delete_remote_agents" id="delete_remote_agents" value="1"/>
                                    删除远程坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_scripts">
                                    <input type="checkbox" name="modify_scripts" id="modify_scripts" value="1"/>
                                    修改话术</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_scripts">
                                    <input type="checkbox" name="delete_scripts" id="delete_scripts" value="1"/>
                                    删除话术</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_filters">
                                    <input type="checkbox" name="modify_filters" id="modify_filters" value="1"/>
                                    修改过滤规则</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_filters">
                                    <input type="checkbox" name="delete_filters" id="delete_filters" value="1"/>
                                    删除过滤规则</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="ast_admin_access">
                                    <input type="checkbox" name="ast_admin_access" id="ast_admin_access" value="1"/>
                                    登陆管理后台</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="ast_delete_phones">
                                    <input type="checkbox" name="ast_delete_phones" id="ast_delete_phones" value="1"/>
                                    删除分机</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_call_times">
                                    <input type="checkbox" name="modify_call_times" id="modify_call_times" value="1"/>
                                    修改话务时间</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_call_times">
                                    <input type="checkbox" name="delete_call_times" id="delete_call_times" value="1"/>
                                    删除话务时间</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_servers">
                                    <input type="checkbox" name="modify_servers" id="modify_servers" value="1"/>
                                    修改服务器</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="add_timeclock_log">
                                    <input type="checkbox" name="add_timeclock_log" id="add_timeclock_log" value="1"/>
                                    添加时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_timeclock_log">
                                    <input type="checkbox" name="modify_timeclock_log" id="modify_timeclock_log" value="1"/>
                                    修改时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_timeclock_log">
                                    <input type="checkbox" name="delete_timeclock_log" id="delete_timeclock_log" value="1"/>
                                    删除时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon07.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="manager_shift_enforcement_override">
                                    <input type="checkbox" name="manager_shift_enforcement_override" id="manager_shift_enforcement_override" value="1" />
                                    管理强制班次-覆盖</label>
                                </p>
                              </div></td>
                          </tr>
                        </table>
                      </div>
                    </div></td>
                </tr>
              </table>
            </fieldset></td>
        </tr>
      </table>
    </form>
   
</div>
<?php 

break;

//复制用户
case "copy_user":
?>
<script>

function do_copy_user(){
	
	if($("#user").val() == "")
	{
		alert("请填写坐席工号！");
		$("#user").focus();
		return false;
	}else if($("#user").val().length>20||$("#user").val().length<2){
		alert("坐席工号位数必须介于2-20位字符之间！");
		$("#user").select();
		return false;
	}
	
	if($("#full_name").val() == "")
	{
		alert("请填写坐席姓名！");
		$("#full_name").focus();
		return false;
	}else if($("#full_name").val().length>20||$("#full_name").val().length<2){
		alert("坐席姓名位数必须介于2-20位字符之间！");
		$("#full_name").select();
		return false;
	}

	if($("#pass").val() == "")
	{
		alert("请填写坐席密码！");
		$("#pass").focus();
		return false;
	}else if($("#pass").val().length>20||$("#pass").val().length<2){
		alert("坐席密码位数必须介于2-20位字符之间！");
		$("#pass").select();
		return false;
	}
	
	if($("#source_user_id").val() == "")
	{
		alert("请选择来源坐席！");
		$("#source_user_id").focus();
		return false;
	}	
	
 	$('#load').show();
	var datas="action=user_set&do_actions=copy&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		  request_tip(json.des,json.counts);
		  _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		  if(json.counts=="1"){
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
 				setTimeout('Dialog.close();',10);
		  }else{
			 alert(json.des);
 		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }

 
//获取工号列表
function get_user_list(){
	//alert(turn_val);
   	var datas="action=get_user_all_list"+times;
	//alert(datas);
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
  		success: function(json){ 
			 
			$("#source_user_id option").remove();
			$("<option value='' selected='selected'>请选择来源坐席</option>").appendTo($("#source_user_id")); 
    		$.each(json.datalist,function(index,con){
				 
 				$("<option value='"+con.user+"' title='"+con.full_name+"--"+con.user+"' name='"+con.full_name+"' pass='"+con.pass+"'>"+con.full_name+" ["+con.user+"]</option>").appendTo($("#source_user_id"));
 				
			})
		}
	});
	
} 

function copy_set(select_val){
	
	$("#full_name").val($("#source_user_id option[value='"+select_val+"']").attr("name"));
	$("#pass").val($("#source_user_id option[value='"+select_val+"']").attr("pass"));
}
 
$(document).ready(function(){
	get_user_list();
	//$("#user").focus();
	$('.td_underline tr:visible:odd').addClass('alt');
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">坐席管理</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
              <tr>
                <td  align="right" nowrap="nowrap">来源坐席：</td>
                <td align="left"><span style="float:left">
                  <select name="source_user_id" class="s_option" id="source_user_id" onchange="copy_set(this.value)" >
                  </select>
                  </span><span class="gray">&nbsp;复制该坐席工号所有设置</span></td>
              </tr>
              <tr>
                <td width="20%"  align="right" nowrap="nowrap">坐席工号：</td>
                <td align="left"><input name="user" type="text" class="s_input" id="user" style="" onblur="check_user()" size="36" maxlength="15" />
                  <span class="red">※</span><span class="gray">2-15个字符长度</span></td>
              </tr>
              <tr>
                <td  align="right" nowrap="nowrap">坐席姓名：</td>
                <td align="left"><input name="full_name" type="text" class="s_input" id="full_name" style="" size="36" maxlength="15" />
                  <span class="red">※</span><span class="gray">2-15个字符长度</span></td>
              </tr>
              <tr>
                <td  align="right" nowrap="nowrap">坐席密码：</td>
                <td align="left"><input name="pass" type="text" class="s_input" id="pass" style="" size="36" maxlength="10" />
                  <span class="red">※</span><span class="gray">2-10个字符长度</span></td>
              </tr>
            </table>
    </form>
  </fieldset>
</div>
<?php
break;

case "add_user_group":
?>
<script>

function do_add_user_group(){
   	
	if($("#user_group").val() == "")
	{
		alert("请填写坐席组ID！");
		$("#user_group").focus();
		return false;
	}else if($("#user_group").val().length>20||$("#user_group").val().length<2){
		alert("坐席组ID位数必须介于2-20位字符之间！");
		$("#user_group").select();
		return false;
	}
	
	if($("#group_name").val() == "")
	{
		alert("请填写坐席组名称！");
		$("#group_name").focus();
		return false;
	}else if($("#group_name").val().length>20||$("#group_name").val().length<2){
		alert("坐席组名称位数必须介于2-20位字符之间！");
		$("#group_name").select();
		return false;
	}
 	
	var campaigns="",shifts="",groups="";
  	
 	$('input[name="group_shifts"]:checked').each(function(i){
		shifts+=" "+$(this).val();
  	}); 
	
	/*if(shifts!=""&&shifts.substr(shifts.length-1)==" "){
		shifts=shifts.substr(0,shifts.length-1);
	}*/
	
 	$('input[name="campaigns"]:checked').each(function(i){
		campaigns+=" "+$(this).val();
  	}); 
	
	/*if(campaigns!=""&&campaigns.substr(campaigns.length-1)==" "){
		campaigns=campaigns.substr(0,campaigns.length-1);
	}*/
	
 	$('input[name="agent_status_viewable_groups"]:checked').each(function(i){
		groups+=" "+$(this).val();
  	}); 
	
	/*if(groups!=""&&groups.substr(groups.length-1)==" "){
		groups=groups.substr(0,groups.length-1);
	}*/
 	
 	$('#load').show();
	var datas="action=user_group_set&do_actions=add&campaigns="+campaigns+"&agent_status_viewable_groups="+groups+"&group_shifts="+shifts+"&"+$('#form1').serialize()+times;
	
	//alert(datas);
	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		    request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
 				 
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 
    
$(document).ready(function(){
 	$('.td_underline tr:visible:odd').addClass('alt');
	$("#tree_list label").bind("click",function(){
		set_tree_class();
	}).hover(
		function(){
			$(this)	.parent().addClass("cur");			
		},function(){
			$(this)	.parent().removeClass("cur");			
		}
	);
	
});
 
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">坐席组管理</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <input name="user_id" id="user_id" type="hidden" value="" />
  <input name="form_index" id="form_index" type="hidden" value="1" />
   
    <table width="99%" align="center" cellspacing="0">
      <tr>
        <td valign="top" ><fieldset style="margin:-2px 2px 2px 2px">
            <legend style="font-weight:normal">
            <label>基本信息</label>
            </legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_underline">
              <form action="" method="post" name="form1" id="form1">
                <tr>
                  <td width="26%" align="right" nowrap="nowrap" >坐席组ID：</td>
                  <td><input name="user_group"  type="text" id="user_group" size="30" class="s_input" maxlength="20" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')" onblur="this.value=value.replace(/[^\w\/,]/ig,'');check_user_group()"/>
                    <span class="red">※</span><span class="gray">2-20个字符长度</span></td>
                </tr>
                <tr>
                  <td align="right" >坐席组名：</td>
                  <td><input name="group_name"  type="text" id="group_name" size="30" class="s_input" maxlength="20" /></td>
                </tr>
                <tr >
                  <td align="right" >强制时间锁登陆：</td>
                  <td><select name="forced_timeclock_login" class="s_option" id="forced_timeclock_login">
                      <option value="N" selected="selected">禁用</option>
                      <option value="Y">启用</option>
                      <option value="ADMIN_EXEMPT">管理员例外</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >坐席组班次：</td>
                  <td><select name="shift_enforcement" class="s_option" id="shift_enforcement">
                      <option value="OFF" selected="selected">禁用</option>
                      <option value="START">开始</option>
                      <option value="ALL">所有用户</option>
                      <option value="ADMIN_EXEMPT">管理员例外</option>
                    </select></td>
                </tr>
                <tr >
                  <td align="right" >坐席状态浏览时间：</td>
                  <td><select name="agent_status_view_time" class="s_option" id="agent_status_view_time">
                      <option selected="selected" value="N">禁用</option>
                      <option value="Y">启用</option>
                    </select></td>
                </tr>
              </form>
              <tr>
                <td align="right" >坐席组班次：</td>
                <td ><table border="0" cellpadding="2" cellspacing="0" class="dataTable" style="margin-top:4px; margin-bottom:4px; width:99%" id="datatable_time">
                    <thead>
                      <tr align="left" class="dataHead">
                        <td width="30" style="font-weight:normal">选择</td>
                        <td style="font-weight:normal">时间班次</td>
                        <td width="50" style="font-weight:normal">操作</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
 							
								$sql="SELECT shift_id,shift_name from vicidial_shifts order by shift_id";
								
								$rows=mysqli_query($db_conn,$sql);
								$row_counts_list=mysqli_num_rows($rows);			
								
								if ($row_counts_list!=0) {
									$i=0;
									while($rs= mysqli_fetch_array($rows)){ 
										$i++;
										$class="";
										if($i%2==1){
											$class=" class='tr_write_bg'";
										}
										echo "<tr $class>\n
										  <td><input type='checkbox' name='group_shifts' id='shift_".$rs["shift_id"]."' value='".$rs["shift_id"]."'></td>
										  <td><label for='shift_".$rs["shift_id"]."'>".$rs["shift_name"]."</label></td>
										  
										  <td><label for='shift_".$rs["shift_id"]."'><span style='color:#08d;'>选择</span></label></td>
										   
										</tr>";
									}
								 
								}else {
									 
								}
								mysqli_free_result($rows);
							?>
                    </tbody>
                  </table></td>
              </tr>
              <tr>
                <td align="right" >可查看用户组：</td>
                <td ><table border="0" cellpadding="2" cellspacing="0" class="dataTable" style="margin-top:4px; margin-bottom:4px; width:99%" id="datatable_campaings">
                    <thead>
                      <tr align="left" class="dataHead">
                        <td width="30" style="font-weight:normal">选择</td>
                        <td style="font-weight:normal">坐席组</td>
                        <td width="50" style="font-weight:normal">操作</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr_write_bg" >
                        <td ><input type="checkbox" name="agent_status_viewable_groups" id="all_groups" value="--ALL-GROUPS--" onclick="set_agent_status_all('all')"></td>
                        <td ><label for="all_groups" ><span class="green">所有坐席组</span></label>
                          <span class="gray">系统中全部坐席组</span></td>
                        <td ><label for="all_groups" ><span style='color:#08d;'>选择</span></label></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="agent_status_viewable_groups" id="campaign_agents" value="--CAMPAIGN-AGENTS--"></td>
                        <td><label for="campaign_agents"><span class="green">登陆同一活动中的坐席</span></label></td>
                        <td ><label for="campaign_agents"><span style='color:#08d;'>选择</span></label></td>
                      </tr>
                      <?php 
                        
                            $sql="select user_group,group_name from vicidial_user_groups order by user_group desc";
                            
                            $rows=mysqli_query($db_conn,$sql);
                            $row_counts_list=mysqli_num_rows($rows);			
                            
                            if ($row_counts_list!=0) {
								$i=0;
                                while($rs= mysqli_fetch_array($rows)){ 
									$i++;
									$class="";
                                	if($i%2==1){
										$class=" class='tr_write_bg'";
									}
 									echo "<tr $class>\n
									  <td><input type='checkbox' name='agent_status_viewable_groups' id='group_".$rs["user_group"]."' value='".$rs["user_group"]."' onclick=\"set_agent_status_all('')\"></td>
									  <td><label for='group_".$rs["user_group"]."' >".$rs["group_name"]."</label></td>
									  
									  <td><label for='group_".$rs["user_group"]."' ><span style='color:#08d;'>选择</span></label></td>
									   
									</tr>";
								}
                             
                            }else {
                                 
                            }
                            mysqli_free_result($rows);
                        ?>
                    </tbody>
                  </table></td>
              </tr>
            </table>
          </fieldset></td>
        <td width="260" valign="top"><fieldset style="margin:-2px 2px 2px 2px">
            <legend style="font-weight:normal">
            <label>可使用业务</label>
            </legend>
            <table width="100%" border="0" cellpadding="2" cellspacing="0">
              <tr>
                <td><div id='tree_container' class='treeContainer' style='width:240px;height:322px'>
                    <div id='tree1' class='treeItem' style="overflow:hidden; overflow-x:hidden;overflow-y:scroll">
                      <table>
                        <tr>
                          <td><p id="TreeRoot"><img src='/images/icons/telephone4.png' align="absmiddle">
                              <input name="campaigns" type="checkbox" id="all_campaigns" value="-ALL-CAMPAIGNS-" checked="checked" onclick="set_campaign_all('all')"/>
                              <label for="all_campaigns" >所有业务(可使用任何业务)</label>
                            </p>
                            <div id="tree_list">
                              <?php 
                        
											$sql="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_name";
											
											$rows=mysqli_query($db_conn,$sql);
											$row_counts_list=mysqli_num_rows($rows);			
											$i=0;
											if ($row_counts_list!=0) {
												while($rs= mysqli_fetch_array($rows)){ 
													$i++;
													if($i==$row_counts_list){
														$tree_ico="treeicon07";
													}else{
														$tree_ico="treeicon06";
													}
													echo "<p><img src='/images/icons/".$tree_ico.".gif'><img src='/images/icons/telephone9.png' align='absmiddle'><input type='checkbox' name='campaigns' id='campaigns_".$rs["campaign_id"]."' value='".$rs["campaign_id"]."' onclick=\"set_campaign_all('')\"/><label for='campaigns_".$rs["campaign_id"]."' >".$rs["campaign_name"]." [".$rs["campaign_id"]."]</label></p>";
												}
											 
											}else {
												echo "<p><img src='/images/icons/treeicon07.gif'><img src='/images/icons/telephone9.png' align='absmiddle'><label for='campaigns_'>系统当前未添加业务活动...</label></p>"; 
											}
											mysqli_free_result($rows);
										?>
                            </div></td>
                        </tr>
                      </table>
                    </div>
                  </div></td>
              </tr>
            </table>
          </fieldset></td>
      </tr>
    </table>
   
</div>
<?php 
break;
 
case "edit_user_group":
 
$OLDuser_group=$user_group;

$sql="SELECT user_group,group_name,allowed_campaigns,forced_timeclock_login,agent_status_view_time,shift_enforcement,agent_status_viewable_groups,group_shifts from vicidial_user_groups where user_group='".$user_group."'";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

$list_arr=array();
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$user_group=$rs["user_group"];
 		$group_name=$rs["group_name"];
 		$allowed_campaigns=$rs["allowed_campaigns"];
		$forced_timeclock_login=$rs["forced_timeclock_login"];
  		$agent_status_view_time=$rs["agent_status_view_time"];
		$shift_enforcement=$rs["shift_enforcement"];
		$agent_status_viewable_groups=$rs["agent_status_viewable_groups"];
  		$group_shifts=$rs["group_shifts"];
    }
 	echo "<script>$(document).ready(
	function(){
 		
 		$('#forced_timeclock_login').val('".$forced_timeclock_login."');
  		$('#agent_status_view_time').val('".$agent_status_view_time."'); 
		$('#shift_enforcement').val('".$shift_enforcement."'); 
  	});
	</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("坐席组不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<script>

function do_edit_user_group(){
   	
	if($("#user_group").val() == "")
	{
		alert("请填写坐席组ID！");
		$("#user_group").focus();
		return false;
	}else if($("#user_group").val().length>20||$("#user_group").val().length<2){
		alert("坐席组ID位数必须介于2-20位字符之间！");
		$("#user_group").select();
		return false;
	}
	
	if($("#group_name").val() == "")
	{
		alert("请填写坐席组名称！");
		$("#group_name").focus();
		return false;
	}else if($("#group_name").val().length>20||$("#group_name").val().length<2){
		alert("坐席组名称位数必须介于2-20位字符之间！");
		$("#group_name").select();
		return false;
	}
 	
	var campaigns="",shifts="",groups="";
  	
 	$('input[name="group_shifts"]:checked').each(function(i){
		shifts+=" "+$(this).val();
  	}); 
	
	/*if(shifts!=""&&shifts.substr(shifts.length-1)==" "){
		shifts=shifts.substr(0,shifts.length-1);
	}*/
	
 	$('input[name="campaigns"]:checked').each(function(i){
		campaigns+=" "+$(this).val();
  	}); 
	
	//if(campaigns!=""&&campaigns.substr(campaigns.length-1)==" "){
		//campaigns=campaigns.substr(0,campaigns.length-1);
	//}
	
 	$('input[name="agent_status_viewable_groups"]:checked').each(function(i){
		groups+=" "+$(this).val();
  	}); 
	
	//if(groups!=""&&groups.substr(groups.length-1)==" "){
	//	groups=groups.substr(0,groups.length-1);
	//}
 	
 	$('#load').show();
	var datas="action=user_group_set&do_actions=update&campaigns="+campaigns+"&agent_status_viewable_groups="+groups+"&group_shifts="+shifts+"&"+$('#form1').serialize()+times;
 	
	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		    request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
 				 
				$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()+" td").eq(0).find("input[type='checkbox']").val($("#user_group").val());
				$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()+" td").eq(2).html("<span class='green'>"+$("#group_name").val()+"</span>");
				$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()+" td").eq(1).html("<span class='green'>"+$("#user_group").val()+"</span>");				
				/*$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()+" td").eq(4).html("<span class='green'>"+$("#forced_timeclock_login option:selected").text()+"</span>");*/
				$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()+" td").eq(4).html("<span class='green'>"+$("#shift_enforcement option:selected").text()+"</span>");
				$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()+" td").eq(5).html("<div class='hide_tit' title='"+campaigns+"'><span class='green'>"+campaigns+"</span></div>");	
				$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()+" td").eq(6).html("<div class='hide_tit' title='"+groups+"'><span class='green'>"+groups+"</span></div>");
				$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()+" td").eq(7).html("<a href='javascript:void(0)' onclick='edit_pope_group(\""+$("#user_group").val()+"\",\""+$("#group_name").val()+"\")'>权限设置</a> <a href='javascript:void(0)' onclick='edit_user_group(\""+$("#user_group").val()+"\")'>修改</a> <a href='javascript:void(0)' onclick='del_(\""+$("#user_group").val()+"\")'>删除</a>");
				
				$(_DialogInstance.ParentWindow.document).find("#group_list_"+$("#OLDuser_group").val()).attr("id","group_list_"+$("#user_group").val());
  				 
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 

function get_group_user_list(){
	var diag =new Dialog("get_group_user_list");
	diag.Width = 680;
	diag.Height = 394;	
 	diag.Title = "坐席组工号列表";
	diag.URL = '/document/agent/list.php?action=get_group_user_list&user_group='+$("#OLDuser_group").val()+'&tits='+encodeURIComponent("坐席组工号列表");
 	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关 闭";
} 

function edit_pope_group(user_group,group_name){
	var diag =new Dialog("edit_pope_group_"+user_group);
	diag.Width = 680;
	diag.Height = 360;	
 	diag.Title = "坐席组权限设置";
	diag.URL = '/document/agent/list.php?action=get_pope_group&group_id='+user_group+'&tits='+encodeURIComponent(group_name);
 	diag.OKEvent = set_pope_group;
	diag.show();
}
 
function set_pope_group(){
	Zd_DW.do_set_pope_group();
}  
   
$(document).ready(function(){
 	$('.td_underline tr:visible:odd').addClass('alt');
	$("#tree_list label").bind("click",function(){
		set_tree_class();
	}).hover(
		function(){
			$(this)	.parent().addClass("cur");			
		},function(){
			$(this)	.parent().removeClass("cur");			
		}
	);
	
});
 
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">坐席组管理</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
    <tr>
      <td colspan="2"><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="get_group_user_list()" title="查看该组坐席用户！"><img src="/images/icons/icon021a12.gif" /><b>查看该组坐席&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="edit_pope_group('<?php echo $user_group ?>','<?php echo $group_name ?>')" title="菜单权限设置！"><img src="/images/icons/icon022a6.gif" /><b>菜单权限设置&nbsp;</b></a></td>
    </tr>
  </table>
   
    <table width="99%" align="center" cellspacing="0">
      <tr>
        <td valign="top" ><fieldset style="margin:-2px 2px 2px 2px">
            <legend  style="font-weight:normal">
            <label>基本信息</label>
            </legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_underline">
              <form action="" method="post" name="form1" id="form1">
                <input name="OLDuser_group" id="OLDuser_group" type="hidden" value="<?php echo $OLDuser_group ?>" />
                <tr>
                  <td width="26%" align="right" nowrap="nowrap" >坐席组ID：</td>
                  <td><input name="user_group"  type="text" id="user_group" value="<?php echo $user_group ?>" size="30" class="s_input" maxlength="20" onblur="this.value=value.replace(/[^\w\/,]/ig,'');check_user_group()" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')"/>
                    <span class="red">※</span><span class="gray">2-20个字符长度</span></td>
                </tr>
                <tr>
                  <td align="right" >坐席组名：</td>
                  <td><input name="group_name"  type="text" id="group_name" size="30" class="s_input" maxlength="20" value="<?php echo $group_name ?>" /></td>
                </tr>
                <tr >
                  <td align="right" >强制时间锁登陆：</td>
                  <td><select name="forced_timeclock_login" class="s_option" id="forced_timeclock_login">
                      <option value="N" selected="selected">禁用</option>
                      <option value="Y">启用</option>
                      <option value="ADMIN_EXEMPT">管理员例外</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >坐席组班次：</td>
                  <td><select name="shift_enforcement" class="s_option" id="shift_enforcement">
                      <option value="OFF" selected="selected">禁用</option>
                      <option value="START">开始</option>
                      <option value="ALL">所有用户</option>
                      <option value="ADMIN_EXEMPT">管理员例外</option>
                    </select></td>
                </tr>
                <tr >
                  <td align="right" >坐席状态浏览时间：</td>
                  <td><select name="agent_status_view_time" class="s_option" id="agent_status_view_time">
                      <option selected="selected" value="N">禁用</option>
                      <option value="Y">启用</option>
                    </select></td>
                </tr>
              </form>
              <tr>
                <td align="right" >坐席组班次：</td>
                <td ><table border="0" cellpadding="2" cellspacing="0" class="dataTable" style="margin-top:4px; margin-bottom:4px; width:99%" id="datatable_time">
                    <thead>
                      <tr align="left" class="dataHead">
                        <td width="30" style="font-weight:normal">选择</td>
                        <td style="font-weight:normal">时间班次</td>
                        <td width="50" style="font-weight:normal">操作</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
 							
								$sql="SELECT shift_id,shift_name from vicidial_shifts order by shift_id";
								
								$rows=mysqli_query($db_conn,$sql);
								$row_counts_list=mysqli_num_rows($rows);			
								
								if ($row_counts_list!=0) {
									while($rs= mysqli_fetch_array($rows)){ 
									
										if (ereg($rs["shift_id"],$group_shifts)){
											$checked=" checked";
									    }else{
											$checked=" ";
										}
									
										echo "<tr>\n
										
										  <td><input type='checkbox' name='group_shifts' id='shift_".$rs["shift_id"]."' value='".$rs["shift_id"]."' ".$checked." ></td>\n
										  <td><label for='shift_".$rs["shift_id"]."'>".$rs["shift_name"]."</label></td>\n
										  
										  <td><label for='shift_".$rs["shift_id"]."'><span style='color:#08d;'>选择</span></label></td>\n
										   
										</tr>\n";
									}
								 
								}else {
									 
								}
								mysqli_free_result($rows);
							?>
                    </tbody>
                  </table></td>
              </tr>
              <tr>
                <td align="right" >可查看用户组：</td>
                <td ><table border="0" cellpadding="2" cellspacing="0" class="dataTable" style="margin-top:4px; margin-bottom:4px; width:99%" id="datatable_campaings">
                    <thead>
                      <tr align="left" class="dataHead">
                        <td width="30" style="font-weight:normal">选择</td>
                        <td style="font-weight:normal">坐席组</td>
                        <td width="50" style="font-weight:normal">操作</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr >
                        <?php 
								if (ereg("--ALL-GROUPS--",$agent_status_viewable_groups)){
									$checked_all_groups=" checked";
								}else{
									$checked_all_groups=" ";
								}
								
								if (ereg("--CAMPAIGN-AGENTS--",$agent_status_viewable_groups)){
									$checked_campaign_agents=" checked";
								}else{
									$checked_campaign_agents=" ";
								}
								
							?>
                        <td ><input type="checkbox" name="agent_status_viewable_groups" id="all_groups" value="--ALL-GROUPS--"<?php echo $checked_all_groups ?> onclick="set_agent_status_all('all')"></td>
                        <td ><label for="all_groups"><span class="green">所有坐席组</span></label>
                          <span class="gray">系统中全部坐席组</span></td>
                        <td ><label for="all_groups"><span style='color:#08d;'>选择</span></label></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="agent_status_viewable_groups" id="campaign_agents" value="--CAMPAIGN-AGENTS--"<?php echo $checked_campaign_agents ?>></td>
                        <td><label for="campaign_agents"><span class="green">登陆同一活动中的坐席</span></label></td>
                        <td ><label for="campaign_agents"><span style='color:#08d;'>选择</span></label></td>
                      </tr>
                      <?php 
                        
                            $sql="select user_group,group_name from vicidial_user_groups order by user_group desc";
                            
                            $rows=mysqli_query($db_conn,$sql);
                            $row_counts_list=mysqli_num_rows($rows);			
                            
                            if ($row_counts_list!=0) {
								$agent_arrs=explode(" ",$agent_status_viewable_groups);
                                while($rs= mysqli_fetch_array($rows)){ 
								
									if (in_array($rs["user_group"],$agent_arrs)){
										$checked_group=" checked";
									}else{
										$checked_group=" ";
									}
                                
 									echo "<tr>\n
									  <td><input type='checkbox' name='agent_status_viewable_groups' id='group_".$rs["user_group"]."' value='".$rs["user_group"]."' ".$checked_group." onclick=\"set_agent_status_all('')\"></td>
									  <td><label for='group_".$rs["user_group"]."'>".$rs["group_name"]."</label></td>
									  
									  <td><label for='group_".$rs["user_group"]."'><span style='color:#08d;'>选择</span></label></td>
									   
									</tr>";
								}
                             
                            }else {
                                 
                            }
                            mysqli_free_result($rows);
                        ?>
                    </tbody>
                  </table></td>
              </tr>
            </table>
          </fieldset></td>
        <td width="260" valign="top"><fieldset style="margin:-2px 2px 2px 2px">
            <legend style="font-weight:normal">
            <label>可使用业务</label>
            </legend>
            <table width="100%" border="0" cellpadding="2" cellspacing="0">
              <tr>
                <td><div id='tree_container' class='treeContainer' style='width:240px;height:322px'>
                    <div id='tree1' class='treeItem' style="overflow:hidden; overflow-x:hidden;overflow-y:scroll">
                      <table>
                        <tr>
                          <td><?php 
									  	if (ereg("-ALL-CAMPAIGNS-",$allowed_campaigns)){
											$checked_all_campaign=" checked";
										}else{
											$checked_all_campaign=" ";
										}
									  ?>
                            <p id="TreeRoot"><img src='/images/icons/telephone4.png' align="absmiddle">
                              <input name="campaigns" type="checkbox" id="all_campaigns" value="-ALL-CAMPAIGNS-" <?php echo $checked_all_campaign ?> onclick="set_campaign_all('all')"/>
                              <label for="all_campaigns">所有业务(可使用任何业务)</label>
                            </p>
                            <div id="tree_list">
                              <?php 
                        					$allowed_array=explode(" ",$allowed_campaigns);
											$sql="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_name";
											
											$rows=mysqli_query($db_conn,$sql);
											$row_counts_list=mysqli_num_rows($rows);			
											$i=0;
											if ($row_counts_list!=0) {
												while($rs= mysqli_fetch_array($rows)){ 
													$i++;
													if($i==$row_counts_list){
														$tree_ico="treeicon07";
													}else{
														$tree_ico="treeicon06";
													}
													
													if (in_array($rs["campaign_id"],$allowed_array)){
														$checked_campaign=" checked";
													}else{
														$checked_campaign=" ";
													}
													
													echo "<p><img src='/images/icons/".$tree_ico.".gif'><img src='/images/icons/telephone9.png' align='absmiddle'><input type='checkbox' name='campaigns' id='campaigns_".$rs["campaign_id"]."' value='".$rs["campaign_id"]."' ".$checked_campaign." onclick=\"set_campaign_all('')\"/><label for='campaigns_".$rs["campaign_id"]."' >".$rs["campaign_name"]." [".$rs["campaign_id"]."]</label></p>";
												}
											 
											}else {
												echo "<p><img src='/images/icons/treeicon07.gif'><img src='/images/icons/telephone9.png' align='absmiddle'><label for='campaigns_'>系统当前未添加业务活动...</label></p>"; 
											}
											mysqli_free_result($rows);
										?>
                            </div></td>
                        </tr>
                      </table>
                    </div>
                  </div></td>
              </tr>
            </table>
          </fieldset></td>
      </tr>
    </table>
   
</div>
<?php 
break;

case "user_group_change":
?>
<script>

function do_user_group_change(do_actions){
   	
	if(do_actions=="one"){
		
		if($("#old_group").val() == "")
		{
			alert("请选择原坐席组！");
			$("#old_group").focus();
			return false;
			
		}else if($("#group").val() == "")
		{
			alert("请选择目标坐席组！");
			$("#group").focus();
			return false;
		}
		
		if($("#old_group").val()==$("#group").val())
		{
			alert("原坐席组和目标坐席组不能为同一个！");
			$("#old_group").focus();
			return false;
 		}
 		
	}else{
		
		if($("#group").val() == "")
		{
			alert("请选择坐席组！");
			$("#group").focus();
			return false;
		}
	}
  	
 	$('#load').show();
	var datas="action=user_group_change&do_actions="+do_actions+"&"+$('#form1').serialize()+times;
	//alert(datas);
 	//return false;
	
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);		    
 			if(json.counts=="1"){
 				 
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
   				 
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 
 
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">坐席组管理</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <?php 
 							
	$sql="select user_group,group_name from vicidial_user_groups order by user_group";
	
	$rows=mysqli_query($db_conn,$sql);
	$row_counts_list=mysqli_num_rows($rows);			
	
	if ($row_counts_list!=0) {
		while($rs= mysqli_fetch_array($rows)){ 
 		  	$option.="<option value='".$rs["user_group"]."'>".$rs["group_name"]."[".$rs["user_group"]."]</option>\n";
 		}
	 
	}else {
		$option="<option value=''>系统当前未添加坐席组</option>";
	}
	mysqli_free_result($rows);
?>
  <fieldset  >
    <legend>
    <label>坐席组转移</label>
    </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_underline">
        <tr>
          <td width="30%" align="right" nowrap="nowrap" >原坐席组：</td>
          <td><select name="old_group" class="s_option" id="old_group">
              <?php echo $option ?>
          </select></td>
        </tr>
        <tr>
          <td align="right" >目标坐席组：</td>
          <td><select name="group" class="s_option" id="group">
              <?php echo $option ?>
          </select></td>
        </tr>
        <tr >
          <td align="right" style="height:36px">&nbsp;</td>
          <td><input type="button" name="form_submit" value="开始转移" onclick="do_user_group_change('one');" style="cursor:pointer" />
            <input type="reset" name="button" id="button" value="重置" /></td>
        </tr>
      </table>
    </form>
  </fieldset>
  <br />
  <fieldset>
    <legend>
    <label>非管理员转移</label>
    </legend>
    <form action="" method="post" name="form2" id="form2">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_underline">
        <tr>
          <td width="30%" align="right" nowrap="nowrap" >坐席组ID：</td>
          <td><select name="group" class="s_option" id="group" >
              <?php echo $option ?>
            </select>
            <span class="gray">将所有非管理员坐席转移到该组</span></td>
        </tr>
        <tr>
          <td align="right"  style="height:36px">&nbsp;</td>
          <td><input type="button" name="form_submit" value="开始转移" onclick="do_user_group_change('all');" style="cursor:pointer" />
            <input type="reset" name="button" id="button" value="重置" /></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 
break;
 
//坐席组用户列表
case "get_group_user_list":
?>
<script>
function GetPageCount(a_ctions,doa_ctions)
    {
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  	
	var url="action=get_user_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&user_group="+$("#user_group").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
	$.ajax({
		
		url: "send.php",
		data: url,
 		cache: false,
 		success: function(msg){
			 
			$("#recounts").val(msg.counts);
			max_pages($("#pagesize").val());
			OutputHtml($("#pages").val(),$("#pagesize").val());
		}
	});
	 
}
   
function get_datalist(page_nums,a_ctions,doa_ctions,pagesize){

	$('#load').show();
 	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_user_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&user_group="+$("#user_group").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
	//alert(url);
	//return false;
	
	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			
			$("#datatable tfoot tr").show();
			if(parseInt(json.counts)>0){
				 
				$("#datatable tbody tr").remove();
				var tits="",td_str="",fun_str="",qua_str="";
				$.each(json.datalist, function(index,con){
    					
					tr_str="<tr >";
					tr_str+="<td >"+con.user+"</td>";
					tr_str+="<td >"+con.full_name+"</td>";
					tr_str+="<td >"+con.user_level+"</td>";
					tr_str+="<td >"+con.group_name+"</td>";
					tr_str+="<td >"+con.active+"</td>";
					tr_str+="</tr>";
					$("#datatable tbody").append(tr_str);
				}); 
				
				OutputHtml(page_nums,pagesize);
  			
			}else{
				 
				$("#datatable tbody tr").remove();
 				$("#datatable tfoot tr").hide();
				tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable").append(tr_str);
 			}  
			d_table_i();
  		
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
	});
	 
}
 
$(document).ready(function(){
 	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="10"/> <input name="sorts" type="hidden" id="sorts" value="a.user_group"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
});
</script>
<style>
.que_tit{width:440px;height:20px;overflow:hidden;white-space:nowrap;-o-text-overflow:ellipsis;text-overflow:ellipsis;}
.que_tit:after{content:"...";}
</style>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">坐席管理</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <input type="hidden" name="user_group" id="user_group" value="<?php echo $user_group ?>"/>
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
      <thead>
        <tr align="left" class="dataHead">
          <th sort="a.user" >坐席工号</th>
          <th sort="a.full_name" >坐席姓名</th>
          <th sort="a.user_level">坐席级别</th>
          <th sort="b.group_name">坐席组</th>
          <th sort="a.active" >激活</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr class='dataTableFoot'>
          <td colspan='14' align='left'><div id='dataTableFoot'>
              <div style='float:right;' id='pagelist'></div>
              <div style='float:left;' id='total'></div>
            </div></td>
        </tr>
      </tfoot>
    </table>
  </fieldset>
</div>
<?php
break;

case "get_pope_group":
?>
<script>

function get_pope_group(group_id){
	
	var datas="action=get_pope_group&group_id="+group_id+times;
	$("#form1 :checkbox[name^='pope']").attr("checked",false);
	//$("#form_menu_pope,#form_menu_reset").unbind("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
	 
	if(group_id!=""){
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 
			   if(json.counts=="1"){
				   
					/*$("#form_menu_pope").unbind("click").bind("click",function(){
						do_set_role_pope();	
					})
				   $("#form_menu_pope,#form_menu_reset").attr("disabled",false).css({"cursor":"pointer","color":""});
				   */
				   $(".search_text_zone label").removeClass("blue");
				   $.each(json.datalist,function(index,con){
					    
						$("#pope_"+con.superid+"_"+con.popeid).attr("checked","checked").parent().addClass("blue");
						$("#pope_item_"+con.superid).attr("checked","checked");
				   });
			   } 
			  
			} 
		});
	}
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
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);	
  			if(json.counts=="1"){
  				
				setTimeout('Dialog.close();',10); 
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 
$(document).ready(function(e) {
    get_pope_group("<?php echo $group_id ?>");
});
 
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">权限管理</a> &gt; 菜单权限设置 </div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main">
  <input name="call_black" type="hidden" id="call_black" value="" />
  <input name="group_id" type="hidden" id="group_id" value="<?php echo $group_id?>" />
  <fieldset>
    <legend>
    <input type="checkbox" id="pope" name="pope_all" parentid="pope_all" value="" onclick="CheckItemsAll('form1','pope')" />
    <label for="pope" >菜单权限设置 <span class="red"><?php echo $tits ?></span></label>
    </legend>
    <div style="position:absolute;right:10px;top:36px">
      <input name="text_search" type="text" class="input_text" id="text_search" title="请输入" size="16" maxlength="16" />
      <input name="do_text_search" id="do_text_search" type="button" value="查询" onclick="text_search()" />
    </div>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
        <tr>
          <td align="left" valign="top" class="search_text_zone"><?php
			  
	    $sql="select popeid,popename,popelink,superid,linktarget,popeimg,icoclass,icoinfo from data_pope_list where isactive='1' and SuperID='0' order by popeid ";
		
		$rows=mysqli_query($db_conn,$sql);
		$row_counts=mysqli_num_rows($rows);
 
 		if ($row_counts!=0) {
	?>
            <table width="100%" border=0 cellpadding=0 cellspacing=2>
              <?php 
			while($rs= mysqli_fetch_array($rows)){ 
		?>
              <tr >
                <td width="" height="24" align="left" class="deepgreen"><label for="pope_item_<?php echo $rs["popeid"]; ?>" onclick="CheckItemsAll('form1','pope_item_<?php echo $rs["popeid"]; ?>');">
                    <input type="checkbox" id="pope_item_<?php echo $rs["popeid"]; ?>" name="pope_item" value="<?php echo $rs["popeid"]; ?>" parentid="pope_<?php echo $rs["popeid"]; ?>" >
                    <?php echo $rs["popename"]; ?></label></td>
                <td align="left" class="check_items"><ul>
                    <?php       	
		
			$sqls="select popeid,popename,popelink,superid,linktarget,popeimg,icoclass,icoinfo from data_pope_list where isactive='1' and SuperID='".$rs["popeid"]."' order by popeid asc";
			$rows2=mysqli_query($db_conn,$sqls);
			
			if(mysqli_num_rows($rows2)!=0){
				while($rs2= mysqli_fetch_array($rows2)){ 
  		 ?>
                    <li>
                      <label for="pope_<?php echo $rs["popeid"]; ?>_<?php echo $rs2["popeid"]; ?>" onclick="CheckItems('form1','pope_<?php echo $rs["popeid"]; ?>','pope_item_<?php echo $rs["popeid"]; ?>');">
                        <input type="checkbox" parentid="pope_item_<?php echo $rs["popeid"]; ?>" id="pope_<?php echo $rs["popeid"]; ?>_<?php echo $rs2["popeid"]; ?>" pid="<?php echo $rs["popeid"]; ?>" name="popeid" value="<?php echo $rs2["popeid"]; ?>">
                        <?php echo $rs2["popename"]; ?></label>
                    </li>
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
</div>
<?php 

break;
 
case "set_group_user":
?> 
<script>

$(document).ready(function(){
	
	$('.td_underline tr:visible:odd').addClass('alt');
	$('#tree_list label').bind('click',function(){
		set_tree_class();
	}).hover(
		function(){
			$(this)	.parent().addClass('cur');			
		},function(){
			$(this)	.parent().removeClass('cur');			
		}
	);
	
	$('div.strategySel_r div').click(function(event){
	
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
		 
	});
	
	$('div.opt_f_list').click(function(event){  
	  var e=window.event || event;  
	  if(e.stopPropagation){  
		e.stopPropagation();  
	  }else{  
		e.cancelBubble = true;  
	  }  
	});
	
	$(document).click(function(){
		$('div.opt_f_list').hide();
	});
	
	$("#chk_all_pope").click(function(){
		var checkbox=$('#tree_list :checkbox:enabled');
 		if(this.checked==true){
			$(checkbox).attr("checked",this.checked);
 		}else{
			$(checkbox).attr("checked",this.checked);
		}
	});
 	
	$('#strategySel div').click(function(){
		$this=$(this);
	　　$this.addClass('sel').removeClass('noSel').siblings().removeClass('sel').addClass('noSel').children('span').removeClass('lineBg_on');
		$this.children('span').addClass('lineBg_on');
		x_top1=$this.offset().top;
		attrs=$this.attr('allow');
		(attrs=='setup')?show_types_list('users',1,x_top1):$('#opt_layer_1').hide();
		$('#allow_users').val(attrs);
	});
	
	
	$('#strategySel2 div').click(function(){
		$this=$(this);
	　　$this.addClass('sel').removeClass('noSel').siblings().removeClass('sel').addClass('noSel').children('span').removeClass('lineBg_on');
		$this.children('span').addClass('lineBg_on');
		x_top2=$this.offset().top;
		attrs=$this.attr('allow');
		(attrs=='setup')?show_types_list('campaigns',2,x_top2):$('#opt_layer_2').hide();
		$('#allow_campaigns').val(attrs);
	});
	
	$('#allow_campaigns_11').addClass('sel').removeClass('noSel').children('span').addClass('lineBg_on');
	$('#allow_users_22').addClass('sel').removeClass('noSel').children('span').addClass('lineBg_on');		
 				 
});
 

function do_set_group_user(){
	
 
	$('#load').show();
	var datas="action=set_group_user&do_actions=update&"+$('#form1').serialize()+times;
	//alert(datas);
	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 request_tip(json.des,json.counts);
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			 
 			$(_DialogInstance.ParentWindow.document).find("#name_<?php echo $user_id ?>").html("<span class='green'>"+$("#full_name").val()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#level_<?php echo $user_id ?>").html("<span class='green'>"+$("#user_level").val()+"</span>");
 			$(_DialogInstance.ParentWindow.document).find("#group_<?php echo $user_id ?>").html("<span class='green'>"+$("#user_group option:selected").text()+"</span>");
			//if($(":input[name=active]:checked").val()=="Y"){active="启用"}else{active="禁用"}
			$(_DialogInstance.ParentWindow.document).find("#active_<?php echo $user_id ?>").html("<span class='green'>"+$("#active option:selected").text()+"</span>");
   			
			setTimeout('Dialog.close();',10);
		  }else{
			  alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">坐席管理</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
   
    <form action="" method="post" name="form1" id="form1">
    
        <input type="hidden" name="allow_users_list" id="allow_users_list" value="0"/>
        <input type="hidden" name="allow_campaigns_list" id="allow_campaigns_list" value="0"/>
        
        <input type="hidden" name="allow_users" id="allow_users" value=""/>
        <input type="hidden" name="allow_campaigns" id="allow_campaigns" value=""/>
        <input type="hidden" name="user_group" id="user_group" value="<?php echo $user_group ?>"/>
    
      <table width="99%" align="center" cellspacing="0">
        <tr>
          <td valign="top" ><fieldset style="margin:-2px 2px 2px 2px">
              <legend style="font-weight:normal">
              <label>基本信息</label>
              </legend>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="td_underline">
                <tr >
                  <td width="30%" align="right" >坐席级别：</td>
                  <td><select name="user_level" class="s_option" id="user_level">
                      <?php
							for($i=1;$i<10;$i++){
						 
								echo"<option value='".$i."'>".$i."</option>\n";
							 
							}
						?>
                    </select>
                    <span class="red">※</span></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >注册服务器：</td>
                  <td ><select name="server_ip" class="s_option" id="server_ip" >
                      <?php 
                
                    $sql="select server_ip,server_id,server_description from servers order by server_id";
                    
                    $rows=mysqli_query($db_conn,$sql);
                    $row_counts_list=mysqli_num_rows($rows);			
                    
                    if ($row_counts_list!=0) {
                        while($rs= mysqli_fetch_array($rows)){ 
                        
                             echo "<option value='".$rs["server_ip"]."' tile='".$rs["server_description"]."'>".$rs["server_id"]." [".$rs["server_ip"]."]</option>";
                        }
                     
                    } 
                    mysqli_free_result($rows);
                ?>
                    </select>
                    <span class="red">※</span></td>
                </tr>
                <tr>
                  <td align="right" >激活使用：</td>
                  <td ><select name="active" class="s_option" id="active">
                      <option value="Y">启用</option>
                      <option value="N">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >手动拨号：</td>
                  <td ><select name="agentcall_manual" class="s_option" id="agentcall_manual">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >通话录音：</td>
                  <td><select name="vicidial_recording" class="s_option" id="vicidial_recording">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >通话转移：</td>
                  <td><select name="vicidial_transfers" class="s_option" id="vicidial_transfers">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >使用热键：</td>
                  <td><select name="hotkeys_active" class="s_option" id="hotkeys_active">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="dis_none">
                  <td align="right" >选择呼入组：</td>
                  <td><select name="agent_choose_ingroups" class="s_option" id="agent_choose_ingroups">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr class="">
                  <td align="right" >电话进线提醒：</td>
                  <td><select name="allow_alerts" class="s_option" id="allow_alerts">
                      <option value="1">启用</option>
                      <option value="0">禁用</option>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" >可查询的坐席：</td>
                  <td><div id="route_type" class="bus_strategySel bus_strategySel_on" style="width:236px">
  <div class="strategySel_r">
    <div id="strategySel" style="width:319px">
      <span class="leftBorLine"></span>
      <div id="allow_users_none" class="noSel" allow="none" title="可查询任何坐席的呼叫记录"><span class="lineBg">无限制</span></div>
      <div id="allow_users_self" class="noSel" allow="self" title="只可查询坐席个人的呼叫记录"><span class="lineBg">只查自己</span> </div>
      <div id="allow_users_setup" class="noSel" allow="setup" title="查询指定坐席的呼叫记录"><span class="lineBg">查询指定</span> </div>
      <span class="rightBorLine"></span> 
    </div>
  </div>
</div><span class="gray">重登陆查询页后生效</span></td>
                </tr>
                <tr>
                  <td align="right" >可查询的业务：</td>
                  <td><div id="route_type" class="bus_strategySel bus_strategySel_on" style="width:158px">
  <div class="strategySel_r">
    <div id="strategySel2" style="width:319px">
      <span class="leftBorLine leftBorLine_on"></span>
      <div id="allow_campaigns_none" class="noSel" allow="none" title="不限定查询业务活动"><span class="lineBg">无限制</span></div>
      <div id="allow_campaigns_setup" class="noSel" allow="setup" title="查询指定业务活动的呼叫记录"><span class="lineBg">查询指定</span> </div>
      <span class="rightBorLine"></span> 
    </div>
  </div>
</div><span class="gray">重登陆查询页后生效</span></td>
                </tr>
              </table>
            </fieldset></td>
          <td width="236" valign="top"><fieldset style="margin:-2px 2px 2px 2px">
              <legend style="font-weight:normal">
              <label>操作权限设置</label>
              </legend>
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td><div id='tree_container' class='treeContainer' style='width:220px;height:390px'>
                      <div id='tree1' class='treeItem' style="overflow:hidden; overflow-x:hidden;overflow-y:scroll">
                        <table>
                          <tr>
                            <td><p id="TreeRoot"><img src='/images/icons/icon021a6.gif' align="absmiddle" style="margin-right:4px"> <input type="checkbox" name="chk_all_pope" id="chk_all_pope" value="1"/> <label for="chk_all_pope">所有权限</label></p>
                              <div id="tree_list">
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="view_reports">
                                    <input type="checkbox" name="view_reports" id="view_reports" value="1"/>
                                    查看报表</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="export_reports">
                                    <input type="checkbox" name="export_reports" id="export_reports" value="1"/>
                                    导出报表</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="vdc_agent_api_access">
                                    <input type="checkbox" name="vdc_agent_api_access" id="vdc_agent_api_access" value="1"/>
                                    质检录音</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="alter_agent_interface_options">
                                    <input type="checkbox" name="alter_agent_interface_options" id="alter_agent_interface_options" value="1"/>
                                    编辑坐席功能</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_users">
                                    <input type="checkbox" name="modify_users" id="modify_users" value="1"/>
                                    修改坐席资料</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="change_agent_campaign">
                                    <input type="checkbox" name="change_agent_campaign" id="change_agent_campaign" value="1"/>
                                    改变坐席活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_users">
                                    <input type="checkbox" name="delete_users" id="delete_users" value="1"/>
                                    删除坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_usergroups">
                                    <input type="checkbox" name="modify_usergroups" id="modify_usergroups" value="1"/>
                                    修改坐席组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_user_groups">
                                    <input type="checkbox" name="delete_user_groups" id="delete_user_groups" value="1"/>
                                    删除坐席组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_lists">
                                    <input type="checkbox" name="modify_lists" id="modify_lists" value="1"/>
                                    修改客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_lists">
                                    <input type="checkbox" name="delete_lists" id="delete_lists" value="1"/>
                                    删除客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="load_leads">
                                    <input type="checkbox" name="load_leads" id="load_leads" value="1"/>
                                    导入客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_leads">
                                    <input type="checkbox" name="modify_leads" id="modify_leads" value="1"/>
                                    修改客户资料</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="download_lists">
                                    <input type="checkbox" name="download_lists" id="download_lists" value="1"/>
                                    下载客户清单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_from_dnc">
                                    <input type="checkbox" name="delete_from_dnc" id="delete_from_dnc" value="1"/>
                                    删除黑名单</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_campaigns">
                                    <input type="checkbox" name="modify_campaigns" id="modify_campaigns" value="1"/>
                                    修改业务活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="campaign_detail">
                                    <input type="checkbox" name="campaign_detail" id="campaign_detail" value="1"/>
                                    查看活动配置</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_campaigns">
                                    <input type="checkbox" name="delete_campaigns" id="delete_campaigns" value="1"/>
                                    删除活动</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_ingroups">
                                    <input type="checkbox" name="modify_ingroups" id="modify_ingroups" value="1"/>
                                    修改呼入组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_ingroups">
                                    <input type="checkbox" name="delete_ingroups" id="delete_ingroups" value="1"/>
                                    删除呼入组</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_inbound_dids">
                                    <input type="checkbox" name="modify_inbound_dids" id="modify_inbound_dids" value="1"/>
                                    修改DID</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_inbound_dids">
                                    <input type="checkbox" name="delete_inbound_dids" id="delete_inbound_dids" value="1"/>
                                    删除DID</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_remoteagents">
                                    <input type="checkbox" name="modify_remoteagents" id="modify_remoteagents" value="1"/>
                                    修改远程坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_remote_agents">
                                    <input type="checkbox" name="delete_remote_agents" id="delete_remote_agents" value="1"/>
                                    删除远程坐席</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_scripts">
                                    <input type="checkbox" name="modify_scripts" id="modify_scripts" value="1"/>
                                    修改话术</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_scripts">
                                    <input type="checkbox" name="delete_scripts" id="delete_scripts" value="1"/>
                                    删除话术</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_filters">
                                    <input type="checkbox" name="modify_filters" id="modify_filters" value="1"/>
                                    修改过滤规则</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_filters">
                                    <input type="checkbox" name="delete_filters" id="delete_filters" value="1"/>
                                    删除过滤规则</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="ast_admin_access">
                                    <input type="checkbox" name="ast_admin_access" id="ast_admin_access" value="1"/>
                                    登陆管理后台</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="ast_delete_phones">
                                    <input type="checkbox" name="ast_delete_phones" id="ast_delete_phones" value="1"/>
                                    删除分机</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_call_times">
                                    <input type="checkbox" name="modify_call_times" id="modify_call_times" value="1"/>
                                    修改话务时间</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_call_times">
                                    <input type="checkbox" name="delete_call_times" id="delete_call_times" value="1"/>
                                    删除话务时间</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_servers">
                                    <input type="checkbox" name="modify_servers" id="modify_servers" value="1"/>
                                    修改服务器</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="add_timeclock_log">
                                    <input type="checkbox" name="add_timeclock_log" id="add_timeclock_log" value="1"/>
                                    添加时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="modify_timeclock_log">
                                    <input type="checkbox" name="modify_timeclock_log" id="modify_timeclock_log" value="1"/>
                                    修改时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon06.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="delete_timeclock_log">
                                    <input type="checkbox" name="delete_timeclock_log" id="delete_timeclock_log" value="1"/>
                                    删除时间锁记录</label>
                                </p>
                                <p><img src='/images/icons/treeicon07.gif'><img src='/images/icons/icon022a8.gif' align="absmiddle">
                                  <label for="manager_shift_enforcement_override">
                                    <input type="checkbox" name="manager_shift_enforcement_override" id="manager_shift_enforcement_override" value="1" />
                                    管理强制班次-覆盖</label>
                                </p>
                              </div></td>
                          </tr>
                        </table>
                      </div>
                    </div></td>
                </tr>
              </table>
            </fieldset></td>
        </tr>
      </table>
    </form>
   
</div>
<?php 

break;



default:
 
}
mysqli_close($db_conn);

?>
</body>
</html>