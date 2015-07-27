<?php 
require("../../inc/pub_func.php"); 
$tits=trim($_REQUEST["tits"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<style>
.dataTable img { cursor:pointer; }
.field_list a {
	cursor:pointer;
	display:inline-block;
	float:left;
	height:16px;
	line-height:17px;
	margin:1px;
	padding:2px;
	position:relative;
	text-align:center;
	white-space:nowrap;
}
.field_list a:hover {
	text-decoration:none;
	border:1px solid #F90;
}
a.close {
	width:4px;
	height:4px;
	line-height:4px;
	background:url(/images/tips/tip_bg.gif) no-repeat 0 -26px;
	position:absolute;
	right:6px;
	top:4px;
	font-size:1px;
	border:0;
}
a.close:hover {
	background-position:0 -34px;
	border:0;
}
a.field_list_1 {
	background-color:#FFF;
	border:1px solid #cfcfcf;
}
a.field_list_2 {
	background-color:#FC6;
	border:1px solid #F90;
	color:#F00
}
.field_list_div {
	background:#FFF;
	border:1px solid #999;
	display:none;
	margin:3px auto auto 3px;
	padding:2px;
	position:absolute;
	top:0;
	width:70%;
	z-index:100;
	box-shadow:0 1px 12px rgba(0, 0, 0, 0.25);
	border-radius:4px;
}
.input_86 { width:90%; }
.input_h_86 {
	width:90%;
	height:40px
}
a.phone_info {
	width:15px;
	height:16px;
	line-height:16px;
	background:url(/images/phone_call.png) no-repeat 0 0px;
	position:absolute;
	margin-left:6px;
	   
	font-size:1px;
	border:0;
	opacity: 0.8;
	transition: opacity 0.7s ease 0s;
}
a.phone_info:hover {
	text-decoration: none;
	opacity: 1;
}
.turn_img {
	cursor:pointer;
	float:left;
	margin-left:6px;
	margin-top:4px;
	background: url(/images/icons/up_down.gif) no-repeat -94px top;
	height: 14px;
	width: 16px;
}
.turn_img img { vertical-align:middle; }
.page_main { _margin-top:-1px; }
.page_main fieldset { margin:2px 8px 8px 8px; }
.td_underline td {
	border-bottom: 1px dotted #ccc;
	height:24px;
	line-height:24px
}
.td_underline select { *margin-top:1px
}
.o_icos span {
	background:url(/images/icons/up_down.gif) no-repeat 2px top;
	display:block;
	height:14px;
	width:14px;
	float:left;
	margin-top:-2px;
	cursor:pointer;
}
.o_icos .add { background-position:-78px top; }
.o_icos .drag {
	background-position:-113px top;
	width:14px;
}
.o_icos .up_e { background-position:-30px top; }
.o_icos .up_d { background-position:-63px top; }
.o_icos .dw_e { background-position:-14px top; }
.o_icos .dw_d { background-position:-47px top; }
.s_input { width:176px }
.s_option { width:182px }
.td_underline {
	table-layout:fixed;
	word-break:break-all;
	word-wrap:break-word;
}
.form_val_ { width:186px }
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

//获取问题跳转步骤
function get_step_turn_list(form_id,turn_val){
	//alert(turn_val);
	var ask_id=$("#ask_id").val();
	var que_id=$("#que_id").val();
  	var datas="action=get_step_turn_list&ask_id="+ask_id+"&que_id="+que_id+times;
	//alert(datas);
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
  		success: function(json){ 
			if(form_id=="0"){
				selects="name=step_turn";
			}else{
				selects="id="+form_id;
			}
			$("select["+selects+"] option").remove();
			 
    		$.each(json.datalist,function(index,con){
				var selected="";
				if (con.que_id==turn_val){selected=" selected";}
 				$("<option value='"+con.que_id+"' title='"+con.que_title+"' "+selected+">"+con.que_tit+"</option>").appendTo($("select["+selects+"]"));
 				
			})
		}
	});
}
   
function choose_fields(action){
	var diag =new Dialog("choose_fields");
 	diag.Width = 460;
	diag.Height = 240;
	diag.Title = "选择可显示客户资料字段";
 	diag.URL = "/document/ask_flow/list.php?cid=0&tits="+encodeURIComponent("选择客户资料字段")+"&action="+action;
  	diag.OKEvent = set_choose_fields;
	diag.show();
	
}

function set_choose_fields(){
	Zd_DW.do_set_choose_fields();
}


(function($){
    $.fn.insert=function(_m){
        var _o=$(this).get(0);
        if($.browser.msie){
             _o.focus();sel=document.selection.createRange();sel.text=_m;sel.select();
         }else if(_o.selectionStart || _o.selectionStart == '0'){
            var startPos=_o.selectionStart;var endPos=_o.selectionEnd;var restoreTop=_o.scrollTop;
            _o.value=_o.value.substring(0,startPos) + _m + _o.value.substring(endPos,_o.value.length);
            if (restoreTop>0){_o.scrollTop=restoreTop;}
            _o.focus();_o.selectionStart=startPos+_m.length;_o.selectionEnd=startPos+_m.length;
        }
    }
})(jQuery);

function set_break(is_){
	
	if(is_==true){
		$("#bre_des").css("display","none");
		$("#bre_div").css("display","block");
	}else{
		$("#bre_des").css("display","block");
		$("#bre_div").css("display","none");
	}
}

//显示子选项设置表单
function show_form_table(do_,is_re){
	if(do_=="show"){
		var c_id=parseInt($("#form_index").val());
   		
		$("#form_table").html("<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" class=\"dataTable\" style=\"margin-top:4px; margin-bottom:4px; width:99%\" id=\"datatable\"><thead><tr align=\"left\" class=\"dataHead\"><td style=\"font-weight:normal\">选项名称</td><td style=\"font-weight:normal\">跳转步骤</td><td style=\"font-weight:normal\">附属表单</td><td style=\"font-weight:normal\">操作</td>\</tr></thead><tbody><tr align=\"left\" valign=\"middle\" id=\"list_1\" nowrap><td><input type=\"text\" name=\"form_value\" id=\"form_value_1\" maxlength=\"360\" size=\"32\" class=\"form_val_\" fid=\"1\"/></td><td><span style=\"float:left\"  id=\"turn_1\" ><select name=\"step_turn\" id=\"step_turn_1\"  class=\"s_option\"><option value=\"yes_des\">营销成功结束语</option><option value=\"no_des\">营销失败结束语</option></select></span><span class=\"turn_img\" title=\"更新跳转步骤\" onclick=\"get_step_turn_list('step_turn_1',0)\"></span></td><td><input name=\"do_func\" type=\"checkbox\" id=\"do_func_1\" value=\"y\" title=\"是否包含附属表单供填写描述\"/><td class='o_icos'><span class='add' onclick=\"set_form('add','1','0');\"></span><span class='up_e' onclick=\"set_form('up','0','1')\"></span><span class='dw_e' onclick=\"set_form('dw','0','1')\"></span><span onclick=\"set_form('del','0','1');\"></span></td></tr></tbody><tfoot><tr><td colspan='6'><a  href='javascript:void(0)' onclick=\"set_form('add','-1','0');\" >增加一项</a></td></tr></tfoot></table>");
		
 		$("#form_value_1").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
		
  		order_datatable_();
		if(is_re=="y"){get_step_turn_list('step_turn_1',1);}
		goto_anchor("list_1");

 	}else{
		$("#form_table").html("<a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv=\"true\" title=\"添加子选项\" onClick=\"show_form_table('show','y');\" style=\"margin-top:4px\"><img src=\"/images/butCollapse.gif\" align=\"absmiddle\" style=\"margin-top:5px\"/><b>添加子选项&nbsp;</b></a>");
	}
}

//插入子选项表单
function set_form(do_,c_id,id){
 	var tr_str="",form_select="",tr_this = $("#list_"+id);

	if(do_=="add"){
		
		var form_index=$("#form_index").val();
 		indexs=parseInt(form_index)+1;
		
		if(c_id=="-1"||$("#list_"+c_id).length<1){c_id=$("#datatable tbody tr:last").find("input[name='form_value']").attr("fid");}
  		
		if($("#step_turn_"+c_id).val()==""||$("#step_turn_"+c_id).val()==undefined||$("#step_turn_"+c_id).val()==null){
			selects="<select name=\"step_turn\" id=\"step_turn_"+indexs+"\"  class=\"s_option\"><option value=\"yes_des\">营销成功结束语</option><option value=\"no_des\">营销失败结束语</option></select>";
 			is_resend=1;
			clone_id=indexs;
  		}else{
 			selects=$("#step_turn_"+c_id).clone(true);
			is_resend=0;
			clone_id=c_id;
		}
     		
   		tr_str="<tr align=\"left\" id=\"list_"+indexs+"\" nowrap><td><input type=\"text\" name=\"form_value\" id=\"form_value_"+indexs+"\" maxlength=\"360\" size=\"32\" class=\"form_val_\" fid=\""+indexs+"\"/></td><td><span style=\"float:left\" id=\"turn_"+indexs+"\"></span><span class=\"turn_img\" title=\"更新跳转步骤\" onclick=\"get_step_turn_list('step_turn_"+indexs+"',0)\"></span></td><td><input type=\"checkbox\" name=\"do_func\" id=\"do_func_"+indexs+"\" value=\"y\"/></td><td class='o_icos'><span class='add' onclick=\"set_form('add','"+indexs+"','0');\"></span><span class='up_e' onclick=\"set_form('up','0','"+indexs+"')\"></span><span class='dw_e' onclick=\"set_form('dw','0','"+indexs+"')\"></span><span onclick=\"set_form('del','0','"+indexs+"');\"></span></td></tr>";
		
  		if(c_id=="-1"&&id=="0"){
  			$("#datatable tbody").append(tr_str);
		}else{
 			$("#list_"+c_id).after(tr_str);
		}
		
		$("#turn_"+indexs).html(selects);
 		if(is_resend==1){get_step_turn_list('step_turn_'+indexs,0);}
 		
  		$("#turn_"+indexs+" [name=step_turn]").attr("id","step_turn_"+indexs).val($("#step_turn_"+clone_id).val());
 		$("#form_index").val(indexs);
		goto_anchor("list_"+indexs);
 	 
 		$("#form_value_"+indexs).addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")}).focus();
  		
		$("#list_"+indexs+"").addClass('over');
		setTimeout("$('#list_"+indexs+"').removeClass('over');",1200);
  	}else if(do_=="up"){
		var tr_up = tr_this.prev();
 		$(tr_up).before(tr_this);
		$("#list_"+id+"").addClass('over');
 		setTimeout("$('#list_"+id+"').removeClass('over');",1200);
 	}else if(do_=="dw"){
		var tr_down = tr_this.next();
 		$(tr_down).after(tr_this);
		$("#list_"+id+"").addClass('over');
		setTimeout("$('#list_"+id+"').removeClass('over');",1200);
  	}else{
  		$("#list_"+id).remove();
 		if($("#datatable tbody tr").length==0){
			show_form_table("hide");
		} 
 	}
	order_datatable_();
}

