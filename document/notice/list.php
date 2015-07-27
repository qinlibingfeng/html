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
.s_input{width:196px}
.s_option{width:202px}
</style>
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script>
function chang_detail(shows){
	if(shows=="y"){
		$("#detail_").css("display","block");
 	}else{
		$("#detail_").css("display","none");
 	}
}
   
function choose_fields(action){
	var diag =new Dialog("choose_fields");
 	diag.Width = 460;
	diag.Height = 240;
	diag.Title = "选择可显示客户资料字段";
 	diag.URL = "/document/lists_flow/list.php?cid=0&tits="+encodeURIComponent("选择客户资料字段")+"&action="+action;
  	diag.OKEvent = set_choose_fields;
	diag.show();
	
}

function set_choose_fields(){
	Zd_DW.do_set_choose_fields();
} 

function set_break(is_){
	
	if(is_==true){
		$("#bre_des").css("display","none");
		$("#bre_div").css("display","block");
	}else{
		$("#bre_des").css("display","block");
		$("#bre_div").css("display","none");
	}
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

function check_notice(){
	if($("#notice_id").val()!=""){
		
		if($("#notice_id").val().length>9||$("#notice_id").val().length<2){
			 
			request_tip("公告ID位数必须介于2-8位字符之间！",0);
			$("#notice_id").select();
			return false;
		}
		
		var datas="action=check_notice&notice_id="+$("#notice_id").val()+times;
		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#notice_id").select();
			   }
			} 
		});
	}
}
 
 
</script>
<script charset="utf-8" src="/document/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/document/plugin/kindeditor/lang/zh_CN.js"></script>
</head>
<body>
<input type="hidden" name="current_input" id="current_input"/> 
<input type="hidden" name="step_id" id="step_id"/> 
<input name="get_dial_status" id="get_dial_status" type="hidden" value="0" />
<input type="hidden" name="get_dial_method" id="get_dial_method" value="0" />
<input type="hidden" name="get_dial_level" id="get_dial_level" value="0" />

<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>

<div class="field_list_div field_list" id="field_list_div"></div>

