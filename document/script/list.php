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

 

function set_tree_class(){
	$("#tree_list p").removeClass("cur");
	$("#tree_list label").click(function(){
		$(this)	.parent().addClass("cur");
	});
}

function check_script(){
	if($("#script_id").val()!=""){
		
		if($("#script_id").val().length>9||$("#script_id").val().length<2){
			 
			request_tip("话术ID位数必须介于2-8位字符之间！",0);
			$("#script_id").select();
			return false;
		}
		
		var datas="action=check_script&script_id="+$("#script_id").val()+times;
		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#script_id").select();
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
  
case "add_script":
?>
<script>
  
var editor; 
$(document).ready(function(){
	$('.td_underline tr:visible:odd').addClass('alt');
 
	KindEditor.lang({
		phone_info : '插入号码属性资料'
	});
	KindEditor.plugin('phone_info', function(K) {
		var self = this,name ='phone_info';
		function click(value) {
			var cmd = self.cmd;
			if (value === 'adv_strikethrough') {
				cmd.wrap('<span style=\'background-color:#e53333;text-decoration:line-through;\'></span>');
			} else {
				cmd.wrap('<span class="' + value + '"></span>');
			}
			cmd.select();
			self.hideMenu();
		}
		self.clickToolbar(name, function() {
			var menu = self.createMenu({
				name : name,
				width : 120
			});
			
			var datas="action=get_field_list&is_json=json";
			
			$.ajax({
				 
				url: "/document/script/send.php",
				data:datas,
				
				success: function(json){
				  if(json.counts=="1"){
					  $.each(json.datalist, function(index,con){
						
 						menu.addItem({
							title : con.field_name,
							click : function() {
								
								
								if(con.field_name=="电话号码"){
									class_s=' class="f_p_n" ';	
								}else{
									class_s='';	
								}
								
 								self.insertHtml('&nbsp;<span style="color:#ff0000" '+class_s+'>--A--'+con.field_name+'--B--</span>&nbsp;');
							} 
						});
						
					  });
				  }
				} 
				
			});
			
 		});
		
	});
	
	editor=KindEditor.create('textarea[name="script_text_re"]', {
		items:[
		'source','|','undo','redo','|','plainpaste','wordpaste', '|','formatblock', 'fontname','|','fontsize','forecolor', 'hilitecolor', 'bold','italic', 'underline','|','justifyleft', 'justifycenter', 'justifyright','|','insertorderedlist','insertunorderedlist','strikethrough', 'lineheight', 'removeformat','clearhtml','quickformat','/', 'image','table','hr','|','selectall', 'preview', 'fullscreen','|','phone_info'
		],newlineTag:'br'
	});
  
});

function do_add_script(){
 	if($("#script_id").val() == "")
	{
		alert("请填写话术ID号！");
		$("#script_id").focus();
		return false;
	}else if($("#script_id").val().length>8||$("#script_id").val().length<2){
		alert("话术ID位数必须介于2-8位字符之间！");
		$("#script_id").select();
		return false;
	}
	
	if($("#script_name").val() == "")
	{
		alert("请填写话术名称！");
		$("#script_name").focus();
		return false;
	}else if($("#script_name").val().length>20||$("#script_name").val().length<2){
		alert("话术名称位数必须介于2-20位字符之间！");
		$("#script_name").select();
		return false;
	}
  	
 	$("#script_text").val(editor.html());
	if ($("#script_text").val()=="") {
  	
	   if(confirm("您还没有填写话术内容，确定不需要填写吗？")){}else{return false;}
	}
   	
	$('#load').show();
	var datas="action=script_set&do_actions=add&"+$('#form1').serialize()+times;
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
         <div class="nav_">当前位置：<a href="javascript:void(0);">话术管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >

<form action="" method="post" name="form1" id="form1">
 <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="26%" align="right">话术ID：</td>
      <td align="left"><input maxlength="8" size="30" class="s_input" name="script_id" id="script_id" onkeyup="this.value=value.replace(/[^\w\/]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/]/ig,'')" onblur="this.value=value.replace(/[^\w\/]/ig,'');check_script()"/><span class="red">※</span><span class="gray">数字、英文组合,最长8位</span></td>
    </tr>
    <tr >
      <td align="right">话术名称：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="script_name" id="script_name"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">话术描述：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="script_comments" id="script_comments"/></td>
    </tr>
    <tr >
      <td align="right">激活使用：</td>
      <td align="left"><select name="active" class="s_option" id="active">
          <option value="Y" selected="selected">启用</option>
          <option value="N">禁用</option>
        </select></td>
    </tr>
    <tr >
      <td align="right">话术内容：</td>
      <td align="left"><textarea name="script_text_re" id="script_text_re" style="width:99%;height:360px;visibility:hidden;"></textarea>
      <input type="hidden" name="script_text" id="script_text"/>
      </td>
    </tr>    
    </table>
 </form>

     
</div>

<?php 

break;

case "edit_script":
?>
<?php

$sql="select script_id,script_name,script_comments,script_text,active from vicidial_scripts where script_id='".$script_id."' ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

$script_arr=array();
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$script_name=$rs["script_name"];
 		$script_id=$rs["script_id"];
 		$active=$rs["active"];
		$script_comments=$rs["script_comments"];
  		$script_text=re_script_info($rs["script_text"],"CH");
     }
 	echo "<script>
var editor;
$(document).ready(
	function(){
    		 
	$('.td_underline tr:visible:odd').addClass('alt');
	$('#active').val('".$active."');

 	$('<input name=\"a_ctions\" type=\"hidden\" id=\"a_ctions\"/> <input name=\"doa_ctions\" type=\"hidden\" id=\"doa_ctions\"/> <input name=\"recounts\" type=\"hidden\" id=\"recounts\"/> <input name=\"pages\" type=\"hidden\" id=\"pages\" value=\"1\"/> <input name=\"pagecounts\" type=\"hidden\" id=\"pagecounts\"/><input name=\"pagesize\" type=\"hidden\" id=\"pagesize\" value=\"12\"/> <input name=\"sorts\" type=\"hidden\" id=\"sorts\" value=\"campaign_id\"/> <input name=\"order\" type=\"hidden\" id=\"order\"/>').appendTo(\"body\");
	
	GetPageCount('search','count');
	get_datalist(1,'search','list',$('#pagesize').val());
		
		
	KindEditor.lang({
		phone_info : '插入号码属性资料'
	});
	KindEditor.plugin('phone_info', function(K) {
		var self = this,name ='phone_info';
		function click(value) {
			var cmd = self.cmd;
			if (value === 'adv_strikethrough') {
				cmd.wrap('<span style=\'background-color:#e53333;text-decoration:line-through;\'></span>');
			} else {
				cmd.wrap('<span class=\'' + value + '\'></span>');
			}
			cmd.select();
			self.hideMenu();
		}
		self.clickToolbar(name, function() {
			var menu = self.createMenu({
				name : name,
				width : 120
			});
			
			var datas='action=get_field_list&is_json=json';
			
			$.ajax({
				type: 'post', 
				dataType: 'json', 
				url:'/document/script/send.php',
				data:datas,
				
				success: function(json){
				  if(json.counts=='1'){
					  $.each(json.datalist, function(index,con){
						
						 
						menu.addItem({
							title : con.field_name,
							click : function() {
								
								if(con.field_name==\"电话号码\"){
									class_s=' class=\"f_p_n\" ';	
								}else{
									class_s='';	
								}
								
 								self.insertHtml('&nbsp;<span style=\"color:#ff0000\" '+class_s+'>--A--'+con.field_name+'--B--</span>&nbsp;');
								
 							} 
						});
						
					  });
				  }
				} 
				
			});
			
 		});
		
	});
 	
	editor=KindEditor.create('textarea[name=\"script_text_re\"]', {
		items:[
		'source','|','undo','redo','|','plainpaste','wordpaste', '|','formatblock', 'fontname','|','fontsize','forecolor', 'hilitecolor', 'bold','italic', 'underline','|','justifyleft', 'justifycenter', 'justifyright','|','insertorderedlist','insertunorderedlist','strikethrough', 'lineheight', 'removeformat','clearhtml','quickformat','/', 'image','table','hr','|','selectall', 'preview', 'fullscreen','|','phone_info'
		],newlineTag:'br'
	});	
    		
});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该话术不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>

<script>
  
function do_edit_script(is_view){
	
	if(is_view!=""){
		request_tip("系统将保存当前话术设置...","1");
	}
	
	if($("#script_name").val() == "")
	{
		alert("请填写话术名称！");
		$("#script_name").focus();
		return false;
	}else if($("#script_name").val().length>20||$("#script_name").val().length<2){
		alert("话术名称位数必须介于2-20位字符之间！");
		$("#script_name").select();
		return false;
	}
  	
 	$("#script_text").val(editor.html());
	if ($("#script_text").val()=="") {
  	
	   if(confirm("您还没有填写话术内容，确定不需要填写吗？")){}else{return false;}
	}
   	
	$('#load').show();
	var datas="action=script_set&do_actions=update&"+$('#form1').serialize()+times;
   	 
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
				 
				$(_DialogInstance.ParentWindow.document).find("#script_<?php echo $script_id ?> td").eq(2).attr("title",$("#script_name").val()).html("<div class='hide_tit'><span class='green'>"+$("#script_name").val()+"</span></div>");
				
				$(_DialogInstance.ParentWindow.document).find("#script_<?php echo $script_id ?> td").eq(3).attr("title",$("#script_comments").val()).html("<div class='hide_tit'><span class='green'>"+$("#script_comments").val()+"</span></div>");
	
				$(_DialogInstance.ParentWindow.document).find("#script_<?php echo $script_id ?> td").eq(5).html("<span class='green'>"+$("#active option:selected").text()+"</span>");
				//alert($("#active option:selected").text());
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
    

function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  
	var url="action=get_script_campaign_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&list_id="+$("#list_id").val()+"&script_id="+$("#script_id").val()+times;
 	
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
	//$("#excel_addr").html('');
	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_script_campaign_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&list_id="+$("#list_id").val()+"&script_id="+$("#script_id").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times;
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
  					
					tr_str="<tr align=\"left\" id=\"campaign_"+con.campaign_id+"\" >";
 					tr_str+="<td>"+con.campaign_id+"</td>";
					tr_str+="<td><div class='hide_tit' title='"+con.campaign_name+"'>"+con.campaign_name+"</div></td>";
					tr_str+="<td><div class='hide_tit' title='"+con.campaign_description+"'>"+con.campaign_description+"</div></td>";
					tr_str+="<td>"+con.status_name+"</td>";
					tr_str+="<td>"+con.auto_dial_level+"</td>";
					tr_str+="<td>"+con.campaign_cid+"</td>";
 					tr_str+="<td>"+con.active+"</td>";
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
 		} 
	});
	 
}