function order_datatable_(){
	
	$("#datatable tbody tr").removeClass("alt").find(".up_d").addClass("up_e").removeClass("up_d");
	$("#datatable tbody tr").find(".dw_d").addClass("dw_e").removeClass("dw_d");
	$("#datatable tbody tr:first").find(".up_e").addClass("up_d").removeClass("up_e").unbind("click");
	$("#datatable tbody tr:last").find(".dw_e").addClass("dw_d").removeClass("dw_e").unbind("click");
	$("#datatable tbody tr:odd").addClass("alt");
	$("#datatable tbody tr").mouseover(function(){$(this).addClass("over")}).mouseout(function(){$(this).removeClass("over")});
}

//显示客户资料字段
function show_field_div(do_,input){
	 
	if(do_=="show"){
		
		if($("#field_list_div").html()==""){
			 
			var datas="action=get_field_list"+times;
			$.ajax({
				type: "post", 
				dataType: "html", 
				url: "send.php",
				data:datas,
				
				success: function(htmls){ 
					$("#field_list_div").html(htmls);
				} 
			});
		}
		
		input_att=$("#"+input).offset();
		
		$("#field_list_div").show().css({"top":input_att.top-58,"left":input_att.left-4});
		$("#current_input").val(input);
  	}else{
		$("#field_list_div").fadeOut("slow");
 	}
	
}
//插入客户资料字段
function insert_field(id_,value_){
	
	$(".field_list_2").removeClass("field_list_2").addClass("field_list_1");
 	$("#"+id_).addClass("field_list_2");
 	show_field_div('hide','hide');
 	$("#"+$("#current_input").val()).insert("--"+value_+"--");
}


$(document).ready(function(e) {
    $('.td_underline tr:visible:odd').addClass('alt');
	
	$("#field_list_div,#que_title,#que_des").click(function(event){  
	  var e=window.event || event;  
	  if(e.stopPropagation){  
		e.stopPropagation();  
	  }else{  
		e.cancelBubble = true;  
	  }  
	});
	
	$(document).click(function(){
		$("#field_list_div").hide();
	});
	
});
</script>
</head>
<body>
<input type="hidden" name="current_input" id="current_input"/>
<input type="hidden" name="step_id" id="step_id"/>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div class="field_list_div field_list" id="field_list_div"></div>
<?php
switch($action){
	case "call_submit":
 ?>
<script>
function do_setsubmit(){
 	$(_DialogInstance.ParentWindow.document).find("#ask_calldes").val($("#ask_calldes").val());
 	
	_DialogInstance.ParentWindow.do_submit();//setTimeout('Dialog.close();',5); 
}

$(document).ready(function(){
	
	$("#yes_des").html($(_DialogInstance.ParentWindow.document).find("#yes_des").val());
	$("#no_des").html($(_DialogInstance.ParentWindow.document).find("#no_des").val());
	
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <strong><?php echo $tits ?></strong></legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="set_table" >
        <tr>
          <td width="16%"align="right">成功结束语：</td>
          <td align="left" class="deepgreen" id="yes_des">&nbsp;</td>
        </tr>
        <tr>
          <td width="16%"align="right">失败结束语：</td>
          <td align="left" class="blue" id="no_des">&nbsp;</td>
        </tr>
        <tr>
          <td width="16%" align="right">呼叫描述：</td>
          <td align="left"><textarea name="ask_calldes" cols="76" rows="3" id="ask_calldes" style=""></textarea></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 

break;

case "add_ask":
?>
<script>

function do_add_ask(){
	
	if($("#ask_title").val() == ""){
		alert("请填写问卷标题！");
		$("#ask_title").focus();
		return false;
	}
	
	if($("#show_info").val() == "y"&&$("#info_name").val() =="" ){
		alert("请选择需显示的客户资料字段！");
		$("#info_name").focus();
		return false;
	}
	
	/*if($("#yes_des").val() == "")
	{
		alert("请填写营销成功结束语！");
		$("#yes_des").focus();
		return false;
	}
	
	if($("#no_des").val() == "")
	{
		alert("请填写营销失败结束语！");
		$("#no_des").focus();
		return false;
	}*/
    
	var form_value="";
 	$('#form1 input[name="que_title"]').each(function(i){
		
		if($(this).val()!=""&&$(this).val()!=undefined){
			
		 s_id="que_type_"+$(this).attr("fid");
		 d_id="is_end_"+$(this).attr("fid");
		 index_order=$(this).parent().parent().index();
		 if($("#"+d_id).is(":checked")==true){
			d_v=$("#"+d_id).val();
		 }else{
			d_v=""
		 }
 		  
 		 form_value+=""+$(this).val()+"#_#"+$("#"+s_id).val()+"#_#"+d_v+"#_#"+index_order+"|";
		 
		}
 	}); 
	
	if(form_value!=""&&form_value.substr(form_value.length-1)=="|"){
		form_value=form_value.substr(0,form_value.length-1);
	}
  	
 	if(form_value==""){
		if (confirm("当前问题还没有添加子问题步骤选项，确定不需要添加吗？！")){}else{show_que_table('show','y');goto_anchor("list_1");$("#que_title_1").focus();return false;}
	}
	$("#form_list").val(form_value);
   	
	$('#load').show();
	var datas="action=ask_set&do_actions=add&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
				$("#ask_id").val(json.ask_id);
			 
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val(),0);

				if (confirm("问卷创建成功，是否立即设置该问卷问题步骤？！")){
 					set_ask_que(json.ask_id);
 				}else{
					Dialog.close();
				}
				 
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}
 
function set_ask_que(ask_id){
	var diag =new Dialog("add_ask_"+ask_id);
    diag.Width = $(_DialogInstance.ParentWindow.window).width() - 30;
    diag.Height = $(_DialogInstance.ParentWindow.window).height() - 88;
 	diag.Title = "问题步骤设置";
    diag.URL = '/document/ask_flow/ask_set.php?ask_id='+ask_id+'&tits='+encodeURIComponent("问题步骤设置");
 	diag.OKEvent = set_save_ask;
	diag.CancelEvent = set_can_ask;
    diag.show();
	
 	
}
//保存
function set_save_ask(){
	Zd_DW.save_ask();
} 
//取消、关闭子窗口
function set_can_ask(){
	Zd_DW.do_set_can_ask();
}
//取消、关闭
function can_ask(){
	Dialog.close();
}

function save_ask(ask_id){
	Dialog.close();
	_DialogInstance.ParentWindow.save_ask(ask_id);
}

function get_que_type_list(type_id){
 	var datas="action=get_que_type_list"+times;
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		//async:false,
  		success: function(json){
		   $("select[id='que_type_"+type_id+"'] option").remove();
 		   $.each(json.datalist,function(index,con){
				$("#que_type_"+type_id).append("<option value='"+con.status+"'>"+con.status_name+"</option>");
		   });
  		} 
	});
}

function get_que_list(){
           	  
	$('#load').show();
	var datas="action=get_que_form_list&que_id="+$('#que_id').val()+times;
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
 		   if(json.counts=="1"){
			   show_form_table("show");
			   $("#datatable tbody tr").remove();
 			   
			   $.each(json.datalist,function(index,con){
				    var checked="";
					
					if(con.do_func=="y"){
						checked="checked";
					}
										
					tr_str="<tr align=\"left\" id=\"list_"+con.form_id+"\" nowrap><td><input type=\"text\" name=\"form_value\" id=\"form_value_"+con.form_id+"\" maxlength=\"360\" size=\"26\" class=\"form_val_\" fid=\""+con.form_id+"\" value=\""+con.form_value+"\"/></td><td><span style=\"float:left\" id=\"turn_"+con.form_id+"\"></span><span class=\"turn_img\"><img src=\"/images/icons/reload.png\" alt=\"更新跳转步骤\" onclick=\"get_step_turn_list('step_turn_"+con.form_id+"','0')\" /></span></td><td><input name=\"do_func\" type=\"checkbox\" id=\"do_func_"+con.form_id+"\" value=\"y\" title=\"是否包含附属表单供填写描述\" "+checked+"/><td><img src=\"/images/butCollapse.gif\" align=\"absmiddle\" onclick=\"set_form('add','"+con.form_id+"','0');\" alt=\"添加新子选项\" /><img src=\"/images/icon_cancel.gif\" alt=\"删除本选项\" align=\"absmiddle\" onclick=\"set_form('del','0','"+con.form_id+"');\" /></td></tr>";
					
					$("#datatable tbody").append(tr_str);
					$("#turn_"+con.form_id).html($("#step_turn_def").clone());
 					$("#turn_"+con.form_id+" [name=step_turn]").attr("id","step_turn_"+con.form_id).css("display","block").val(con.step_turn);
					 
 					$("#form_index").val(con.form_id);
			   });
 			   d_table_i();
		   }else{
			   show_form_table("hide");
		   }
		  
 		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
}
  
//显示子选项设置表单
function show_que_table(do_,is_re){
	if(do_=="show"){
		var c_id=parseInt($("#form_index").val());
		$("#form_table").html("<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" class=\"dataTable\" style=\"margin-top:4px; margin-bottom:4px; width:99%\" id=\"datatable\"><thead><tr align=\"left\" class=\"dataHead\"><td style=\"font-weight:normal\">问题标题</td><td style=\"font-weight:normal\">问题类型</td><td style=\"font-weight:normal\">是否结束</td><td style=\"font-weight:normal\">操作</td>\</tr></thead><tbody><tr align=\"left\" valign=\"middle\" id=\"list_1\" nowrap><td><input type=\"text\" name=\"que_title\" id=\"que_title_1\" maxlength=\"480\" size=\"42\" fid=\"1\"/></td><td><span style=\"float:left\" id=\"type_1\" ><select name=\"que_type\" id=\"que_type_1\" style=\"width:90px\"><option value=\"\">请选择类型</option></select></span></td><td><input type=\"checkbox\" name=\"is_end\" id=\"is_end_1\" value=\"y\" title=\"是否在本题结束本问卷\"/></td><td class='o_icos'><span class='add' onclick=\"set_que_form('add','1','0');\"></span><span class='up_e' onclick=\"set_que_form('up','0','1')\"></span><span class='dw_e' onclick=\"set_que_form('dw','0','1')\"></span><span onclick=\"set_que_form('del','0','1');\"></span></td></tr></tbody><tfoot><tr><td colspan='6'><a href='javascript:void(0)' onclick=\"set_que_form('add','-1','0');\";>增加一项</a></td></tr></tfoot></table>");
  		$("#que_title_1").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
  		order_datatable_();
		get_que_type_list("1");
		goto_anchor("list_1");
 	}else{
		$("#form_table").html("<a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' title=\"添加问题步骤选项\" onClick=\"show_que_table('show','y');\" style=\"margin-top:4px\"><img src=\"/images/butCollapse.gif\" align=\"absmiddle\" style=\"margin-top:5px\"/><b>添加问题步骤选项&nbsp;</b></a>");
	}
}