<?php
switch($action){
  
case "add_notice":
?>
<script>
  
var editor; 
$(document).ready(function(){
	$('.td_underline tr:visible:odd').addClass('alt');
  
	editor=KindEditor.create('textarea[name="notice_content_re"]', {
		items:[
		'source','|','undo','redo','|','plainpaste','wordpaste', '|','formatblock', 'fontname','|','fontsize','forecolor', 'hilitecolor', 'bold','italic', 'underline','|','justifyleft', 'justifycenter', 'justifyright','|','insertorderedlist','insertunorderedlist','strikethrough', 'lineheight', 'removeformat','clearhtml','quickformat','/', 'image','table','hr','|','selectall', 'preview', 'fullscreen'
		],newlineTag:'br'
	});
  
});

function do_add_notice(){
 	 
 	if($("#notice_title").val() == ""){
		alert("请填写公告名称！");
		$("#notice_title").focus();
		return false;
	} 
	
  	if ($("#user").val()=="") {
  	
	   if(confirm("您还设置查看人员，确定不需要填写吗？")){}else{return false;}
	}
	
 	$("#notice_content").val(editor.html());
	if ($("#notice_content").val()=="") {
  	
	   if(confirm("您还没有填写公告内容，确定不需要填写吗？")){}else{return false;}
	}
   	
	$('#load').show();
	var datas="action=notice_set&do_actions=add&"+$('#form1').serialize()+times;
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
$(document).ready(function(e) {
    $("#notice_title").focus();
});

</script>

<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">公告管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
            
<fieldset ><legend ><?php echo $tits ?></legend>
<form action="" method="post" name="form1" id="form1">
  <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="30%" align="right">公告名称：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="notice_title" id="notice_title"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">公告描述：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="notice_des" id="notice_des"/></td>
    </tr>
    <tr >
      <td align="right">查看人员：</td>
      <td align="left"><input name="agent_name_list" type="text" id="agent_name_list"  title="双击选择查看人员" size="30" class="s_input" readonly="readonly"  ondblclick="c_agent_list('get_agent_list');" style="float:left; margin-right:4px"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择查看人员" onclick="c_agent_list('get_agent_list');"></a><input type="hidden" name="agent_list" id="agent_list" value="" /></td>
    </tr>
    <tr >
      <td align="right">公告内容：</td>
      <td align="left"><textarea name="notice_content_re" id="notice_content_re" style="width:99%;height:300px;visibility:hidden;"></textarea>
      <input type="hidden" name="notice_content" id="notice_content"/>
      </td>
    </tr>    
    </table>
    
 </form>
 
</fieldset>
  
     
</div>

<?php 

break;

case "edit_notice":
?>
<?php

$sql="select notice_id,notice_title,notice_content,notice_des,user_list from data_notice where notice_id='".$notice_id."' ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

$script_arr=array();
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$notice_id=$rs["notice_id"];
 		$notice_title=$rs["notice_title"];
 		$notice_content=$rs["notice_content"];
		$notice_des=$rs["notice_des"];
  		$user_list=$rs["user_list"]; 
     }
 	echo "<script>
	
var editor;
$(document).ready(
	function(){
    		 
	$('.td_underline tr:visible:odd').addClass('alt');
   
 	
	editor=KindEditor.create('textarea[name=\"notice_content_re\"]', {
		items:[
		'source','|','undo','redo','|','plainpaste','wordpaste', '|','formatblock', 'fontname','|','fontsize','forecolor', 'hilitecolor', 'bold','italic', 'underline','|','justifyleft', 'justifycenter', 'justifyright','|','insertorderedlist','insertunorderedlist','strikethrough', 'lineheight', 'removeformat','clearhtml','quickformat','/', 'image','table','hr','|','selectall', 'preview', 'fullscreen'
		],newlineTag:'br'
	});
    		
});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该公告不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>

<script>
  
function do_edit_notice(is_view){
	
	if(is_view!=""){
		request_tip("系统将保存当前公告设置...","1");
	}
	
	if($("#notice_title").val() == ""){
		alert("请填写公告名称！");
		$("#notice_title").focus();
		return false;
	} 
	
  	if ($("#user_list").val()=="") {
  	
	   if(confirm("您还设置查看人员，确定不需要填写吗？")){}else{return false;}
	}
	
 	$("#notice_content").val(editor.html());
	if ($("#notice_content").val()=="") {
  	
	   if(confirm("您还没有填写公告内容，确定不需要填写吗？")){}else{return false;}
	}
   	
   	
	$('#load').show();
	var datas="action=notice_set&do_actions=update&"+$('#form1').serialize()+times;
   	 
 	//alert(datas);
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){
			$('#load').css("top",$(document).scrollTop()).show('100');
  		},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
		 request_tip(json.des,json.counts);
		
		 if(is_view==""||is_view==null){
			  _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			 if(json.counts=="1"){
				 
				$(_DialogInstance.ParentWindow.document).find("#notice_<?php echo $notice_id ?> td").eq(1).attr("title",$("#notice_title").val()).html("<div class='hide_tit'><span class='green'>"+$("#notice_title").val()+"</span></div>");
				
				$(_DialogInstance.ParentWindow.document).find("#notice_<?php echo $notice_id ?> td").eq(2).attr("title",$("#notice_des").val()).html("<div class='hide_tit'><span class='green'>"+$("#notice_des").val()+"</span></div>");
 				 
				setTimeout('Dialog.close();',10);
				
			  }else{
				  alert(json.des);
			  }
			}	
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}
 
function view_notice(){
	
	do_edit_notice("1");
	var diag =new Dialog("view_notice");
    diag.Width = $(window).width() - 200;
    diag.Height = $(window).height() -100;
	diag.Title = "预览公告";
 	diag.URL = "/document/notice/list.php?notice_id="+$("#notice_id").val()+"&tits="+encodeURIComponent("预览公告")+"&action=view_notice"+"&script_name="+encodeURIComponent($("#script_name").val());
  	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关闭";
}

 
$(document).ready(function(e) {
    $("#notice_title").focus();
 	
});
</script>
<style>
.hide_tit{width:140px;}
 
