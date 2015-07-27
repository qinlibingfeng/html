<?php
 
require("../../inc/pub_func.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>电话营销调查功能设置</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<style>
.n-extra{margin-top:10px;background:#f7f7f7;padding:16px 56px;border:1px solid #eaead8;}
.font_14{font-size:14px;}
.font_14_tit{font-size:14px;font-weight:700;}
.edit_div{position:absolute;/*border: 1px solid #999;background: #FFFFEF;width:116px;*/padding:4px 4px 4px 0;top:2px;z-index:120;height:24px;right:2px;display:none;}
.edit_div div{float:left;margin-left:4px;display:inline;}
.edit_div img{cursor:pointer;}
.ask_title{font-size:18px;font-weight:700;position:relative;text-align:center;height:50px;line-height:50px;}
.ask_info{border:1px solid #D2D2D2;background:#F6F9FE;padding:10px;/*margin-bottom:10px;*/position:relative;border-radius:3px;}
.ask_info tr td{ height:16px; line-height:16px;}
.ask_des{
	border:1px dashed #D2D2D2;
	background:#FFFFEF;
	text-align:left;
	padding:10px;
	margin-top:10px;
	position:relative;
	zoom:1;border-radius:3px;
}
.ask_que{border:2px solid #DBE6EF;padding:10px 30px;margin-top:10px;line-height:160%;position:relative;border-radius:3px;}
.des{border-bottom:1px dashed #999;margin-bottom:6px;padding-bottom:6px;color:#f60;}
.tit{margin-bottom:4px;color:#0C6AC0;padding-top:6px;padding-bottom:4px;}
.ask_que li,.ask_que_hover li{line-height:24px;word-wrap:break-word;text-align:left;margin-right:4px;}
.ask_que_hover,.ask_que_focus{border:2px solid #999;background:#FFFFE1;box-shadow: 0 1px 3px rgba(0,0,0,0.4);}
.ask_que_hover .tit,.ask_que_focus .tit{color:#329900;}
.ask_que_hover .list,.ask_que_focus .list{color:#000;}
.ask_cutline{border: 1px solid #D2D2D2;background: #E4EDFC;margin-top: 10px;padding:2px 6px 2px 6px;*padding:4px 6px 2px 6px;font-size: 12px;font-weight: bold;position: relative;zoom:1;color:#666;/*#329900*/text-align: left;}
.que_list_left{text-align:left;}
.que_list_center{text-align:center;}
.que_list_center ul{width:56%;margin-left:auto;margin-right:auto;}
.que_list_center .step_do{margin-right:auto;margin-left:auto;}
.land{width:70%;}
.land li{float:left;display:block;line-height:24px}
.port{width:40%;}
.port li{float:left;width:96%;display:block;line-height:24px;}
.port li input,.land li input{margin-top:-4px;+margin-top:-2px;}
.ask_list{position:relative;margin-right:auto;margin-left:auto;word-break:break-all;word-wrap:break-word;}
.list{color:#333;overflow:auto;}
.step_sub{padding-top:6px;margin-top:6px;border-top:1px dotted #999;height:26px;}
.step_do{display:none;font-size:12px;width:306px;z-index:120;}
.deepgreen{color:#329900;}
.placeHolder{border:dashed 2px gray;margin-top:10px;border-radius:3px;}
.drags{zoom:1;+margin-left:-16px;_margin-left:-16px;}
.o_icos span{background:url(/images/icons/up_down.gif) no-repeat 2px top;display:block;height:14px;width:16px;float:left;margin-top:-2px;cursor:pointer;}
.o_icos .add{background-position:-78px top;}
.o_icos .drag{background-position:-113px top;width:14px;}
.o_icos .up_e{background-position:-30px top;}
.o_icos .up_d{background-position:-63px top;}
.o_icos .dw_e{background-position:-14px top;}
.o_icos .dw_d{background-position:-47px top;}

#que_order_list{width:488px;position:absolute;background:url(/images/shadow_.png) no-repeat bottom right!important;background:url(/images/shadow_6.png) no-repeat bottom right;}
#que_order_list .tip{width:486px;margin-right:auto;margin-left:auto;border:1px solid #6B97C1;position:relative;left:-4px;top:-4px;}
#que_order_list .tit{background:url(/images/que_tip_bg.jpg) repeat-x;line-height:16px;height:16px;color:#FFF;padding-left:10px;position:relative;margin-bottom:0;cursor:move;font-weight:bold;}
#que_order_list .tit a,#que_order_list .tit a:visited{width:34px;height:19px;background:url(/images/que_tip_close.jpg) no-repeat 0 0;display:inline;position:absolute;right:2px;top:0px;}
#que_order_list .tit a:hover{background-position:0px -19px;}
#que_order_list .main {padding:4px;height:300px;background:#FFF;overflow-x:hidden;*float:left;}
#que_order_list .bot{line-height:24px;background:#F7F7F7;text-align:right;height:24px;border-top:1px solid #F0F0F0;padding-top:0px;padding-bottom:2px;padding-right:4px;}
.que_tit{width:270px;height:20px;overflow:hidden;white-space:nowrap;-o-text-overflow:ellipsis;text-overflow:ellipsis;}
.que_tit:after{content:"...";}
.page_nav{z-index:10;} 
#ask_menu{}
.ask_menu_layer{margin-left:0px;margin-top:0px;z-index:2;background:url(/images/ask_menu_bg.png) repeat-x bottom;_background:none!important;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/images/ask_menu_bg.png',sizingMethod='scale');top:0px;left:0px;width:100%;position: fixed;}
/*.ask_menu_layer_2{margin-top:8px;}margin-left:8px;margin-top:8px;left:0px;*/
.ask_end{font-size:12px;color:#888;font-weight:normal}
.ask_type{color:#AA8300;font-size:12px;font-weight:normal}

</style>
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/jquery.dragsort.js"></script>
<script src="/js/clipboard.js"></script>
<script>
 
function do_set_question(action,tits,que_type,height){
	var diag =new Dialog("do_set_question");
	diag.Width = 780;
	diag.Height = height;	
	diag.Title = tits;
 	diag.URL = "/document/ask_flow/list.php?ask_id="+$("#ask_id").val()+"&tits="+encodeURIComponent(tits)+"&action="+action+"&que_type="+que_type;
	diag.OKEvent = set_que;
	diag.show();
}
 
function set_que(){
	Zd_DW.do_set_que();
}
  
//获取问题列表
function get_ask_que_list(action,do_actions,que_id){
	
  if($("#ask_id").val()!=""){	
  	var datas="action=get_ask_que_list&ask_id="+$("#ask_id").val()+"&do_actions="+do_actions+"&que_id="+que_id+"&go_tit=y"+times;
	//alert(datas);
  	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
  		  if(json.counts=="1"){
    		
 			$.each(json.datalist, function(index,con){
				
				var que="",form_input="",form_list="",breaks="",break_top="",break_bot="",que_edit="",input_size="",is_end="",status_name="",to_que="",f_to_que="";
				
				if(con.form_size=="0"){input_size="width:70%";}
				
				que_edit='<div class="edit_div">';
                que_edit+='  <div ><img src="/images/icons/ask_edit.gif" alt="修改本项问题设置" onclick="ask_set(\''+con.que_id+'\',\''+con.que_type+'\',\'edit\');" /> </div>';
                que_edit+='  <div ><img src="/images/icons/ask_del.gif" alt="删除本项问题" onclick="ask_set(\''+con.que_id+'\',\''+con.que_type+'\',\'del\');" /></div>';
                que_edit+='</div>';
 				
				if(con.is_break=="y"){
					
					if(con.break_pos=="top"){
						break_top='<div class="ask_cutline" id="ask_break_'+con.que_id+'">'+con.break_des+'</div>';
					}else{
						break_bot='<div class="ask_cutline" id="ask_break_'+con.que_id+'">'+con.break_des+'</div>';
					}
 				}
				if(con.is_end=="y"){
					is_end='<span class="ask_end"> 【结束】</span> ';
				}
				
				
				if(con.is_to=="y"){
					if(con.to_que=="跳转目标错误"){
						to_que=" <span class='red font_12'>To:【"+con.to_que+"】</span>";
					}else{
						to_que=" <span class='gray font_12'>To:【"+con.to_que+"】</span>";
					}
				}
			
				
				status_name=' <span class="ask_type">【'+con.status_name+'】</span> ';
				
 				switch(con.que_type){
					case "radio":
					 que=break_top;	
					 que+='<div class="ask_que" >';
					 que+=que_edit;
					 que+='<div class="tit">';
					 que+='   <h4 >'+con.que_title+status_name+is_end+'</h4>';
					 que+=' </div>';
					 que+=' <div class="des">'+con.que_des+'</div>';
 					 que+=' <div class="list">';
			 		 que+='<ul class="'+con.postion+'">';
					 $.each(con.form_list, function(f_i,con_f){
 						 if(con_f.do_func=="y"){
							 form_input="&nbsp;<input type='text' size='20' class='inputText' name='ask_"+con.que_id+"' id='ask_"+con_f.form_id+"_"+f_i+"_text' disabled />";
						 }else{
							 form_input="";
						 }
						 
						 if(con_f.to_que=="跳转目标错误"){
							 f_to_que=" <span class='red'>To:【"+con_f.to_que+"】</span>";
						 }else{
							 f_to_que=" <span class='gray'>To:【"+con_f.to_que+"】</span>";
						 }
						 
						 form_list+='<li><label for="ask_'+con_f.form_id+"_"+f_i+'"><input name="ask_'+con.que_id+'" id="ask_'+con_f.form_id+"_"+f_i+'" type="radio" value="'+con_f.form_value+'" onclick="text_read(this.id,this.checked)"/>'+con_f.form_value+f_to_que+'</label>'+form_input+'</li>';
					 
					 });
					 que+=form_list;
					 que+='  </ul>';
 					 que+=' </div>';
					 que+='</div>';	
					 que+=break_bot;
					 
					break;
					
					case "checkbox":
					  
					 que=break_top;
					 que+='<div class="ask_que" >';
					 que+=que_edit;
					 que+='<div class="tit">';
					 que+='   <h4 >'+con.que_title+status_name+is_end+'</h4>';
					 que+=' </div>';
					 que+=' <div class="des">'+con.que_des+'</div>';
 					 que+=' <div class="list">';
					 que+='<ul class="'+con.postion+'">';
					 $.each(con.form_list, function(f_i,con_f){
						 if(con_f.do_func=="y"){
							 form_input="&nbsp;<input type='text' size='20' class='inputText' name='ask_"+con.que_id+"' id='ask_"+con_f.form_id+"_"+f_i+"_text' disabled />";
						 }else{
							 form_input="";
						 }
 					
						 if(con_f.to_que=="跳转目标错误"){
							 f_to_que=" <span class='red'>To:【"+con_f.to_que+"】</span>";
						 }else{
							 f_to_que=" <span class='gray'>To:【"+con_f.to_que+"】</span>";
						 }
						 
						 form_list+='<li><label for="ask_'+con_f.form_id+"_"+f_i+'"><input name="ask_'+con.que_id+'" id="ask_'+con_f.form_id+"_"+f_i+'" type="checkbox" value="'+con_f.form_value+'" onclick="text_read(this.id,this.checked)" />'+con_f.form_value+f_to_que+'</label>'+form_input+'</li>';
					 
					 });
 					 que+=form_list;
					 que+='  </ul>';
 					 que+=' </div>';
					 que+='</div>';
					 que+=break_bot;
					break;
 					
					case "text":
					 
					 que=break_top;
					 que+='<div class="ask_que" >';
					 que+=que_edit;
					 que+='<div class="tit">';
					 que+='   <h4 >'+con.que_title+status_name+is_end+'</h4>';
					 que+=' </div>';
					 que+=' <div class="des">'+con.que_des+'</div>';
 					 que+=' <div class="list">';
 					 que+="<input type='text' size='20' class='inputText' name='ask_"+con.que_id+"' size='"+con.form_size+"' style='"+input_size+"'>"+to_que;
 					 que+=' </div>';
					 que+='</div>';	
					 que+=break_bot;
					break;
   					
					case "textarea":
					 que=break_top;
					 que+='<div class="ask_que">';
					 que+=que_edit;
					 que+='<div class="tit">';
					 que+='   <h4 >'+con.que_title+status_name+is_end+'</h4>';
					 que+=' </div>';
					 que+=' <div class="des">'+con.que_des+'</div>';
 					 que+=' <div class="list">';
 					 que+="<textarea name='ask_"+con.que_id+"' cols='"+con.form_size+"' rows='3' class='input_86' style='height:60px;"+input_size+"' ></textarea>"+to_que;
 					 que+=' </div>';
					 que+='</div>';	
					 que+=break_bot;
					break;
					
					case "des":
					 que=break_top;
					 que+='<div class="ask_que" >';
					 que+=que_edit;
					 que+='<div class="tit">';
					 que+='   <h4 ><span class="gray">'+con.que_title+'</span> '+con.que_des+status_name+is_end+to_que+'</h4>';
					 que+=' </div>';
					 que+=' <div class="des"></div>';
 					 //que+=' <div class="list"></div>';
					 que+='</div>';
					 que+=break_bot;
					break;
    					
 				}
				form_input="";
				form_list="";
				
				if(action=="list"){
					
 					$("#que_list").append("<li class='drags' id='ask_que_"+con.que_id+"' que_type='"+con.que_type+"'  ondblclick=\"ask_set('"+con.que_id+"','"+con.que_type+"','edit');\" onselectstart='return false' >"+que+"</li>");
 					
				}else if(action=="edit"){
					
					$("#ask_que_"+con.que_id).html(que).attr("que_type",con.que_type);
					$("#ask_que_"+con.que_id+" .ask_que").addClass("ask_que_focus");
					setTimeout('$("#ask_que_'+con.que_id+' .ask_que").removeClass("ask_que_focus")',6000);
					//ask_hover(con.que_id);
					$("#que_list_"+con.que_id+" td:eq(1)").html("<div class='que_tit green'>"+con.que_title+"</div>");
 					
				}else if(action=="add"){
 
  					$("#que_list").append("<li class='drags' id='ask_que_"+con.que_id+"' que_type='"+con.que_type+"'   ondblclick=\"ask_set('"+con.que_id+"','"+con.que_type+"','edit');\" ><a name='step_to_"+con.que_id+"' id='step_to_"+con.que_id+"'></a>"+que+"</li>");
					$("#ask_que_"+con.que_id+" .ask_que").addClass("ask_que_focus");
					setTimeout('$("#ask_que_'+con.que_id+' .ask_que").removeClass("ask_que_focus")',6000);
					goto_anchor("step_to_"+con.que_id);
 				}
				ask_hover(con.que_id);
 			});
			
			//if(action=="list"){ask_hover("");}
			
 		  } 
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	
  }

}

//子选项附属表单禁用、启用
function text_read(id,checked){
	if($("#"+id).attr("type")=="radio"){
		$(":text[name='"+$("#"+id).attr("name")+"']").attr("disabled","disabled");
	}
	
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
		
		edit_div="<div class=\"edit_div\"><div ><img src=\"/images/icons/ask_edit.gif\" alt=\"修改本项问题设置\" ondblclick=\"ask_set('0','ask_info','edit');\" /> </div></div>";
 		
		tables="<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size:12px\">\n";
		
		for(i=0;i<list_ary.length;i++){
 			field_ary=list_ary[i].split(",");
			if(i%3==0){
				tables+="<tr>\n";
			}
			
			tables+="<td width='10%' height='20' align='right' nowrap='nowrap'>"+field_ary[0]+"：</td>\n";
			tables+="<td width='23%' align='left' class='blue'>"+field_ary[0]+"</td>\n";
			
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

//问题修改、删除
function ask_set(que_id,que_type,do_,do_from){
	var tits,action,width,height;

	if(do_=="edit"){
	
		switch (que_type){
			case "ask_title":
				tits="修改问卷标题";
				action="edit_title";
				width=620;
				height=294;
			break;
			
			case "ask_des":
				tits="修改问卷描述";
				action="edit_ask_des";
				width=620;
				height=294;
			break;
			
			case "yes_des":
				tits="修改成功结束语";
				action="edit_yes_des";
				width=620;
				height=294;
			break;
	
			case "no_des":
				tits="修改失败结束语";
				action="edit_no_des";
				width=620;
				height=294;
			break;
	
			case "ask_info":
				tits="修改客户资料设置";
				action="edit_info_list";
				width=800;
				height=300;
			break;
			
			case "ask":
				tits="修改问卷设置";
				action="edit_ask";
				width=800;
				height=378;
			break;
			
			case "radio":
				tits="修改问题步骤";
				action="edit_que_dx_fx";
				width=800;
				height=428;
			break;
			
			case "checkbox":
				tits="修改问题步骤";
				action="edit_que_dx_fx";
				width=800;
				height=428;
			break;
			
			case "text":
				tits="修改问题步骤";
				action="edit_que_text";
				width=800;
				height=428;
			break;
			
			case "textarea":
				tits="修改问题步骤";
				action="edit_que_text";
				width=800;
				height=428;
			break;
			
			case "com":
				tits="修改问题步骤";
				action="edit_que_com";
				width=800;
				height=428;
			break;
			
			case "des":
				tits="修改问题步骤";
				action="edit_que_des";
				width=800;
				height=260;
			break;
  		}
  		
		var diag =new Dialog("do_set_edit_que");
		diag.Width = width;
		diag.Height = height;	
		diag.Title = tits;
		diag.URL = "/document/ask_flow/list.php?ask_id="+$("#ask_id").val()+"&que_id="+que_id+"&tits="+encodeURIComponent(tits)+"&action="+action+"&que_type="+que_type;
 		diag.OKEvent = set_edit_que;
		diag.show();
		
 	}else{
		
		if(confirm("删除后不可恢复，您确定要删除本项问题吗？！")){
			
			$('#load').show();
			var datas="action=del_ask&do_actions=que&que_id="+que_id+times+"&"+$("#form1").serialize();
			//alert(datas);
			$.ajax({
				 
				url: "send.php",
				data:datas,
				
				beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
				complete :function(){$('#load').hide('100');},
				success: function(json){ 
				
 				   request_tip(json.des,json.counts);
				   if(json.counts=="1"){
					   $('#ask_que_'+que_id).fadeOut("slow").remove();
					   if(do_from=="list_order"){
							$('#que_list_'+que_id).remove();
							
							$("#datatable tbody tr").removeClass("alt").find(".up_d").addClass("up_e").removeClass("up_d");
							$("#datatable tbody tr").find(".dw_d").addClass("dw_e").removeClass("dw_d");
							$("#datatable tbody tr:first").find(".up_e").addClass("up_d").removeClass("up_e").unbind("click");
							$("#datatable tbody tr:last").find(".dw_e").addClass("dw_d").removeClass("dw_e").unbind("click");
							$("#datatable tbody tr:odd").addClass("alt");
							$("#datatable tbody tr").map(function(){
								$(this).find("td:first").html($(this).index()+1);
							});
							
							if($("#datatable tbody tr").length>10){
								$("#que_order_list .main").css({"overflow-y":"scroll"});
							}else{
								$("#que_order_list .main").css({"overflow-y":"hidden"});
							}
  					   }
				   }else{
						alert(json.des);
 				   }
				   
 					
				},error:function(XMLHttpRequest,textStatus ){
					alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
				}
			});
			
		}else{
			return false;
		}
		
	}
 	
}
 
function set_edit_que(){
	Zd_DW.do_edit_que();
}	
  
//问题列表鼠标事件
function ask_hover(que_id){
	if(que_id!=""){divs="#ask_que_"+que_id+" .ask_que"}else{divs=".ask_que"}
	//alert(divs);
	$(divs).hover(
		function(){
			$(this).addClass("ask_que_hover").find("div[class=edit_div]").stop(true,true).fadeIn();
		}
		,function(){
			$(this).removeClass("ask_que_hover").find("div[class=edit_div]").stop(true,true).fadeOut("slow");
		}
	);	
	
}

//设置问题Class 
function set_que_class(){
  	$("#que_list").attr("class","que_list_"+$("#postion").val());
	$("#yes_des,#no_des").css("text-align",$("#postion").val());
	$('#ask_des').css("display",$("#is_ask_des").val());
}
//复制引用地址
function copySuccess(){
	$("#copy_url").fadeIn("slow");
 	setTimeout("$('#copy_url').fadeOut('slow');",5000);
 	alert("该问卷引用地址已成功复制到剪贴板！\n---------------------------------------\n"+$("#url").val()+"\n---------------------------------------");
}
	 
 
//保存排序
function saveOrder(do_){
	var order="";
	$("#que_list .drags").map(function(i) {
		i=i+1;
		que_id=$(this).attr("id").replace("ask_que_","");
		order+=que_id+"_"+i+"|";
 	});
 	if (order!=""){order=order.substr(0,order.length-1)}
 	
	$('#load').show();
	var datas="action=set_que&do_actions=order&order_list="+order+times;
	
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
		   request_tip(json.des,json.counts); 
		   if(json.counts=="1"&&do_=="tip"){
		   		$("#que_order_list").hide();
		   }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
 	
};

//执行问题列表排序
function do_que_order(que_id,order){
	
	var tr_this = $("#que_list_"+que_id);
	var li_this = $("#ask_que_"+que_id);

	if(order=="del"){
		ask_set(que_id,"order","del","list_order");
	}else{
		
		if(order=="up"){
			var tr_up = tr_this.prev();
			var li_up = li_this.prev();
			$(tr_up).before(tr_this);
			$(li_up).before(li_this);
		}else if(order=="dw"){
			var tr_down = tr_this.next();
			var li_down = li_this.next();
			$(tr_down).after(tr_this);
			$(li_down).after(li_this);
		} 
		
		$("#datatable tbody tr").find(".up_d").addClass("up_e").removeClass("up_d");
		$("#datatable tbody tr").find(".dw_d").addClass("dw_e").removeClass("dw_d");
		$("#datatable tbody tr:first").find(".up_e").addClass("up_d").removeClass("up_e").unbind("click");
		$("#datatable tbody tr:last").find(".dw_e").addClass("dw_d").removeClass("dw_e").unbind("click");
	 
		$("#datatable tbody tr").removeClass("alt").map(function(){
			$(this).find("td:first").html($(this).index()+1);
		});
		$("#datatable tbody tr:odd").addClass("alt");
		setTimeout("$('#datatable tbody tr').removeClass('over');",1500);
		
	}
	
}

//获取问题步骤排序列表
function get_que_order_list(){
 	
	var tr="",table="";
	$("#que_order_list").remove();
 	table='<div id="que_order_list"><div class="tip"><div class="tit" drag="y">问题步骤排序<a href="javascript:void(0)" onclick="javascript:$(\'#que_order_list\').hide();" title="关闭"></a></div><div class="main"><table border="0" align="center" cellpadding="2" cellspacing="0" class="dataTable" id="datatable" style="margin-top:2px;width:100%"><thead ><tr align="left" class="dataHead"><td width="28">序号</td><td width="270">问题</td><td style="width:54px;+width:60px">类型</td><td>操作</td></tr></thead><tbody ></tbody></table></div><div class="bot"><a class="zInputBtn" hidefocus="true" href="javascript:void(0);"><input type="button" value="确 定" onclick="saveOrder(\'tip\')" class="inputButton"/></a>  <a class="zInputBtn" hidefocus="true" href="javascript:void(0);"><input type="button" value="取 消" onclick="javascript:$(\'#que_order_list\').hide();" class="inputButton"/></a></div></div></div>';
	$("body").append(table);
 	
	$("#que_list .drags").map(function(i){
   		i=i+1;
		switch($(this).attr("que_type")){
			case "radio":
				que_type="单选题";
			break;
			case "checkbox":
				que_type="多选题";
			break;
			case "text":
				que_type="填空题";
			break;
			case "textarea":
				que_type="问答题";
			break;
			case "com":
				que_type="组合选择题";
			break;
			case "des":
				que_type="描述题";
			break;
			
			default:
				que_type="其他";
		}
		que_id=$(this).attr("id").replace("ask_que_","");
		
		tr="<tr align='left' id='que_list_"+que_id+"' que_id='"+que_id+"' ondblclick=\"ask_set('"+que_id+"','"+$(this).attr("que_type")+"','edit');\" title='双击修改本问题步骤'>";
        tr+="	<td>"+i+"</td>";
        tr+="	<td><div class='que_tit'>"+$(this).find("h4").html()+"</div></td>";
        tr+="	<td>"+que_type+"</td>";
        tr+="	<td class='o_icos'><span class='up_e' onclick=\"do_que_order('"+que_id+"','up')\"></span><span class='dw_e' onclick=\"do_que_order('"+que_id+"','dw')\"></span><span onclick=\"do_que_order('"+que_id+"','del')\"></span></td>";
        tr+="</tr>";
		
		$("#datatable tbody").append(tr);
		
	});
	$("#datatable tbody tr:first").find(".up_e").addClass("up_d").removeClass("up_e").unbind("click");
	$("#datatable tbody tr:last").find(".dw_e").addClass("dw_d").removeClass("dw_e").unbind("click");
  
	$("#que_order_list").css({
		left: ($(document).width()-$('#que_order_list').outerWidth())/2+"px",
		top: ($(window).height()-$("#que_order_list").outerHeight())/2 + $(document).scrollTop()+"px"
	});
	if($("#datatable tbody tr").length>10){
		$("#que_order_list .main").css({"overflow-y":"scroll"});
 	}else{
		$("#que_order_list .main").css({"overflow-y":"hidden"});
	}
	drag_("#que_order_list");
 	d_table_i();
}

//保存问卷设置
function save_ask(){
	Dialog.close();
	_DialogInstance.ParentWindow.save_ask($("#ask_id").val());
}
//取消、关闭
function do_set_can_ask(){
	Dialog.close();
	_DialogInstance.ParentWindow.can_ask();
}

function result_ask(ask_id){
	var diag =new Dialog("result_ask_"+ask_id);
    diag.Width = $(window).width()+30;
    diag.Height = $(window).height();
 	diag.Title = "问卷详单查询";
	diag.URL = '/document/ask_flow/ask_list.php?ask_id='+ask_id+'&tits='+encodeURIComponent("问卷详单查询");
	diag.show();
 	diag.OKButton.hide();
	diag.CancelButton.value="关 闭";
}
 
function getScrollY() {
    scrOfY = 0;
    if( typeof( window.pageYOffset ) == "number" ) {
        scrOfY = window.pageYOffset;
    } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
        scrOfY = document.body.scrollTop;
    } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
        scrOfY = document.documentElement.scrollTop;
    }
    return scrOfY;
}

$.fn.extend({
    scrollFollow: function(d) {
        d = d || {};
        d.container = d.container || $(this).parent();
        d.bottomObj = d.bottomObj || '';
        d.bottomMargin = d.bottomMargin || 0;
        d.marginTop = d.marginTop || 0;
        d.marginBottom = d.marginBottom || 0;
        d.zindex = d.zindex || 9999;
        var e = $(window);
        var f = $(this);
        if (f.length <= 0) {
            return false
        }
        var g = f.position().top;
        var h = d.container.height();
        var i = f.css("position");
        if (d.bottomObj == '' || $(d.bottomObj).length <= 0) {
            var j = false
        } else {
            var j = true
        }
        e.scroll(function(a) {
            var b = f.height();
            if (f.css("position") == i) {
                g = f.position().top
            }
            scrollTop = e.scrollTop();
            topPosition = Math.max(0, g - scrollTop);
            if (j == true) {
                var c = $(d.bottomObj).position().top - d.marginBottom - d.marginTop;
                topPosition = Math.min(topPosition, (c - scrollTop) - b)
            }
            if (scrollTop > g) {
                if (j == true && (g + b > c)) {
                    f.css({
                        position: i,
                        top: g
                    })
                } else {
                    if (window.XMLHttpRequest) {
                        f.css({
                            position: "fixed",
                            top: topPosition + d.marginTop,
                            'z-index': d.zindex
                        })
                    } else {
                        f.css({
                            position: "absolute",
                            top: scrollTop + topPosition + d.marginTop + 'px',
                            'z-index': d.zindex
                        })
                    }
                }
            } else {
                f.css({
                    position: i,
                    top: g
                })
            }
        });
		 
        return this
    }
});
 
$(document).ready(function(){
 	 
  	get_ask_que_list('list','ask','0');
 	create_info_table();
		 
	$("li.ask_hover").hover(
		function(){
			$(this).find("div[class=edit_div]").stop(true,true).fadeIn("slow");
   		}
		,function(){
			$(this).find("div[class=edit_div]").stop(true,true).fadeOut("slow");
 		}
	 );
  	
	$("div [class^='ask_']").not($("#yes_des,#no_des")[0]).attr("title","拖动修改问题显示顺序，双击修改本项设置");
	$("#yes_des,#no_des,#ask_title,#ask_des,#ask_info").attr("title","双击修改本项设置");
 	set_que_class();
   	
	$("#que_list").dragsort({
		dragSelector: ".drags",
		dragBetween: true,
		dragEnd: saveOrder,
		placeHolderTemplate: "<li class='placeHolder'></li>"
	});
   	
 	var urls=$("#url").val();
	var flashvars = {
		content: encodeURIComponent(urls),
		uri: '/images/copy_url.png'
	};
	var params = {
		wmode: "transparent",
		allowScriptAccess: "always"
	};
	swfobject.embedSWF("/js/clipboard.swf","load_swf","59","24","9.0.0",null,flashvars,params);
 	
	/*$(window).scroll(function(event){
		if($(window).scrollTop()>0){
  			
			$("#ask_menu").addClass("ask_menu_layer").floatdiv({
				left: "0px",
				top: "0px"
			}).css({"margin-top":"0px","margin-left":"0px","width":$(document).width()+"px"});
 			
		}else{
			$("#ask_menu").removeClass("ask_menu_layer").css({"margin-top":"8px","margin-left":"8px"});
			$("#page_main").css({"padding-top":"26px"});
		}
	}); */
	
	/*$("#ask_menu").scrollFollow({
        marginTop:0,
        marginLeft:0,
		zindex:150
    });*/
     
	/*$(window).scroll(function() {
 		 
		if(getScrollY()>0){
 			$("#ask_menu").removeClass("ask_menu_layer_2").addClass("ask_menu_layer");
 		}else{
			$("#ask_menu").removeClass("ask_menu_layer").addClass("ask_menu_layer_2");
			$("#page_main").css({"padding-top":"26px"});
		}
    });*/
	
});
</script>

</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>

<div class="page_main" id="page_main" style="padding-top:40px">
<div id="ask_menu" class="ask_menu_layer">
<div style="padding:8px 0 12px 8px;">
<?php 
	$url="http://".$_SERVER["HTTP_HOST"]."/document/ask_flow/ask_sub.php?ask_id=".$ask_id;
	$urls="<a href=\"".$url."\" target=\"_blank\" style=\"color:#fff\">".$url."</a>";
?>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" ><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false'  onclick="do_set_question('add_que_dx_fx','新建单选题','radio',360);" title="新建单选题"><img src="/images/icons/radio_ed.gif" /><b>单选题&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' title="新建多选题" onclick="do_set_question('add_que_dx_fx','新建多选题','checkbox',366);"><img src="/images/icons/checked_20.gif" align="absmiddle" /><b>多选题&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false'  title="新建填空题" onclick="do_set_question('add_que_wd','新建填空题','text',326);"><img src="/images/icons/icon033a17.gif" /><b>填空题&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false'   onclick="do_set_question('add_que_wd','新建问答题','textarea',326);" title="新建问答题"><img src="/images/icons/icon034a2.gif" /><b>问答题&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false'   onclick="do_set_question('add_que_des','新建描述题','des',270);" title="新建描述题"><img src="/images/icons/icon034a17.gif" /><b>描述题&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn zPushBtnDisabled' hidefocus='true' tabindex='-1' onselectstart='return false'  title="新建组合选择题" onclick="javascript:void(0);"><img src="/images/icons/icon010a1.gif" /><b>组合选择题&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false'  onclick="ask_set('0','ask','edit');" title="修改问卷全局设置"><img src="/images/icons/icon042a14.gif" /><b>修改&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false'  onclick="get_que_order_list();" title="修改问题步骤排序"><img src="/images/icons/icon042a13.gif" /><b>排序&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false'  onclick="save_ask();" title="保存问卷选项"><img src="/images/icons/icon042a16.gif" /><b>保存&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' onclick="result_ask('<?php echo $ask_id ?>');" title="导出问卷结果详单"><img src="/images/icons/icon042a20.gif"  /><b>详单&nbsp;</b></a><a href='<?php echo "http://".$_SERVER["HTTP_HOST"]."/document/ask_flow/ask_view.php?ask_id=".$ask_id ?>'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' target="_blank" title="预览问卷选项"><img src="/images/icons/icon042a15.gif" /><b>预览&nbsp;</b></a><span id="load_swf"></span><span id="pos_test"></span></td>
      </tr>
    </table>
    <div id="copy_url" style="display:none"> 引用地址：<span style="display:inline-block;margin-top:6px;height:20px;line-height:20px; padding-left:4px;padding-right:4px" class="green_layer" title="复制引用绿色部分地址">
    <?php 
		echo $urls;
     ?>
     <input type="hidden" name="url" id="url" value="<?php echo $url ?>" />
    </span>
    </div>
    </div>
</div>
  <table width="99%" border="0" align="center" cellpadding="0" class="blocktable">
    <tr>
      <td align="left" valign="top" >
       	
<?php
 
if($ask_id==""){
	
	echo '<script>$(document).ready(function(){$(".ask_list").html("");Dialog.alert("问卷编号不存在，请检查后重试！");});</script>';
	
}else{
	
	$sql="select ask_title,ask_des,yes_des,no_des,postion,show_info,info_list,ask_type from data_ask where ask_id='".$ask_id."'";
 
 	$rows=mysqli_query($db_conn,$sql);
	$row_counts_list=mysqli_num_rows($rows);			
	if ($row_counts_list!=0) {
		while($rs= mysqli_fetch_array($rows)){ 
			 $ask_title=$rs["ask_title"];
			 $ask_des=$rs["ask_des"];
			 $yes_des=$rs["yes_des"];
			 $no_des=$rs["no_des"];
			 $postion=$rs["postion"];
			 $show_info=$rs["show_info"];
			 $info_list=$rs["info_list"];
  			 $ask_type=$rs["ask_type"];
			 
			 if($ask_des!=""){
				$is_ask_des="block";
			 }else{
				$is_ask_des="none"; 
			 }
			 
			 //if($info_list!=""){
				//$info_list_ary=explode("#_#",$info_list);
			 //}
 		}
		 
		$counts="1";
		$des="获取成功！";
	}else {
		$counts="0";
		$des="问卷不存在，请检查后重试！";
		echo '<script>$(document).ready(function(){$(".ask_list").html("");Dialog.alert("'.$des.'");});</script>';
		exit();
	}
	
	mysqli_free_result($rows);
}
mysqli_close($db_conn);

?>
        <input type="hidden" name="is_ask_des" id="is_ask_des" value="<?php echo $is_ask_des ?>" />
        <div class="ask_list" >
          <form name="form1" id="form1" method="post" action="" onsubmit="">
            <input type="hidden" name="ask_id" id="ask_id" value="<?php echo $ask_id;?>" />
            <input type="hidden" name="ask_type" id="ask_type" value="<?php echo $ask_type;?>" />
            <input type="hidden" name="postion" id="postion" value="<?php echo $postion;?>" />
            <input name="info_list_ary" type="hidden" id="info_list_ary" value="<?php echo $info_list;?>"/>
            <input name="show_info" type="hidden" id="show_info" value="<?php echo $show_info;?>"/>
            <div class="ask_title ask_hover" id="ask_title" ondblclick="ask_set('0','ask_title','edit');">
              <div class="edit_div">
                <div><img src="/images/icons/ask_edit.gif" alt="修改本项问题设置" onclick="ask_set('0','ask_title','edit');" /></div>
              </div>
              <span id="ask_title_det"><?php echo $ask_title ?></span> 
            </div>
              
            <div class="ask_info ask_hover" id="ask_info" style="display:none" onclick="ask_set('0','ask_info','edit');"> </div>
            <div class="ask_des" id="ask_des" ondblclick="ask_set('0','ask_des','edit');">
              <div class="edit_div" >
                <div ><img src="/images/icons/ask_edit.gif" alt="修改本项问题设置" onclick="ask_set('0','ask_des','edit');" /> </div>
              </div>
              <span id="ask_des_det"><?php echo str_replace("\n","<br/>",$ask_des)?></span>
            </div>
            <div id="que_list" ></div>
            <div class="ask_que ask_hover" id="yes_des" ondblclick="ask_set('0','yes_des','edit');">
              <div class="edit_div" >
                <div ><img src="/images/icons/ask_edit.gif" alt="修改本项问题设置" onclick="ask_set('0','yes_des','edit');" /> </div>
              </div>
              <div class="tit">
                <h4 class="deepgreen"><span class="gray">成功结束语：</span><span id="yes_des_det"><?php echo str_replace("\n","<br/>",$yes_des)?></span></h4>
              </div>
            </div>
            <div class="ask_que ask_hover" id="no_des" ondblclick="ask_set('0','no_des','edit');">
              <div class="edit_div" >
                <div ><img src="/images/icons/ask_edit.gif" alt="修改本项问题设置" onclick="ask_set('0','no_des','edit');" /> </div>
              </div>
              <div class="tit">
                <h4 class="deepgreen"><span class="gray">失败结束语：</span><span id="no_des_det"><?php echo str_replace("\n","<br/>",$no_des)?></span></h4>
              </div>
            </div>
          </form>
      </div></td>
    </tr>
  </table>
</div>
<br />
<br />

 



 
</body>
</html>