//插入子选项表单
function set_que_form(do_,c_id,id){
	var tr_str="",form_select="",tr_this = $("#list_"+id);

	if(do_=="add"){
		
		var form_index=$("#form_index").val();
 		indexs=parseInt(form_index)+1;
		
		if(c_id=="-1"||$("#list_"+c_id).length<1){c_id=$("#datatable tbody tr:last").find("input[name='que_title']").attr("fid");}
  		
		if($("#que_type_"+c_id).val()==""||$("#que_type_"+c_id).val()==undefined||$("#que_type_"+c_id).val()==null){
			selects="<select name=\"que_type\" id=\"que_type_"+indexs+"\" ></select>";
 			is_resend=1;
			clone_id=indexs;
  		}else{
 			selects=$("#que_type_"+c_id).clone(true);
			is_resend=0;
			clone_id=c_id;
		}
  		
   		tr_str="<tr align=\"left\" id=\"list_"+indexs+"\" nowrap><td><input type=\"text\" name=\"que_title\" id=\"que_title_"+indexs+"\" maxlength=\"480\" size=\"42\" fid=\""+indexs+"\"/></td><td><span style=\"float:left\" id=\"type_"+indexs+"\"></span></td><td><input type=\"checkbox\" name=\"is_end\" id=\"is_end_"+indexs+"\" value=\"y\" title=\"是否在本题结束本问卷\"/></td><td class='o_icos'><span class='add' onclick=\"set_que_form('add','"+indexs+"','0');\"></span><span class='up_e' onclick=\"set_que_form('up','0','"+indexs+"')\"></span><span class='dw_e' onclick=\"set_que_form('dw','0','"+indexs+"')\"></span><span onclick=\"set_que_form('del','0','"+indexs+"');\"></span></td></tr>";
   		//alert(tr_str);
		if(c_id=="-1"&&id=="0"){
  			$("#datatable tbody").append(tr_str);
		}else{
 			$("#list_"+c_id).after(tr_str);
		}
		
		$("#type_"+indexs).html(selects);
 		if(is_resend==1){get_que_type_list(indexs);}
 		
  		$("#type_"+indexs+" [name=que_type]").attr("id","que_type_"+indexs).val($("#que_type_"+clone_id).val());
 		$("#form_index").val(indexs);
		goto_anchor("list_"+indexs);
		
   		$("#que_title_"+indexs).addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")}).focus();
 		
		$("#list_"+indexs+"").addClass('over');
		setTimeout("$('#list_"+indexs+"').removeClass('over');",1200);
  	}else if(do_=="up"){
		var tr_up = tr_this.prev();
 		$(tr_up).before(tr_this);
		$("#list_"+id+"").addClass('over');
 		setTimeout("$('#list_"+id+"').removeClass('over');",1200);
 	}else if(do_=="dw"){
		var tr_down = tr_this.next();
 		$(tr_down).after(tr_this);
		$("#list_"+id+"").addClass('over');
		setTimeout("$('#list_"+id+"').removeClass('over');",1200);
  	}else{
  		$("#list_"+id).remove();
 		if($("#datatable tbody tr").length==0){
			show_que_table("hide");
		} 
 	}
	order_datatable_();
}
   

 
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <input name="ask_id" id="ask_id" type="hidden" value="" />
  <input name="form_index" id="form_index" type="hidden" value="1" />
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <input name="form_list" id="form_list" type="hidden" value="" />
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
        <tr>
          <td width="16%"  align="right" nowrap="nowrap">问卷标题：</td>
          <td align="left"><input name="ask_title" type="text" class="input_86" id="ask_title" maxlength="600" style="width:90%" />
            <span class="red">※</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">客户资料：</td>
          <td align="left" >
			  <?php       	
                $info_list="";
                $info_name="";
                if(is_array($ask_list_ary)){
                    foreach($ask_list_ary as $field_value =>$field_name ){
                         if($field_name=="电话号码"||$field_name=="标题(公司)"||$field_name=="名字"||$field_name=="描述"){
                             $info_list.=$field_name.",".$field_value."#_#";
                             $info_name.=$field_name.",";
                         }else{
                         }
                    }
                }
                if($info_list!=""){
                    $info_list=rtrim($info_list,"#_#");
                }
                if($info_name!=""){
                    $info_name=rtrim($info_name,",");
                }
               ?>
            <select name="show_info" class="s_option" id="show_info" style="float:left; margin-top:2px" onchange="chang_detail(this.value);" >
              <option value="y" title="显示客户详细资料" selected="selected" >显示客户详细资料</option>
              <option value="n" title="隐藏客户详细资料">隐藏客户详细资料</option>
            </select>
            <span id="detail_" style="float:left">&nbsp;
            <input type="hidden" name="info_list" id="info_list" value="<?php echo $info_list?>" />
            <input name="info_name" type="text" id="info_name" title="双击选择需显示的客户资料" value="<?php echo $info_name?>" size="26" maxlength="460" readonly="readonly" ondblclick="choose_fields('choose_info_field');"/>
            &nbsp;
            <input type="button" name="choose_info" id="choose_info" value="选" onclick="choose_fields('choose_info_field');" title="选择需显示的客户资料"/>
            </span><span class="gray" style="float:left" >&nbsp;&nbsp;设置客户资料字段显示</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">对齐方式：</td>
          <td align="left" valign="middle"><select name="postion" id="postion" class="s_option">
              <option value="left">居左显示</option>
              <option value="center">居中显示</option>
            </select>
            <span class="gray">&nbsp;设置问题内容对齐方式</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">显示类型：</td>
          <td align="left" valign="middle"><select name="ask_type" id="ask_type" class="s_option">
              <option value="que">分步列表</option>
              <option value="list">全文列表</option>
            </select>
            <span class="gray">&nbsp;设置问题显示类型</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">自动跳转：</td>
          <td align="left" valign="middle"><select name="auto_turn" id="auto_turn" class="s_option">
              <option value="Y">打开跳转</option>
              <option value="N">关闭跳转</option>
            </select>
            <span class="gray">&nbsp;设置<strong>单选题</strong>选中答案后是否自动跳转到下一题</span></td>
        </tr>
        <tr>
          <td height="" align="right" nowrap="nowrap">问卷描述：</td>
          <td align="left" valign="top"><div style="position:relative">
              <textarea name="ask_des"  class="input_86" id="ask_des" style="float:left; height:32px"></textarea>
            </div></td>
        </tr>
        <tr>
          <td height="" align="right" nowrap="nowrap">营销成功结束语：</td>
          <td align="left" valign="top"><div style="position:relative">
              <textarea name="yes_des"  class="input_86" id="yes_des" style="float:left; height:32px"></textarea>
            </div></td>
        </tr>
        <tr>
          <td height="" align="right" nowrap="nowrap">营销失败结束语：</td>
          <td align="left" valign="top"><div style="position:relative">
              <textarea name="no_des"  class="input_86" id="no_des" style="float:left; height:32px"></textarea>
            </div></td>
        </tr>
        <tr valign="">
          <td width="16%" height="36" align="right" valign="middle" nowrap="nowrap">问题步骤选项：</td>
          <td align="left" id="form_table"><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" title="添加问题选项" onclick="show_que_table('show','y');" style="margin-top:4px"><img src="/images/butCollapse.gif" align="absmiddle" style="margin-top:5px"/><b>添加问题步骤选项&nbsp;</b></a></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 

break;

case "edit_ask":
?>
<?php

$sql="select ask_title,ask_des,yes_des,no_des,postion,show_info,info_list,info_name,ask_type,auto_turn from data_ask where ask_id='".$ask_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$ask_title=HtmlReplace($rs["ask_title"],3);
 		$ask_des=HtmlReplace($rs["ask_des"],3);
 		$yes_des=HtmlReplace($rs["yes_des"],3);
 		$no_des=HtmlReplace($rs["no_des"],3);
 		$postion=$rs["postion"];
 		$show_info=$rs["show_info"];
 		$info_list=$rs["info_list"];
 		$info_name=$rs["info_name"];
		$ask_type=$rs["ask_type"];
		$auto_turn=$rs["auto_turn"];
   	}
  	
	echo '<script>$(document).ready(
	function(){
		$("#ask_title").val("'.$ask_title.'");
 		$("#postion").val("'.$postion.'");
		$("#show_info").val("'.$show_info.'");
		$("#info_list").val("'.$info_list.'");
		$("#ask_type").val("'.$ask_type.'");
		$("#auto_turn").val("'.$auto_turn.'");
		$("#info_name").attr("title",$(this).attr("title")+"：'.$info_name.'").val("'.$info_name.'");
	});
	</script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<script>