</style> 

    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">公告管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="view_notice();" title="预览本公告！"><img src="/images/icons/script_5.png"  style="margin-top:4px"/><b>预览本公告&nbsp;</b></a></td>
    </tr>
    </table>      
<fieldset ><legend ><?php echo $tits ?></legend>
<input type="hidden" name="script_active" id="notice_active" value="" />
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="notice_id" id="notice_id" value="<?php echo $notice_id ?>" />
       
<table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="30%" align="right">公告名称：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="notice_title" id="notice_title" value="<?php echo $notice_title ?>"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">公告描述：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="notice_des" id="notice_des" value="<?php echo $notice_des ?>"/></td>
    </tr>
    <tr >
      <td align="right">查看人员：</td>
      <td align="left"><input name="agent_name_list" type="text" id="agent_name_list"  value="<?php echo $user_list ?>" title="双击选择查看人员：<?php echo $user_list ?>" size="30" class="s_input" readonly="readonly"  ondblclick="c_agent_list('get_agent_list');" style="float:left; margin-right:4px"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择查看人员" onclick="c_agent_list('get_agent_list');"></a><input type="hidden" name="agent_list" id="agent_list" value="" /></td>
    </tr>
    <tr >
      <td align="right">公告内容：</td>
      <td align="left"><textarea name="notice_content_re" id="notice_content_re" style="width:99%;height:280px;visibility:hidden;"><?php echo stripslashes($notice_content); ?></textarea>
      <input type="hidden" name="notice_content" id="notice_content"/>
      </td>
    </tr>    
    </table>  
  
  
 </form>
    

</fieldset>
    
      
</div>
  
<?php 

break;
  

//预览公告
case "view_notice":
  
?>
<?php


$sql="select a.notice_id,a.notice_title,a.notice_content,a.addtime,a.user_id,b.full_name from data_notice a left join vicidial_users b on a.user_id=b.user  where a.notice_id='".$notice_id."' ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);
if ($row_counts_list!=0) {
	
	while($rs= mysqli_fetch_array($rows)){ 

		$notice_title=$rs["notice_title"];
		$notice_content=$rs["notice_content"];
		$addtime=$rs["addtime"];
		$user_id=$rs["user_id"];
		$full_name=$rs["full_name"];
		
  }
  	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该公告不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?> 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">公告管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      	<input type="hidden" name="notice_active" id="notice_active" value="<?php echo $notice_active ?>" />
        <input type="hidden" name="notice_id" id="notice_id" value="<?php echo $notice_id ?>" />
        <fieldset style=""><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table border="0" width="98%" align="center" cellpadding="4" cellspacing="1" style="table-layout: fixed" >
                    <tr>
                      <td height="26" align="center" valign="middle"><strong><?php echo $notice_title ?></strong></td>
                    </tr>
                    <tr align='center' >
                      <td height="24" align="center" valign="middle" style="border-bottom:dotted 1px #ccc"><span class="gray">发布人：</span><?php echo $full_name ?> [<?php echo $user_id ?>]<span class="gray">&nbsp; 发布时间：</span><?php echo $addtime ?></td>
                    </tr>
                    <tr align='center' >
                      <td height="40" align="left" valign="top" style="word-wrap:break-word;word-break:break-all;"><?php echo stripslashes($notice_content); ?></td>
                    </tr>
                  </table>
          </form>
      </fieldset>      
      
</div>
 
<?php
break;

case "test":
	?>
    <script>
    function test(){
	setTimeout('Dialog.close();',10);	
	}
    </script>
    <input type="text" name="notice_active" id="notice_active" value="<?php echo $notice_active ?>" />
        <input type="text" name="notice_id" id="notice_id" value="<?php echo $notice_id ?>" />
    
<?php

break;

default:
 
}
 
mysqli_close($db_conn);

?>


</body>
</html>