<?php
require("../../inc/pub_func.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<style>
.n-extra{MARGIN-TOP: 10px;BACKGROUND: #f7f7f7;padding: 16px 56px;border: 1px solid #eaead8;}
.font_14{font-size:14px}
.font_14_tit{font-size:14px;font-weight:bold}
.edit_div{position:absolute;/*border: 1px solid #999;background: #FFFFEF;width:116px;*/padding: 4px 4px 4px 0px;top:2px;z-index: 120;height: 24px;right: 2px;display:none;}
.edit_div div{float: left;margin-left: 4px;display: inline;}
.edit_div img{cursor:pointer}
.ask_title{font-size:18px;font-weight:bold;position:relative;text-align:center;height: 50px;line-height: 50px;}
.ask_info{border: 1px solid #D2D2D2;background: #F6F9FE;padding: 10px;margin-bottom: 10px;position: relative;border-radius:3px;border-radius:3px;}
.ask_info tr td{ height:16px; line-height:16px;}
.ask_des{border: 1px dashed #D2D2D2;background: #FFFFEF;text-align: left;padding: 10px;margin-bottom: 10px;position: relative;zoom:1;border-radius:3px;}
.ask_que{border: 2px solid #DBE6EF;padding: 10px 30px 6px;margin-top: 10px;line-height: 160%;position: relative;border-radius:3px;}
.ask_que li, .ask_que_hover li{line-height: 24px;word-wrap:break-word;text-align: left;margin-right:4px;}
.que_list_left{text-align:left;}
.que_list_center{text-align:center}
.que_list_center ul{width:56%;margin-left:auto;margin-right:auto;}
.que_list_center .step_do{margin-right: auto;margin-left: auto;}
.ask_que_hover,.ask_que_focus,.ask_que_alert{border: 2px solid #999;background: #FFFFE1;box-shadow: 0 1px 3px rgba(0,0,0,0.4);}
.ask_que_hover .ask_que_tit, .ask_que_focus .ask_que_tit{color:#329900;}
.ask_que_alert .ask_que_tit{color:#ff0000;}
.ask_que_hover .ask_que_list, .ask_que_focus .ask_que_list, .ask_que_alert .ask_que_list{color:#000;}
.ask_cutline{border: 1px solid #D2D2D2;background: #E4EDFC;margin-top: 10px;padding:2px 6px 2px 6px;*padding:4px 6px 2px 6px;font-size: 12px;font-weight: bold;position: relative;zoom:1;color:#666;/*#329900*/text-align: left;}
.ask_que_des{border-bottom: 1px dashed #999;margin-bottom: 6px;padding-bottom: 6px;color: #ff6600;}
.ask_que_tit{margin-bottom: 4px;color: #0C6AC0;padding-top: 6px;padding-bottom: 4px;}
.land{width:70%;}
.land li{float:left;display:block;line-height:24px}
.port{width:40%;}
.port li{float:left;width:96%;display:block;line-height:24px;}
.port li input,.land li input{margin-top:-4px;+margin-top:-2px}
.ask_list{position:relative;margin-right:auto;width:86%;margin-left:auto;word-break:break-all;word-wrap:break-word;}
.ask_que_list{color: #333;overflow: auto;}
.step_sub{padding-top: 6px;margin-top: 6px;border-top: 1px dotted #999;height:26px;}
.step_do{display:none;font-size: 12px;width: 306px;z-index: 120;}
.deepgreen{color:#329900}
</style>
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script> 
<script>
var times='&times='+new Date().getTime()+'&round='+Math.random();
function call_submit_(action,is_answer){
  	var diag =new Dialog("call_submit_");
 	diag.Width = 680;
	diag.Height = 300;
	diag.Title = "填写呼叫备注描述";
 	diag.URL = "/document/ask_flow/list.php?cid=0&tits="+encodeURIComponent("填写呼叫描述")+"&calldes="+encodeURIComponent($("#calldes").val())+"&action="+action;
  	diag.OKEvent = setsubmit;
	diag.show();
}
 
function setsubmit(){
	Zd_DW.do_setsubmit();
}
 
function do_submit(){
	//$("#vicidial_id").val(parent.document.getElementById("uniqueid").value);
	$('#load').show();
	var datas="action=ask_save"+times+"&"+$("#form1").serialize();
	//alert(datas);
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
 		   request_tip(json.des,json.counts);
		   if(json.counts=="1"){
 			   request_tip(json.des,json.counts);
			   setTimeout("window.opener=null;window.open('','_self');window.close()",6000);
  		   }else{
			   alert(json.des);
 		   }
   			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
 	
}
    
function step_go(cur_id,go_id,turn_){
	/*if($("#vicidial_id").val()==""){
		$("#vicidial_id").val(parent.document.getElementById("uniqueid").value)	
	}*/
	var is_go=false;
	$("#ask_que_end_des").remove();
	
	if(cur_id!="0"){
	
		if(turn_=="pre"){
			is_go=true;
			goto_anchor("step_to_"+go_id);
		}else{
		
			if($("#go_next_"+cur_id).val()==""){
				request_tip("请选择或填写当前问题选项后进入下一题！",0);
				//$("#ask_que_"+cur_id+" h4").addClass("red");
				$("#ask_que_"+go_id+" .ask_que").addClass("ask_que_alert");
				$("#ask_que_"+go_id+" .step_do").stop(true,true).fadeIn();
				setTimeout('$("#ask_que_'+cur_id+' .ask_que").removeClass("ask_que_alert");',6000);
				return false;			
			} 
			
			go_id=$("#go_next_"+cur_id).val();
			step_do='	<div class="step_sub"><div class="step_do"><a href="javascript:void(0);" class="zPushBtn" hidefocus="true" onselectstart="return false" onClick="step_go(\''+go_id+'\',\''+cur_id+'\',\'pre\');" title="返回上一题" ><img src="/images/icons/icon400a4.gif" /><b>上一题&nbsp;</b></a><a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="goto_anchor(\'main_top\');" title="转到页面顶部" ><img src="/images/icons/icon400a9.gif" /><b>顶部&nbsp;</b></a><a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="do_submit(\'call_submit\',\'yes\');"  title="结束本次调查，提交保存结果" ><img src="/images/icons/icon004a16.gif" /><b>结束提交&nbsp;</b></a></div></div>';
			
			if(go_id=="yes_des"||go_id=="no_des"){
			
				des='<div class="ask_que" id="ask_que_end_des" >';
				des+='	<div class="ask_que_tit">';
				des+='		<h4 class="deepgreen"><span class="gray">结束语：</span><span id="_des_det">'+$("#"+go_id).val()+'</span></h4>';
				des+='	</div>';
				des+=step_do;
				des+='</div>';
			
				if($("#ask_type").val()=="que"){
					$("#step_"+cur_id).html(des);
				}else{
					$("#que_list").append(des);
				}
				$("#ask_que_end_des").addClass("ask_que_focus");
				setTimeout('$("#ask_que_end_des").removeClass("ask_que_focus")',8000);
				$("#ask_que_end_des .step_do").stop(true,true).fadeIn();
				
				goto_anchor("ask_que_end_des");
				ask_hover("ask_que_end_des");
			
			}else{
			
				if($("div[id^='ask_que_']").index($("#ask_que_"+go_id))!=0){
				
					$("#pre_btu_"+go_id+"").html('<a href="javascript:void(0);" class="zPushBtn" hidefocus="true" onselectstart="return false" onClick="step_go(\''+go_id+'\',\''+cur_id+'\',\'pre\');" title="返回上一题" ><img src="/images/icons/icon400a4.gif" /><b>上一题&nbsp;</b></a>');
				
				}
			
				if($("#ask_type").val()=="que"){
					get_ask_que_list('step','que_step',cur_id,go_id);
					is_go=true;
				}else{
					if($("#step_to_"+go_id).length<1){
						is_go=false;
 
						des='<div class="ask_que" id="ask_que_end_des" >';
						des+='	<div class="ask_que_tit">';
						des+='		<h4 class="red"><span class="gray">错误：</span><span id="_des_det">未找到目标步骤，请检查问卷设置或跳转步骤是否正确！</span></h4>';
						des+='	</div>';
						des+=step_do;
						des+='</div>';
					
						$("#que_list").append(des);
						$("#ask_que_end_des").addClass("ask_que_focus");
						setTimeout('$("#ask_que_end_des").removeClass("ask_que_focus")',8000);
						$("#ask_que_end_des .step_do").stop(true,true).fadeIn();
 						goto_anchor("ask_que_end_des");
 						
					}else{
						is_go=true;
					}
				}
 				
			}
		}
		
		if(is_go==true){
			goto_anchor("step_to_"+go_id);
			$("#ask_que_"+cur_id+" .ask_que").removeClass("ask_que_focus ask_que_hover");
 			$("#ask_que_"+go_id+" .ask_que").addClass("ask_que_focus");
			$("#ask_que_"+go_id+" .step_do").stop(true,true).fadeIn();
 			setTimeout('$("#ask_que_'+go_id+' .ask_que").removeClass("ask_que_focus")',6000);
 		}
	
	}

}
  
//获取问题列表
//action:问题显示动作
//do_actions：获取问题列表或单项问题
//go_id：获取单项问题目标ID
//cur_id:当前问题ID
function get_ask_que_list(action,do_actions,cur_id,go_id){
    
  if($("#ask_id").val()!=""){
   	 
	var datas="action=get_ask_que_list&ask_id="+$("#ask_id").val()+"&is_re=y&do_actions="+do_actions+"&phone_number=<?php echo $phone_number?>&que_id="+go_id+times;
	//alert(datas);
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		  if(json.counts=="1"){
			
			$.each(json.datalist, function(index,con){
				
				var que="",form_input="",form_list="",breaks="",break_top="",break_bot="",que_sub="",que_edit="",input_size="",pre_btu="",is_end="";
				
				if(con.form_size=="0"){input_size="width:70%";}
				
				if(go_id=="0"){
					pre_btu='<a href="javascript:void(0);" class="zPushBtn zPushBtnDisabled" hidefocus="true" onselectstart="return false" title="返回上一题" ><img src="/images/icons/icon400a4.gif" /><b>上一题&nbsp;</b></a>';	
				}else{
					pre_btu='<a href="javascript:void(0);" class="zPushBtn" hidefocus="true" onselectstart="return false" onClick="step_go(\''+con.que_id+'\',\''+cur_id+'\',\'pre\');" title="返回上一题" ><img src="/images/icons/icon400a4.gif" /><b>上一题&nbsp;</b></a>';	
				}
				
				if(con.is_end=="y"){
					is_end='<a href="javascript:void(0);" class="zPushBtn zPushBtnDisabled" hidefocus="true"  onselectstart="return false" title="转到下一题：问卷结束" ><img src="/images/icons/icon400a2.gif" /><b>下一题&nbsp;</b></a>';
				}else{
					is_end='<a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="step_go(\''+con.que_id+'\',\''+con.que_id+'\',\'next\');" title="转到下一题" ><img src="/images/icons/icon400a2.gif" /><b>下一题&nbsp;</b></a>';	
				}

 				que_sub='<div class="step_do">'+is_end+'<span id="pre_btu_'+con.que_id+'">'+pre_btu+'</span><a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="goto_anchor(\'main_top\');" title="转到页面顶部" ><img src="/images/icons/icon400a9.gif" /><b>顶部&nbsp;</b></a><a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="do_submit(\'call_submit\',\'yes\');"  title="结束本次调查，提交保存结果" ><img src="/images/icons/icon004a16.gif" /><b>结束提交&nbsp;</b></a></div>';
				
				go_next="<a name='step_to_"+con.que_id+"' id='step_to_"+con.que_id+"'></a>";
				
				if(con.is_break=="y"){
					
					if(con.break_pos=="top"){
						break_top='<div class="ask_cutline" id="ask_break_'+con.que_id+'">'+con.break_des+'</div>';
					}else{
						break_bot='<div class="ask_cutline" id="ask_break_'+con.que_id+'">'+con.break_des+'</div>';
					}			
				}
				
				switch(con.que_type){
					case "radio":
					 que=go_next+break_top;	
					 que+='<div class="ask_que" >';
					 que+=que_edit;
					 que+='<div class="ask_que_tit">';
					 que+='   <h4>'+con.que_title+'</h4>';
					 que+=' </div>';
					 que+=' <div class="ask_que_des">'+con.que_des+'</div>';
					 que+=' <div class="ask_que_list">';
					 que+=' <input type="hidden" name="go_next" id="go_next_'+con.que_id+'" />';
					 que+='<ul class="'+con.postion+'">';
					 $.each(con.form_list, function(f_i,con_f){
						 if(con_f.do_func=="y"){
							 form_input="&nbsp;<input type='text' size='20' class='inputText' name='ask_"+con.que_id+"[]' id='ask_"+con_f.form_id+"_"+f_i+"_text' disabled />";
						 }else{
							 form_input="";
						 }
						 form_list+='<li><label for="ask_'+con_f.form_id+"_"+f_i+'"><input name="ask_'+con.que_id+'[]" id="ask_'+con_f.form_id+"_"+f_i+'" type="radio" value="'+con_f.form_value+'" onclick="text_read(this.id,this.checked,\''+con.que_id+'\',\''+con_f.step_turn+'\')"/>'+con_f.form_value+'</label>'+form_input+'</li>';
					 
					 });
					 que+=form_list;
					 que+='  </ul>';
					 que+='  <div class="clear"></div><div class="step_sub">'+que_sub+'</div>';
					 que+=' </div>';
					 que+='</div>';	
					 que+=break_bot;
					 
					break;
					
					case "checkbox":
					 que=go_next+break_top;
					 que+='<div class="ask_que" >';
					 que+=que_edit;
					 que+='<div class="ask_que_tit">';
					 que+='   <h4 >'+con.que_title+'</h4>';
					 que+=' </div>';
					 que+=' <div class="ask_que_des">'+con.que_des+'</div>';
					 que+=' <div class="ask_que_list">';
					 que+=' <input type="hidden" name="go_next" id="go_next_'+con.que_id+'" />';
					 que+='<ul class="'+con.postion+'">';
					 $.each(con.form_list, function(f_i,con_f){
						 if(con_f.do_func=="y"){
							 form_input="&nbsp;<input type='text' size='20' class='inputText' name='ask_"+con.que_id+"[]' id='ask_"+con_f.form_id+"_"+f_i+"_text' disabled />";
						 }else{
							 form_input="";
						 }
						 form_list+='<li><label for="ask_'+con_f.form_id+"_"+f_i+'"><input name="ask_'+con.que_id+'[]" id="ask_'+con_f.form_id+"_"+f_i+'" type="checkbox" value="'+con_f.form_value+'" step_turn="'+con_f.step_turn+'"  onclick="text_read(this.id,this.checked,\''+con.que_id+'\',\''+con_f.step_turn+'\')"/>'+con_f.form_value+'</label>'+form_input+'</li>';
					 
					 });
					 que+=form_list;
					 que+='  </ul>';
					 que+='  <div class="clear"></div><div class="step_sub">'+que_sub+'</div>';
					 que+=' </div>';
					 que+='</div>';
					 que+=break_bot;
					break;
					
					case "text":
					 que=go_next+break_top;
					 que+='<div class="ask_que" >';
					 que+=que_edit;
					 que+='<div class="ask_que_tit">';
					 que+='   <h4 >'+con.que_title+'</h4>';
					 que+=' </div>';
					 que+=' <div class="ask_que_des">'+con.que_des+'</div>';
					 que+=' <div class="ask_que_list">';
					 que+=' <input type="hidden" name="go_next" id="go_next_'+con.que_id+'" value="'+con.step_turn+'" />';
					 que+="<input type='text' size='20' class='inputText' name='ask_"+con.que_id+"' size='"+con.form_size+"' style='"+input_size+"'>";
					 que+='  <div class="step_sub">'+que_sub+'</div>';
					 que+=' </div>';
					 que+='</div>';	
					 que+=break_bot;
					break;
					
					case "textarea":
					 que=go_next+break_top;
					 que+='<div class="ask_que">';
					 que+=que_edit;
					 que+='<div class="ask_que_tit">';
					 que+='   <h4 >'+con.que_title+'</h4>';
					 que+=' </div>';
					 que+=' <div class="ask_que_des">'+con.que_des+'</div>';
					 que+=' <div class="ask_que_list">';
					 que+=' <input type="hidden" name="go_next" id="go_next_'+con.que_id+'" value="'+con.step_turn+'" />';
					 que+="<textarea name='ask_"+con.que_id+"' cols='"+con.form_size+"' rows='3' class='input_86' style='height:60px;"+input_size+"' ></textarea>";
					 que+='  <div class="step_sub">'+que_sub+'</div>';
					 que+=' </div>';
					 que+='</div>';	
					 que+=break_bot;
					break;
					
					case "des":
					 que=go_next+break_top;
					 que+='<div class="ask_que" >';
					 que+=que_edit;
					 que+='<div class="ask_que_tit">';
					 que+='   <h4 ><span class="gray">'+con.que_title+'</span>  '+con.que_des+'</h4>';
					 que+=' </div>';
					 que+=' <div class="ask_que_des"></div>';
					 que+=' <div class="ask_que_list">';
					 que+=' <input type="hidden" name="go_next" id="go_next_'+con.que_id+'" value="'+con.step_turn+'" />';
 					 que+='  <div class="step_sub">'+que_sub+'</div>';
					 que+=' </div>';
					 que+='</div>';	
					 que+=break_bot;
					break;
					
					case "ask_end":
					 que=go_next;
					 que+='<div class="ask_que" id="ask_end_des">';
					 que+='	<div class="ask_que_tit">';
					 que+='	  <h4 class="deepgreen"><span class="gray">结束语：</span><span id="ask_end_des_det">'+con.que_title+'</span></h4>';
					 que+='  <div class="step_sub">'+que_sub+'</div>';
					 que+='	</div>';
					 que+='</div>';
					 
					break;
					
				}
				
				form_input="";
				form_list="";
				
				//alert(que);
				if(action=="list"){
					
					$("#que_list").append("<div id=\"ask_que_"+con.que_id+"\" >"+que+"</div><div id='step_"+con.que_id+"'></div>");
					
				}else if(action=="step"){
					
					$("#step_"+cur_id).html("<div id=\"ask_que_"+con.que_id+"\" >"+que+"</div><div id='step_"+con.que_id+"'></div>");
					$("#ask_que_"+cur_id+" .ask_que").removeClass("ask_que_hover");
					$("#ask_que_"+con.que_id+" .ask_que").addClass("ask_que_focus");
					setTimeout('$("#ask_que_'+con.que_id+' .ask_que").removeClass("ask_que_focus")',6000);
					$("#ask_que_"+con.que_id+" .step_do").stop(true,true).fadeIn();
					goto_anchor('step_to_'+con.que_id);
					ask_hover("ask_que_"+con.que_id);
				}
				
			});			
			
			if(action=="list"){ask_hover("");$("#que_list div[class='ask_que']:first").addClass("ask_que_hover").find("div[class=step_do]").stop(true,true).fadeIn();}
			
		  }else{
			que='<div class="ask_que" id="ask_que_err_'+cur_id+"_"+go_id+'" >';
			que+='	<div class="ask_que_tit">';
			que+='		<h4 class="red"><span id="_des_det">'+json.des+'</span></h4>';
			que+='	</div>';
			que+='	<div class="step_sub"><div class="step_do"><a href="javascript:void(0);" class="zPushBtn" hidefocus="true" onselectstart="return false" onClick="step_go(\''+go_id+'\',\''+cur_id+'\',\'pre\');" title="返回上一题" ><img src="/images/icons/icon400a4.gif" /><b>上一题&nbsp;</b></a><a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="goto_anchor(\'main_top\');" title="转到页面顶部" ><img src="/images/icons/icon400a9.gif" /><b>顶部&nbsp;</b></a><a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="do_submit(\'call_submit\',\'yes\');"  title="结束本次调查，提交保存结果" ><img src="/images/icons/icon004a16.gif" /><b>结束提交&nbsp;</b></a></div></div>';
			que+='</div>';
			$("#step_"+cur_id).html(que);
			$("#ask_que_err_"+cur_id+"_"+go_id+"").addClass("ask_que_focus");
			setTimeout('$("#ask_que_err_'+cur_id+"_"+go_id+'").removeClass("ask_que_focus")',6000);
			$("#ask_que_err_"+cur_id+"_"+go_id+" .step_do").stop(true,true).fadeIn();
			goto_anchor('ask_que_err_'+cur_id+'_'+go_id);
			ask_hover('ask_que_err_'+cur_id+'_'+go_id);
		  }
 		  
		} 
		
	});
	
   }

}

 
//子选项附属表单禁用、启用
function text_read(id,checked,que_id,go_next){
 	if($("#"+id).attr("type")=="radio"){
		
		$(":text[name='"+$("#"+id).attr("name")+"']").attr("disabled","disabled");
 		
	}else if($("#"+id).attr("type")=="checkbox"){
		go_next="";
		$("input[name='"+$("#"+id).attr("name")+"'][type=checkbox]").each(function(){ 
		 	if($(this).is(":checked")==true){
				go_next=$(this).attr("step_turn");
			}
		});
 	}
	$("#go_next_"+que_id).val(go_next);
	
	if(checked==true){
		$("#"+id+"_text").attr("disabled",false).removeClass("disabled").focus();
	}else{
		$("#"+id+"_text").attr("disabled","disabled");
	}
  	
}

//创建客户资料表格
function create_info_table(){
	var info_list=$("#info_list_ary").val(),show_info=$("#show_info").val();
 
 	if(show_info=="y"&&info_list!=""){
 		$("#ask_info").css("display","block");
 		var tables="",edit_div="";
		list_ary=info_list.split("#_#");
		
		edit_div="";
 		
		tables="<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size:12px\">\n";
		
		for(i=0;i<list_ary.length;i++){
 			field_ary=list_ary[i].split(",");
			if(i%3==0){
				tables+="<tr>\n";
			}
			
			tables+="<td width='10%' height='20' align='right' nowrap='nowrap'>"+field_ary[0]+"：</td>\n";
			tables+="<td width='23%' align='left' class='blue'>"+field_ary[1]+"</td>\n";
			
			if(list_ary.length==2){
				tables+="<td width='2%' ></td><td width='6%' ></td>\n";	
			}else if(list_ary.length==1){
				tables+="<td width='10%' ></td><td width='23%' ></td><td width='10%' ></td><td width='23%' ></td>";
			}
			if(i%3==2){
				tables+="</tr>\n";
			}
		}
 		tables+="</table>\n";
		$("#ask_info").css("display","block").html(edit_div+tables);
	}else{
		$("#ask_info").css("display","none");
	}
}

 
//问题列表鼠标事件
function ask_hover(que_id){
	if(que_id!=""){divs="#"+que_id+" .ask_que"}else{divs=".ask_que"}
	//alert(divs);
	$(divs).hover(
		function(){
			$(this).addClass("ask_que_hover").find("div[class=step_do]").stop(true,true).fadeIn();
		}
		,function(){
			$(this).removeClass("ask_que_hover").find("div[class=step_do]").stop(true,true).fadeOut("slow");
		}
	);	
	
}
  

function set_que_class(){
  	$("#que_list").attr("class","que_list_"+$("#postion").val());
	$("#yes_des,#no_des").css("text-align",$("#postion").val());
	$('#ask_des').css("display",$("#is_ask_des").val());
}

   
$(document).ready(function(){
 	if($("#ask_type").val()=="list"){
		que_action="list";
 	}else{
		que_action="que_first";
	}
	get_ask_que_list('list',que_action,'0','0');
	
 	create_info_table();
	set_que_class();
	if (window.screen) {   
		window.moveTo(0,0); 
		window.resizeTo(screen.availWidth,screen.availHeight);   
	}
});

</script>

</head>
<body>

<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<div class="page_main">
  <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
    <tr>
      <td align="left" valign="top" style=""> 
<?php
$campaign_id=trim($_REQUEST["campaign"]);
$vicidial_id=trim($_REQUEST["uniqueid"]);  
if($ask_id==""){
	
	echo '<script>$(document).ready(function(){$(".ask_list").html("");request_tip("问卷编号不存在，请检查后重试！",0,45000);});</script>';
	
}else{
  	
	$sql="select ask_title,ask_des,yes_des,no_des,postion,show_info,info_list,ask_type from data_ask where ask_id='".$ask_id."'";
 
 	$rows=mysqli_query($db_conn,$sql);
	$row_counts_list=mysqli_num_rows($rows);			
	if ($row_counts_list!=0) {
		
		foreach($ask_list_ary as $field_v=>$field_n){
			$_SESSION[$field_v."_".$phone_number]=trim($_REQUEST[$field_v]);
			//echo $_SESSION[$field_v."_".$phone_number]."<br>";
  		}
		
		while($rs= mysqli_fetch_array($rows)){ 
			 $ask_title=$rs["ask_title"];
			 $ask_des=str_replace("\n","<br/>",$rs["ask_des"]);
			 $yes_des=str_replace("\n","<br/>",$rs["yes_des"]);
			 $no_des=str_replace("\n","<br/>",$rs["no_des"]);
			 $postion=$rs["postion"];
			 $show_info=$rs["show_info"];
			 $info_list=$rs["info_list"];
  			 $ask_type=$rs["ask_type"];
			 
			 if($ask_des!=""){
				$is_ask_des="block";
			 }else{
				$is_ask_des="none"; 
			 }
			 
			 if($info_list!=""){
				$info_ary=explode("#_#",$info_list);
				
				if(is_array($info_ary)){
					foreach($info_ary as $list_ary){
						$info_ary_2=explode(",",$list_ary);
						
						if(is_array($info_ary_2)){
							$info_str.=$info_ary_2[0].",".$_SESSION[$info_ary_2[1]."_".$phone_number]."#_#";
						}
					}
					$info_list=rtrim($info_str,"#_#");				
				}
			 }
 		}
   		
		$counts="1";
		$des="获取成功！";
		echo '<script>$(document).ready(function(){$(document).attr("title","'.$ask_title.'");});</script>';
	}else {
		$counts="0";
		echo '<script>$(document).ready(function(){;$(".ask_list").html("");request_tip("问卷不存在，请检查后重试！",0,45000);});</script>';
		//exit();
		die();
	}
	
	mysqli_free_result($rows);
}
mysqli_close($db_conn);

?>
        <input type="hidden" name="yes_des" id="yes_des" value="<?php echo $yes_des;?>" />
        <input type="hidden" name="no_des" id="no_des" value="<?php echo $no_des;?>" />
        <input type="hidden" name="is_ask_des" id="is_ask_des" value="<?php echo $is_ask_des ?>" />
        <input type="hidden" name="ask_type" id="ask_type" value="<?php echo $ask_type;?>" />
        <input type="hidden" name="postion" id="postion" value="<?php echo $postion;?>" />
        <input type="hidden" name="info_list_ary" id="info_list_ary" value="<?php echo $info_list;?>"/>
        <input type="hidden" name="show_info" id="show_info" value="<?php echo $show_info;?>"/>
        <input type="hidden" name="is_sub" id="is_sub" value="0"/>
        
        <div class="ask_list" >
        <a id="main_top" name="main_top"></a>
          <form name="form1" id="form1" method="post" action="" onsubmit="">
          
            <input type="hidden" name="vicidial_id" id="vicidial_id" value="<?php echo $vicidial_id ?>" />
            <input type="hidden" name="phone_number" id="phone_number" value="<?php echo $phone_number ?>" />
            <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead_id ?>" />
            <input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id ?>" />
            <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id ?>" />
            <input type="hidden" name="user" id="user" value="<?php echo $user ?>" />             
            <input type="hidden" name="ask_id" id="ask_id" value="<?php echo $ask_id;?>" />
            <input type="hidden" name="is_test" id="is_test" value="y" />
            
             <div class="ask_title" id="ask_title" > <span id="ask_title_det"><?php echo $ask_title ?></span> </div>
            <div class="ask_info" id="ask_info" style="display:none" > </div>
            <div class="ask_des" id="ask_des" > <span id="ask_des_det"><?php echo $ask_des?></span> </div>
            <div id="que_list" > 
               
              
            </div>
            <div>
            	<div class="ask_cutline" id="ask_break_call_des">呼叫描述（根据需要填写）</div>
            	<div class="ask_que"> 
					 
					   
					   <div class="ask_que_list"> 
					    
					  <textarea name="ask_calldes" id="ask_calldes" rows='3' cols="80" class='input_86' style='height:60px;' ></textarea> 
					    <div class="step_sub"><div class="step_do"> <span id="pre_btu_des"> </span><a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="goto_anchor('main_top');" title="转到页面顶部" ><img src="/images/icons/icon400a9.gif" /><b>顶部&nbsp;</b></a><a href="javascript:void(0);" class="zPushBtn" hidefocus="true"  onselectstart="return false" onClick="do_submit('call_submit','yes');"  title="结束本次调查，提交保存结果" ><img src="/images/icons/icon004a16.gif" /><b>结束提交&nbsp;</b></a></div></div> 
					   </div>
					  </div>
            </div>
          </form>
        </div></td>
    </tr>
  </table>
</div>

<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
</body>
</html>