function do_edit_que(){
	
	if($("#ask_title").val() == ""){
		alert("请填写问卷标题！");
		$("#ask_title").focus();
		return false;
	}
	
	if($("#show_info").val() == "y"&&$("#info_name").val() =="" ){
		alert("请选择需显示的客户资料字段！");
		$("#info_name").focus();
		return false;
	}
	
/*	if($("#yes_des").val() == "")
	{
		alert("请填写营销成功结束语！");
		$("#yes_des").focus();
		return false;
	}
	
	if($("#no_des").val() == "")
	{
		alert("请填写营销失败结束语！");
		$("#no_des").focus();
		return false;
	}*/
     
  	  
	$('#load').show();
	var datas="action=edit_ask&do_actions=ask&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
			if($.trim($("#ask_des").val())!=""){
				display="block";
			}else{
				display="none";
			}
			
 			$(_DialogInstance.ParentWindow.document).find("#ask_des").css("display",display);
			$(_DialogInstance.ParentWindow.document).find("#is_ask_des").val(display);
 			$(_DialogInstance.ParentWindow.document).find("#info_list_ary").val($("#info_list").val());
			$(_DialogInstance.ParentWindow.document).find("#show_info").val($("#show_info").val());
			$(_DialogInstance.ParentWindow.document).find("#postion").val($("#postion").val());
			$(_DialogInstance.ParentWindow.document).find("#ask_type").val($("#ask_type").val());
			$(_DialogInstance.ParentWindow.document).find("#ask_title_det").html($("#ask_title").val());
			$(_DialogInstance.ParentWindow.document).find("#ask_des_det").html($("#ask_des").val().replaceAll("\n","<br>"));
 			$(_DialogInstance.ParentWindow.document).find("#yes_des_det").html($("#yes_des").val().replaceAll("\n","<br>"));
			$(_DialogInstance.ParentWindow.document).find("#no_des_det").html($("#no_des").val().replaceAll("\n","<br>"));
  			
			_DialogInstance.ParentWindow.set_que_class();
			_DialogInstance.ParentWindow.create_info_table();
			
    		 setTimeout('Dialog.close();',1);
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
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
        <tr>
          <td width="16%"  align="right" nowrap="nowrap">问卷标题：</td>
          <td align="left"><input name="ask_title" type="text" class="input_86" id="ask_title" maxlength="600" style="width:90%" />
            <span class="red">※</span>
            <input type="hidden" name="ask_id" id="ask_id" value="<?php echo $ask_id?>" /></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">客户资料：</td>
          <td align="left" ><select name="show_info" class="s_option" id="show_info" style="float:left" onchange="chang_detail(this.value);" >
              <option value="y" title="显示客户详细资料" >显示客户详细资料</option>
              <option value="n" title="隐藏客户详细资料">隐藏客户详细资料</option>
            </select>
            <span id="detail_" style="float:left">&nbsp;
            <input type="hidden" name="info_list" id="info_list" value="" />
            <input name="info_name" type="text" id="info_name" title="双击选择需显示的客户资料" value="" size="26" maxlength="460" readonly="readonly" ondblclick="choose_fields('choose_info_field');" sie="40"/>
            &nbsp;
            <input type="button" name="choose_info" id="choose_info" value="选" onclick="choose_fields('choose_info_field');" title="选择需显示的客户资料"/>
            </span><span class="gray" style="float:left" >&nbsp;&nbsp;设置是否显示客户资料字段</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">对齐方式：</td>
          <td align="left" valign="middle"><select name="postion" id="postion" class="s_option">
              <option value="left">居左显示</option>
              <option value="center">居中显示</option>
            </select>
            <span class="gray">&nbsp;设置问题内容对齐方式</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">显示类型：</td>
          <td align="left" valign="middle"><select name="ask_type" id="ask_type" class="s_option">
              <option value="que">分步列表</option>
              <option value="list">全文列表</option>
            </select>
            <span class="gray">&nbsp;设置问题显示类型</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">自动跳转：</td>
          <td align="left" valign="middle"><select name="auto_turn" id="auto_turn" class="s_option">
              <option value="Y">打开跳转</option>
              <option value="N">关闭跳转</option>
            </select>
            <span class="gray">&nbsp;设置<strong>单选题</strong>选中答案后是否自动跳转到下一题</span></td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">问卷描述：</td>
          <td align="left" valign="top"><div style="position:relative">
              <textarea name="ask_des"  class="input_86" id="ask_des" style="float:left; height:32px"><?php echo $ask_des ?></textarea>
            </div></td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">营销成功结束语：</td>
          <td align="left" valign="top"><div style="position:relative">
              <textarea name="yes_des"  class="input_86" id="yes_des" style="float:left; height:32px"><?php echo $yes_des ?></textarea>
            </div></td>
        </tr>
        <tr>
          <td height="48" align="right" nowrap="nowrap">营销失败结束语：</td>
          <td align="left" valign="top"><div style="position:relative">
              <textarea name="no_des"  class="input_86" id="no_des" style="float:left; height:32px"><?php echo $no_des ?></textarea>
            </div></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 

break;

//新建问答题
case "add_que_wd":
?>
<script>

function do_set_que(){
	
	if($("#que_title").val() == "")
	{
		alert("请填写问题标题！");
		$("#que_title").focus();
		return false;
	}
	
	if($("#is_break").is(':checked')==true&&$("#break_des").val()==""){
		alert("请填写分隔标识描述！");
		$("#break_des").focus();
		return false;
	}
	
	if(parseInt($("#form_size").val())>120){
		alert("表单宽度已超过最大限额120，请修改！");
		$("#form_size").select();
		return false;
	}	
	
 	$('#load').show();
	var datas="action=set_que&do_actions=add&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			_DialogInstance.ParentWindow.get_ask_que_list("add","que",json.que_id);
   			setTimeout('Dialog.close();',1);
		  }else{
			 alert(json.des);
 		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
$(document).ready(function(){
	get_step_turn_list(0,0);
	 
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
        <tr>
          <td width="16%"  align="right" nowrap="nowrap">问题标题：</td>
          <td align="left"><textarea name="que_title"  class="input_h_86" id="que_title" style="float:left"  onclick="show_field_div('show','que_title');"></textarea>
            <span class="red"> </span>
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
            <input name="que_id" type="hidden" id="que_id" value="<?php echo $que_id;?>" />
            <input name="que_type" type="hidden" id="que_type" value="<?php echo $que_type;?>" /></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">跳转步骤：</td>
          <td align="left"><span style="float:left">
            <select name="step_turn" id="step_turn_do" >
              <option value="yes_des">营销成功结束语</option>
              <option value="no_des">营销失败结束语</option>
            </select>
            </span> <span class="turn_img" title="更新跳转步骤" onclick="get_step_turn_list('step_turn_do',0)"></span> <span class="gray">&nbsp;设置本题跳转步骤</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">分隔标识：</td>
          <td align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr style="display:none">
                <td></td>
              </tr>
              <tr>
                <td style="border:0"><input name="is_break" type="checkbox" id="is_break" value="y" onclick="set_break(this.checked);" /></td>
                <td style="border:0"><span id="bre_des" class="gray" >
                  <label for="is_break">&nbsp;是否在本题顶部或底部显示分隔行，以标识问卷不同部分</label>
                  </span> <span id="bre_div" style="display:none;"> &nbsp;描述：
                  <input name="break_des" type="text" id="break_des" size="30" class="s_input" maxlength="290" title="分隔标识描述" />
                  &nbsp;
                  <label for="break_pos">位置：
                    <select name="break_pos" id="break_pos" title="分隔标识显示位置" class="s_option">
                      <option value="top">本题顶部</option>
                      <option value="bottom">本题底部</option>
                    </select>
                  </label>
                  </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="" align="right" nowrap="nowrap">是否结束：</td>
          <td align="left"><input name="is_end" type="checkbox" id="is_end" value="y"/>
            <span class="gray"><label for="is_end">是否在本题结束本问卷</label></span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">表单宽度：</td>
          <td align="left" valign="middle"><input name="form_size" type="text" id="form_size" value="80" onkeyup="if(isNaN(value))execCommand('undo');" onafterpaste="if(isNaN(value))execCommand('undo');" />
            <span class="gray">&nbsp;表单显示字符宽度；默认：80、自动：0、最大120（单位：字）</span></td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">题目描述：</td>
          <td align="left" valign="top"><span style="position:relative">
            <textarea name="que_des"  class="input_86" id="que_des" style="float:left"  onclick="show_field_div('show','que_des');"></textarea>
            </span></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 

break;

//修改问答题
case "edit_que_text":
?>
<?php

$sql="select que_title,que_des,que_type,step_turn,is_break,break_pos,break_des,form_size,is_end from data_ask_question where que_id='".$que_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$que_title=HtmlReplace($rs["que_title"],3);
 		$que_des=HtmlReplace($rs["que_des"],3);
 		$que_type=$rs["que_type"];
 		$step_turn=$rs["step_turn"];
 		$is_break=$rs["is_break"];
		$is_end=$rs["is_end"];
		if($is_break=="y"){$is_break="true";}else{$is_break="false";}
 		$break_pos=$rs["break_pos"];
 		$break_des=HtmlReplace($rs["break_des"],3);
 		$form_size=$rs["form_size"];
		if($is_end=="y"){$is_end="true";}else{$is_end="false";}
  	}
  	
	echo '<script>$(document).ready(
		function(){
			get_step_turn_list(0,"'.$step_turn.'");
  			
			$("#que_title").val("'.$que_title.'");
			 
			$("#que_type").val("'.$que_type.'");
			 
			$("#is_break").attr("checked",'.$is_break.');
			$("#is_end").attr("checked",'.$is_end.');
			$("#break_pos").val("'.$break_pos.'");
			$("#break_des").val("'.$break_des.'");
			$("#form_size").val("'.$form_size.'");
			set_break('.$is_break.');

		});</script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<script>

function do_edit_que(){
	
	if($("#que_title").val() == "")
	{
		alert("请填写问题标题！");
		$("#que_title").focus();
		return false;
	}
	
	if($("#is_break").is(':checked')==true&&$("#break_des").val()==""){
		alert("请填写分隔标识描述！");
		$("#break_des").focus();
		return false;
	}
	
	if(parseInt($("#form_size").val())>120){
		alert("表单宽度已超过最大限额120，请修改！");
		$("#form_size").select();
		return false;
	}	
	
 	$('#load').show();
	var datas="action=set_que&do_actions=edit&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			_DialogInstance.ParentWindow.get_ask_que_list("edit","que",json.que_id);
   			setTimeout('Dialog.close();',1);
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
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
        <tr>
          <td width="16%"  align="right" nowrap="nowrap">问题标题：</td>
          <td align="left"><textarea name="que_title"  class="input_h_86" id="que_title" style="float:left"  onclick="show_field_div('show','que_title');"></textarea>
            <span class="red"> </span>
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
            <input name="que_id" type="hidden" id="que_id" value="<?php echo $que_id;?>" />
            <input name="que_type" type="hidden" id="que_type" value="<?php echo $que_type;?>" /></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">跳转步骤：</td>
          <td align="left"><span style="float:left">
            <select name="step_turn" id="step_turn_do" >
              <option value="yes_des">营销成功结束语</option>
              <option value="no_des">营销失败结束语</option>
            </select>
            </span> <span class="turn_img" title="更新跳转步骤" onclick="get_step_turn_list('step_turn_do',0)"></span> <span class="gray">&nbsp;设置本题跳转步骤</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">分隔标识：</td>
          <td align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr style="display:none">
                <td></td>
              </tr>
              <tr>
                <td style="border:0"><input name="is_break" type="checkbox" id="is_break" value="y" onclick="set_break(this.checked);" /></td>
                <td style="border:0"><span id="bre_des" class="gray" >
                  <label for="is_break">&nbsp;是否在本题顶部或底部显示分隔行，以标识问卷不同部分</label>
                  </span> <span id="bre_div" style="display:none;"> &nbsp;描述：
                  <input name="break_des" type="text" id="break_des" size="30" class="s_input" maxlength="290" title="分隔标识描述" />
                  &nbsp;
                  <label for="break_pos">位置：
                    <select name="break_pos" id="break_pos" title="分隔标识显示位置" class="s_option">
                      <option value="top">本题顶部</option>
                      <option value="bottom">本题底部</option>
                    </select>
                  </label>
                  </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="" align="right" nowrap="nowrap">是否结束：</td>
          <td align="left"><input name="is_end" type="checkbox" id="is_end" value="y"/>
            <span class="gray"><label for="is_end">是否在本题结束本问卷</label></span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">表单宽度：</td>
          <td align="left" valign="middle"><input name="form_size" type="text" id="form_size" value="80" onkeyup="if(isNaN(value))execCommand('undo');" onafterpaste="if(isNaN(value))execCommand('undo');" />
            <span class="gray">&nbsp;表单显示字符宽度；默认：80、自动：0、最大120（单位：字）</span></td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">题目描述：</td>
          <td align="left" valign="top"><span style="position:relative">
            <textarea name="que_des"  class="input_86" id="que_des" style="float:left"  onclick="show_field_div('show','que_des');"><?php echo $que_des ?></textarea>
            </span></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 
break;

//新建分隔符
case "add_que_fgf":
?>
<script>

function do_set_que(){
	
	if($("#que_des").val() == "")
	{
		alert("请填写分隔符描述！");
		$("#que_des").focus();
		return false;
	}
       	  
	$('#load').show();
	var datas="action=set_que&do_actions=add&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			_DialogInstance.ParentWindow.get_ask_que_list("add","que",json.que_id);
   			setTimeout('Dialog.close();',1);
		  }else{
			 alert(json.des);
 		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
$(document).ready(function(){
	//get_step_turn_list("<?php echo $ask_id?>");
	$("#que_des").focus();
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 >
        <tr>
          <td width="16%" align="right" nowrap="nowrap">分隔符描述：</td>
          <td align="left"><div style="position:relative">
              <textarea name="que_des"  class="input_86" id="que_des" style="float:left;"></textarea>
              <div style="float:left;top:2px;margin-left:6px"><span class="red">※</span></div>
            </div>
            <input name="que_title" type="hidden" id="que_title" value="[<?php echo $tits;?>]" />
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
            <input name="que_id" type="hidden" id="que_id" value="<?php echo $que_id;?>" />
            <input name="que_type" type="hidden" id="que_type" value="<?php echo $que_type;?>" /></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 
break;

//新建自定义描述
case "add_que_des":
?>
<script>

function do_set_que(){
	
	if($("#que_des").val() == "")
	{
		alert("请填写描述内容！");
		$("#que_des").focus();
		return false;
	}
       	  
	$('#load').show();
	var datas="action=set_que&do_actions=add&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			_DialogInstance.ParentWindow.get_ask_que_list("add","que",json.que_id);
   			setTimeout('Dialog.close();',1);
		  }else{
			 alert(json.des);
 		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
$(document).ready(function(){
	get_step_turn_list(0,0);
	 
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
        <tr>
          <td width="16%" align="right" nowrap="nowrap">跳转步骤：</td>
          <td align="left"><span style="float:left">
            <select name="step_turn" id="step_turn_do" >
              <option value="yes_des">营销成功结束语</option>
              <option value="no_des">营销失败结束语</option>
            </select>
            </span> <span class="turn_img" title="更新跳转步骤" onclick="get_step_turn_list('step_turn_do',0)"></span> <span class="gray">&nbsp;设置本题跳转步骤</span></td>
        </tr>
        <tr>
          <td width="16%" align="right" nowrap="nowrap">分隔标识：</td>
          <td align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr style="display:none">
                <td></td>
              </tr>
              <tr>
                <td style="border:0px"><input name="is_break" type="checkbox" id="is_break" value="y" onclick="set_break(this.checked);" /></td>
                <td style="border:0px"><span id="bre_des" class="gray" >
                  <label for="is_break">&nbsp;是否在本题顶部或底部显示分隔行，以标识问卷不同部分</label>
                  </span> <span id="bre_div" style="display:none;"> &nbsp;描述：
                  <input name="break_des" type="text" id="break_des" size="30" class="s_input" maxlength="290" title="分隔标识描述" />
                  &nbsp;
                  <label for="break_pos">位置：
                    <select name="break_pos" id="break_pos" title="分隔标识显示位置" class="s_option">
                      <option value="top">本题顶部</option>
                      <option value="bottom">本题底部</option>
                    </select>
                  </label>
                  </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="16%" height="" align="right" nowrap="nowrap">是否结束：</td>
          <td align="left"><input name="is_end" type="checkbox" id="is_end" value="y"/>
            <span class="gray"><label for="is_end">是否在本题结束本问卷</label></span></td>
        </tr>
        <tr>
          <td width="16%" align="right" nowrap="nowrap">描述内容：</td>
          <td align="left"><div style="position:relative">
              <textarea name="que_des"  class="input_86" id="que_des" style="float:left;" onclick="show_field_div('show','que_des');" ></textarea>
              <div style="float:left;top:2px;margin-left:6px"><span class="red"> </span></div>
            </div>
            <input name="que_title" type="hidden" id="que_title" value="" />
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
            <input name="que_id" type="hidden" id="que_id" value="<?php echo $que_id;?>" />
            <input name="que_type" type="hidden" id="que_type" value="<?php echo $que_type;?>" /></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 
break;

//修改问答题
case "edit_que_des":
?>
<?php

$sql="select que_title,que_des,que_type,step_turn,is_break,break_pos,break_des,form_size,is_end from data_ask_question where que_id='".$que_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$que_title=HtmlReplace($rs["que_title"],3);
 		$que_des=HtmlReplace($rs["que_des"],3);
 		$que_type=$rs["que_type"];
 		$step_turn=$rs["step_turn"];
 		$is_break=$rs["is_break"];
		$is_end=$rs["is_end"];
		if($is_break=="y"){$is_break="true";}else{$is_break="false";}
 		$break_pos=$rs["break_pos"];
 		$break_des=HtmlReplace($rs["break_des"],3);
 		$form_size=$rs["form_size"];
		if($is_end=="y"){$is_end="true";}else{$is_end="false";}
  	}
  	
	echo '<script>$(document).ready(
		function(){
			get_step_turn_list(0,"'.$step_turn.'");
  			
			$("#que_des").focus();
			 
			$("#que_type").val("'.$que_type.'");
			$("#is_end").attr("checked",'.$is_end.');
			$("#is_break").attr("checked",'.$is_break.');
			$("#break_pos").val("'.$break_pos.'");
			$("#break_des").val("'.$break_des.'");
			//$("#form_size").val("'.$form_size.'");
			set_break('.$is_break.');

		});</script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<script>

function do_edit_que(){
	
	if($("#que_des").val() == "")
	{
		alert("请填写描述内容！");
		$("#que_des").focus();
		return false;
	}
	
	if($("#is_break").is(':checked')==true&&$("#break_des").val()==""){
		alert("请填写分隔标识描述！");
		$("#break_des").focus();
		return false;
	}
  	
 	$('#load').show();
	var datas="action=set_que&do_actions=edit&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			_DialogInstance.ParentWindow.get_ask_que_list("edit","que",json.que_id);
   			setTimeout('Dialog.close();',1);
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
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
        <tr>
          <td width="16%" align="right">跳转步骤：</td>
          <td align="left"><span style="float:left">
            <select name="step_turn" id="step_turn_do" >
              <option value="yes_des">营销成功结束语</option>
              <option value="no_des">营销失败结束语</option>
            </select>
            </span> <span class="turn_img" title="更新跳转步骤" onclick="get_step_turn_list('step_turn_do',0)"></span> <span class="gray">&nbsp;设置本题跳转步骤</span></td>
        </tr>
        <tr>
          <td width="16%" align="right">分隔标识：</td>
          <td align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr style="display:none">
                <td></td>
              </tr>
              <tr>
                <td style="border:0"><input name="is_break" type="checkbox" id="is_break" value="y" onclick="set_break(this.checked);" /></td>
                <td style="border:0"><span id="bre_des" class="gray" >
                  <label for="is_break">&nbsp;是否在本题顶部或底部显示分隔行，以标识问卷不同部分</label>
                  </span> <span id="bre_div" style="display:none;"> &nbsp;描述：
                  <input name="break_des" type="text" id="break_des" size="30" class="s_input" maxlength="290" title="分隔标识描述" />
                  &nbsp;
                  <label for="break_pos">位置：
                    <select name="break_pos" id="break_pos" title="分隔标识显示位置" class="s_option">
                      <option value="top">本题顶部</option>
                      <option value="bottom">本题底部</option>
                    </select>
                  </label>
                  </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="16%" height="" align="right">是否结束：</td>
          <td align="left"><input name="is_end" type="checkbox" id="is_end" value="y"/>
            <span class="gray"><label for="is_end">是否在本题结束本问卷</label></span></td>
        </tr>
        <tr>
          <td width="16%" align="right">描述内容：</td>
          <td align="left" valign="top"><div style="position:relative">
              <textarea name="que_des"  class="input_86" id="que_des" style="float:left;" onclick="show_field_div('show','que_des');" ><?php echo $que_des ?></textarea>
              <div style="float:left;top:2px;margin-left:6px"><span class="red">※</span></div>
            </div>
            <input name="que_title" type="hidden" id="que_title" value="" />
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
            <input name="que_id" type="hidden" id="que_id" value="<?php echo $que_id;?>" />
            <input name="que_type" type="hidden" id="que_type" value="<?php echo $que_type;?>" /></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 
break;
//新建单选、复选题目
case "add_que_dx_fx":
?>
<script>
 
function do_set_que(){
	
	if($("#que_title").val() == "")
	{
		alert("请填写问题标题！");
		$("#que_title").focus();
		return false;
	}
	
	if($("#is_break").is(':checked')==true&&$("#break_des").val()==""){
		alert("请填写分隔标识描述！");
		$("#break_des").focus();
		return false;
	}
  	
	var form_value="";
 	$('#form1 input[name="form_value"]').each(function(i){
		
		if($(this).val()!=""&&$(this).val()!=undefined){
			
		 s_id="step_turn_"+$(this).attr("fid");
		 d_id="do_func_"+$(this).attr("fid");
		 if($("#"+d_id).is(":checked")==true){
			d_v=$("#"+d_id).val();
		 }else{
			 d_v=""
		 }
 		  
 		 form_value+=""+$(this).val()+"#_#"+$("#"+s_id).val()+"#_#"+d_v+"|";
		 
		}
 	}); 
	//alert(form_value);
	if(form_value!=""&&form_value.substr(form_value.length-1)=="|"){
		form_value=form_value.substr(0,form_value.length-1);
	}
  	
 	if(form_value==""){
		if (confirm("当前问题还没有添加子选项，确定不需要添加吗？！")){}else{return false;}
	}
	$("#form_list").val(form_value);
         	  
	$('#load').show();
	var datas="action=set_que&do_actions=add&"+$('#form1').serialize()+times;
	 
	//return false;
	
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
 		   
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			_DialogInstance.ParentWindow.get_ask_que_list("add","que",json.que_id);
   			setTimeout('Dialog.close();',1);
		  }else{
			 alert(json.des);
 		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
}


$(document).ready(function(){
	 
	$("#que_type").val("<?php echo $que_type?>");
});

</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <input name="form_index" type="hidden" id="form_index" value="1" />
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" id="field_table" >
        <tr>
          <td width="16%" align="right" nowrap="nowrap">问题标题：</td>
          <td height="28" align="left"><textarea name="que_title"  class="input_h_86" id="que_title" style="float:left"  onclick="show_field_div('show','que_title');"></textarea>
            <span class="red"> </span>
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
            <input name="que_id" type="hidden" id="que_id" value="<?php echo $que_id;?>" />
            <input name="form_list" type="hidden" id="form_list" value=""/></td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">排列方式：</td>
          <td height="28" align="left"><select name="postion" class="s_option" id="postion" style="float:left" title="选择子选项排列方式">
              <option value="port" selected="selected">纵向排列</option>
              <option value="land">横向排列</option>
            </select>
            <span class="gray">&nbsp;设置子选项排列方式</span></td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"> 选项类型：</td>
          <td align="left" valign="middle"><select name="que_type" class="s_option" id="que_type" style="float:left">
              <option value="radio">单选题</option>
              <option value="checkbox">多选题</option>
            </select>
            <span class="gray">&nbsp;设置子选项类型</span></td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">分隔标识：</td>
          <td align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr style="display:none">
                <td></td>
              </tr>
              <tr>
                <td style="border:0"><input name="is_break" type="checkbox" id="is_break" value="y" onclick="set_break(this.checked);" /></td>
                <td style="border:0"><span id="bre_des" class="gray" >
                  <label for="is_break">&nbsp;是否在本题顶部或底部显示分隔行，以标识问卷不同部分</label>
                  </span> <span id="bre_div" style="display:none;"> &nbsp;描述：
                  <input name="break_des" type="text" id="break_des" size="30" class="s_input" maxlength="290" title="分隔标识描述" />
                  &nbsp;
                  <label for="break_pos">位置：
                    <select name="break_pos" id="break_pos" title="分隔标识显示位置" class="s_option">
                      <option value="top">本题顶部</option>
                      <option value="bottom">本题底部</option>
                    </select>
                  </label>
                  </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="" align="right" nowrap="nowrap">是否结束：</td>
          <td align="left"><input name="is_end" type="checkbox" id="is_end" value="y"/>
            <span class="gray"><label for="is_end">是否在本题结束本问卷</label></span></td>
        </tr>
        <tr valign="">
          <td width="16%" align="right" valign="middle" nowrap="nowrap">子选项：</td>
          <td align="left" id="form_table"><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" title="添加子选项" onclick="show_form_table('show','y');" style="margin-top:4px"><img src="/images/butCollapse.gif" align="absmiddle" style="margin-top:5px"/><b>添加子选项&nbsp;</b></a></td>
        </tr>
        <tr>
          <td width="16%" align="right" nowrap="nowrap">题目描述：</td>
          <td align="left" valign="middle" style="padding-top:4px; padding-bottom:4px"><span style="position:relative;">
            <textarea name="que_des"  class="input_86" id="que_des" style="float:left;height:60px" onclick="show_field_div('show','que_des');"></textarea>
            </span></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 
break;

//修改单选、复选题目
case "edit_que_dx_fx":
?>
<?php

$sql="select que_title,que_des,que_type,is_break,break_pos,break_des,postion,is_end from data_ask_question where que_id='".$que_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$que_title=HtmlReplace($rs["que_title"],3);
 		$que_des=HtmlReplace($rs["que_des"],3);
 		$que_type=$rs["que_type"];
  		$is_break=$rs["is_break"];
		$is_end=$rs["is_end"];
		if($is_break=="y"){$is_break="true";}else{$is_break="false";}
 		$break_pos=$rs["break_pos"];
 		$break_des=HtmlReplace($rs["break_des"],3);
 		$postion=$rs["postion"];
		if($is_end=="y"){$is_end="true";}else{$is_end="false";}
  	}
  	
	echo '<script>$(document).ready(
		function(){
			//get_step_turn_list("'.$ask_id.'","step_turn_def",0);
  			get_que_form_list();
			$("#que_title").val("'.$que_title.'");
			 
			$("#que_type").val("'.$que_type.'");
			$("#postion").val("'.$postion.'");
			$("#is_end").attr("checked",'.$is_end.');
			$("#is_break").attr("checked",'.$is_break.');
			$("#break_pos").val("'.$break_pos.'");
			$("#break_des").val("'.$break_des.'");
 			set_break('.$is_break.');

		});</script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<script>
  
function get_que_form_list(){
           	  
	$('#load').show();
	var datas="action=get_que_form_list&que_id="+$('#que_id').val()+times;
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
 		   if(json.counts=="1"){
			   show_form_table("show");
			   $("#datatable tbody tr").remove();
 			   
			   $.each(json.datalist,function(index,con){
				    var checked="";
					
					if(con.do_func=="y"){
						checked="checked";
					}
										
					tr_str="<tr align=\"left\" id=\"list_"+con.form_id+"\" nowrap><td><input type=\"text\" name=\"form_value\" id=\"form_value_"+con.form_id+"\" maxlength=\"360\" size=\"32\" class=\"form_val_\" fid=\""+con.form_id+"\" value=\""+con.form_value+"\"/></td><td><span style=\"float:left\" id=\"turn_"+con.form_id+"\"></span><span class=\"turn_img\" title=\"更新跳转步骤\" onclick=\"get_step_turn_list('step_turn_"+con.form_id+"','0')\"></span></td><td><input name=\"do_func\" type=\"checkbox\" id=\"do_func_"+con.form_id+"\" value=\"y\" title=\"是否包含附属表单供填写描述\" "+checked+"/><td class='o_icos'><span class='add' onclick=\"set_form('add','"+con.form_id+"','0');\"></span><span class='up_e' onclick=\"set_form('up','0','"+con.form_id+"')\"></span><span class='dw_e' onclick=\"set_form('dw','0','"+con.form_id+"')\"></span><span onclick=\"set_form('del','0','"+con.form_id+"');\"></span></td></tr>";
					
					$("#datatable tbody").append(tr_str);
					$("#turn_"+con.form_id).html($("#step_turn_def").clone());
 					$("#turn_"+con.form_id+" [name=step_turn]").attr("id","step_turn_"+con.form_id).css("display","block").val(con.step_turn);
					$("#form_value_"+con.form_id).click(function(){$(this).css("border-color","#FF8800")}).blur(function(){$(this).css("border-color","")});
 					$("#form_index").val(con.form_id);
					
					$("#form_value_"+con.form_id).addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
					
			   });
 			   order_datatable_();
		   }else{
			   show_form_table("hide");
		   }
		  
 		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
}
  

function do_edit_que(){
	
	if($("#que_title").val() == "")
	{
		alert("请填写问题标题！");
		$("#que_title").focus();
		return false;
	}
	
	if($("#is_break").is(':checked')==true&&$("#break_des").val()==""){
		alert("请填写分隔标识描述！");
		$("#break_des").focus();
		return false;
	}
  	
	var form_value="";
 	$('#form1 input[name="form_value"]').each(function(i){
		
		if($(this).val()!=""&&$(this).val()!=undefined){
			
		 s_id="step_turn_"+$(this).attr("fid");
		 d_id="do_func_"+$(this).attr("fid");
		 if($("#"+d_id).is(":checked")==true){
			d_v=$("#"+d_id).val();
		 }else{
			 d_v="";
		 }
		 
		 form_value+=""+$(this).val()+"#_#"+$("#"+s_id).val()+"#_#"+d_v+"|";
		 
		}
 	}); 
	
	if(form_value!=""&&form_value.substr(form_value.length-1)=="|"){
		form_value=form_value.substr(0,form_value.length-1);
	}
  	
 	if(form_value==""){
		if (confirm("当前问题还没有添加子选项，确定不需要添加吗？！")){}else{return false;}
	}
	$("#form_list").val(form_value);
         	  
	$('#load').show();
	var datas="action=set_que&do_actions=edit&"+$('#form1').serialize()+times;
	//alert(datas);
	//return false;
	
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
 		   
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			_DialogInstance.ParentWindow.get_ask_que_list("edit","que",json.que_id);
   			setTimeout('Dialog.close();',1);
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
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <input name="form_index" type="hidden" id="form_index" value="1" />
  <select name="step_turn" id="step_turn_def" style="display:none" class="s_option">
    <?php 
		$sql="select left(case when que_type='des' then concat(que_title,que_des) else que_title end,18) as que_tit,que_title,que_id from data_ask_question where ask_id='".$ask_id."' order by que_id asc";
		
 		$rows=mysqli_query($db_conn,$sql);
		$row_counts_list=mysqli_num_rows($rows);			
 		if ($row_counts_list!=0) {
			while($rs= mysqli_fetch_array($rows)){ 
				if($que_id!=$rs['que_id']){
					echo '<option value="'.$rs["que_id"].'" title="'.$rs["que_title"].'">'.$rs["que_tit"].'</option>';
				}
			}
			 
			$counts="1";
			$des="获取成功！";
		} 
		mysqli_free_result($rows);
	?>
    <option value="yes_des">营销成功结束语</option>
    <option value="no_des">营销失败结束语</option>
  </select>
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 id="field_table" class="td_underline"   >
        <tr>
          <td width="16%"  align="right" nowrap="nowrap">问题标题：</td>
          <td height="28" align="left"><textarea name="que_title"  class="input_h_86" id="que_title" style="float:left"  onclick="show_field_div('show','que_title');"></textarea>
            <span class="red"> </span>
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
            <input name="que_id" type="hidden" id="que_id" value="<?php echo $que_id;?>" />
            <input name="form_list" type="hidden" id="form_list" value=""/></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">排列方式：</td>
          <td height="28" align="left"><select name="postion" class="s_option" id="postion" style="float:left" title="选择子选项排列方式">
              <option value="port">纵向排列</option>
              <option value="land">横向排列</option>
            </select>
            <span class="gray">&nbsp;设置子选项排列方式</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap"> 选项类型：</td>
          <td align="left" valign="middle"><select name="que_type" class="s_option" id="que_type" style="float:left">
              <option value="radio">单选题</option>
              <option value="checkbox">多选题</option>
            </select>
            <span class="gray">&nbsp;设置子选项类型</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">分隔标识：</td>
          <td align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr style="display:none">
                <td></td>
              </tr>
              <tr>
                <td style="border:0"><input name="is_break" type="checkbox" id="is_break" value="y" onclick="set_break(this.checked);" /></td>
                <td style="border:0"><span id="bre_des" class="gray" >
                  <label for="is_break">&nbsp;是否在本题顶部或底部显示分隔行，以标识问卷不同部分</label>
                  </span> <span id="bre_div" style="display:none;"> &nbsp;描述：
                  <input name="break_des" type="text" id="break_des" size="30" class="s_input" maxlength="290" title="分隔标识描述" />
                  &nbsp;
                  <label for="break_pos">位置：
                    <select name="break_pos" id="break_pos" title="分隔标识显示位置" class="s_option">
                      <option value="top">本题顶部</option>
                      <option value="bottom">本题底部</option>
                    </select>
                  </label>
                  </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="" align="right" nowrap="nowrap">是否结束：</td>
          <td align="left"><input name="is_end" type="checkbox" id="is_end" value="y"/>
            <span class="gray"><label for="is_end">是否在本题结束本问卷</label></span></td>
        </tr>
        <tr valign="">
          <td width="16%" height="36" align="right" valign="middle" nowrap="nowrap">子选项：</td>
          <td align="left" id="form_table"><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" title="添加子选项" onclick="show_form_table('show','y');" style="margin-top:4px"><img src="/images/butCollapse.gif" align="absmiddle" style="margin-top:5px"/><b>添加子选项&nbsp;</b></a></td>
        </tr>
        <tr>
          <td width="16%" align="right" nowrap="nowrap">题目描述：</td>
          <td align="left" valign="middle" style="padding-top:4px; padding-bottom:4px"><span style="position:relative;">
            <textarea name="que_des"  class="input_86" id="que_des" style="float:left;height:60px" onclick="show_field_div('show','que_des');"><?php echo $que_des ?></textarea>
            </span></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 
break;

//新建单选、复选题目
case "update_que_dx_fx":
?>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<?php 

break;

//插入客户资料
case "add_cus_info":
?>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <input id="field_value" name="field_value" value="" type="hidden">
      <table width="98%" height="250" border="0" align="center" cellpadding="0"
                    cellspacing="0">
        <tr>
          <td align="center" valign="middle" class="field_list"><?php
                            $i=0;
                            foreach($ask_list_ary as $field_value =>$field_name ){
								 if($field_name=="换行符"){
								 }else{
									$i+=1;
                        ?>
            <div class="field_list_1" onclick="insert_field('field_<?php echo $i ?>','<?php echo $field_name ?>');" id="field_<?php echo $i ?>" title="点击插入：<?php echo $field_name ?>" ><?php echo $field_name ?></div>
            <?php
								}
							}
                         ?></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 

break;

//选择可显示字段
case "choose_info_field":
?>
<script>
function do_set_choose_fields(){
 	var info_list="",info_name="";
	//var callstatus_name="";
	$('#form1 input[name="field"]:checked').each(function(i){
		 //if(this.checked){
 			 //var list_s_r=$(this).val().split("|")[0];
 			 //callstatus_name+=list_s_r+",";
 			 var list_s=$(this).val();
 			 info_list+=list_s+"#_#";
			 
 			 var name_s=$(this).val().split(",")[0];
 			 info_name+=name_s+",";
  		 //}
   	}); 
 	if (info_list!=""){info_list=info_list.substr(0,info_list.length-3)}
	if (info_name!=""){info_name=info_name.substr(0,info_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#info_list").val(info_list);
	$(_DialogInstance.ParentWindow.document).find("#info_name").val(info_name);
	
  	setTimeout("Dialog.close();",0);
	$(_DialogInstance.ParentWindow.document).find("#ask_title").focus();
	//_DialogInstance.ParentWindow.check_form('excel_field');
}
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; <?php echo $tits ?> </div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <input name="call_black" type="hidden" id="call_black" value="" />
  <fieldset>
    <legend>
    <label for="field"><strong>
      <input type="checkbox" id="field" name="field_all" parentid="field_all" value="" onclick="CheckItemsAll('form1','field')" />
      <?php echo $tits ?></strong> </label>
    </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
        <tr>
          <td align="left" valign="top" class="check_items"><ul>
              <?php       	
 						$i=0;
 						foreach($ask_list_ary as $field_value =>$field_name ){
							 if($field_name=="换行符"){
							 }else{
								$i+=1;
                       ?>
              <li>
                <label for="field_<?php echo $i ?>" onclick="CheckItems('form1','field','field_all');">
                  <input type="checkbox" parentid="field_all" id="field_<?php echo $i ?>" name="field" value="<?php echo $field_name ?>,<?php echo $field_value ?>">
                  <?php echo $field_name ?></label>
              </li>
              <?php 
							 }
                         }
                        
                   		?>
            </ul></td>
        </tr>
      </table>
    </form>
  </fieldset>
</div>
<?php 
break;
 
//修改
case "edit_title":
?>
<script>

function do_edit_que(){
	
	if($("#ask_title").val() == "")
	{
		alert("请填写问卷标题！");
		$("#ask_title").focus();
		return false;
	}
       	  
	$('#load').show();
	var datas="action=edit_ask&do_actions=ask_title&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			$(_DialogInstance.ParentWindow.document).find("#ask_title_det").html($("#ask_title").val());
   			setTimeout('Dialog.close();',1);
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
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<?php

$sql="select ask_title from data_ask where ask_id='".$ask_id."'";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$ask_title=HtmlReplace($rs["ask_title"],3);
 	}
  	
	echo '<script>$(document).ready(function(){$("#ask_title").val("'.$ask_title.'");});</script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 >
        <tr>
          <td align="right" nowrap="nowrap">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td width="16%" align="right" nowrap="nowrap">问卷标题：</td>
          <td align="left"><input name="ask_title" type="text" class="input_86" id="ask_title" maxlength="600" style="width:90%" />
            <span class="red">※</span>
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
            <input name="que_id" type="hidden" id="que_id" value="<?php echo $que_id;?>" />
            <input name="que_type" type="hidden" id="que_type" value="<?php echo $que_type;?>" /></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </form>
  </fieldset>
</div>
<?php 
break;
 
//修改
case "edit_ask_des":
?>
<script>

function do_edit_que(){
	
	if($("#ask_des").val() == "")
	{
		if (confirm("您还没有填写问卷描述，确定不需要描述吗？！")){}else{return false;}

	}
       	  
	$('#load').show();
	var datas="action=edit_ask&do_actions=ask_des&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
			
			if($.trim($("#ask_des").val())!=""){
				display="block";
			}else{
				display="none";
			}
			$(_DialogInstance.ParentWindow.document).find("#ask_des").css("display",display);
			$(_DialogInstance.ParentWindow.document).find("#is_ask_des").val(display);
			$(_DialogInstance.ParentWindow.document).find("#ask_des_det").html($("#ask_des").val().replaceAll("\n","<br/>"));
 			
  			setTimeout('Dialog.close();',1);
		  }else {
			 alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
$(document).ready(function(){
 	$("#ask_des").focus();
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<?php

$sql="select ask_des from data_ask where ask_id='".$ask_id."'";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$ask_des=HtmlReplace($rs["ask_des"],3);
 	}
  	
	//echo '<script>$(document).ready(function(){$("#ask_des").val("'.$ask_des.'");});<//script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);

  
?>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 >
        <tr>
          <td align="right" nowrap="nowrap">&nbsp;</td>
          <td align="left">
        </tr>
        <tr>
          <td width="16%" align="right" nowrap="nowrap">问卷描述：</td>
          <td align="left"><div style="position:relative">
              <textarea name="ask_des" rows="3" class="input_86" id="ask_des" style="float:left;height:120px"><?php echo $ask_des ?></textarea>
            </div>
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </form>
  </fieldset>
</div>
<?php 
break;
 
//修改
case "edit_yes_des":
?>
<script>

function do_edit_que(){
	
	if($("#yes_des").val() == "")
	{
		alert("请填写营销成功结束语！");
		$("#yes_des").focus();
 		return false;
	}
       	  
	$('#load').show();
	var datas="action=edit_ask&do_actions=yes_des&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
  			$(_DialogInstance.ParentWindow.document).find("#yes_des_det").html($("#yes_des").val().replaceAll("\n","<br>"));
   			setTimeout('Dialog.close();',1);
		  }else{
			  alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
$(document).ready(function(){
 	$("#yes_des").focus();
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<?php

$sql="select yes_des from data_ask where ask_id='".$ask_id."'";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$yes_des=HtmlReplace($rs["yes_des"],3);
 	}
  	
	//echo '<script>$(document).ready(function(){$("#yes_des").val("'.$yes_des.'");});<//script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 >
        <tr>
          <td align="right" nowrap="nowrap">&nbsp;</td>
          <td align="left">
        </tr>
        <tr>
          <td width="16%" align="right" nowrap="nowrap">成功结束语：</td>
          <td align="left"><div style="position:relative">
              <textarea name="yes_des" rows="3" class="input_86" id="yes_des" style="float:left;height:120px"><?php echo $yes_des ?></textarea>
              <div style="float:left;top:2px; margin-left:6px"><span class="red"></span></div>
            </div>
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </form>
  </fieldset>
</div>
<?php 
break;
 
//修改
case "edit_no_des":
?>
<script>

function do_edit_que(){
	
	if($("#no_des").val() == "")
	{
		alert("请填写营销成功结束语！");
		$("#no_des").focus();
 		return false;
	}
       	  
	$('#load').show();
	var datas="action=edit_ask&do_actions=no_des&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
 		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
		 
 		 if(json.counts=="1"){
  			
			$(_DialogInstance.ParentWindow.document).find("#no_des_det").html($("#no_des").val().replaceAll("\n","<br>"));
   			setTimeout('Dialog.close();',1);
		  }else{
			alert(json.des);  
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
$(document).ready(function(){
 	$("#no_des").focus();
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<?php

$sql="select no_des from data_ask where ask_id='".$ask_id."'";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$no_des=HtmlReplace($rs["no_des"],3);
 	}
  	
	//echo '<script>$(document).ready(function(){$("#no_des").val("'.$no_des.'");});<//script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 >
        <tr>
          <td align="right" nowrap="nowrap">&nbsp;</td>
          <td align="left">
        </tr>
        <tr>
          <td width="16%" align="right" nowrap="nowrap">失败结束语：</td>
          <td align="left"><div style="position:relative">
              <textarea name="no_des"  class="input_86" id="no_des" style="float:left;height:120px"><?php echo $no_des ?></textarea>
              <div style="float:left;top:2px; margin-left:6px"><span class="red"></span></div>
            </div>
            <input name="ask_id" type="hidden" id="ask_id" value="<?php echo $ask_id;?>" />
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </form>
  </fieldset>
</div>
<?php 
break;
 
//修改
case "edit_info_list":
?>
<?php

$sql="select ask_title,show_info,info_list,info_name from data_ask where ask_id='".$ask_id."'";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
 		$ask_title=HtmlReplace($rs["ask_title"],3);
 		$show_info=$rs["show_info"];
 		$info_list=$rs["info_list"];
 		$info_name=$rs["info_name"];
 	}
  	
	//echo '<script>$(document).ready(function(){$("#no_des").val("'.$no_des.'");});<//script>';
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>
<script>

function do_edit_que(){
	
	if($("#show_info").val()=="y"&&$('#form1 input[name="field"]:checked').val()==undefined)
	{
		alert("请选择需显示的客户资料字段！");
		$("#show_info").focus();
 		return false;
	}
    
	var info_list="",info_name="";
 	$('#form1 input[name="field"]:checked').each(function(i){
		 //if(this.checked){
   			 var list_s=$(this).val();
 			 info_list+=list_s+"#_#";
			 
 			 var name_s=$(this).val().split(",")[0];
 			 info_name+=name_s+",";
  		 //}
   	}); 
 	if (info_list!=""){info_list=info_list.substr(0,info_list.length-3)}
	if (info_name!=""){info_name=info_name.substr(0,info_name.length-1)}
 	$("#info_list").val(info_list);
	$("#info_name").val(info_name);
 	  
	$('#load').show();
	var datas="action=edit_ask&do_actions=info_list&"+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		 
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
			
 			$(_DialogInstance.ParentWindow.document).find("#info_list_ary").val(info_list);
			$(_DialogInstance.ParentWindow.document).find("#show_info").val($("#show_info").val());
			_DialogInstance.ParentWindow.create_info_table();
			
    		 setTimeout('Dialog.close();',1);
		  }else{
			  alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
$(document).ready(function(){
	
 	$("#show_info").val("<?php echo $show_info?>").focus();
 	$("#ask_title").html("<?php echo $ask_title?>");
	$("#info_list").val("<?php echo $info_list?>");
	$("#info_name").val("<?php echo $info_name?>");
 	
	var info_list=$("#info_list").val();

 	if(info_list!=""){
		list_ary=info_list.split("#_#");
		
		for(i=0;i<list_ary.length;i++){
			field_ary=list_ary[i].split(",");
			
			$("#field_"+field_ary[1]).attr("checked","true").parent().addClass("blue");
		}
	}
	
	$(".check_items input[type=checkbox]").click(function(){if(this.checked==true){$(this).parent().addClass("blue")}else{$(this).parent().removeClass("blue")}});
   	
});
</script>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
        <tr>
          <td width="16%"  align="right" nowrap="nowrap">问卷标题：</td>
          <td align="left" class="blue" id="ask_title"></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap">客户资料：</td>
          <td align="left"><select name="show_info" id="show_info" style="float:left" onchange="chang_detail(this.value);" class="s_option">
              <option value="y" title="显示客户详细资料" selected="selected" >显示客户详细资料</option>
              <option value="n" title="隐藏客户详细资料">隐藏客户详细资料</option>
            </select>
            <span id="detail_" style="display:">
            <input type="hidden" name="info_list" id="info_list"/>
            <input name="info_name" type="hidden" id="info_name" />
            <input type="hidden" name="ask_id" id="ask_id" value="<?php echo $ask_id ?>"/>
            </span> <span class="gray" style="float:left">&nbsp;设置是否显示客户资料字段</span></td>
        </tr>
        <tr>
          <td  align="right" nowrap="nowrap"><label for="field">客户资料
              <input type="checkbox" id="field" name="field_all" parentid="field_all" value="" onclick="CheckItemsAll('form1','field')" />
            </label></td>
          <td align="left" valign="top" class="check_items"><ul>
              <?php       	
                            $i=0;
                            foreach($ask_list_ary as $field_value =>$field_name ){
								if($field_name=="换行符"){
								}else{
									$i+=1;
                            
                              echo "<li><label for=\"field_".$field_value."\" onclick=\"CheckItems('form1','field','field_all');\"><input type=\"checkbox\" parentid=\"field_all\" id=\"field_".$field_value."\" name=\"field\" value=\"".$field_name.",".$field_value."\">".$field_name."</label></li>\n";
                            
								}
                             }
                            
                            ?>
            </ul></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </form>
  </fieldset>
</div>
<?php
break;

//修改
case "get_ask_que_list":
?>
<script>

function do_set_que_list(){
 	var agent_list="";
	var agent_name="";
 	 $('#form1 input[name="que_id"]:checked').each(function(i){
		 //if(this.checked){
			 var list_s=$(this).val().split("|")[0];
 			 agent_list+=list_s+",";
			 
			 var list_s_r=$(this).val().split("|")[1];
 			 agent_name+=list_s_r+",";
		// }  
   	}); 
 	if (agent_list!=""){agent_list=agent_list.substr(0,agent_list.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#que_id").val(agent_list);
	
	if (agent_name!=""){agent_name=agent_name.substr(0,agent_name.length-1)}
 	$(_DialogInstance.ParentWindow.document).find("#que_name_list").val(agent_name);
	
  	setTimeout('Dialog.close();',10); 
}

function get_ask_que_list(action,do_actions){
	
  if($("#ask_id").val()!=""){	
  	var datas="action=get_ask_que_list&que_title="+$("#que_title").val()+"&ask_id="+$("#ask_id").val()+"&do_actions="+do_actions+times;
  	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		  $("#datatable tbody tr").remove();
  		  if(parseInt(json.counts)>0){
    		var tits="";td_str="",chk="";
			
				$.each(json.datalist, function(index,con){
					index=index+1;
					if(con.que_type=="des"){
						tits="<span class='gray'>"+con.que_title+"</span> "+con.que_des+"";
						chk="";
						td_str="选择";
					}else{
						tits=con.que_title;
						chk="<input name=\"que_id\" type=\"checkbox\" value=\""+con.que_id+"|Q_"+con.que_order+"\" id=\"que_id_"+con.que_id+"\"/>";
						td_str="<label for='que_id_"+con.que_id+"'><span style='color:#08d;'>选择</span></label>";
					}
					
					tr_str="<tr align=\"left\">";
					tr_str+="<td>"+chk+"</td>";
					tr_str+="<td>"+index+"</td>";
					tr_str+="<td ><label for='que_id_"+con.que_id+"'><div class='que_tit'>"+tits+"</div></label></td>";
					tr_str+="<td >"+con.status_name+"</td>";
					tr_str+="<td >"+td_str+"</td>";
					tr_str+="</tr>";
					$("#datatable tbody").append(tr_str);
				});
				
  				$("[name=que_id]:checkbox:enabled").unbind().bind("click",function(){
					var parent=$(this).parent().parent();
					if($(this).is(":checked")==true){
						$(parent).addClass("click")
					}else{
						$(parent).removeClass("click")
					}
				});
				
			}else{
 				tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable").append(tr_str);
			}  
			d_table_i();
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	
  }else{
  	Dialog.alert("问卷编号不存在，请检查后重试！");
  }

} 
function search_bak(){
	$("#que_title").val("");
	get_ask_que_list("que_list","ask");
}

$(document).ready(function(){
	$("#CheckedAll").click(function(){
		var checkbox=$('[name=que_id]:checkbox:enabled');
 		if(this.checked==true){
			$(checkbox).attr("checked",this.checked).parent().parent().addClass("click");
 		}else{
			$(checkbox).attr("checked",this.checked).parent().parent().removeClass("click");
		}
	});
	
   	get_ask_que_list("que_list","ask");
});
</script>
<style>
.que_tit{width:440px;height:20px;overflow:hidden;white-space:nowrap;-o-text-overflow:ellipsis;text-overflow:ellipsis;}
.que_tit:after{content:"...";}
</style>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; <?php echo $tits ?></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main" >
  <input type="hidden" name="ask_id" id="ask_id" value="<?php echo $ask_id ?>" />
  <fieldset style="">
    <legend> <?php echo $tits ?> </legend>
    <div style="position:absolute;right:10px;top:36px">
      <input name="que_title" type="text" class="input_text" id="que_title" title="请输入问题步骤标题或描述查询" size="16" maxlength="16" />
      &nbsp;
      <input name="search" type="button" value="查询" onclick="get_ask_que_list('que_list','ask');" />
      &nbsp;<a href="javascript:void(0)" onclick="search_bak()" style="font-weight:normal">返回</a></div>
    <form action="" method="post" name="form1" id="form1">
      <table cellspacing="0" border="0" align="center" style="margin-top:2px;width:99%" id="datatable" class="dataTable">
        <thead>
          <tr align="left" class="dataHead">
            <td><input name="CheckedAll" type="checkbox" id="CheckedAll" /></td>
            <td>序号</td>
            <td >问题步骤</td>
            <td >问题类型</td>
            <td>操作</td>
          </tr>
        </thead>
        <tbody>
        </tbody>
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