function view_script(){
	
	do_edit_script("1");
	var diag =new Dialog("view_script");
    diag.Width = $(window).width() - 200;
    diag.Height = $(window).height() -100;
	diag.Title = "预览话术脚本";
 	diag.URL = "/document/script/list.php?script_id="+$("#script_id").val()+"&tits="+encodeURIComponent("预览话术脚本")+"&action=view_script"+"&script_name="+encodeURIComponent($("#script_name").val());
  	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关闭";
}


function del_script(){

	datas="action=del_script&do_actions=script&c_id="+$("#script_id").val()+times;
 	//alert(datas);
    if(confirm("删除后不可恢复，您确定要删除本话术脚本吗？")){
 
		$('#load').show();
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

} 

</script>
<style>
.hide_tit{width:140px;}
 
</style> 

    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">话术管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="view_script();" title="预览本话术！"><img src="/images/icons/script_5.png"  style="margin-top:4px"/><b>预览本话术&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="del_script();" title="删除本话术"><img src="/images/icon_cancel.gif" style="margin-top:4px"/><b>删除本话术&nbsp;</b></a></td>
    </tr>
    </table>      

<input type="hidden" name="script_active" id="script_active" value="" />
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="script_id" id="script_id" value="<?php echo $script_id ?>" />
  
 <fieldset> <legend style="font-weight:normal" onclick="show_div('script_info')">基本信息</legend>
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline" id="script_info">
     
    <tr >
      <td width="26%" align="right">话术ID：</td>
      <td align="left"><span class="blue"><strong><?php echo $script_id ?></strong></span></td>
    </tr>
    <tr >
      <td align="right">话术名称：</td>
      <td align="left"><input name="script_name" id="script_name" value="<?php echo $script_name ?>" size="30" class="s_input" maxlength="30"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">话术描述：</td>
      <td align="left"><input name="script_comments" id="script_comments" value="<?php echo $script_comments ?>" size="30" class="s_input" maxlength="255"/></td>
    </tr>
    <tr >
      <td align="right">激活使用：</td>
      <td align="left">
       <select name="active" class="s_option" id="active">
          <option value="Y" selected="selected">启用</option>
          <option value="N">禁用</option>
        </select>
        </td>
    </tr>
    <tr >
      <td align="right">话术内容：</td>
      <td align="left"><textarea name="script_text_re" id="script_text_re" style="width:99%;height:360px;visibility:hidden;"><?php echo stripslashes($script_text); ?></textarea>
      <input type="hidden" name="script_text" id="script_text" value=""/>
      </td>
    </tr>    
   
  </table>
</fieldset>
 <fieldset> <legend style="font-weight:normal" onclick="show_div('datatable')" >应用本话术业务活动</legend>
            <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
              <thead>
                <tr class="dataHead">
                              
                  <th align="left">活动ID</th>
                  <th align="left">活动名称</th>
                  <th align="left">活动描述</th>
                  <th align="left">呼叫模式</th>
                  <th align="left">呼叫级别</th>
                  <th align="left">主叫号码</th>
                  <th align="left">激活</th>
                </tr>
              </thead>   
                <tbody>
                </tbody>
                <tfoot><tr class='dataTableFoot'><td colspan='14' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
         </table>
               
   </fieldset>
</form>


    
      
</div>
  
<?php 

break;
  

//复制话术
case "copy_script":
?>
<script>

function do_copy_script(){
	if($("#script_id").val() == ""){
		alert("请填写话术ID号！");
		$("#script_id").focus();
		return false;
	}else if($("#script_id").val().length>8||$("#script_id").val().length<2){
		alert("话术ID位数必须介于2-8位字符之间！");
		$("#script_id").select();
		return false;
	}
	
	if($("#script_name").val() == ""){
		alert("请填写话术名称！");
		$("#script_name").focus();
		return false;
	}else if($("#script_name").val().length>20||$("#script_name").val().length<2){
		alert("话术名称位数必须介于2-20位字符之间！");
		$("#script_name").select();
		return false;
	}
	
	if($("#source_script_id").val() == ""){
		alert("请选择来源话术！");
		$("#source_script_id").focus();
		return false;
	}	
	
 	$('#load').show();
	var datas="action=script_set&do_actions=copy&"+$('#form1').serialize()+times;
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

function copy_set(select_val){
	
	$("#script_comments").val($("#source_script_id option[value='"+select_val+"']").attr("des"));
	$("#script_name").val($("#source_script_id option[value='"+select_val+"']").attr("name"));
}

$(document).ready(function(){
	 
	get_select_opt('','send.php','get_scripts_all_list','source_script_id','group_def');
});

</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">话术管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      	<input type="hidden" name="get_source_script_id" id="get_source_script_id" value="0"/>
        
        <fieldset ><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">
 			
                <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
                          	<tr>
                               <td  align="right" nowrap="nowrap">来源话术：</td>
                               <td align="left">
                               
                               <select name="source_script_id" class="s_option" id="source_script_id" onchange="copy_set(this.value);" >
								   <option value="" selected="selected">请选择来源话术</option>
                                   <option value="XXXXXNONE" disabled="disabled">------------------------</option>
								  
                                </select>
                               <span class="red">※</span><span class="gray">来源话术的所有配置将被复制</span>
                               </td>
                             </tr>
                             <tr>
                               <td width="20%"  align="right" nowrap="nowrap">话术ID：</td>
                               <td align="left"><input maxlength="8" size="30" class="s_input" name="script_id" id="script_id" onkeyup="this.value=value.replace(/[^\w\/]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/]/ig,'')" onblur="this.value=value.replace(/[^\w\/]/ig,'');check_script()"/><span class="red">※</span><span class="gray">数字、英文组合,最长8位</span></td>
                             </tr>
                             <tr>
                               <td  align="right" nowrap="nowrap">话术名称：</td>
                               <td align="left"><input maxlength="30" size="30" class="s_input" name="script_name" id="script_name"/><span class="red">※</span></td>
                             </tr>
                             <tr>
                               <td  align="right" nowrap="nowrap">话术描述：</td>
                               <td align="left"><input maxlength="255" size="30" class="s_input" name="script_comments" id="script_comments"/></td>
                             </tr>
                              
                             
                               
                        </table>
          </form>
      </fieldset>      
      
</div>
 
<?php
break;

//预览话术
case "view_script":
  
?>
<?php

	$vendor_lead_code = 'VENDOR:LEAD;CODE';
	$list_id = '客户清单ID';
	$list_name = '客户清单名称';
	$list_description = '客户清单描述';
	$gmt_offset_now = '时区';
	$phone_code = '86';
	$phone_number = '13588606688';
	$title = '标题';
	$first_name = '名字';
	$middle_initial = '中间名';
	$last_name = '姓氏';
	$address1 = '地址1';
	$address2 = '地址2';
	$address3 = '地址3';
	$city = '城市';
	$state = '地区';
	$province = '省份';
	$postal_code = '邮编';
	$country_code = '国家代码';
	$gender = '性别';
	$date_of_birth = '生日';
	$alt_phone = '备用号码';
	$email = 'test@test.com';
	$security_phrase = 'SECUTIRY';
	$comments = '描述';
	$RGfullname = 'JOE AGENT';
	$RGuser = '6666';
	$RGlead_id = '1234';
	$RGcampaign = '业务活动测试';
	$RGphone_login = 'gs102';
	$RGgroup = 'TESTCAMP';
	$RGchannel_group = 'TESTCAMP';
	$RGSQLdate = date("Y-m-d H:i:s");
	$RGepoch = date("U");
	$RGuniqueid = '1163095830.4136';
	$RGcustomer_zap_channel = 'Zap/1-1';
	$RGserver_ip = '10.10.10.15';
	$RGSIPexten = 'SIP/gs102';
	$RGsession_id = '8600051';
	$RGdialed_number = '3125551111';
	$RGdialed_label = 'ALT';
	$RGrank = '99';
	$RGowner = '6666';
	$RGcamp_script = 'TESTSCRIPT';
	$RGin_script = '';
	$script_width = '600';
	$script_height = '400';
	$recording_filename = '20091204-1639_6666_7275551212';
	$recording_id = '1235';
	$user_custom_one = 'custom one';
	$user_custom_two = 'custom two';
	$user_custom_three = 'custom three';
	$user_custom_four = 'custom four';
	$user_custom_five = 'custom five';
	$preset_number_a = 'preset_a';
	$preset_number_b = 'preset_b';
	$preset_number_c = 'preset_c';
	$preset_number_d = 'preset_d';
	$preset_number_e = 'preset_e';
	$preset_number_f = 'preset_f';
	$preset_dtmf_a = 'preset_dtmf_a';
	$preset_dtmf_b = 'preset_dtmf_b';


$sql="select script_text from vicidial_scripts where script_id='".$script_id."' ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);
if ($row_counts_list!=0) {
	
	while($rs= mysqli_fetch_array($rows)){ 

		$script_text=stripslashes($rs["script_text"]);

		$script_text = eregi_replace('--A--vendor_lead_code--B--',"$vendor_lead_code",$script_text);
		$script_text = eregi_replace('--A--list_id--B--',"$list_id",$script_text);
		$script_text = eregi_replace('--A--list_name--B--',"$list_name",$script_text);
		$script_text = eregi_replace('--A--list_description--B--',"$list_description",$script_text);
		$script_text = eregi_replace('--A--gmt_offset_now--B--',"$gmt_offset_now",$script_text);
		$script_text = eregi_replace('--A--phone_code--B--',"$phone_code",$script_text);
		$script_text = eregi_replace('--A--phone_number--B--',"$phone_number",$script_text);
		$script_text = eregi_replace('--A--title--B--',"$title",$script_text);
		$script_text = eregi_replace('--A--first_name--B--',"$first_name",$script_text);
		$script_text = eregi_replace('--A--middle_initial--B--',"$middle_initial",$script_text);
		$script_text = eregi_replace('--A--last_name--B--',"$last_name",$script_text);
		$script_text = eregi_replace('--A--address1--B--',"$address1",$script_text);
		$script_text = eregi_replace('--A--address2--B--',"$address2",$script_text);
		$script_text = eregi_replace('--A--address3--B--',"$address3",$script_text);
		$script_text = eregi_replace('--A--city--B--',"$city",$script_text);
		$script_text = eregi_replace('--A--state--B--',"$state",$script_text);
		$script_text = eregi_replace('--A--province--B--',"$province",$script_text);
		$script_text = eregi_replace('--A--postal_code--B--',"$postal_code",$script_text);
		$script_text = eregi_replace('--A--country_code--B--',"$country_code",$script_text);
		$script_text = eregi_replace('--A--gender--B--',"$gender",$script_text);
		$script_text = eregi_replace('--A--date_of_birth--B--',"$date_of_birth",$script_text);
		$script_text = eregi_replace('--A--alt_phone--B--',"$alt_phone",$script_text);
		$script_text = eregi_replace('--A--email--B--',"$email",$script_text);
		$script_text = eregi_replace('--A--security_phrase--B--',"$security_phrase",$script_text);
		$script_text = eregi_replace('--A--comments--B--',"$comments",$script_text);
		$script_text = eregi_replace('--A--fullname--B--',"$RGfullname",$script_text);
		$script_text = eregi_replace('--A--fronter--B--',"$RGuser",$script_text);
		$script_text = eregi_replace('--A--user--B--',"$RGuser",$script_text);
		$script_text = eregi_replace('--A--lead_id--B--',"$RGlead_id",$script_text);
		$script_text = eregi_replace('--A--campaign--B--',"$RGcampaign",$script_text);
		$script_text = eregi_replace('--A--phone_login--B--',"$RGphone_login",$script_text);
		$script_text = eregi_replace('--A--group--B--',"$RGgroup",$script_text);
		$script_text = eregi_replace('--A--channel_group--B--',"$RGchannel_group",$script_text);
		$script_text = eregi_replace('--A--SQLdate--B--',"$RGSQLdate",$script_text);
		$script_text = eregi_replace('--A--epoch--B--',"$RGepoch",$script_text);
		$script_text = eregi_replace('--A--uniqueid--B--',"$RGuniqueid",$script_text);
		$script_text = eregi_replace('--A--customer_zap_channel--B--',"$RGcustomer_zap_channel",$script_text);
		$script_text = eregi_replace('--A--server_ip--B--',"$RGserver_ip",$script_text);
		$script_text = eregi_replace('--A--SIPexten--B--',"$RGSIPexten",$script_text);
		$script_text = eregi_replace('--A--session_id--B--',"$RGsession_id",$script_text);
		$script_text = eregi_replace('--A--dialed_number--B--',"$RGdialed_number",$script_text);
		$script_text = eregi_replace('--A--dialed_label--B--',"$RGdialed_label",$script_text);
		$script_text = eregi_replace('--A--rank--B--',"$RGrank",$script_text);
		$script_text = eregi_replace('--A--owner--B--',"$RGowner",$script_text);
		$script_text = eregi_replace('--A--camp_script--B--',"$RGcamp_script",$script_text);
		$script_text = eregi_replace('--A--in_script--B--',"$RGin_script",$script_text);
		$script_text = eregi_replace('--A--script_width--B--',"$script_width",$script_text);
		$script_text = eregi_replace('--A--script_height--B--',"$script_height",$script_text);
		$script_text = eregi_replace('--A--recording_filename--B--',"$recording_filename",$script_text);
		$script_text = eregi_replace('--A--recording_id--B--',"$recording_id",$script_text);
		$script_text = eregi_replace('--A--user_custom_one--B--',"$user_custom_one",$script_text);
		$script_text = eregi_replace('--A--user_custom_two--B--',"$user_custom_two",$script_text);
		$script_text = eregi_replace('--A--user_custom_three--B--',"$user_custom_three",$script_text);
		$script_text = eregi_replace('--A--user_custom_four--B--',"$user_custom_four",$script_text);
		$script_text = eregi_replace('--A--user_custom_five--B--',"$user_custom_five",$script_text);
		$script_text = eregi_replace('--A--preset_number_a--B--',"$preset_number_a",$script_text);
		$script_text = eregi_replace('--A--preset_number_b--B--',"$preset_number_b",$script_text);
		$script_text = eregi_replace('--A--preset_number_c--B--',"$preset_number_c",$script_text);
		$script_text = eregi_replace('--A--preset_number_d--B--',"$preset_number_d",$script_text);
		$script_text = eregi_replace('--A--preset_number_e--B--',"$preset_number_e",$script_text);
		$script_text = eregi_replace('--A--preset_number_f--B--',"$preset_number_f",$script_text);
		$script_text = eregi_replace('--A--preset_dtmf_a--B--',"$preset_dtmf_a",$script_text);
		$script_text = eregi_replace('--A--preset_dtmf_b--B--',"$preset_dtmf_b",$script_text);
		//$script_text = eregi_replace("\n","<br/>",$script_text);

  }
  	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该话术不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?> 
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">话术管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      	<input type="hidden" name="script_active" id="script_active" value="<?php echo $script_active ?>" />
        <input type="hidden" name="script_id" id="script_id" value="<?php echo $script_id ?>" />
        <fieldset ><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top">
                         <div style="text-align:center;border-bottom:dotted 1px #ccc">话术ID：<span class="blue_tip"><?php echo $script_id ?></span>&nbsp; 话术名称：<span class="blue_tip"><?php echo $script_name ?></span><br /><br /></div>
                         <br />
						 <?php 
						 	//echo stripslashes($script_text)
						 	echo $script_text
						  ?>
                             
                      </td>
                    </tr>
                     
                  </table>
          </form>
      </fieldset>      
      
</div>
 
<?php
break;
 
default:
 
}
mysqli_close($db_conn);

?>


</body>
</html>